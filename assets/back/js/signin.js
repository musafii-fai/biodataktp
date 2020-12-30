$(document).ready(function() {

	$("#btnSignIn").click(function() {
		

		$("#btnSignIn").attr("disabled",true);
		$("#btnSignIn").html("Loading...<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url: base_url+'login/login_ajax',
			type:'POST',
			dataType:'json',
			data:$("#formLogin").serialize(),
			success:function(json) {
				if (json.status == true) {

					$("#btnSignIn").attr("disabled",true);
					$("#btnSignIn").html("Harap menunggu...<i class='fa fa-spinner fa-spin'></i>");

					setTimeout(function() {
						$("#btnSignIn").attr("disabled",false);
						$("#btnSignIn").html('<i class="fa fa-sign-in"></i> LOGIN');
						window.location.href = base_url;
					},2000);
				} else {
					$("#errorEmail").html(json.error.email);
					$("#errorPassword").html(json.error.password);
					$("#errorCaptcha").html(json.error.kode_captcha);

					if (json.error.account) {
				        Swal.fire({
				        		// position: 'center-start',
							  	type: 'error',
							  	html: json.error.account,
							})
					}

					setTimeout(function() {
						$("#errorEmail").html("");
						$("#errorPassword").html("");
						$("#errorCaptcha").html("");
						$("#btnSignIn").attr("disabled",false);
						$("#btnSignIn").html('<i class="fa fa-sign-in"></i> LOGIN');
					},3000);
				}
			}
		});
	});
});

$(document).keypress(function(e) {
    if(e.which == 13) {
        $("#btnSignIn").click();
    }
});

$(document).on('click', '#reloadCaptcha', function(e) {
	e.preventDefault();
	reloadCaptcha();

	$("#reloadCaptcha").children().addClass("fa-spin");
	setTimeout(function(){
	  $("#reloadCaptcha").children().removeClass("fa-spin");
	}, 1000);
});

function reloadCaptcha() {
	$.post(base_url+'login/reloadCaptcha',function(resp) {
		if (resp.status == true) {
			$("#image_captcha").html(resp.data.captcha_img)
		} else {
			$("#image_captcha").html("");
		}
	})
}

