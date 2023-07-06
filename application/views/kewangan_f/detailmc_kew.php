<?php $this->load->view('templates/layout_dashboard.php');  ?>

<?php

$session_ukmper = $this->session->userdata('session_ukmper');
$data_peribadi = $this->auth_m->get_data_peribadi($session_ukmper['ukmper']);
$this->template->set('data_peribadi', $data_peribadi);
//dbug($arr['ukmper']);die();

if (!empty($data_peribadi)) {

    $nama = $data_peribadi[0]->nama;
}
?>


<!--Main container start -->
<main class="ttr-wrapper">
    <div class="container-fluid">
        <div class="db-breadcrumb">
            <h4 class="breadcrumb-title">Detail Application</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="<?= base_url('urusetia/dash_admin') ?>"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="<?= base_url('kewangan/dash_kew') ?>">Dashboard Finance Department</a></li>
                <li><a href="<?= base_url('kewangan/semakkew_mc') ?>">Application Review</a></li>
                <li>Detail Application</li>
            </ul>
        </div>
        <div class="row">
            <!-- Your Profile Views Chart -->
            <div class="col-lg-12 m-b30">
                <div class="widget-box">
                    <div class="wc-title">
                        <h4>Applicant Details</h4>
                    </div>
                    <div class="widget-inner">
                        <form class="edit-profile m-b30">
                            <div class="row">
                                <div class="col-12">
                                    <div class="ml-auto m-b5">
                                        <h3>1. Applicant Info</h3>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="col-2 m-b5" style="padding-left: 0px;">
                                        <label class="col-form-label">Matric No.</label>
                                        <div>
                                            <input class="form-control" type="text" value="MC00001" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Full Name</label>
                                    <div>
                                        <input class="form-control" type="text" value="Mohd Ramli" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">IC Number</label>
                                    <div>
                                        <input class="form-control" type="text" value="910402036857" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Email</label>
                                    <div>
                                        <input class="form-control" type="text" value="mohdramli@gmail.com" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Phone Number</label>
                                    <div>
                                        <input class="form-control" type="text" value="0128392846" disabled>
                                    </div>
                                </div>
                                <div class="seperator"></div>

                                <div class="col-12 m-t20">
                                    <div class="ml-auto m-b5">
                                        <h3>2. Selected Course</h3>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Application Date</label>
                                    <div>
                                        <input class="form-control" type="text" value="28/02/2022" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Invoice Number</label>
                                    <div>
                                        <input class="form-control" type="text" value="P32300" disabled>
                                    </div>
                                </div>
                                <div class="col-12 m-t20">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Course Code</th>
                                                <th scope="col">Course Name</th>
                                                <th scope="col">Code Faculty</th>
                                                <th scope="col">Category Course</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>LMC0001</td>
                                                <td>Information Engineering</td>
                                                <td>FEP0001</td>
                                                <td>Information Technology</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 m-t40">
                                    <div class="ml-auto m-b5">
                                        <h3>3. Status Application</h3>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Status Application</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Completed Payment</option>
                                        <option value="1">Register</option>
                                        <option value="2">Failed</option>
                                        <option value="3">Enrol</option>
                                    </select>
                                </div>

                                <div class="col-12 m-t20">
                                    <button type="submit" class="btn">Save changes</button>
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