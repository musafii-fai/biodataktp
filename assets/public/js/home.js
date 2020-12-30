function tglFormatInd(idTgl) {
	$('#'+idTgl).datetimepicker({
        format: 'YYYY-MM-DD'
    });
}

$(function () {
    tglFormatInd("tgl_lahir_val");
})


$("#provinsi_val").change(function() {
	var val = $(this).val(); // id_prov
	var option = "";
	if (val != "") {
		
		$.get(base_url+"home/allGetKotaKab/"+val+"/true",function(resp) {
			// console.log(resp);
			option += '<option value="">--Pilih Kota/Kabupaten--</option>';
			$.each(resp,function(i,v) {
				option += '<option value="'+v.id_kab+'">'+v.nama_kab+'</option>';
			})
			// console.log(option);
			$("#kab_kota_val").html(option);
		})
		
	} else {
		$("#kab_kota_val").html("");
	}
	$("#kecamatan_val").html("");
	$("#kelurahan_val").html("");
})

$("#kab_kota_val").change(function() {
	var val = $(this).val(); // id_kab
	var option = "";
	if (val != "") {
		$.get(base_url+"home/allGetKecamatan/"+val+"/true",function(resp) {
			option += '<option value="">--Pilih Kecamatan--</option>';
			$.each(resp,function(i,v) {
				option += '<option value="'+v.id_kec+'">'+v.nama_kec+'</option>';
			})
			$("#kecamatan_val").html(option);
		})
	} else {
		$("#kecamatan_val").html("");
	}
	$("#kelurahan_val").html("");
})

$("#kecamatan_val").change(function() {
	var val = $(this).val(); // id_kec
	var option = "";
	if (val != "") {
		$.get(base_url+"home/allGetKelurahan/"+val+"/true",function(resp) {
			option += '<option value="">--Pilih Kelurahan/Desa--</option>';
			$.each(resp,function(i,v) {
				option += '<option value="'+v.id_kel+'">'+v.nama_kel+'</option>';
			})
			$("#kelurahan_val").html(option);
		})
	} else {
		$("#kelurahan_val").html("");
	}
})


$("#btnSave").click(function() {
	var pesan =	"<span style='color:orange;'>Silahkan periksa kembali data yang anda input, dan pastikan sudah benar.</span><hr>";
	Swal.fire({
	  	title: 'Apakah anda yakin.?',
	  	html: pesan,
	  	type: 'info',
	  	showCancelButton: true,
	  	confirmButtonColor: '#3085d6',
	  	cancelButtonColor: '#d33',
	  	confirmButtonText: 'Iya, Simpan',
	  	cancelButtonText: "Batal"
	}).then((result) => {
	  	if (result.value) {
			var formData = new FormData($("#formData")[0]);
	  		$.ajax({
				url: base_url+"home/saveBiodata",
				type:'POST',
				data:formData,
				contentType:false,
				processData:false,
				dataType:'JSON',
				success: function(json) {
					if (json.status == true) {
						Swal.fire({
						  	type: 'success',
						  	title: json.message,
						  	showConfirmButton: false,
						  	timer: 2500,
						})
						/*setTimeout(function() {
					        window.location.href = base_url+"pendaftaran";
			            },4000);*/
					} else {
						Swal.fire({
						  	type: 'error',
						  	// title: 'Error Form',
						  	html: json.message,
						})
					}
				}
			});
	  	}
	});		
});
