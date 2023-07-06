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
            <h4 class="breadcrumb-title">Course Registration by Unit</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="<?= base_url('urusetia/dash_admin') ?>"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="<?= base_url('urusetia_mc/dash_admin') ?>">Dashboard Micro-credential</a></li>
                <li>Course Registration by Unit Form</li>
            </ul>
        </div>
        <div class="row">
            <!-- Your Profile Views Chart -->
            <div class="col-lg-12 m-b30">
                <div class="widget-box">

                    <?php if ($this->session->flashdata('mesej')) { ?>
                        <div class="<?php echo $this->session->flashdata('mesej_css'); ?>" role="alert" id="mesej-alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <center><?php echo $this->session->flashdata('mesej'); ?></center>
                        </div>

                    <?php } ?>

                    <div class="wc-title">
                        <h4>Registration Form</h4>
                    </div>
                    <div class="widget-inner">
                        <form class="edit-profile m-b30" method="post" action="<?php echo base_url(); ?>urusetia_mc/registration_kursusunit">
                            <div class="row">
                                <div class="col-12">
                                    <div class="ml-auto m-b5">
                                        <h3>1. Basic info</h3>
                                    </div>
                                </div>

                                <div class="form-group col-3">
                                    <label class="col-form-label">Course Code</label>
                                    <div>
                                        <input class="form-control" type="text" value="" name="txt_coursecode">
                                    </div>
                                </div>


                                <div class="form-group col-12">
                                    <label class="col-form-label">Course Name</label>
                                    <div>
                                        <input class="form-control" type="text" value="" name="txt_coursename">
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Credit</label>
                                    <div>
                                        <input class="form-control" type="text" value="" name="txt_credit">
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Courses Level</label>
                                    <div>
                                        <input class="form-control" type="text" value="" name="txt_courselevel">
                                    </div>
                                </div>
                                <div class="seperator"></div>
                                <div class="col-12 m-t20">
                                    <div class="ml-auto m-b5">
                                        <h3>2. Synopsis</h3>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label">Synopsis (Bahasa)</label>
                                    <div>
                                        <textarea class="form-control" name="txt_synopsisbm"> </textarea>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label">Synopsis (English)</label>
                                    <div>
                                        <textarea class="form-control" name="txt_synopsisbi"> </textarea>
                                    </div>
                                </div>

                                <div class="col-12 m-t20">
                                    <button type="submit" class="btn" name="btn_regkursusunit" id="btn_regkursusunit" value="btn_regkursusunit">Save changes</button>
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
</body>

<!-- Mirrored from educhamp.themetrades.com/demo/admin/add-listing.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:09:05 GMT -->

</html>
