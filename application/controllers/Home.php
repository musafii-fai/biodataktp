<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('Biodata_model',"biodataModel");
	}

	public function index()
	{
		$content = array(
							"allGetProvinsi"	=>	self::allGetProvinsi(),
							"allGetKotaKab"		=>	self::allGetKotaKab(),
							"allGetKecamatan"	=>	self::allGetKecamatan(),
							"allGetKelurahan"	=>	self::allGetKelurahan(),
						);
		parent::viewContent($content);
		parent::viewPublic();

	}

	public function allGetProvinsi($resp=false)
	{
		$this->load->model('Provinsi_model',"provinsiModel");
		
		if ($resp) { // jika biodata belum di update
			$whereAjax = false;
			
			$result = $this->provinsiModel->getAll($whereAjax); // untuk ajax data
			parent::json($result);
		} else {
			$result = $this->provinsiModel->getAll();
			return $result;	
		}	
	}

	public function allGetKotaKab($idProv=0,$resp=false)
	{
		$this->load->model('Kabupaten_model',"kabupatenModel");
		$orderBy = array("nama_kab ASC");
		if ($resp) { // jika biodata belum di update
			$whereAjax = array("id_prov"=>$idProv);
			$result = $this->kabupatenModel->getAll($whereAjax,false,$orderBy); // untuk ajax data
			parent::json($result);
		} else {
			$where = array("id_prov"=>$this->userData->id_prov);
			$result = $this->kabupatenModel->getAll($where,false,$orderBy);
			return $result;	// jika sudah ada data kabupaten
		}
	}

	public function allGetKecamatan($idKab=0,$resp=false)
	{
		$this->load->model('Kecamatan_model',"kecamatanModel");
		$orderBy = array("nama_kec ASC");
		if ($resp) { // jika biodata belum di update
			$result = $this->kecamatanModel->getAll(array("id_kab"=>$idKab),false,$orderBy); // untuk ajax data
			parent::json($result);
		} else {
			$result = $this->kecamatanModel->getAll(array("id_kab"=>$this->userData->id_kab),false,$orderBy);
			return $result;	// jika sudah ada data kabupaten
		}
	}

	public function allGetKelurahan($idKec=0,$resp=false)
	{
		$this->load->model('Kelurahan_model',"kelurahanModel");
		$orderBy = array("nama_kel ASC");
		if ($resp) { // jika biodata belum di update
			$result = $this->kelurahanModel->getAll(array("id_kec"=>$idKec),false,$orderBy); // untuk ajax data
			parent::json($result);

		} else {
			$result = $this->kelurahanModel->getAll(array("id_kec"=>$this->userData->id_kec),false,$orderBy);
			return $result;	// jika sudah ada data kabupaten
		}
	}

	public function saveBiodata()
	{
		if ($this->isPost()) {
			$nik_val = $this->input->post('nik_val');
			$nama_val = $this->input->post('nama_val');
			$tempat_lahir_val = $this->input->post('tempat_lahir_val');
			$tgl_lahir_val = $this->input->post('tgl_lahir_val');
			$jenis_kelamin_val = $this->input->post('jenis_kelamin_val');
			$agama_val = $this->input->post('agama_val');
			$status_perkawinan = $this->input->post('status_perkawinan');
			$pekerjaan = $this->input->post('pekerjaan');
			$alamat_val = $this->input->post('alamat_val');

			$provinsi_val = $this->input->post('provinsi_val');
			$kab_kota_val = $this->input->post('kab_kota_val');
			$kecamatan_val = $this->input->post('kecamatan_val');
			$kelurahan_val = $this->input->post('kelurahan_val');
			
			$this->form_validation->set_rules('nik_val', 'Nik', 'trim|required|max_length[16]|min_length[16]');
			$this->form_validation->set_rules('nama_val', 'Nama', 'trim|required');
			$this->form_validation->set_rules('tempat_lahir_val', 'Tempat Lahir', 'trim|required');
			$this->form_validation->set_rules('tgl_lahir_val', 'Tanggal Lahir', 'trim|required');
			$this->form_validation->set_rules('jenis_kelamin_val', 'Jenis Kelamin', 'trim|required');
			$this->form_validation->set_rules('agama_val', 'Agama', 'trim|required');
			$this->form_validation->set_rules('status_perkawinan', 'Status Perkawinan', 'trim|required');
			$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required');
			$this->form_validation->set_rules('alamat_val', 'Alamat', 'trim|required');

			$this->form_validation->set_rules('provinsi_val', 'Provinsi', 'trim|required');
			$this->form_validation->set_rules('kab_kota_val', 'Kota / Kabupaten', 'trim|required');
			$this->form_validation->set_rules('kecamatan_val', 'Kecamatan', 'trim|required');
			$this->form_validation->set_rules('kelurahan_val', 'Kelurahan / Desa', 'trim|required');

			if ($this->form_validation->run() == true) {
				$data = array(
								"id"				=>	$this->userData->id,
								"nik"				=>	$nik_val,
								"nama"				=>	$nama_val,
								"tempat_lahir"		=>	$tempat_lahir_val,
								"tanggal_lahir"		=>	$tgl_lahir_val,
								"jenis_kelamin"		=>	$jenis_kelamin_val,
								"agama"				=>	$agama_val,
								"status_perkawinan"	=>	$status_perkawinan,
								"pekerjaan"			=>	$pekerjaan,
								"alamat"			=>	$alamat_val,
								"id_prov"			=>	$provinsi_val,
								"id_kab"			=>	$kab_kota_val,
								"id_kec"			=>	$kecamatan_val,
								"id_kel"			=>	$kelurahan_val,
							);
				$update = $this->biodataModel->update($data);
				if ($update) {
					$this->response->status = true;
					$this->response->message = alertSuccess("Berhasil simpan update biodata anda.");
				} else {
					$this->response->message = alertDanger("Opps Maaf, Gagal simpan update biodata anda. <br> Silahkan Reload Halaman biodata");
				}
			} else {
				$this->response->message = validation_errors('<span style="color:red;">', '</span><br>');
			}
		}
		parent::json();
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */