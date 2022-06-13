const API_URL = "../api/";
$(".forgotten").on("click",function(e){
	e.preventDefault();
	var email = $("#lecturer_email_forgotten").val();
	if (!email) {
		$(".email_div").html("");
		$(".email_div").append('<small class="text-danger">Email is required</small>');
		return;
	}
	$(".email_div").html("");

	$.ajax({
		url : API_URL + "lecturer_forgot_password.php",
		method : "POST",
		cache : false,
		data : {lecturer_email : email},
		success : function(res){
			/*Fire success the message through a toast*/
            $.toast({
                text: res.msg,
                hideAfter: 3000,
                bgColor: '#28a745',
                loaderBg: '#166328',
                stack: 3,
                icon: 'success',
                position: 'top-right'
            })
		},
		error : function(res){
			/*Fire failure the message through a toast*/
            $.toast({
                text: res.responseJSON.errorMsg,
                hideAfter: 4000,
                bgColor: '#dc3545',
                loaderBg: '#850713',
                stack: 3,
                icon: 'error',
                position: 'top-right'
            })
		}
	})

})


$("#login_form").on("submit",function(e){
	e.preventDefault();
	var formData = $(this).serialize()
	var submit_btn = $(".submit_button");
	var html_submit = submit_btn.html();
	submit_btn.html("PLEASE WAIT...");
	$.ajax({
		url : API_URL + "lecturer_login.php",
		method : "POST",
		cache : false,
		data : formData,
		success : function(res){
			/*Fire success the message through a toast*/
            $.toast({
                text: res.msg,
                hideAfter: 3000,
                bgColor: '#28a745',
                loaderBg: '#166328',
                stack: 3,
                icon: 'success',
                position: 'top-right'
            })
            window.location = res.redirect;
		},
		error : function(res){
			submit_btn.html(html_submit)
			/*Fire failure the message through a toast*/
            $.toast({
                text: res.responseJSON.errorMsg,
                hideAfter: 4000,
                bgColor: '#dc3545',
                loaderBg: '#850713',
                stack: 3,
                icon: 'error',
                position: 'top-right'
            })
		}
	})

})