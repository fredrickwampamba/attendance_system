            <?php include 'header.php'; ?>

                    <div class="">
                        <div class="card">
                            <div class="py-3 text-primary font600 text-sm mb-0 card-header">MY PROFILE</div>
                            <div class="row-deck gx-0 gy-2 row">
                                <div class="col-md-3">
                                    <div class="text-sm text-muted border-0 p-0 card">
                                        <div class="text-center p-3 border-bottom">
                                            <div class="mx-auto text-center pb-2">
                                                <div shape="" class="ant-image" style="width: 64px; height: 64px;"><img class="ant-image-img mx-auto rounded border bg-white" style="height: 64px;" src="<?php echo "assets/images/user.png"; ?>">
                                                </div>
                                            </div>
                                            <div class="font600 text-uppercase text-primary"><?php echo $lecturer_info['lecturer_name']; ?></div>
                                            <div class="font600 text-uppercase text-xs mt-2">LECTURER ID : <?php echo $lecturer_info['lecturerID']; ?></div>
                                        </div>
                                        <div class="list-group list-group-flush"><a href="?" class="fw-bold text-uppercase text-sm text-start list-group-item <?php echo (isset($_GET['security'])) ? "" : "active"; ?> list-group-item-action"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" class="me-2" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M319.4 320.6L224 416l-95.4-95.4C57.1 323.7 0 382.2 0 454.4v9.6c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-9.6c0-72.2-57.1-130.7-128.6-133.8zM13.6 79.8l6.4 1.5v58.4c-7 4.2-12 11.5-12 20.3 0 8.4 4.6 15.4 11.1 19.7L3.5 242c-1.7 6.9 2.1 14 7.6 14h41.8c5.5 0 9.3-7.1 7.6-14l-15.6-62.3C51.4 175.4 56 168.4 56 160c0-8.8-5-16.1-12-20.3V87.1l66 15.9c-8.6 17.2-14 36.4-14 57 0 70.7 57.3 128 128 128s128-57.3 128-128c0-20.6-5.3-39.8-14-57l96.3-23.2c18.2-4.4 18.2-27.1 0-31.5l-190.4-46c-13-3.1-26.7-3.1-39.7 0L13.6 48.2c-18.1 4.4-18.1 27.2 0 31.6z"></path>
                                                </svg>Personal Details</a><a href="?security" class="fw-bold text-uppercase text-sm text-start list-group-item <?php echo (isset($_GET['security'])) ? "active" : ""; ?> list-group-item-action"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 640 512" class="me-2" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M224 256A128 128 0 1 0 96 128a128 128 0 0 0 128 128zm96 64a63.08 63.08 0 0 1 8.1-30.5c-4.8-.5-9.5-1.5-14.5-1.5h-16.7a174.08 174.08 0 0 1-145.8 0h-16.7A134.43 134.43 0 0 0 0 422.4V464a48 48 0 0 0 48 48h280.9a63.54 63.54 0 0 1-8.9-32zm288-32h-32v-80a80 80 0 0 0-160 0v80h-32a32 32 0 0 0-32 32v160a32 32 0 0 0 32 32h224a32 32 0 0 0 32-32V320a32 32 0 0 0-32-32zM496 432a32 32 0 1 1 32-32 32 32 0 0 1-32 32zm32-144h-64v-80a32 32 0 0 1 64 0z"></path>
                                                </svg>Security Details</a></div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="border-start border-top-0 border-bottom-0 border-end-0 card">
                                        <div class="text-primary font600 py-3 text-sm card-header"><?php echo (isset($_GET['security'])) ? "CHANGE PASSWORD" : "MY PROFILE DETAILS"; ?></div>

                                        <div class="card-body">
                                            <?php 
                                                if (isset($_GET['security'])) {
                                             ?>
                                             <form class="row" method="POST" id="security_details">
                                                <div class="col-md-11">
                                                    <div class="row my-2"><label class="font500 text-muted text-sm col-md-4 my-auto form-label">Current Password</label>
                                                        <div class="col-md-8"><input autocomplete="off" type="password" required name="lecturer_password" class="form-control form-control-sm text-sm font500 w-100 rounded-0 null form-control"></div>
                                                    </div>
                                                    <div class="row my-2"><label class="font500 text-muted text-sm col-md-4 my-auto form-label">New Password</label>
                                                        <div class="col-md-8"><input  name="new_lecturer_password" required autocomplete="off" type="password" class="form-control form-control-sm text-sm font500 w-100 rounded-0 null form-control"></div>
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col-md-12 pt-3 text-center"><input type="submit" autocomplete="off" class="text-sm font500 btn btn-primary text-white submit_button" value="Submit"></div>
                                                    </div>
                                                </div>
                                            </form>
                                            <?php }else{ ?>
                                            <form class="row" id="profile_details">
                                                <div class="col-md-11">
                                                    <div class="row my-2"><label class="font500 text-muted text-sm col-md-4 my-auto form-label">Full Name</label>
                                                        <div class="col-md-8"><input autocomplete="off" type="text" name="lecturer_name" class="form-control form-control-sm text-sm font500 w-100 rounded-0 null form-control" value="<?php echo $lecturer_info['lecturer_name']; ?>"></div>
                                                    </div>
                                                    <div class="row my-2"><label class="font500 text-muted text-sm col-md-4 my-auto form-label">Email</label>
                                                        <div class="col-md-8"><input  name="lecturer_email" autocomplete="off" type="email" class="form-control form-control-sm text-sm font500 w-100 rounded-0 null form-control" value="<?php echo $lecturer_info['lecturer_email']; ?>"></div>
                                                    </div>
                                                    <div class="row my-2"><label class="font500 text-muted text-sm col-md-4 my-auto form-label">Phone</label>
                                                        <div class="col-md-8"><input  name="lecturer_phone" autocomplete="off" type="text" class="form-control form-control-sm text-sm font500 w-100 rounded-0 null form-control" value="<?php echo $lecturer_info['lecturer_phone']; ?>"></div>
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col-md-12 pt-3 text-center"><input type="submit" autocomplete="off" class="text-sm font500 btn btn-primary text-white submit_button" value="Submit"></div>
                                                    </div>
                                                </div>
                                            </form>

                                            <?php } ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-2 w-100 text-center text-muted text-xs">Last Login <?php echo date('D, M dS Y, h:i:s a', strtotime($last_login_info['date_time']))." on ".$last_login_info['remote_ip']; ?></div>
                    </div>

                    <?php 
                        if (isset($_GET['security'])) {
                     ?>

                    <div class="p-3">
                        <div class="card">
                            <div class="py-3 text-primary font600 text-sm mb-0"><span class="px-4">Login History</span></div>
                            <div class="row-deck row p-4">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    </table>        
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php } ?>

                </main>
                <?php include 'footer.php'; ?>

                <?php 
                    if (isset($_GET['security'])) {
                 ?>
                <script>
                    var data = <?php echo json_encode($db_info->get_all_logins(LECTURERID) ,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE); ?>;
                    $('#datatable').DataTable({
                        data : data,
                        columns: [
                            { title: "#" },
                            { title: "IP" },
                            { title: "Date" },
                            { title: "Time" }
                        ],
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                    });           
                </script>
                <?php } ?>