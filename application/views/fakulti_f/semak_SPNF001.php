<?php $this->load->view('templates/layout_dashboard_f.php');  ?>


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
                <li><a href="<?= base_url('fakulti/dash_fakulti') ?>"><i class="fa fa-home"></i>Dashboard</a></li>
                <li>Application Review</li>
            </ul>
        </div>

        <?php if (!empty($list_SPNF001)) : ?>
            <div class="row">
                <!-- Your Profile Views Chart -->
                <div class="col-lg-12 m-b30">
                    <div class="widget-box">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="text-align:center; vertical-align:middle;">No.</th>
                                    <th style="text-align:center; vertical-align:middle;">Name</th>
                                    <th style="text-align:center; vertical-align:middle;">IC/Passport Number</th>
                                    <th style="text-align:center; vertical-align:middle;">Application Date</th>
                                    <th style="text-align:center; vertical-align:middle;">Courses</th>
                                    <th style="text-align:center; vertical-align:middle;">Status Application</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $num = 0; ?>
                                <?php foreach ($list_SPNF001 as $row) {
                                        foreach ($list_infomohonSPNF001 as $row1) {
                                        ++$num; ?>
                                        <tr>
                                            <td style="text-align:center; vertical-align:middle;"><?php echo $num."."; ?></td>
                                            <td style="vertical-align:middle;"><?php echo $row->nama; ?></td>
                                            <td style="text-align:center; vertical-align:middle;"><?php echo $row->nokp; ?></td>
                                            <td style="text-align:center; vertical-align:middle;"><?php echo date("d/m/Y g:i A", strtotime($row->create_dated)); ?></td>
                                            <td style="text-align:center; vertical-align:middle;"><?php echo $row->namakursus; ?></td>
                                            <td style="text-align:center; vertical-align:middle;">
                                                <?php if ($row->status_fakulti == "2") : ?>
                                                    <?php echo "Process Order" ?>
                                                <?php elseif ($row->status_fakulti == "3") : ?>
                                                    <?php echo "Unpaid" ?>
                                                <?php elseif ($row->status_fakulti == "4") : ?>
                                                    <?php echo "Paid" ?>
                                                <?php elseif ($row->status_fakulti == "5") : ?>
                                                    <?php echo "Waiting to Verify" ?>
                                                <?php elseif ($row->status_fakulti == "6") : ?>
                                                    <?php echo "Invalid" ?>
                                                <?php elseif ($row->status_fakulti == "7") : ?>
                                                    <?php echo "Valid" ?>
                                                <?php elseif ($row->status_fakulti == "8") : ?>
                                                    <?php echo "Completed" ?>
                                                <?php elseif ($row->status_fakulti == "9") : ?>
                                                    <?php echo "Cancelled" ?>
                                                <?php endif; ?>
                                            </td>
                                            <td align="center">
                                                <?php $parameter = $row->noinvoice;  ?>

                                                <a name="detail_pemohon" href="<?php echo base_url('/fakulti/detail_SPNF001/'.$this->encryption->encrypt($parameter)); ?>" class="btn bg-gradient-success" title="Action">Detail Applicant</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                <?php }  ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="text-align:center; vertical-align:middle;">No.</th>
                                    <th style="text-align:center; vertical-align:middle;">Name</th>
                                    <th style="text-align:center; vertical-align:middle;">IC/Passport Number</th>
                                    <th style="text-align:center; vertical-align:middle;">Application Date</th>
                                    <th style="text-align:center; vertical-align:middle;">Courses</th>
                                    <th style="text-align:center; vertical-align:middle;">Status Application</th>
                                    <th> </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- Your Profile Views Chart END-->
            </div>
        <?php endif; ?>
    </div>
</main>
<div class="ttr-overlay"></div>

<!-- External JavaScripts -->
<script src='<?php echo base_url('/'); ?>/assets/dashboard/js/jquery.min.js'></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/bootstrap/js/popper.min.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/magnific-popup/magnific-popup.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/counter/waypoints-min.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/counter/counterup.min.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/imagesloaded/imagesloaded.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/masonry/masonry.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/masonry/filter.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/owl-carousel/owl.carousel.js"></script>
<script src='<?php echo base_url('/'); ?>/assets/dashboard/vendors/scroll/scrollbar.min.js'></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/js/functions.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/chart/chart.min.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/js/admin.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/calendar/moment.min.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/switcher/switcher.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script> -->
<!-- <script>
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
</script> -->
<!-- <script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            autoWidth: true,
            responsive: true
        });

        new $.fn.dataTable.FixedHeader(table);
    });
</script> -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>





</body>

</html>
