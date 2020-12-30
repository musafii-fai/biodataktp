<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Admin_Controller {

	public function __construct()
	{
		parent::__construct();

        $this->load->model('Biodata_model',"biodataModel");

        $this->load->library('pdf');
	}

	public function index()
	{
		parent::pageTitle("Laporan Data KTP");
		$breadcrumbs = array(
								"Laporan" => "#",
								"Laporan Data KTP"	=> "",
							);
		parent::breadcrumbs($breadcrumbs);

		$content = array(
							"dataKTP"	=>	$this->biodataModel->getAll(),
						);
		parent::viewContent($content);

		parent::viewAdmin();
	}

	public function btnPrint()
	{
		if ($this->isPost()) {
			$nik = $this->input->post('nik');
			$nik = str_replace(" ", "-", $nik);
			$nama = $this->input->post('nama');
			$nama = str_replace(" ", "-", $nama);
			$jenis_kelamin = $this->input->post('jenis_kelamin');

			$this->form_validation->set_rules('nik', 'NIK', 'trim');
			$this->form_validation->set_rules('nama', 'NAMA', 'trim');
			$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim');

			if ($this->form_validation->run() == true) {
				$this->response->status = true;
				$this->response->message = "form ok";
				$data = array(
								"nik"	=> $nik,
								"nama"	=> $nama,
								"jenis_kelamin"	=>	$jenis_kelamin,
							);
				$this->response->data = $data;
			} else {
				$this->response->message = validation_errors('<span style="color:red;" class="float-left">', '</span><br>');
			}
		}
		parent::json();
	}

	public function cetakExcel($all=false)
	{
		// Fungsi header dengan mengirimkan raw data excel
		header("Content-type: application/vnd-ms-excel");
		// Mendefinisikan nama file ekspor "hasil-export.xls"
		$nameFile = "Cetak Data KTP_".date("Y-m-d");
		header("Content-Disposition: attachment; filename=Laporan-file-biodata_".$nameFile.".xls");
        
		$where = false;
 		if ($all == false) {
 			$getNik = $this->input->get('nik');
 			$getNama = $this->input->get('nama');
 			$getJK = $this->input->get('jk');

 			$where = array();
 			if (isset($getNik) && $getNik != "") {
 				$getNik = str_replace("-", " ", $getNik);
 				$where["nik"] = $getNik;
 			}

 			if (isset($getNama) && $getNama != "") {
 				$getNama = str_replace("-", " ", $getNama);
 				$where["nama"] = $getNama;
 			}

 			if (isset($getJK) && $getJK != "") {
 				$getJK = str_replace("-", " ", $getJK);
 				$where["jenis_kelamin"] = $getJK;
 			}
 		}

       	$select = array("tbl_biodata_users.*","_tbl_provinsi.nama_provinsi","_tbl_kabupaten.nama_kab","_tbl_kecamatan.nama_kec","_tbl_kelurahan.nama_kel");
 		$join = array(
							array("_tbl_provinsi","_tbl_provinsi.id_prov = tbl_biodata_users.id_prov","LEFT"),
							array("_tbl_kabupaten","_tbl_kabupaten.id_kab = tbl_biodata_users.id_kab","LEFT"),
							array("_tbl_kecamatan","_tbl_kecamatan.id_kec = tbl_biodata_users.id_kec","LEFT"),
							array("_tbl_kelurahan","_tbl_kelurahan.id_kel = tbl_biodata_users.id_kel","LEFT"),
						);

        $result = $this->biodataModel->getAll($where,$select,array("nama ASC"),$join);
        $tabel = '';
        $tabel .= '<h3>Laporan Data KTP (Kartu Tanda Penduduk)</h3>';
        if ($result) {
        	$styleStr = "vertical-align: middle border-collapse: collapse; border: 1px solid #3c3c3c;";
        	$widthcount = (85/23)."%";
        	$tabel .= '
	        			<table border="1" cellpadding="4" width="100%" style="border-collapse: collapse; border: 1px solid #3c3c3c;">
	        				<thead>
				            	<tr>
				                    <th width="2%" style="'.$styleStr.'"><b> No </b></th>
				                    <th style="'.$styleStr.'"><b> Nik </b></th>
				                    <th style="'.$styleStr.'"><b> Nama Lengkap </b></th>
				                    <th style="'.$styleStr.'"><b> Tempat Lahir </b></th>
				                    <th style="'.$styleStr.'"><b> Tgl Lahir </b></th>
				                    <th style="'.$styleStr.'"><b> Jenis Kelamin </b></th>
				                    <th style="'.$styleStr.'"><b> Agama </b></th>
				                    <th style="'.$styleStr.'"><b> Status Perkawinan </b></th>
				                    <th style="'.$styleStr.'"><b> Pekerjaan </b></th>
				                    <th style="'.$styleStr.'"><b> Alamat </b></th>
				                    <th style="'.$styleStr.'"><b> Provinsi </b></th>
				                    <th style="'.$styleStr.'"><b> Kota / Kabupaten </b></th>
				                    <th style="'.$styleStr.'"><b> Kecamatan </b></th>
				                    <th style="'.$styleStr.'"><b> Kelurahan / Desa </b></th>
				                </tr>
				            </thead>
				      '; 

			$trBody = "";
        	$no = 0;
        	foreach ($result as $item) {
        		$no++;
        		$trBody .= '<tr>
        						<td style="'.$styleStr.'" width="2%" align="center">'.$no.'</td>
					        	<td style="'.$styleStr.' mso-number-format:\@;">'.$item->nik.'</td>
					        	<td style="'.$styleStr.'">'.$item->nama.'</td>
					        	<td style="'.$styleStr.'">'.$item->tempat_lahir.'</td>
					        	<td style="'.$styleStr.'">'.$item->tanggal_lahir.'</td>
					        	<td style="'.$styleStr.'">'.$item->jenis_kelamin.'</td>
					        	<td style="'.$styleStr.'">'.$item->agama.'</td>
					        	<td style="'.$styleStr.'">'.$item->status_perkawinan.'</td>
					        	<td style="'.$styleStr.'">'.$item->pekerjaan.'</td>
					        	<td style="'.$styleStr.'">'.$item->alamat.'</td>
					        	<td style="'.$styleStr.'">'.$item->nama_provinsi.'</td>
					        	<td style="'.$styleStr.'">'.$item->nama_kab.'</td>
					        	<td style="'.$styleStr.'">'.$item->nama_kec.'</td>
					        	<td style="'.$styleStr.'">'.$item->nama_kel.'</td>

        				   </tr>';
        	}
        	$tabel .=	'	<tbody>
        						'.$trBody.'
				            </tbody>
	        			</table>';
        	
        } else {
        	$tabel .= '
        				<table border="1" cellpadding="0.5" width="100%">
	        				<thead><tr><th><h2>'.spanRed("Opps Maaf, Data Tidak Ada.!!").'</h2></th></tr></thead>
	        			</table>
        			';
        }

  		echo $tabel;
	}

	public function cetakPdf($all=false)
	{
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->AddPage('L');
        $pdf->Write(0, 'Laporan Data KTP (Kartu Tanda Penduduk) ', '', 0, 'L', true, 0, false, false, 0);
        $pdf->Ln(5);
        $pdf->SetFont('times', '', 8);
 		
 		$trBody = "";
 		$no = 0;
 		$where = false;
 		if ($all == false) {
 			$getNik = $this->input->get('nik');
 			$getNama = $this->input->get('nama');
 			$getJK = $this->input->get('jk');

 			$where = array();
 			if (isset($getNik) && $getNik != "") {
 				$getNik = str_replace("-", " ", $getNik);
 				$where["nik"] = $getNik;
 			}

 			if (isset($getNama) && $getNama != "") {
 				$getNama = str_replace("-", " ", $getNama);
 				$where["nama"] = $getNama;
 			}

 			if (isset($getJK) && $getJK != "") {
 				$getJK = str_replace("-", " ", $getJK);
 				$where["jenis_kelamin"] = $getJK;
 			}
 		}

 		$select = array("tbl_biodata_users.*","_tbl_provinsi.nama_provinsi","_tbl_kabupaten.nama_kab","_tbl_kecamatan.nama_kec","_tbl_kelurahan.nama_kel");
 		$join = array(
							array("_tbl_provinsi","_tbl_provinsi.id_prov = tbl_biodata_users.id_prov","LEFT"),
							array("_tbl_kabupaten","_tbl_kabupaten.id_kab = tbl_biodata_users.id_kab","LEFT"),
							array("_tbl_kecamatan","_tbl_kecamatan.id_kec = tbl_biodata_users.id_kec","LEFT"),
							array("_tbl_kelurahan","_tbl_kelurahan.id_kel = tbl_biodata_users.id_kel","LEFT"),
						);
        $result = $this->biodataModel->getAll($where,$select,array("nama ASC"),$join);
        // var_dump($result);
        
        if ($result) {
        	foreach ($result as $item) {
	        	$no++;

	        	$trBody .= '<tr>';
		        	$trBody .= '<td width="2%" align="center">'.$no.'</td>';
		        	$trBody .= '<td width="9%">'.$item->nik.'</td>';
		        	$trBody .= '<td>'.$item->nama.'</td>';
		        	$trBody .= '<td>'.$item->tempat_lahir.'</td>';
		        	$trBody .= '<td>'.$item->tanggal_lahir.'</td>';
		        	$trBody .= '<td>'.$item->jenis_kelamin.'</td>';
		        	$trBody .= '<td>'.$item->agama.'</td>';
		        	$trBody .= '<td>'.$item->status_perkawinan.'</td>';
		        	$trBody .= '<td>'.$item->pekerjaan.'</td>';
		        	$trBody .= '<td>'.$item->alamat.'</td>';
		        	$trBody .= '<td>'.$item->nama_provinsi.'</td>';
		        	$trBody .= '<td>'.$item->nama_kab.'</td>';
		        	$trBody .= '<td>'.$item->nama_kec.'</td>';
		        	$trBody .= '<td>'.$item->nama_kel.'</td>';
	        	$trBody .= '</tr>';
	        }
        } else {
        	$trBody .= '<tr><td colspan="14" align="center">Data Tidak ada.</td></tr>';
        }

        $tabel = '
			        <table border="1" cellpadding="1.8" width="100%">
			        	<thead>
			            	<tr>
			                    <th width="2%"><b> No </b></th>
			                    <th width="9%"><b> Nik </b></th>
			                    <th><b> Nama Lengkap </b></th>
			                    <th><b> Tempat Lahir </b></th>
			                    <th><b> Tgl Lahir </b></th>
			                    <th><b> Jenis Kelamin </b></th>
			                    <th><b> Agama </b></th>
			                    <th><b> Status Perkawinan </b></th>
			                    <th><b> Pekerjaan </b></th>
			                    <th><b> Alamat </b></th>
			                    <th><b> Provinsi </b></th>
			                    <th><b> Kota / Kabupaten </b></th>
			                    <th><b> Kecamatan </b></th>
			                    <th><b> Kelurahan / Desa </b></th>
			                </tr>
			            </thead>
			            <tbody>
			            	'.$trBody.'
			            </tbody>
			        </table>
        ';
        // var_dump($tabel);

        // $tabel = "<h2>TEsting</h2>";
        $pdf->writeHTML($tabel);

       
        $nameFile = "Cetak Data KTP_".date("Y-m-d");

        $pdf->Output('file-biodata_'.$nameFile.'.pdf', 'I');
	}

}

/* End of file Laporan.php */
/* Location: ./application/controllers/admin/Laporan.php */