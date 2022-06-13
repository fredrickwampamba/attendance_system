const API_URL = "../api/";
$("#security_details").on("submit",function(e){
	e.preventDefault();
	var formData = $(this).serialize()
	var submit_btn = $(".submit_button");
	var html_submit = submit_btn.html();
	submit_btn.html("PLEASE WAIT...");
	$.ajax({
		url : API_URL + "change_password.php",
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
$("#profile_details").on("submit",function(e){
	e.preventDefault();
	var formData = $(this).serialize()
	var submit_btn = $(".submit_button");
	var html_submit = submit_btn.html();
	submit_btn.html("PLEASE WAIT...");
	$.ajax({
		url : API_URL + "update_lecturer.php",
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

$("#add_lecture").on("submit",function(e){
    e.preventDefault();
    var formData = $(this).serialize()
    var submit_btn = $(".submit_button");
    var html_submit = submit_btn.html();
    submit_btn.html("PLEASE WAIT...");
    $.ajax({
        url : API_URL + "insert_lecture.php",
        method : "POST",
        cache : false,
        data : formData,
        success : function(res){
            /*Fire success the message through a toast*/
            submit_btn.html(html_submit)
            $.toast({
                text: res.msg,
                hideAfter: 3000,
                bgColor: '#28a745',
                loaderBg: '#166328',
                stack: 3,
                icon: 'success',
                position: 'top-right'
            })

	        setTimeout(function() {
			    $('#add-modal').modal('hide');
			}, 1000);
            
            $.ajax({
            	url : res.url,
            	cache : false,
            	method : "GET",
            	success: function(res){
        		    var a = document.createElement("a"); //Create <a>
				    a.href = res; //Image Base64 Goes here
				    a.download = "lecture_qr_code.png"; //File name Here
				    a.click(); //Downloaded file
            	}
            })

            $("#add_lecture").trigger("reset");
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

$("#enroll_course_unit").on("submit",function(e){
    e.preventDefault();
    var formData = $(this).serialize()
    var submit_btn = $(".submit_button1");
    var html_submit = submit_btn.html();
    submit_btn.html("PLEASE WAIT...");
    $.ajax({
        url : API_URL + "lecturer_course_unit.php",
        method : "POST",
        cache : false,
        data : formData,
        success : function(res){
            /*Fire success the message through a toast*/
            submit_btn.html(html_submit)
            $.toast({
                text: res.msg,
                hideAfter: 3000,
                bgColor: '#28a745',
                loaderBg: '#166328',
                stack: 3,
                icon: 'success',
                position: 'top-right'
            })
            
            $("#enroll_course_unit").trigger("reset");
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

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    $("#lecture_gps").val(lat+","+lng);
}

getLocation();