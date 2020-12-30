$(document).ready(function() {
	$('#yearItem').datetimepicker({
	    format      :   "YYYY",
	    viewMode    :   "years",
	    date 		: 	new Date()
	});

	$("#monthItem").change(function() {
		var val = $(this).val();
		var month = "";
		if (val == "01") {
			month = "Januari";
		} else if (val == "02") {
			month = "Februari"
		} else if (val == "03") {
			month = "Maret"
		} else if (val == "04") {
			month = "April"
		} else if (val == "05") {
			month = "Mei"
		} else if (val == "06") {
			month = "Juni"
		} else if (val == "07") {
			month = "Juli"
		} else if (val == "08") {
			month = "Agustus"
		} else if (val == "09") {
			month = "Septermber"
		} else if (val == "10") {
			month = "Oktober"
		} else if (val == "11") {
			month = "November"
		} else if (val == "12") {
			month = "Desember"
		}
		$(".month-item").html(month);

	    var urlValMonth = base_url_back+'dashboard/dataCard/true/'+val+yearVal;
    	dataProsesItemByMonthYear(urlValMonth);
	})

})

function dataProsesItemByMonthYear(urlValue) {
	$.post(urlValue,function(respon) {
    	// console.log(respon)
    	$.each(respon,function(ind,vl) {
    		// console.log(vl.data_bagian);
    		$.each(vl.data_bagian,function(dex,vlu) {
    			// console.log(vlu.data_item);
    			$.each(vlu.data_item,function(idx,lue) {
	    			$("#"+lue.name_dash+"__jumlah").html(lue.jml_ketersediaan);
	    			$("#"+lue.name_dash+"__kebutuhan").html(lue.kebutuhan);
    			})	
    		})
    	})
    })
}
