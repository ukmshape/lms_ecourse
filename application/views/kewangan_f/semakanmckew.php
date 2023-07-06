<?php $this->load->view('templates/layout_dashboard.php');  ?>
<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.dataTables.min.css" rel="stylesheet" />

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
            <h4 class="breadcrumb-title">List Application</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="<?= base_url('urusetia/dash_admin') ?>"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="<?= base_url('kewangan/dash_kew') ?>">Dashboard Finance Department</a></li>
                <li>Application Review</li>
            </ul>
        </div>
        <div class="row">
            <!-- Your Profile Views Chart -->
            <div class="col-lg-12 m-b30">
                <div class="widget-box">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>IC/Passport Number</th>
                                <th>Email</th>
                                <th>Application Date</th>
                                <th>Course</th>
                                <th>Invoice Number</th>
                                <th>Status Application</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>Mohd Ramli</td>
                                <td>910402036857</td>
                                <td>mohdramli@gmail.com</td>
                                <td>28/02/2022</td>
                                <td>Information Engineering</td>
                                <td>P32300</td>
                                <td>Completed Payment</td>
                                <td align="center"><a name="detail_pemohon" href="<?= base_url('/kewangan/detailmc_kew/') ?>" class="btn bg-gradient-success" title="Action">Detail Applicant</a> </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>IC/Passport Number</th>
                                <th>Email</th>
                                <th>Course</th>
                                <th>Invoice Number</th>
                                <th>Status Application</th>
                                <th> </th>
                            </tr>
                        </tfoot>
                    </table>
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script> -->
<script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>
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
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            autoWidth: true,
            responsive: true
        });

        new $.fn.dataTable.FixedHeader(table);
    });
</script>
</body>

<!-- Mirrored from educhamp.themetrades.com/demo/admin/add-listing.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:09:05 GMT -->

</html>