<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		parent::viewContent(array("dataCardItem" => ""));
		parent::viewPublic();
	}



}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */