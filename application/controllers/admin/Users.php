<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_admin_model',"usersModel");
	}

	public function index()
	{
		// parent::headerTitle("Pengguna");
		parent::pageTitle("Pengguna");
		$breadcrumbs = array(
								"Settings" => "#",
								"Pengguna"	=> "",
							);
		parent::breadcrumbs($breadcrumbs);

		parent::viewAdmin();
	}

	public function ajax_list()
	{
		if ($this->isPost()) {
			$columns = array(null,'full_name','email','level');
			$search = array('full_name','email','level');
			$where = array("status" => 1);
			if ($this->user->level == "operator" || $this->user->level == "admin") {
				$where["level !="] = "superadmin"; 
			}
			// $where = false;
			$result = $this->usersModel->findDataTable($where,false,$columns,$search);
			$data = array();
			foreach ($result as $item) {
				$item->no = "<b style='color:black;'>".$item->no."</b>";
				$btnAction = "";
				if ($this->user->level == "operator") {
					if ($this->user->id == $item->id) {
						$btnAction .= '<button type="button" class="btn btn-xs btn-warning" onclick=editUser("'.$item->id.'")><i class="fas fa-edit"></i> Edit</button> &emsp;';
					} else {
						$btnAction = "-";
					}
				} else if ($this->user->level == "admin") {
					if ($this->user->id == $item->id) {
						$btnAction .= '<button type="button" class="btn btn-xs btn-warning" onclick=editUser("'.$item->id.'")><i class="fas fa-edit"></i> Edit</button> &emsp;';

					} else {
						if ($item->level == "operator") {
							$btnAction .= '<button type="button" class="btn btn-xs btn-warning" onclick=editUser("'.$item->id.'")><i class="fas fa-edit"></i> Edit</button> &emsp;';
							$btnAction .= '<button type="button" class="btn btn-xs btn-danger" onclick=deleteUser("'.$item->id.'")><i class="fa fa-trash"></i> Hapus</button>';
						} else {
							$btnAction = "-";
						}
					}
				} else if ($this->user->level == "superadmin") {
					if ($this->user->id == $item->id) {
						$btnAction .= '<button type="button" class="btn btn-xs btn-warning" onclick=editUser("'.$item->id.'")><i class="fas fa-edit"></i> Edit</button> &emsp;';

					} else {
						if ($item->level == "operator" || $item->level == "admin") {
							$btnAction .= '<button type="button" class="btn btn-xs btn-warning" onclick=editUser("'.$item->id.'")><i class="fas fa-edit"></i> Edit</button> &emsp;';
							$btnAction .= '<button type="button" class="btn btn-xs btn-danger" onclick=deleteUser("'.$item->id.'")><i class="fa fa-trash"></i> Hapus</button>';
						} else {
							$btnAction = "-";
						}
					}
				}
				$item->action = $btnAction;
				$data[] = $item;
			}
			return $this->usersModel->findDataTableOutput($data,$where,false,$search);
		}
		parent::json();
	}

	public function add()
	{
		if ($this->isPost()) {
			$full_name = $this->input->post("full_name");
			$email = $this->input->post("email");
			$level = $this->input->post("level");
			$password = $this->input->post("password");

			$this->form_validation->set_rules("level","Level pengguna","trim|required");
			$this->form_validation->set_rules("full_name","Nama Lengkap","trim|required");
			$this->form_validation->set_rules(
												"email","Email",
												"trim|required|valid_email|is_unique[tbl_user_admin.email]",
												array(
										                'is_unique'     => '%s sudah ada di database.'
										        )
											);
			$this->form_validation->set_rules("password","Password","required|min_length[6]");
			$this->form_validation->set_rules("confirm_password","Confirm Password","required|matches[password]");

			if ($this->form_validation->run() == true) {
				
				$data = array(
							"full_name"	=>	$full_name,
							"email"	=>	$email,
							"password"	=>	sha1($password),
							"level"		=>	$level,
						);
				$insert = $this->usersModel->insert($data);
				if ($insert) {
					$this->response->status = true;
					$this->response->message = alertSuccess("Berhasil simpan pengguna baru.");
					$this->response->data = $insert;
				} else {
					$this->response->message = alertDanger("<span style='color:red;'>Opps,Gagal simpan pengguna baru.</span>");
				}
			} else {
				$this->response->message = validation_errors('<span style="color:red;">', '</span><br>');
			}
		}
		parent::json();
	}

	public function getId($id)
	{
		if ($this->isPost()) {
			$data = $this->usersModel->getById($id);
			if ($data) {
				$this->response->status = true;
				$this->response->message = "data get By Id";
				$this->response->data = $data;
			} else {
				$this->response->message = alertDanger("Data not found.");
			}
		}
		parent::json();
	}

	public function update($id)
	{
		if ($this->isPost()) {
			$full_name = $this->input->post("full_name");
			$level = $this->input->post("level");
			$password = $this->input->post("password");

			if ($this->user->level == "operator") {
				$level = "operator";
			} else {
				$this->form_validation->set_rules("level","Level pengguna","trim|required");
			}
			$this->form_validation->set_rules("full_name","Nama Lengkap","trim|required");

			if (!empty(trim($password))) {
				$this->form_validation->set_rules("password","Password","required|min_length[6]");
				$this->form_validation->set_rules("confirm_password","Confirm Password","required|matches[password]");
			}

			if ($this->form_validation->run() == true) {
				$getById = $this->usersModel->getById($id);
				if($getById) {
					$data = array(
								"id"			=>	$id,
								"full_name"		=>	$full_name,
								"level"			=>	$level,
								"updated_at"	=>	date("Y-m-d H:i:s"),
							);
					if (!empty(trim($password))) {
						$data["password"] = sha1($password);
					}
					$update = $this->usersModel->update($data);
					if ($update) {
						$this->response->status = true;
						$this->response->message = alertSuccess("Berhasil edit data pengguna");
					} else {
						$this->response->message = alertDanger("Opps,Gagal edit data pengguna.");
					}
				} else {
					$this->response->message = alertDanger("Data sudah tidak ada..!");
				}
			} else {
				$this->response->message = validation_errors('<span style="color:red;">', '</span><br>');
			}
		}
		parent::json();
	}

	public function delete($id)
	{
		if ($this->isPost()) {
			$getById = $this->usersModel->getById($id);
			if($getById){
				$delete = $this->usersModel->delete($id);
				if ($delete) {
					$this->response->status = true;
					$this->response->message = alertSuccess("Data berhasil di hapus..");
				} else {
					$this->response->message = alertDanger("Opps, terjadi kesalahan.<br>Mungkin data sudah dihapus pengguna lain");
				}
			} else {
				$this->response->message = alertDanger("Data tidak ada.");
			}
		}
		parent::json();
	}

}

/* End of file Users.php */
/* Location: ./application/controllers/admin/Users.php */