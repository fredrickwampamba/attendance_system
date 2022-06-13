<?php 
  if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
  }
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="assets/logo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
      Attendance System
    </title>
    <meta
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"
      name="viewport"
    />
    <!--     Fonts and icons     -->
    <link
      rel="stylesheet"
      type="text/css"
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
    />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-dashboard.css" rel="stylesheet" />
    <link href="assets/css/demo-documentation.css" rel="stylesheet" />
    <style media="screen">
      .page-header {
        height: 100vh;
      }

      .page-header .description {
        color: #ffffff;
      }

      .header-filter .container {
        padding-top: 33vh;
      }
    </style>
  </head>

  <body class="components-page">
    <nav
      class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll"
    >
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a href="https://kwaug.com/">
            <div class="logo-container">
              <div class="logo">
                <img src="assets/logo.png" alt="kyu" />
              </div>
              <div class="brand">Attendance project</div>
            </div>
          </a>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
    <div
      class="page-header header-filter"
      style="background-image: url('assets/bg.jpg');"
    >
      <div class="container">
        <!-- <div class="row"> -->
          <div class="col-md-8 col-md-offset-2 text-center">
            <h1 class="title ">Attendance System</h1>
            <h5 class="description" style="font-size: 1em;">Scan to take attendance</h5>
            <a
              href="web/"
              class="btn btn-success btn-fill btn-round"
              >Lecturer Portal</a
            >
              <a
                href="app/app-release.apk"
                download
                class="btn btn-info btn-fill btn-round"
                >Android app</a
              >
          </div>
        <!-- </div> -->
      </div>
    </div>
    <footer class="footer footer-transparent">
      <div class="container">
        <div class="copyright">
          &copy; 
          <script>
            document.write(new Date().getFullYear());
          </script>

          By Fredrick Wampamba, Kelly Allowo, Arinda Joyce
        </div>
      </div>
    </footer>
  </body>
  <!--   Core JS Files   -->
  <script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
  <script>
    var header_height;
    var fixed_section;
    var floating = false;

    $().ready(function() {
      suggestions_distance = $("#suggestions").offset();
      pay_height = $(".fixed-section").outerHeight();
    });
  </script>
</html>
