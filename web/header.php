<?php include 'main.php'; ?>

<?php $pageTitleUsingFile = fileNameBeautifier(basename($_SERVER['SCRIPT_FILENAME'], '.php')); ?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="assets/images/favicon.ico">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#000000">
    <meta name="description" content="Kyambogo University Online Attendance Portal">
    <link rel="apple-touch-icon" href="assets/images/favicon.ico">
    <link rel="manifest" href="manifest.json">
    <title><?php echo $pageTitleUsingFile; ?></title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/style-2.css" rel="stylesheet">
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <link href="css/custom.css" rel="stylesheet">
    <style data-emotion="css"></style>
   <link rel="stylesheet" href="assets/toast/jquery.toast.css">
   <link href="css/style-3.css" rel="stylesheet">

   <!-- DataTables -->
    <link href="plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root">
        <section class="ant-layout ant-layout-has-sider" style="min-height: 100vh;">

           <!--  <aside class="ant-layout-sider ant-layout-sider-light border-end col-2" style="height: 100vh; position: fixed;">
                <div class="ant-layout-sider-children">
                    <div class="bg-white font600 p-2">
                        <div class="ant-row ant-row-no-wrap" style="row-gap: 0px;">
                            <div style="flex: 2 2 auto; min-width: 0px;" class="ant-col my-auto">
                                <div class="ant-image" style="width: 45px; height: 45px;"><img alt="Logo" class="ant-image-img my-auto" style="height: 45px;" src="assets/images/full-logo.png"></div>
                            </div>
                            <div style="flex: 3 3 auto; min-width: 0px;" class="ant-col text-center my-auto">
                                <div class="px-2 text-primary text-md text-uppercase text-center font600">Kyambogo University</div>
                            </div>
                        </div>
                    </div>
                    <div class="student-profile mx-auto text-sm text-center py-3 border-bottom">
                        <div shape="square" size="76" draggable="false" class="ant-image" style="width: 64px; height: 64px;"><img class="ant-image-img mx-auto rounded border bg-white" style="height: 64px;" src="<?php echo (isset($lecturer_info['image_path']))? $lecturer_info['image_path'] : 'assets/images/full-logo.png' ; ?>" alt="lecturer image">
                        </div>
                        <div class="font500 mt-2 text-uppercase text-light"><?php echo $lecturer_info['lecturer_name']; ?> </div>
                        <div class="font600 text-uppercase mt-1 text-light">LECTURER ID : <?php echo $lecturer_info['lecturerID']; ?></div>
                    </div>
                    <ul class="ant-menu ant-menu-root ant-menu-inline ant-menu-light" role="menu" tabindex="0" data-menu-list="true">
                        <li class="ant-menu-item px-3 m-0 font500" style="padding-left: 24px;"><a href="index.php" role="img" aria-label="field-binary" class="anticon anticon-field-binary ant-menu-item-icon"><svg viewBox="64 64 896 896" focusable="false" data-icon="field-binary" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                    <path d="M600 395.4h91V649h79V267c0-4.4-3.6-8-8-8h-48.2c-3.7 0-7 2.6-7.7 6.3-2.6 12.1-6.9 22.3-12.9 30.9a86.14 86.14 0 01-26.3 24.4c-10.3 6.2-22 10.5-35 12.9-10.4 1.9-21 3-32 3.1a8 8 0 00-7.9 8v42.8c0 4.4 3.6 8 8 8zM871 702H567c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h304c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zM443.9 312.7c-16.1-19-34.4-32.4-55.2-40.4-21.3-8.2-44.1-12.3-68.4-12.3-23.9 0-46.4 4.1-67.7 12.3-20.8 8-39 21.4-54.8 40.3-15.9 19.1-28.7 44.7-38.3 77-9.6 32.5-14.5 73-14.5 121.5 0 49.9 4.9 91.4 14.5 124.4 9.6 32.8 22.4 58.7 38.3 77.7 15.8 18.9 34 32.3 54.8 40.3 21.3 8.2 43.8 12.3 67.7 12.3 24.4 0 47.2-4.1 68.4-12.3 20.8-8 39.2-21.4 55.2-40.4 16.1-19 29-44.9 38.6-77.7 9.6-33 14.5-74.5 14.5-124.4 0-48.4-4.9-88.9-14.5-121.5-9.5-32.1-22.4-57.7-38.6-76.8zm-29.5 251.7c-1 21.4-4.2 42-9.5 61.9-5.5 20.7-14.5 38.5-27 53.4-13.6 16.3-33.2 24.3-57.6 24.3-24 0-43.2-8.1-56.7-24.4-12.2-14.8-21.1-32.6-26.6-53.3-5.3-19.9-8.5-40.6-9.5-61.9-1-20.8-1.5-38.5-1.5-53.2 0-8.8.1-19.4.4-31.8.2-12.7 1.1-25.8 2.6-39.2 1.5-13.6 4-27.1 7.6-40.5 3.7-13.8 8.8-26.3 15.4-37.4 6.9-11.6 15.8-21.1 26.7-28.3 11.4-7.6 25.3-11.3 41.5-11.3 16.1 0 30.1 3.7 41.7 11.2a87.94 87.94 0 0127.4 28.2c6.9 11.2 12.1 23.8 15.6 37.7 3.3 13.2 5.8 26.6 7.5 40.1 1.8 13.5 2.8 26.6 3 39.4.2 12.4.4 23 .4 31.8.1 14.8-.4 32.5-1.4 53.3z"></path>
                                </svg> <span class="ant-menu-title-content">Dashboard</span></a></li>
                        <li class="ant-menu-item px-3 m-0 font500" style="padding-left: 24px;"><a href="course_units.php" role="img" aria-label="field-binary" class="anticon anticon-field-binary ant-menu-item-icon"><svg viewBox="0 0 512 512" focusable="false" data-icon="user" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                    <path d="M505.04 442.66l-99.71-99.69c-4.5-4.5-10.6-7-17-7h-16.3c27.6-35.3 44-79.69 44-127.99C416.03 93.09 322.92 0 208.02 0S0 93.09 0 207.98s93.11 207.98 208.02 207.98c48.3 0 92.71-16.4 128.01-44v16.3c0 6.4 2.5 12.5 7 17l99.71 99.69c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.59.1-33.99zm-297.02-90.7c-79.54 0-144-64.34-144-143.98 0-79.53 64.35-143.98 144-143.98 79.54 0 144 64.34 144 143.98 0 79.53-64.35 143.98-144 143.98zm27.11-152.54l-45.01-13.5c-5.16-1.55-8.77-6.78-8.77-12.73 0-7.27 5.3-13.19 11.8-13.19h28.11c4.56 0 8.96 1.29 12.82 3.72 3.24 2.03 7.36 1.91 10.13-.73l11.75-11.21c3.53-3.37 3.33-9.21-.57-12.14-9.1-6.83-20.08-10.77-31.37-11.35V112c0-4.42-3.58-8-8-8h-16c-4.42 0-8 3.58-8 8v16.12c-23.63.63-42.68 20.55-42.68 45.07 0 19.97 12.99 37.81 31.58 43.39l45.01 13.5c5.16 1.55 8.77 6.78 8.77 12.73 0 7.27-5.3 13.19-11.8 13.19h-28.1c-4.56 0-8.96-1.29-12.82-3.72-3.24-2.03-7.36-1.91-10.13.73l-11.75 11.21c-3.53 3.37-3.33 9.21.57 12.14 9.1 6.83 20.08 10.77 31.37 11.35V304c0 4.42 3.58 8 8 8h16c4.42 0 8-3.58 8-8v-16.12c23.63-.63 42.68-20.54 42.68-45.07 0-19.97-12.99-37.81-31.59-43.39z"></path>
                                </svg> <span class="ant-menu-title-content">Course Units</span></a></li>
                        <li class="ant-menu-item-divider m-0 p-0"></li>
                        <li class="ant-menu-item px-3 m-0 font500" style="padding-left: 24px;" role="menuitem" tabindex="-1" data-menu-id="rc-menu-uuid-71229-1-bio-data"><a href="profile.php" role="img" aria-label="user" class="anticon anticon-user ant-menu-item-icon"><svg viewBox="64 64 896 896" focusable="false" data-icon="user" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                    <path d="M858.5 763.6a374 374 0 00-80.6-119.5 375.63 375.63 0 00-119.5-80.6c-.4-.2-.8-.3-1.2-.5C719.5 518 760 444.7 760 362c0-137-111-248-248-248S264 225 264 362c0 82.7 40.5 156 102.8 201.1-.4.2-.8.3-1.2.5-44.8 18.9-85 46-119.5 80.6a375.63 375.63 0 00-80.6 119.5A371.7 371.7 0 00136 901.8a8 8 0 008 8.2h60c4.4 0 7.9-3.5 8-7.8 2-77.2 33-149.5 87.8-204.3 56.7-56.7 132-87.9 212.2-87.9s155.5 31.2 212.2 87.9C779 752.7 810 825 812 902.2c.1 4.4 3.6 7.8 8 7.8h60a8 8 0 008-8.2c-1-47.8-10.9-94.3-29.5-138.2zM512 534c-45.9 0-89.1-17.9-121.6-50.4S340 407.9 340 362c0-45.9 17.9-89.1 50.4-121.6S466.1 190 512 190s89.1 17.9 121.6 50.4S684 316.1 684 362c0 45.9-17.9 89.1-50.4 121.6S557.9 534 512 534z"></path>
                                </svg> <span class="ant-menu-title-content">Bio Data</span></a></li>
                        <li class="ant-menu-item-divider m-0 p-0"></li>
                    </ul>
                </div>
            </aside> -->

            <section class="ant-layout col-12" style="transition: all 0.2s ease 0s;">
                <header class="ant-layout-header bg-white border-bottom ps-0 pe-3" theme="light"><button type="button" class="btn btn-link menu_link">
                    <img style="height: 40px; border-radius: 10%;" src="<?php echo (isset($lecturer_info['image_path']))? $lecturer_info['image_path'] : 'assets/images/full-logo.png' ; ?>" alt="lecturer image">
                </button>
                    <div role="group" class="btn-group"><button type="button" class="me-1 text-sm font500 btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#add-modal">GENERATE QR Code</button></div>
                    <div role="group" class="rightContainer d-inline">
                        <span class="no_on_small_dev"><img style="height: 30px; border-radius: 100%;" src="<?php echo 'assets/images/user.png'; ?>" alt="lecturer image">
                        <div class="me-1 text-sm text-primary font500 btn"><?php echo $lecturer_info['lecturer_name']; ?></div></span>
                        <a href="logout.php" class="me-1 text-sm font500 btn btn-danger btn-sm"><svg viewBox="64 64 896 896" focusable="false" data-icon="ellipsis" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                            <path d="M868 732h-70.3c-4.8 0-9.3 2.1-12.3 5.8-7 8.5-14.5 16.7-22.4 24.5a353.84 353.84 0 01-112.7 75.9A352.8 352.8 0 01512.4 866c-47.9 0-94.3-9.4-137.9-27.8a353.84 353.84 0 01-112.7-75.9 353.28 353.28 0 01-76-112.5C167.3 606.2 158 559.9 158 512s9.4-94.2 27.8-137.8c17.8-42.1 43.4-80 76-112.5s70.5-58.1 112.7-75.9c43.6-18.4 90-27.8 137.9-27.8 47.9 0 94.3 9.3 137.9 27.8 42.2 17.8 80.1 43.4 112.7 75.9 7.9 7.9 15.3 16.1 22.4 24.5 3 3.7 7.6 5.8 12.3 5.8H868c6.3 0 10.2-7 6.7-12.3C798 160.5 663.8 81.6 511.3 82 271.7 82.6 79.6 277.1 82 516.4 84.4 751.9 276.2 942 512.4 942c152.1 0 285.7-78.8 362.3-197.7 3.4-5.3-.4-12.3-6.7-12.3zm88.9-226.3L815 393.7c-5.3-4.2-13-.4-13 6.3v76H488c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h314v76c0 6.7 7.8 10.5 13 6.3l141.9-112a8 8 0 000-12.6z"></path>
                                        </svg> Log out</a></div>
                </header>
                <main class="ant-layout-content">
                    <div class="py-1 px-1 border-0 bg-light card-header">
                        <div class="text-sm font500 my-auto"></div>
                    </div>
                    <div class="border-top border-bottom border-start-0 border-end-0 card">
                        <div class="py-2 px-3 border-0 mb-0 text-center justify-content-center card-header">
                            <div role="group" class="rounded-0 me-2 academic-status btn-group btn-group-sm"><button type="button" class="text-sm text-uppercase mb-1 btn btn-dark btn-sm">Current Yr.</button><button type="button" class="text-sm fw-bold text-white text-uppercase mb-1 btn btn-info btn-sm"><?php echo $academic_year['year']; ?></button></div>
                            <div role="group" class="rounded-0 me-2 academic-status btn-group btn-group-sm"><button type="button" class="text-sm text-uppercase mb-1 btn btn-dark btn-sm">Current Sem.</button><button type="button" class="text-sm fw-bold text-white text-uppercase mb-1 btn btn-info btn-sm"><?php echo $academic_year['semester']; ?></button></div>
                        </div>
                    </div>
                    <div class="py-0 px-1 border-0 bg-light card-header">
                        <div class="text-sm font500 my-auto"></div>
                    </div>
                    <div class="border-top border-bottom border-start-0 border-end-0 card">
                        <div class="py-2 px-2 border-0 mb-0 text-center justify-content-center card-header">
                        <div class="ant-menu-item px-5 py-2 m-0 font500" style="padding-left: 24px;"><a href="index.php" role="img" aria-label="field-binary" class="anticon anticon-field-binary ant-menu-item-icon"><svg viewBox="64 64 896 896" focusable="false" data-icon="field-binary" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                    <path d="M600 395.4h91V649h79V267c0-4.4-3.6-8-8-8h-48.2c-3.7 0-7 2.6-7.7 6.3-2.6 12.1-6.9 22.3-12.9 30.9a86.14 86.14 0 01-26.3 24.4c-10.3 6.2-22 10.5-35 12.9-10.4 1.9-21 3-32 3.1a8 8 0 00-7.9 8v42.8c0 4.4 3.6 8 8 8zM871 702H567c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h304c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zM443.9 312.7c-16.1-19-34.4-32.4-55.2-40.4-21.3-8.2-44.1-12.3-68.4-12.3-23.9 0-46.4 4.1-67.7 12.3-20.8 8-39 21.4-54.8 40.3-15.9 19.1-28.7 44.7-38.3 77-9.6 32.5-14.5 73-14.5 121.5 0 49.9 4.9 91.4 14.5 124.4 9.6 32.8 22.4 58.7 38.3 77.7 15.8 18.9 34 32.3 54.8 40.3 21.3 8.2 43.8 12.3 67.7 12.3 24.4 0 47.2-4.1 68.4-12.3 20.8-8 39.2-21.4 55.2-40.4 16.1-19 29-44.9 38.6-77.7 9.6-33 14.5-74.5 14.5-124.4 0-48.4-4.9-88.9-14.5-121.5-9.5-32.1-22.4-57.7-38.6-76.8zm-29.5 251.7c-1 21.4-4.2 42-9.5 61.9-5.5 20.7-14.5 38.5-27 53.4-13.6 16.3-33.2 24.3-57.6 24.3-24 0-43.2-8.1-56.7-24.4-12.2-14.8-21.1-32.6-26.6-53.3-5.3-19.9-8.5-40.6-9.5-61.9-1-20.8-1.5-38.5-1.5-53.2 0-8.8.1-19.4.4-31.8.2-12.7 1.1-25.8 2.6-39.2 1.5-13.6 4-27.1 7.6-40.5 3.7-13.8 8.8-26.3 15.4-37.4 6.9-11.6 15.8-21.1 26.7-28.3 11.4-7.6 25.3-11.3 41.5-11.3 16.1 0 30.1 3.7 41.7 11.2a87.94 87.94 0 0127.4 28.2c6.9 11.2 12.1 23.8 15.6 37.7 3.3 13.2 5.8 26.6 7.5 40.1 1.8 13.5 2.8 26.6 3 39.4.2 12.4.4 23 .4 31.8.1 14.8-.4 32.5-1.4 53.3z"></path>
                                </svg> <span class="ant-menu-title-content">Dashboard</span></a></div>
                        <div class="ant-menu-item px-5 m-0 font500" style="padding-left: 24px;"><a href="course_units.php" role="img" aria-label="field-binary" class="anticon anticon-field-binary ant-menu-item-icon"><svg viewBox="0 0 512 512" focusable="false" data-icon="user" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                    <path d="M505.04 442.66l-99.71-99.69c-4.5-4.5-10.6-7-17-7h-16.3c27.6-35.3 44-79.69 44-127.99C416.03 93.09 322.92 0 208.02 0S0 93.09 0 207.98s93.11 207.98 208.02 207.98c48.3 0 92.71-16.4 128.01-44v16.3c0 6.4 2.5 12.5 7 17l99.71 99.69c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.59.1-33.99zm-297.02-90.7c-79.54 0-144-64.34-144-143.98 0-79.53 64.35-143.98 144-143.98 79.54 0 144 64.34 144 143.98 0 79.53-64.35 143.98-144 143.98zm27.11-152.54l-45.01-13.5c-5.16-1.55-8.77-6.78-8.77-12.73 0-7.27 5.3-13.19 11.8-13.19h28.11c4.56 0 8.96 1.29 12.82 3.72 3.24 2.03 7.36 1.91 10.13-.73l11.75-11.21c3.53-3.37 3.33-9.21-.57-12.14-9.1-6.83-20.08-10.77-31.37-11.35V112c0-4.42-3.58-8-8-8h-16c-4.42 0-8 3.58-8 8v16.12c-23.63.63-42.68 20.55-42.68 45.07 0 19.97 12.99 37.81 31.58 43.39l45.01 13.5c5.16 1.55 8.77 6.78 8.77 12.73 0 7.27-5.3 13.19-11.8 13.19h-28.1c-4.56 0-8.96-1.29-12.82-3.72-3.24-2.03-7.36-1.91-10.13.73l-11.75 11.21c-3.53 3.37-3.33 9.21.57 12.14 9.1 6.83 20.08 10.77 31.37 11.35V304c0 4.42 3.58 8 8 8h16c4.42 0 8-3.58 8-8v-16.12c23.63-.63 42.68-20.54 42.68-45.07 0-19.97-12.99-37.81-31.59-43.39z"></path>
                                </svg> <span class="ant-menu-title-content">Course Units</span></a></div>
                        <div class="ant-menu-item px-5 m-0 font500" style="padding-left: 24px;" role="menuitem" tabindex="-1" data-menu-id="rc-menu-uuid-71229-1-bio-data"><a href="profile.php" role="img" aria-label="user" class="anticon anticon-user ant-menu-item-icon"><svg viewBox="64 64 896 896" focusable="false" data-icon="user" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                    <path d="M858.5 763.6a374 374 0 00-80.6-119.5 375.63 375.63 0 00-119.5-80.6c-.4-.2-.8-.3-1.2-.5C719.5 518 760 444.7 760 362c0-137-111-248-248-248S264 225 264 362c0 82.7 40.5 156 102.8 201.1-.4.2-.8.3-1.2.5-44.8 18.9-85 46-119.5 80.6a375.63 375.63 0 00-80.6 119.5A371.7 371.7 0 00136 901.8a8 8 0 008 8.2h60c4.4 0 7.9-3.5 8-7.8 2-77.2 33-149.5 87.8-204.3 56.7-56.7 132-87.9 212.2-87.9s155.5 31.2 212.2 87.9C779 752.7 810 825 812 902.2c.1 4.4 3.6 7.8 8 7.8h60a8 8 0 008-8.2c-1-47.8-10.9-94.3-29.5-138.2zM512 534c-45.9 0-89.1-17.9-121.6-50.4S340 407.9 340 362c0-45.9 17.9-89.1 50.4-121.6S466.1 190 512 190s89.1 17.9 121.6 50.4S684 316.1 684 362c0 45.9-17.9 89.1-50.4 121.6S557.9 534 512 534z"></path>
                                </svg> <span class="ant-menu-title-content">Bio Data</span></a></div>
                        </div>
                    </div>

                    <!-- /.modal -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h3 class="modal-title m-0 text-white" id="exampleModalPrimary1">Generate QR code</h3>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                    </button>
                </div><!--end modal-header-->
                <div class="modal-body">
                    
                    <div class="bg-white rounded shadow-sm  card">
                        <div class="py-3 d-block fw-bold text-center border-light rounded-top card-header">Add Lecture to generate QR code</div>
                        <div class="card-body">
                            <form method="post" id="add_lecture">
                                <input type="hidden" name="lecture_gps" id="lecture_gps">
                                <div class="form-group mb-2"><label class="font500 text-muted text-sm mb-1 form-label" for="lecture_course_unit">Select Course Unit<strong class="text-danger ms-1">*</strong></label>
                                    <div class="">
                                        <select class="form-control form-control-sm text-sm font500 w-100 rounded-0 null form-control" name="lecture_course_unit">
                                            <option value="">Choose</option>
                                            <?php 
                                                $lecturer_course_units = $db_info->get_lecturer_course_units(LECTURERID, $academic_year['yearID']);
                                                foreach ($lecturer_course_units as $key => $lecture) {
                                            ?>
                                            <option value="<?php echo $lecture[1]; ?>"><?php echo $lecture[3]." ".$lecture[2]; ?></option>
                                            <?php 
                                                }
                                             ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-2"><label class="font500 text-muted text-sm mb-1 form-label" for="lecturer_email">Enter Lecture Date<strong class="text-danger ms-1">*</strong></label>
                                    <div class="">
                                        <input name="lecture_date" autocomplete="off" type="date" id="lecturer_email_forgotten" class="form-control form-control-sm text-sm font500 w-100 rounded-0 null form-control" value="<?php echo date("Y-m-d"); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group mb-2"><label class="font500 text-muted text-sm mb-1 form-label" for="lecture_time">Enter Lecture Time<strong class="text-danger ms-1">*</strong></label>
                                    <div class="">
                                        <input name="lecture_time" autocomplete="off" type="time" id="lecturer_email_forgotten" class="form-control form-control-sm text-sm font500 w-100 rounded-0 null form-control" value="<?php echo date("H:i"); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group mb-2"><label class="font500 text-muted text-sm mb-1 form-label" for="lecturer_email">Enter Lecture Duration <small>(In minutes)</small><strong class="text-danger ms-1">*</strong></label>
                                    <div class="">
                                        <input name="time_bound" autocomplete="off" type="number" id="lecturer_email_forgotten" min="0" max="120" class="form-control form-control-sm text-sm font500 w-100 rounded-0 null form-control" value="" required>
                                    </div>
                                </div>
                                <button type="submit" class="text-white text-sm mt-3 w-100 mb-2 fw-normal btn btn-primary btn-sm submit_button">Add Lecture</button>
                            </form>
                        </div>
                    </div>                                                
                </div><!--end modal-body-->
            </div><!--end modal-content-->
        </div><!--end modal-dialog-->
    </div><!--end modal-->