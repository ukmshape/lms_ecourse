<?php $this->load->view('templates/layout_dashboard.php');  ?>
<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.dataTables.min.css" rel="stylesheet" />

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
            <h4 class="breadcrumb-title">List Courses</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="<?= base_url('user/dashboard') ?>"><i class="fa fa-home"></i>Dashboard</a></li>
                <li><a href="<?= base_url('user/role_list') ?>">Course List</a></li>
                <li>Assign Roles</li>
            </ul>
        </div>

        <?php if (!empty($enrol)) : ?>
            <div class="row">
                <!-- Your Profile Views Chart -->
                <div class="col-lg-12 m-b30">
                    <div class="widget-box">
                      <div class="col-lg-12 m-b30 p-t30">
                        <?php $parameter1 = $course_id; ?>
                        <a name="detail_pemohon" href="<?=base_url('/user/add_role/'.$this->encryption->encrypt($parameter1));?>" class="btn red" title="Action">Add User</a>
                      </div>
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align:center; vertical-align:middle;">No.</th>
                                    <th style="text-align:center; vertical-align:middle;">Matric No.</th>
                                    <th style="text-align:center; vertical-align:middle;">Full Name</th>
                                    <th style="text-align:center; vertical-align:middle;">Status</th>
                                    <th style="text-align:center; vertical-align:middle;">Action</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $num = 0; ?>
                                <?php foreach ($enrol as $row) {
                                            ++$num; ?>
                                            <tr>
                                                <td style="text-align:center; vertical-align:middle;"><?php echo $num."."; ?></td>
                                                <td style="vertical-align:middle;"><?php echo $row->nomatrik; ?></td>
                                                <td style="vertical-align:middle;"><?php echo $row->fullname; ?></td>
                                                <td style="text-align:center; vertical-align:middle;">
                                                  <?php
                                                  if($row->status_enrol == '12') {
                                                    echo "Active";
                                                  } else if($row->status_enrol == '13') {
                                                    echo "Complete";
                                                  } else if($row->status_enrol == '11') {
                                                    echo "Passive";
                                                  }
                                                  ?>
                                                </td>
                                                <td style="text-align:center; vertical-align:middle;"><?php echo $row->role; ?></td>

                                                <td align="center">
                                                    <?php if($row->role == 'Teacher') {  ?>
                                                    <?php $parameter = $row->enrol_id; ?>
                                                    <a name="detail_pemohon" href="<?php echo base_url('/user/edit_user/'.$this->encryption->encrypt($parameter)); ?>" class="btn button-sm blue" title="Action"><i class="fa fa-edit"></i></a>
                                                    <a name="detail_pemohon" href="<?php echo base_url('/user/delete/'.$this->encryption->encrypt($parameter)); ?>" class="btn button-sm red" title="Action"><i class="fa fa-trash"></i></a>
                                                      <?php } ?>
                                                </td>
                                            </tr>
                                        <?php }  ?>
                                    <!-- <tr>
                                        <td>1</td>
                                        <td>TEST</td>
                                        <td>TEST</td>
                                        <td>TEST</td>
                                        <td>TEST</td>
                                        <td>TEST</td>
                                        <td align="center"></td>
                                    </tr> -->
                            </tbody>
                            <tfoot>
                                <tr>
                                  <th style="text-align:center; vertical-align:middle;">No.</th>
                                  <th style="text-align:center; vertical-align:middle;">Course Code</th>
                                  <th style="text-align:center; vertical-align:middle;">Course Name</th>
                                  <th style="text-align:center; vertical-align:middle;">Course Category</th>
                                  <th style="text-align:center; vertical-align:middle;">Total Enrollment</th>
                                  <th></th>
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
