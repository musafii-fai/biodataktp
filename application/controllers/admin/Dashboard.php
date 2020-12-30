<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		parent::pageTitle("Dashboard");
		$breadcrumbs = array(
								"Dashboard"	=> "",
							);
		parent::breadcrumbs($breadcrumbs);
		parent::viewContent(array("dataCardItem" => ""));

		parent::viewAdmin();
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */