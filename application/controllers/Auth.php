<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('captcha');

        $this->load->model('Biodata_model',"biodataModel");
	}

	public function index()
	{
		if ($this->userpublic != null) {
			redirect(base_url(),'refresh');
		}

		$capt = self::buat_captcha();
        $this->session->set_userdata('kode_captcha', $capt['word']);

        $filename = $this->session->captcha_filename;
        if ($filename != null) {
        	if (file_exists('captcha/'.$filename)) {
				unlink('captcha/'.$filename);
			}
        }
			
        $this->session->set_userdata('captcha_filename', $capt['filename']);

		$contentData = array(
							"captcha_img" => $capt['image'],
						);

		parent::viewContent($contentData);

		parent::viewPublic(true,false);
	}

	public function buat_captcha(){
        $vals = array(
            'img_path' => 'captcha/',
            'img_url' => base_url().'captcha/',
//            'font_path' => './font/timesbd.ttf',
            'font_path' => FCPATH . 'captcha/font/1.ttf',
            'font_size' => 40,
            'img_width' => '110',
            'img_height' => 32,
//            'img_width' => '150',
//            'img_height' => 30,
            'word_length'   => 5,
            'pool'      => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', // angka dan huruf acak
            'expiration' => 7200,
            'colors'        => array(
                    'background' => array(149, 247, 233),
                    'border' => array(255, 255, 255),
                    'text' => array(0, 0, 0),
                    'grid' => null
            )
        );
        $cap = create_captcha($vals);
        return $cap;
    }

    public function reloadCaptcha()
    {
    	if ($this->isPost()) {
    		$capt = self::buat_captcha();
	    	if ($capt) {
	    		$this->response->status = true;
	    		$this->response->message = "Reload Captcha";
	    		$this->response->data = array(
											"captcha_img" => $capt['image'],
										);

	    		$this->session->set_userdata('kode_captcha', $capt['word']);

	    		$filename = $this->session->captcha_filename;
		        if ($filename != null) {
		        	if (file_exists('captcha/'.$filename)) {
						unlink('captcha/'.$filename);
					}
		        }
		        $this->session->set_userdata('captcha_filename', $capt['filename']);

	    	} else {
	    		$this->response->message = "Error Reload Captcha";
	    	}
    	}
    	parent::json();
    }

    public function signUp()
    {
    	if ($this->isPost()) {
			$this->form_validation->set_rules("email","Email","trim|required|valid_email");
			$this->form_validation->set_rules("password","Password","required");
			$this->form_validation->set_rules("confirm_password","Konfirmasi Password","required|matches[password]");

			$email = $this->input->post("email");
			$password = $this->input->post("password");
			$confirm_password = $this->input->post("confirm_password");

			if ($this->form_validation->run() == true) {

				$where = array(
								"email"	=>	$email,
								// 
							);
				$checkEmail = $this->biodataModel->getByWhere($where);
				if ($checkEmail) {
					$this->response->message = spanRed("Email yang anda input sudah terdaftar.!");
				} else {
					$data = array(
									"email"		=>	$email,
									"password"	=>	sha1($password)
								);
					$insert = $this->biodataModel->insert($data);
					if ($insert) {
						$this->response->status = true;
						$this->response->message = alertSuccess("Berhasil Sign Up, <br> Silahkan Login Untuk masuk ke Aplikasi");
					} else {
						$this->response->message = alertDanger("Gagal Sign Up, <br> Silahkan coba lagi");
					}
				}
			} else {
				$this->response->message = validation_errors('<span style="color:red;">', '</span><br>');
			}
		}
		parent::jsonp();
    }

	public function login_ajax()
	{
		if ($this->isPost()) {
			$this->form_validation->set_rules("email","Email","trim|required|valid_email");
			$this->form_validation->set_rules("password","Password","required");
			$this->form_validation->set_rules("kode_captcha","Kode Captcha","required");

			$email = $this->input->post("email");
			$password = $this->input->post("password");
			$kode_captcha = $this->input->post('kode_captcha');

			// var_dump($this->session->kode_captcha);

			if ($this->form_validation->run() == true) {

				if ($kode_captcha == $this->session->kode_captcha) {
					$where = array(
									"email"	=>	$email,
									"password"	=>	sha1($password)
								);
					$checkAuthentic = $this->biodataModel->getByWhere($where);
					if ($checkAuthentic) {
						// validate untuk check status aktif atau tidak aktif user
						$this->response->status = true;
						$this->response->message = "<span style='color:blue; font-size: 20px;'><i class='fa fa-spinner fa-spin'></i> Mohon tunggu ....</span>";

						$filename = $this->session->captcha_filename;
				        if ($filename != null) {
				        	if (file_exists('captcha/'.$filename)) {
								unlink('captcha/'.$filename);
							}
				        }

						$this->session->set_userdata("userpublic",$checkAuthentic);
						
					} else {
						$this->response->message = "error check password";
						$this->response->error = array(
												"account"	=>	spanRed("Email atau Password yang dimasukan salah..!"),
											);
					}
				} else {
					$this->response->error = array(
												"account"	=>	spanRed("Kode Captcha yang anda input salah.!"),
											);
				}
			} else {
				$this->response->message = "error form data";
				$this->response->error = array(
										"email"		=>	form_error("email","<span style='color:red;'>","</span>"),
										"password"	=>	form_error("password","<span style='color:red;'>","</span>"),
										"kode_captcha"	=>	form_error("kode_captcha","<span style='color:red;'>","</span>"),
									);
			}
		}
		parent::jsonp();
	}

	public function logout()
	{
		$this->session->unset_userdata("userpublic");
		$this->session->sess_destroy();
		redirect("auth");
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */