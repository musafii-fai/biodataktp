<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ktp extends MY_Admin_Controller {

	public function __construct()
	{
		parent::__construct();

        $this->load->model('Biodata_model',"biodataModel");
	}

	public function index()
	{
		parent::pageTitle("Data Biodata KTP");
		$breadcrumbs = array(
								"Settings" => "#",
								"Data Biodata KTP"	=> "",
							);
		parent::breadcrumbs($breadcrumbs);

		parent::viewAdmin();
	}

	public function ajax_list()
	{
		if ($this->isPost()) {
			$where = false;
			$select = array("tbl_biodata_users.*","_tbl_provinsi.nama_provinsi","_tbl_kabupaten.nama_kab","_tbl_kecamatan.nama_kec","_tbl_kelurahan.nama_kel");
			$columns = array(null,'nik','nama','tempat_lahir','tanggal_lahir','jenis_kelamin','status_perkawinan','pekerjaan','alamat','_tbl_provinsi.nama_provinsi','_tbl_kecamatan.nama_kec','_tbl_kabupaten.nama_kab','_tbl_kelurahan.nama_kel');
			$search = array('nik','nama','tempat_lahir','tanggal_lahir','jenis_kelamin','status_perkawinan','pekerjaan','alamat','_tbl_provinsi.nama_provinsi','_tbl_kecamatan.nama_kec','_tbl_kabupaten.nama_kab','_tbl_kelurahan.nama_kel');
			$join = array(
							array("_tbl_provinsi","_tbl_provinsi.id_prov = tbl_biodata_users.id_prov","LEFT"),
							array("_tbl_kabupaten","_tbl_kabupaten.id_kab = tbl_biodata_users.id_kab","LEFT"),
							array("_tbl_kecamatan","_tbl_kecamatan.id_kec = tbl_biodata_users.id_kec","LEFT"),
							array("_tbl_kelurahan","_tbl_kelurahan.id_kel = tbl_biodata_users.id_kel","LEFT"),
						);
			$result = $this->biodataModel->findDataTable($where,$select,$columns,$search,$join);
			$data = array();
			foreach ($result as $item) {
				$item->no = "<b style='color:black;'>".$item->no."</b>";



				$data[] = $item;
			}
			return $this->biodataModel->findDataTableOutput($data,$where,$select,$search,$join);
		}
		parent::json();
	}

}

/* End of file Ktp.php */
/* Location: ./application/controllers/admin/Ktp.php */