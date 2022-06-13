<?php 
    if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }else{
        if(session_id() == null) {
            session_start();
        }
    }
            
    if (!empty($_SESSION['lecturerID'])) {
        header("Location: index.php");
        exit();
    }
 ?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="assets/images/favicon.ico">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#000000">
    <meta name="description" content="Kyambogo University Online Attendance Portal">
    <link rel="apple-touch-icon" href="assets/images/favicon.ico">
    <link rel="manifest" href="manifest.json">
    <title>Lecturers' Portal</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-2.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <style data-emotion="css"></style>
   <link rel="stylesheet" href="assets/toast/jquery.toast.css">
</head>

<body>
	<noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root">
        <div class="text-primary overflow-auto">
            <div class="container-fluid">
                <div class="min-vh-100 justify-content-center py-4 g-0 row">
                    <div class="my-auto mx-center col-lg-3 col-md-4 col-sm-6">
                        <div class="mx-auto text-center">
                            <div draggable="false" class="ant-image"><img alt="University Logo" class="ant-image-img text-center" src="assets/images/full-logo.png" style="max-width: 200px;"></div>
                        </div>
                        <div class="align-centre mt-1 font600 text-uppercase text-md mb-4 mt-3">LECTURERS' PORTAL</div>
                        <div class="bg-white rounded shadow-sm  card">
                            <div class="py-3 border-light fw-bold d-block text-center rounded-top card-header">LOGIN TO YOUR ACCOUNT</div>
                            <div class="card-body">
                                <form class="" id="login_form">
                                    <div class="form-group mb-2"><label class="font500 text-muted text-sm mb-1 form-label" for="lecturer_email">Lecturer Email<strong class="text-danger ms-1">*</strong></label>
                                        <div class=""><input name="lecturer_email" autocomplete="off" type="email" id="lecturer_email" class="form-control form-control-sm text-sm font500 w-100 rounded-0 null form-control" value="" required></div>
                                    </div>
                                    <div class="form-group mb-2"><label class="font500 text-muted text-sm mb-1 form-label" for="lecturer_password">Password<strong class="text-danger ms-1">*</strong></label>
                                        <div class=""><input name="lecturer_password" autocomplete="off" type="password" id="lecturer_password" class="form-control form-control-sm text-sm font500 w-100 rounded-0 null form-control" value="" required></div>
                                    </div><button type="submit" class="text-uppercase text-white text-sm my-3 w-100 fw-normal btn btn-primary btn-sm submit_button"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="me-1" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M416 448h-84c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h84c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32h-84c-6.6 0-12-5.4-12-12V76c0-6.6 5.4-12 12-12h84c53 0 96 43 96 96v192c0 53-43 96-96 96zm-47-201L201 79c-15-15-41-4.5-41 17v96H24c-13.3 0-24 10.7-24 24v96c0 13.3 10.7 24 24 24h136v96c0 21.5 26 32 41 17l168-168c9.3-9.4 9.3-24.6 0-34z"></path>
                                        </svg>SIGN IN</button>
                                </form>
                            </div>
                        </div>
                        <div class="mt-3 mb-2 text-center text-sm font600"><button type="button" class="text-sm fw-bold btn btn-link" data-toggle="modal" data-target="#add-modal">Reset My Password</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.modal -->
	<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header bg-primary">
	                <h3 class="modal-title m-0 text-white" id="exampleModalPrimary1">Password Reset</h3>
	                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true"><i class="la la-times text-white"></i></span>
	                </button>
	            </div><!--end modal-header-->
	            <div class="modal-body">
	                <div role="alert" class="fade text-md text-uppercase text-center text-success p-3 font500 rounded shadow-sm alert alert-info show">To reset your default or forgotten password, Enter your email and a password reset token will be sent to your email</div>

					<div class="bg-white rounded shadow-sm  card">
					    <div class="py-3 d-block fw-bold text-center border-light rounded-top card-header">RESET YOUR PASSWORD</div>
					    <div class="card-body">
					        <form method="post">
					            <div class="form-group mb-2"><label class="font500 text-muted text-sm mb-1 form-label" for="lecturer_email">Enter your email<strong class="text-danger ms-1">*</strong></label>
					                <div class=""><input name="lecturer_email" autocomplete="off" type="text" id="lecturer_email_forgotten" class="form-control form-control-sm text-sm font500 w-100 rounded-0 null form-control" value="" required><span class="email_div"></span></div>
					            </div><button type="submit" class="text-uppercase text-white text-sm mt-3 w-100 mb-2 fw-normal btn btn-primary btn-sm forgotten">Request New Password</button>
					        </form>
					    </div>
					</div>                                                
	            </div><!--end modal-body-->
	        </div><!--end modal-content-->
	    </div><!--end modal-dialog-->
	</div><!--end modal-->


</body>
<!-- jQuery  -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="js/login.js"></script>
<script src="assets/toast/jquery.toast.js"></script>

<script>
       
	if (window.history.replaceState) {
	    window.history.replaceState(null, null, window.location.href);
	}

</script>

</html>
