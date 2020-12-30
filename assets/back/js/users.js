$(document).ready(function() {
	btnTambah = "";
   	if(user_level == "admin" || user_level == "superadmin" ) {
    	btnTambah = "&emsp;&emsp;<button type='button' class='btn btn-primary btn-sm' id='btnTambah'><i class='fa fa-plus'></i> Tambah</button>";
   	}
	btnRefresh = "&emsp;&emsp;<button type='button' class='btn btn-success btn-sm' title='Refresh table data pengguna' id='btnRefresh'><i class='fa fa-refresh'></i> Refresh</button>";

	$("#listTableUsers").DataTable({
		serverSide:true,
		responsive:true,
		processing:true,
		oLanguage: {
            // sProcessing : '<center><span class="fa fa-refresh fa-spin" style="font-size: 100px;"></span></center>',
            sZeroRecords: "<center>Data tidak ditemukan</center>",
            sLengthMenu: "Tampilkan _MENU_ data   "+btnTambah+btnRefresh,
            sSearch: "Cari data:",
            sInfo: "Menampilkan: _START_ - _END_ dari total: _TOTAL_ data",                                   
            oPaginate: {
                sFirst: "Awal", "sPrevious": "Sebelumnya",
                sNext: "Selanjutnya", "sLast": "Akhir"
            },
        },
		//load data
		ajax: {
			url: base_url_back+'users/ajax_list',
			type: 'POST',
		},
		order:[[1,'ASC']],
		columns:[
			{
				data:'no',
				searchable:false,
				orderable:false,
			},
			{ data:'full_name' },
			{ data:'email' },
			{ data:'level' },
			{
				data:'action',
				searchable:false,
				orderable:false,
			},
		],
	});
})

function reloadTable() {
	$("#listTableUsers").DataTable().ajax.reload(null,false);
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

$(document).on('click', '#btnTambah', function (e) {
	e.preventDefault();
	$("#modalForm").modal("show");
	$("#formData")[0].reset();
	$(".modal-title").text("Tambah Pengguna Admin");
	$("#email").attr("readonly",false);
	save_method = "add";
});

function editUser(id) {
	$("#modalForm").modal("show");
	$(".modal-title").text("Edit Pengguna Admin");
	$("#email").attr("readonly",true);

	if (user_level == "operator") {
		$("#level").attr("disabled",true);
	} else {
		$("#level").attr("disabled",false);
	}

	save_method = "update";
	idData = id;
	$.post(base_url_back+'users/getId/'+idData,function(json) {
		if (json.status == true) {
			$("#full_name").val(json.data.full_name);
			$("#email").val(json.data.email);
			$("#level").val(json.data.level);
		} else {
			$("#formData")[0].reset();
			reloadTable();
			setTimeout(function() {
				$("#modalForm").modal("hide");
			},1000);

			Swal.fire({
				  	type: 'error',
				  	title: json.message,
				  	showConfirmButton: false,
				  	timer: 2500,
				})
		}
	});
}

$("#modalButtonSave").click(function() {
	var url;
	if (save_method == "add") {
		url = base_url_back+'users/add';
	} else {
		url = base_url_back+'users/update/'+idData;
	}

	var formData = new FormData($("#formData")[0]);
	$.ajax({
		url: url,
		type:'POST',
		data:formData,
		contentType:false,
		processData:false,
		dataType:'JSON',
		success: function(json) {
			if (json.status == true) {
				setTimeout(function() {
					$("#formData")[0].reset();
					$("#modalForm").modal("hide");
					reloadTable();
					
				}, 1500);

				Swal.fire({
				  	type: 'success',
				  	title: json.message,
				  	showConfirmButton: false,
				  	timer: 2500,
				})

			} else {
				Swal.fire({
				  	type: 'error',
				  	title: 'Error Form',
				  	html: json.message,
				})
			}
		}
	});
});

function deleteUser(id) {
	idData = id;

	$.post(base_url_back+"users/getId/"+idData, function(json) {
		if (json.status == true) {
			var pesan =	"<span style='color:orange;'>Note: Data yang dihapus tidak bisa dikembalikan.!</span><hr>";
				pesan += "<div class='row'>"
							+ "<div class='col-md-12'>"
								+ "<li class='pull-left'><small>Nama lengkap : <i>"+json.data.full_name+"</small></i></li><br>"
							 	+ "<li class='pull-left'><small>Email : <i>"+json.data.email+"</small></i></li><br>"
							 	+ "<li class='pull-left'><small>Level : <i>"+json.data.level+"</small></i></li><br>"
							+ "</div>"
				 		+"</div>";

			Swal.fire({
			  	title: 'Apakah anda yakin.?',
			  	// text: "data yang di hapus tidak bisa dikembalikan lagi.!",
			  	html: pesan,
			  	type: 'warning',
			  	showCancelButton: true,
			  	confirmButtonColor: '#3085d6',
			  	cancelButtonColor: '#d33',
			  	confirmButtonText: 'Hapus',
			  	cancelButtonText: "Batal"
			}).then((result) => {
			  	if (result.value) {
			  		$.post(base_url_back+"users/delete/"+idData, function(resp) {
			  			if (resp.status == true) {
			  				reloadTable();
							Swal.fire({
							  	type: 'success',
							  	title: resp.message,
							  	showConfirmButton: false,
							  	timer: 2500,
							})
			  			} else {
			  				reloadTable();
			  				Swal.fire({
							  	type: 'error',
							  	title: resp.message,
							  	showConfirmButton: false,
							  	timer: 2000,
							})
			  			}
			  		});	    
			  	}
			});

		} else {
			Swal.fire({
				  	type: 'error',
				  	title: json.message,
				  	showConfirmButton: false,
				  	timer: 2000,
				})
			reloadTable();
		}
	});
}
