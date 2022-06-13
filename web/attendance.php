            <?php 
                if (empty($_GET['lec'])) {
                    header("Location: lectures.php");
                    exit();
                }
                $lecture_id = trim($_GET['lec']);
                /*Auto incremented value*/
             ?>

            <?php include 'header.php'; 
                $lecture_info = $db_info->get_lecture_info($lecture_id);
                $lecture_details = $lecture_info[0];
            ?>
                    <div class="">
                        <div class="card">
                            <div class="py-3 text-primary font600 text-sm mb-0 card-header">Attendance [<?php echo $lecture_details['lecture']." on ".$lecture_details['lecture_date']." @ ".$lecture_details['lecture_time']; ?>] (<?php echo $academic_year['year']." - ".$academic_year['semester']; ?>)</div>
                            <div class="row-deck row p-4">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    </table>        
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include 'footer.php'; ?>

                <script>
                    var data = <?php echo json_encode($lecture_info[1] ,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE); ?>;
                    $('#datatable').DataTable({
                        data : data,
                        columns: [
                            { title: "#" },
                            { title: "Registration no." },
                            { title: "Date : Time" },
                            { title: "GPS" },
                            { title: "IP" },
                            { title: "MAC" }
                        ],
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                    });           
                </script>