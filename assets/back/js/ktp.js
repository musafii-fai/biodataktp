$(document).ready(function() {
	btnRefresh = "&emsp;&emsp;<button type='button' class='btn btn-success btn-sm' title='Refresh table data pengguna' id='btnRefresh'><i class='fa fa-refresh'></i> Refresh</button>";

	$("#listTableBiodata").DataTable({
		serverSide:true,
		responsive:true,
		processing:true,
		oLanguage: {
            // sProcessing : '<center><span class="fa fa-refresh fa-spin" style="font-size: 100px;"></span></center>',
            sZeroRecords: "<center>Data tidak ditemukan</center>",
            sLengthMenu: "Tampilkan _MENU_ data   "+btnRefresh,
            sSearch: "Cari data:",
            sInfo: "Menampilkan: _START_ - _END_ dari total: _TOTAL_ data",                                   
            oPaginate: {
                sFirst: "Awal", "sPrevious": "Sebelumnya",
                sNext: "Selanjutnya", "sLast": "Akhir"
            },
        },
		//load data
		ajax: {
			url: base_url_back+'ktp/ajax_list',
			type: 'POST',
		},
		order:[[2,'ASC']],
		columns:[
			{
				data:'no',
				searchable:false,
				orderable:false,
			},
			{ data:'nik' },
			{ data:'nama' },
			{ data:'tempat_lahir' },
			{ data:'tanggal_lahir' },
			{ data:'jenis_kelamin' },
			{ data:'agama' },
			{ data:'status_perkawinan' },
			{ data:'pekerjaan' },
			{ data:'alamat' },
			{ data:'nama_provinsi' },
			{ data:'nama_kab' },
			{ data:'nama_kec' },
			{ data:'nama_kel' },
		],
	});
})

function reloadTable() {
	$("#listTableBiodata").DataTable().ajax.reload(null,false);
}

var idData;
var save_method;

$(document).on('click', '#btnRefresh', function(e) {
	e.preventDefault();
	reloadTable();
	$("#btnRefresh").children().addClass("fa-spin");
	setTimeout(function(){
	  $("#btnRefresh").children().removeClass("fa-spin");
	}, 1000);
});
