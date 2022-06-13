            <?php 
                if (empty($_GET['course_unit'])) {
                    header("Location: courses.php");
                    exit();
                }
                $course_unit_id = trim($_GET['course_unit']);
                /*Auto incremented value*/
             ?>

            <?php include 'header.php'; 
                $course_unit_info = $db_info->get_course_unit_info(trim($course_unit_id));
            ?>
                    <div class="">
                        <div class="card">
                            <div class="py-3 text-primary font600 text-sm mb-0 card-header">Attendance for (<?php echo $course_unit_info['course_unit']; ?>) (<?php echo $academic_year['year']." - ".$academic_year['semester']; ?>)</div>
                            <div class="row-deck row p-4">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <td>#</td>
                                            <td>Student</td>
                                            <td>Attendance</td>
                                            <td>Absentism</td>
                                        </thead>
<?php 
    $reg_nos = array();
    $yearID = $academic_year['yearID'];
    $sql = "SELECT DISTINCT reg_no FROM attendance LEFT JOIN lectures ON lectures.lecture_id = attendance.lectureID WHERE lectures.course_unit_id = '$course_unit_id' AND lectures.yearID = '$yearID'";
    $stt = $conn->query($sql);
    $a = 0;
    while ($reg_no_s = $stt->fetch_assoc()) {
        $reg_nos[$a]['reg_no'] = $reg_no__s = $reg_no_s['reg_no'];

        $sql__ = "SELECT reg_no FROM attendance LEFT JOIN lectures ON lectures.lecture_id = attendance.lectureID WHERE lectures.course_unit_id = '$course_unit_id' AND lectures.yearID = '$yearID' AND reg_no = '$reg_no__s'";
        $reg_nos[$a]['count'] = $conn->query($sql__)->num_rows;
        $a++;
    }

    /*Total lecture count*/
    $__ = "SELECT DISTINCT lecture_id FROM lectures WHERE lectures.course_unit_id = '$course_unit_id' AND lectures.yearID = '$yearID'";
    $_p_ = $conn->query($__);
    $tot___ = array();
    while ($lecture_info = $_p_->fetch_assoc()) {
        $lecture___ID = $lecture_info['lecture_id'];
        $tot___[] = $conn->query("SELECT DISTINCT lectureID FROM attendance LEFT JOIN lectures ON lectures.lecture_id = attendance.lectureID WHERE lectures.course_unit_id = '$course_unit_id' AND lectures.yearID = '$yearID' AND lectures.lecture_id = '$lecture___ID'")->num_rows;
    }
    $total_lectures = array_sum($tot___);
    
 ?>     
                                        <tbody>
                                    <?php $i = 1; foreach ($reg_nos as $key => $student_info) { ?>
                                        <tr>
                                            
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $student_info['reg_no'] ?></td>
                                            <td><?php echo $att = $student_info['count']/$total_lectures * 100 ?>%</td>
                                            <td><?php echo 100 - $att ?>%</td>
                                            
                                        </tr>
                                    <?php $i++; } ?>
                                        </tbody>
                                    </table>        
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include 'footer.php'; ?>

                <script>
                    $('#datatable').DataTable({
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        "buttons": ["copy", "excel", "pdf", "colvis"],
                    }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"), $(".dataTables_length select").addClass("form-select form-select-sm");;           
                </script>