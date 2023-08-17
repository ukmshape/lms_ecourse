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

<style>
.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: unset!important;
  }
</style>


<!--Main container start -->
<main class="ttr-wrapper">
    <div class="container-fluid">
        <div class="db-breadcrumb">
            <h4 class="breadcrumb-title">List Application</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="<?= base_url('urusetia/dash_admin') ?>"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="<?= base_url('urusetia_sp/dash_adminsp') ?>"><i class="fa fa-home"></i>Professional Certificate</a></li>
                <li>Application Review</li>
            </ul>
        </div>

        <?php if (!empty($list_mohon)) : ?>
            <div class="row">
                <!-- Your Profile Views Chart -->
                <div class="col-lg-12 m-b30">
                    <div class="widget-box">
                      <div class="m-4 pt-3">
                        <a href="<?=base_url('/urusetia_sp/semak_sp/').$this->encryption->encrypt('all');?>" class="btn green" style="color:#fff;">All</a>
                        <a href="<?=base_url('/urusetia_sp/semak_sp/').$this->encryption->encrypt('waiting');?>" class="btn blue" style="color:#fff;">Waiting for Verification</a>
                        <a href="<?=base_url('/urusetia_sp/semak_sp/').$this->encryption->encrypt('unpaid');?>" class="btn red" style="color:#fff;">Unpaid</a>
                      </div>
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align:center; vertical-align:middle;">No.</th>
                                    <th style="text-align:center; vertical-align:middle;">Order ID</th>
                                    <th style="text-align:center; vertical-align:middle;">Matric No<br>Name <br>NRIC/Passport No<br>Email</th>
                                    <!--<th style="text-align:center; vertical-align:middle;">Email</th>-->
                                    <th style="text-align:center; vertical-align:middle;">Application Date</th>
                                    <th style="text-align:center; vertical-align:middle;">Course</th>
                                    <th style="text-align:center; vertical-align:middle;">Invoice Number</th>
                                    <th style="text-align:center; vertical-align:middle;width: 180px;">Status</th>
                                    <!-- <th>Status Application</th> -->
                                    <th style="text-align:center; vertical-align:middle;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $num = 0; ?>
                            <?php foreach ($list_mohon as $row) {
                                ++$num; ?>
                                    <tr>
                                        <td style="text-align:center; vertical-align:middle;"><?php echo $num."."; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $row->order_id; ?></td>
                                        <td style="text-align:left; vertical-align:middle;"><span style="color:red"><?php echo $row->nomatrik_sp; ?></span><br/><?php echo $row->nama; ?><br/>(<?php echo $row->nokp; ?>)<br><?php echo $row->emel; ?></td>
                                        <!--<td style="vertical-align:middle;"><?php echo $row->emel; ?></td>-->
                                        <td style="text-align:center; vertical-align:middle;"><?php echo date("d/m/Y", strtotime($row->create_dated)); ?><br><?php echo date("g:i A", strtotime($row->create_dated)); ?></td>
                                        <td style="text-align:left; vertical-align:middle;">
                                          <ol class="ml-4 mb-0">
                                            <?php
                                            $invoicedetails = $this->urusetiasp_m->get_param_kursus_by_invoice($row->user_id,$row->noinvoice);
                                            if($invoicedetails) {
                                              $i = 0;
                                              $totalstatusenrol = 0;
                                              foreach ($invoicedetails as $value) {
                                                $i += 1;
                                                $mdl_courselist = $this->urusetiasp_m->get_course_detail_mcodlukm($value->kursusid);
                                                $dataenrol = array(
                                                  'order_sp' => $row->id,
                                                  'nomatrik' => $row->nomatrik_sp,
                                                  'kursusid' => $value->kursusid
                                                );
                                                $enrol = $this->urusetiasp_m->get_data_enrol($dataenrol);
                                                $statusenrol = '';

                                                if($enrol){
                                                  $liststatus2 = $this->urusetiasp_m->get_liststatus($enrol[0]->status_enrol);
                                                  if($liststatus2) {
                                                    if($enrol[0]->status_enrol == 12 || $enrol[0]->status_enrol == 13 || trim($enrol[0]->status_enrol) == 'X') {
                                                      $totalstatusenrol += 1;
                                                    }
                                                    $statusenrol = "<br><span class='text-warning'>(".$liststatus2[0]->status.")</span>";
                                                  }
                                                }
                                              ?>
                                                <li><?php /*(<?=$value->kodkursus;?>)<br> */ ?><?=$mdl_courselist[0]->cname;?> <?php echo $statusenrol; ?></li>
                                              <?php
                                              }
                                            }
                                             ?>
                                          </ol>
                                        </td>
                                        <td style="text-align:center; vertical-align:middle;"><?php echo $row->noinvoice; ?></td>
                                        <td style="text-align:left; vertical-align:middle;">
                                          <?php
                                            $liststatus = $this->urusetiasp_m->get_liststatus($row->status_app);
                                            echo "Application: ";
                                            
                                            if($liststatus[0]->status_id == '9' && $row->status_admin == '5') {
                                              echo "<span class='text-warning font-weight-bold'>Waiting for Verification</span>";
                                            } else if($liststatus[0]->status_id == '9' || ($row->status_admin == '5' && $row->status_inv == '4')) {
                                              echo "<span class='text-warning font-weight-bold'>Waiting for Verification</span>";
                                            } else if($liststatus[0]->status_id == '3') {
                                              echo "<span class='text-red font-weight-bold'>".$liststatus[0]->status."</span>";
                                            } else if($liststatus[0]->status_id == '4') {
                                              echo "<span class='text-success font-weight-bold'>".$liststatus[0]->status."</span>";
                                            } else if($liststatus[0]->status_id == '9') {
                                              echo "<span class='text-warning font-weight-bold'>".$liststatus[0]->status."</span>";
                                            } else if($liststatus[0]->status_id == '6') {
                                              echo "<span class='text-success font-weight-bold'>".$liststatus[0]->status."</span>";
                                            } else if($liststatus[0]->status_id == '7') {
                                              echo "<span class='text-danger font-weight-bold'>".$liststatus[0]->status."</span>";
                                            } else if($liststatus[0]->status_id == '8') {
                                              echo "<span class='text-warning font-weight-bold'>".$liststatus[0]->status."</span>";
                                            }

                                        //    $liststatus1 = $this->urusetiasp_m->get_liststatus($row->status_urus);
                                        //    if($liststatus1) {
                                        //      echo "<br>Payment: <span class='font-weight-bold'>".$liststatus1[0]->status."</span>";
                                        //    }

                                            if($row->status_urus == '6' && ($totalstatusenrol < $i)) {
                                                echo "<br>Course: <span class='font-weight-bold'>Waiting for Enroll</span>";
                                              }
                                          ?>
                                        </td>
                                        <!-- <td><-?php echo $row->tarikhsahfakulti; ?></td> -->
                                        <td align="center" style="vertical-align:middle;">
                                            <?php $parameter = $row->noinvoice; //dbug($parameter);die();?>
                                              <!--<a name="detail_pemohon" href="<?php echo base_url('/urusetia_sp/email_compose/'.$this->encryption->encrypt($parameter)); ?>" class="btn button-sm blue radius-xl mb-2" title="Email"><i class="fa fa-envelope-o"></i></a>
                                              -->
                                            <?php if($liststatus[0]->status_id == '4' || $liststatus[0]->status_id == '6' || $row->status_urus == '7' || $row->status_admin == '6') { ?>
                                              <a name="detail_pemohon" href="<?php echo base_url('/urusetia_sp/detail_pemohon/'.$this->encryption->encrypt($parameter)); ?>" class="btn button-sm blue" title="Action"><i class="fa fa-pencil"></i></a>
                                            <?php } else if($liststatus[0]->status_id != '3' || $row->status_urus == '7') { ?>
                                              <a name="detail_pemohon" href="<?php echo base_url('/urusetia_sp/detail_pemohon/'.$this->encryption->encrypt($parameter)); ?>" class="btn button-sm yellow" title="Action"><i class="fa fa-pencil"></i></a>
                                            <?php } ?>

                                              <!--<a name="detail_pemohon" href="<?php echo base_url('/urusetia_sp/payment_pemohon/'.$this->encryption->encrypt($parameter)); ?>" class="btn bg-info" title="Action">Payment Detail</a>-->

                                        </td>
                                    </tr>
                            <?php }  ?>
                          </tbody>
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

<?php $this->load->view('admin_f/script/script-dashboardlayout.php'); ?>

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
            responsive: true,
            drawCallback: function( settings ) {
              $('#example_wrapper').addClass('p-4');
            }
        });
        //new $.fn.dataTable.FixedHeader(table);



    });
</script>
</body>

<!-- Mirrored from educhamp.themetrades.com/demo/admin/add-listing.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:09:05 GMT -->

</html>
