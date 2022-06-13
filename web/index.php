            <?php include 'header.php'; ?>
            
                    <div class="">
                        <div class="card">
                            <div class="card-body">
                                <?php 
                                    $enrollment_check = $db_info->lecturer_enrolled_check(count($db_info->get_lecturer_course_units(LECTURERID, $academic_year['yearID'])));
                                    if ($enrollment_check) {
                                ?>

                                <div role="alert" class="fade py-2 font600 text-uppercase text-center text-sm mb-4 alert alert-success show"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="me-1" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
                                    </svg>Enrolled for <?php echo $academic_year['year']; ?> - <?php echo $academic_year['semester']; ?>
                                </div>

                                <?php 
                                    }else{
                                 ?>
                                
                                <div role="alert" class="fade py-2 font600 text-center text-uppercase text-sm mb-4 alert alert-danger show"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="me-1" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
                                    </svg>Not Enrolled for <?php echo $academic_year['year']; ?> - <?php echo $academic_year['semester']; ?>
                                    <br>
                                    <small style="text-transform: lowercase;">Please add the course units you are to lecture <br> <a href="course_units.php">Click here</a></small>
                                </div>

                                <?php } ?>

                                <div class="row-deck g-3 text-muted row">
                                    <div class="mb-3 col-md-6">
                                        <div class="py-1 bg-light card">
                                            <div class="card-body">
                                                <p class="text-sm"><span class="font600 text-uppercase me-1">Academic Year:</span><?php echo $academic_year['year']; ?></p>
                                                <p class="text-sm mb-0"><span class="font600 text-uppercase me-1">SEMESTER:</span><?php echo $academic_year['semester']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="py-1 bg-light card">
                                            <div class="card-body">
                                                <p class="text-sm"><span class="font600 text-uppercase me-1">ENROLLED AS:</span><?php echo ($enrollment_check)? "LECTURER" : "--"; ?></p>
                                                <p class="text-sm mb-0"><span class="font600 text-uppercase me-1">ENROLLED BY:</span><?php echo ($enrollment_check)? "SELF" : "--"; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include 'footer.php'; ?>