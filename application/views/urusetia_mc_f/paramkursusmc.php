<?php $this->load->view('templates/layout_dashboard.php');  ?>

<?php

$session_ukmper = $this->session->userdata('session_ukmper');
//$data_peribadi = $this->auth_m->get_data_peribadi($session_ukmper['ukmper']);
//$this->template->set('data_peribadi', $data_peribadi);
//dbug($arr['ukmper']);die();

$nama = $session_ukmper['fullname'];

/*if (!empty($data_peribadi)) {

    $nama = $data_peribadi[0]->nama;
}*/

?>


<!--Main container start -->
<main class="ttr-wrapper">
    <div class="container-fluid">
        <div class="db-breadcrumb">
            <h4 class="breadcrumb-title">Courses Parameter</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="<?= base_url('urusetia/dash_admin') ?>"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="<?= base_url('urusetia_mc/dash_admin') ?>">Dashboard Micro-credential</a></li>
                <li>Course Parameter Form</li>
            </ul>
        </div>
        <div class="row">
            <!-- Your Profile Views Chart -->
            <div class="col-lg-12 m-b30">
                <div class="widget-box">
                    <div class="wc-title">
                        <h4>Parameter Form</h4>
                    </div>
                    <div class="widget-inner">
                        <form class="edit-profile m-b30">
                            <div class="row">
                                <div class="col-12">
                                    <div class="ml-auto m-b5">
                                        <h3>1. Basic info</h3>
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <label class="col-form-label">Course Name</label>
                                    <select class="form-select" id="course_name" name="course_name" title="Select Course Name">
                                        <option disabled selected>--Choose--</option>
                                        <?php
                                        foreach ($list_course as $course) {
                                            echo "<option value='".$course->kodkursusinduk."'>".$course->nmkursusbi."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Courses Start Date</label>
                                    <div class="form-group">
                                        <div class="input-group input-group-lg date" id="datetimepicker1" data-target-input="nearest">
                                            <input type="text" id="startdate" name="startdate" class="form-control datetimepicker-input" data-target="#datetimepicker1">
                                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Courses End Date</label>
                                    <div class="form-group">
                                        <div class="input-group input-group-lg date" id="datetimepicker2" data-target-input="nearest">
                                            <input type="text" id="enddate" name="enddate" class="form-control datetimepicker-input" data-target="#datetimepicker2">
                                            <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Status</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Status Course</option>
                                        <option value="1">Computer Science</option>
                                        <option value="2">Computer Security</option>
                                        <option value="3">Business Information</option>
                                        <option value="4">Accounting</option>
                                        <option value="5">Cloud Technology</option>
                                    </select>
                                </div>

                                <div class="col-12 m-t20">
                                    <button type="submit" class="btn" name="btn_regkursus" id="btn_regkursus" value="btn_regkursus">Save changes</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Your Profile Views Chart END-->
        </div>
    </div>
</main>
<div class="ttr-overlay"></div>

<!-- External JavaScripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/vendors/bootstrap/js/popper.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="assets/vendors/magnific-popup/magnific-popup.js"></script>
<script src="assets/vendors/counter/waypoints-min.js"></script>
<script src="assets/vendors/counter/counterup.min.js"></script>
<script src="assets/vendors/imagesloaded/imagesloaded.js"></script>
<script src="assets/vendors/masonry/masonry.js"></script>
<script src="assets/vendors/masonry/filter.js"></script>
<script src="assets/vendors/owl-carousel/owl.carousel.js"></script>
<script src='assets/vendors/scroll/scrollbar.min.js'></script>
<script src="assets/js/functions.js"></script>
<script src="assets/vendors/chart/chart.min.js"></script>
<script src="assets/js/admin.js"></script>
<script src='assets/vendors/switcher/switcher.js'></script>
<script>
    // Pricing add
    function newMenuItem() {
        var newElem = $('tr.list-item').first().clone();
        newElem.find('input').val('');
        newElem.appendTo('table#item-add');
    }
    if ($("table#item-add").is('*')) {
        $('.add-item').on('click', function(e) {
            e.preventDefault();
            newMenuItem();
        });
        $(document).on("click", "#item-add .delete", function(e) {
            e.preventDefault();
            $(this).parent().parent().parent().parent().remove();
        });
    }
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js"></script>

<script>
    $(function() {
        $('#datetimepicker1').datetimepicker({
            useCurrent: false
        })

        $("#datetimepicker1").on("change.datetimepicker", function(e) {
            if (e.oldDate !== e.date) {
                alert('You picked: ' + new Date(e.date).toLocaleDateString('en-US'))
            }
        })
        $('#datetimepicker2').datetimepicker({
            useCurrent: false
        })

        $("#datetimepicker2").on("change.datetimepicker", function(e) {
            if (e.oldDate !== e.date) {
                alert('You picked: ' + new Date(e.date).toLocaleDateString('en-US'))
            }
        })
    })
</script>
</body>

<!-- Mirrored from educhamp.themetrades.com/demo/admin/add-listing.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:09:05 GMT -->

</html>
