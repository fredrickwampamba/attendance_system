            <?php 
                if (empty($_GET['course_unit'])) {
                    header("Location: course_units.php");
                    exit();
                }
             ?>
            <?php include 'header.php'; ?>
            <?php $course_unit_info = $db_info->get_course_unit_info(trim($_GET['course_unit'])); ?>
                    <div class="">
                        <div class="card">
                            <div class="py-3 text-primary font600 text-sm mb-0"><span class="px-4">Course Unit: <?php echo $course_unit_info['course_unitID']." ".$course_unit_info['course_unit']; ?> -- <?php  ?>Lecturers (<?php echo $academic_year['year']." - ".$academic_year['semester']; ?>)</span><span class="float-right px-4"><a href="javascript:void(0);" class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#add-modal">Add Lecture</a></span></div>
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
                    var data = <?php echo json_encode($db_info->get_lecturer_lectures(LECTURERID,trim($_GET['course_unit']),$academic_year['yearID']) ,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE); ?>;
                    $('#datatable').DataTable({
                        data : data,
                        columns: [
                            { title: "#" },
                            { title: "Lecture ID" },
                            { title: "Lecture" },
                            { title: "Lecture Date" },
                            { title: "Lecture Time" },
                            { title: "Max Time Bound" },
                            { title: "Action" }
                        ],
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                    });           
                </script>

                <script type="text/javascript">
                    $(document).ready(function (){
                        $(".del_lecture").on('click', function(e){
                            var lecture_id = $(this).attr("data-id");
                            var btn = $(this);
                            if (!confirm("Delete this lecture? This will cause loss of attendance taken for this lecture.")) return false;
                            $.ajax({
                                method : "POST",
                                url : API_URL + "delete_lecture.php",
                                cache : false,
                                data : {lecture_id : lecture_id},
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
                                    btn.parent().parent().fadeOut('slow');
                                },
                                error : function(res){
                                    /*Fire success the message through a toast*/
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
                    });
                </script>