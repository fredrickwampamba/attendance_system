            <?php include 'header.php'; ?>

                    <div class="">
                        <div class="card">
                            <div class="py-3 text-primary font600 text-sm mb-0"><span class="px-4">Course Units</span><span class="float-right px-4"><a href="javascript:void(0);" class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#enroll-modal">Enroll Course Unit</a></span></div>
                            <div class="row-deck row p-4">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    </table>        
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <div class="modal fade" id="enroll-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h3 class="modal-title m-0 text-white" id="exampleModalPrimary1">Enroll for Course Units</h3>
                                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                                </button>
                            </div><!--end modal-header-->
                            <div class="modal-body">
                                
                                <div class="bg-white rounded shadow-sm  card">
                                    <div class="py-3 d-block fw-bold text-center border-light rounded-top card-header">Add the course units that you are going to lecture</div>
                                    <div class="card-body">
                                        <form method="post" id="enroll_course_unit">
                                            <div class="form-group mb-2"><label class="font500 text-muted text-sm mb-1 form-label" for="course_unit_id">Select Course Unit<strong class="text-danger ms-1">*</strong></label>
                                                <div class="">
                                                    <select class="form-control form-control-sm text-sm font500 w-100 rounded-0 null form-control" name="course_unit_id">
                                                        <option value="">Choose</option>
                                                        <?php 
                                                            $course_units_db = $db_info->get_all_course_units($academic_year['sem']);
                                                            foreach ($course_units_db as $key => $lecture) {
                                                        ?>
                                                        <option value="<?php echo $lecture[1]; ?>"><?php echo $lecture[3]." ".$lecture[2]; ?></option>
                                                        <?php 
                                                            }
                                                         ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="submit" class="text-white text-sm mt-3 w-100 mb-2 fw-normal btn btn-primary btn-sm submit_button1">Enroll</button>
                                        </form>
                                    </div>
                                </div>                                                
                            </div><!--end modal-body-->
                        </div><!--end modal-content-->
                    </div><!--end modal-dialog-->
                </div><!--end modal-->
                
                <?php include 'footer.php'; ?>

                <script>
                    var data = <?php echo json_encode($lecturer_course_units ,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE); ?>;
                    $('#datatable').DataTable({
                        data : data,
                        columns: [
                            { title: "#" },
                            { title: "Course ID" },
                            { title: "Course Unit" },
                            { title: "Code" },
                            { title: "Year" },
                            { title: "Semester" },
                            { title: "Action" }
                        ],
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                    });           
                </script>
                
                <script type="text/javascript">
                    $(document).ready(function (){
                        $(".del_un_enroll_course_unit").on('click', function(e){
                            var lecturer_course_unit = $(this).attr("data-id");
                            var btn = $(this);
                            if (!confirm("Un Enroll from this course unit? You will loose any information about lectures, and attendance taken for the lectures. Ensure print a copy.")) return false;
                            $.ajax({
                                method : "POST",
                                url : API_URL + "un_enroll_course_unit.php",
                                cache : false,
                                data : {lecturer_course_unit : lecturer_course_unit},
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