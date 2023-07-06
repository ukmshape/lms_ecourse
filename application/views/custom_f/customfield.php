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

$custom_id = '';
$title = '';
$type = '';
$shortname = '';
$value = '';
$required = '';
$show_field = '';

if(isset($data_custom)) {
  $custom_id = $data_custom[0]->custom_id;
  $title = $data_custom[0]->title;
  $type = $data_custom[0]->type;
  $shortname = $data_custom[0]->shortname;
  $value = $data_custom[0]->value;
  $required = $data_custom[0]->required;
  $show_field = $data_custom[0]->show_field;
}
?>
<style>
    input[type=text]:enabled {
        background: #FFFFFF;
        font-weight: 500;
    }
    input[type=text]:disabled {
        background: #FFFFFF;

    }
    .no-border {
        border: 0;
        box-shadow: none; /* You may want to include this as bootstrap applies these styles too */
    }
</style>



<!--Main container start -->
<main class="ttr-wrapper">
    <div class="container-fluid">
        <div class="db-breadcrumb">
          <h4 class="breadcrumb-title">Add Custom Field</h4>
          <ul class="db-breadcrumb-list">
              <li><a href="<?= base_url('urusetia/dash_admin') ?>"><i class="fa fa-home"></i>Dashboard</a></li>
              <li><a href="<?= base_url('custom/dashboard') ?>">Custom Form Application</a></li>
              <li><a href="<?= base_url('custom/custom_field') ?>">Custom Field</a></li>
              <li>Add Custom Field</li>
          </ul>
        </div>
        <div class="row">
            <!-- Your Profile Views Chart -->
                          <div class="col-lg-12 m-b30">
                              <div class="widget-box">

                              <form id="form_addfield" class="edit-profile m-b30" action="" method="post">
                                  <div class="wc-title">
                                      <h4>Add Custom Field</h4>
                                  </div>
                                  <div class="widget-inner">

                                  <div class="row">
                                  <div class="form-group col-6 m-t20">
                                      <div>
                                          <label class="col-form-label">Create New</label>

                                      </div>
                                  </div>

                                  <div class="col-12">
                										<table id="item-add" style="width:100%;">
                											<tr class="list-item">
                												<td>
                													<div class="row">
                														<div class="col-md-2">
                															<label class="col-form-label">Title <span class="text-red">*</span></label>
                															<div>
                																<input class="form-control" type="text" id="txt_label" name="txt_label" value="<?=$title;?>" placeholder="label" required>
                															</div>
                														</div>
                														<div class="col-md-2">
                															<label class="col-form-label">Type <span class="text-red">*</span></label>
                															<div>
                                                <select class="form-control" id="txt_type" name="txt_type" required>
                                                  <option value="text" <?php if($type == 'text') { echo 'selected'; } ?>>Text</option>
                                                  <option value="select" <?php if($type == 'select') { echo 'selected'; } ?>>Dropdown</option>
                                                  <option value="checkbox" <?php if($type == 'checkbox') { echo 'selected'; } ?>>Check</option>
                                                  <option value="radio" <?php if($type == 'radio') { echo 'selected'; } ?>>Optional</option>
                                                  <option value="file" <?php if($type == 'file') { echo 'selected'; } ?>>Upload File</option>
                                                  <option value="textarea" <?php if($type == 'textarea') { echo 'selected'; } ?>>Long Text</option>
                                                  <option value="date" <?php if($type == 'date') { echo 'selected'; } ?>>Date</option>
                                                  <option value="email" <?php if($type == 'email') { echo 'selected'; } ?>>Email</option>
                                                  <option value="number" <?php if($type == 'number') { echo 'selected'; } ?>>Number</option>
                                                  <option value="tel" <?php if($type == 'tel') { echo 'selected'; } ?>>Phone No.</option>
                                                </select>
                															</div>
                														</div>
                														<div class="col-md-2">
                															<label class="col-form-label">Short Name <span class="text-red">*</span></label>
                                              <small></small>
                															<div>
                																<input class="form-control" type="text" id="txt_shortname" name="txt_shortname" value="<?=$shortname;?>" placeholder="txtname" required>
                                                <div class="invalid-feedback">
                                                  Must be unique, not contain space.
                                                </div>
                															</div>
                														</div>
                                            <div class="col-md-3">
                															<label class="col-form-label">Value (for: Dropdown, Check, Optional)</label>
                															<div>
                                                <?php
                                                  if(strpos($value, ',') !== false) {

                                                    $array = json_decode($value);
                                                    $value = '';
                                                    foreach ($array as $key => $value1) {
                                                      reset($array);
                                                      $value .= $value1;
                                                      end($array);
                                                      if ($key !== key($array)) {
                                                          $value .= ',';
                                                      }
                                                    }
                                                  }
                                                 ?>
                																<input class="form-control" type="text" id="txt_value" name="txt_value" value="<?=$value;?>" placeholder="Option 1,Option 2,Option 3">
                															</div>
                														</div>
                                            <div class="col-md-2">
                															<label class="col-form-label">required ? <span class="text-red">*</span></label>
                															<div>
                                                <select class="form-control" id="txt_required" name="txt_required" required>
                                                  <option value="yes" <?php if($required == 'yes') { echo 'selected'; } ?>>Yes</option>
                                                  <option value="no" <?php if($required == 'no') { echo 'selected'; } ?>>No</option>
                                                </select>
                															</div>
                														</div>
                                            <div class="col-md-1">
                															<label class="col-form-label">Show Field ? <span class="text-red">*</span></label>
                															<div>
                                                <select class="form-control" id="txt_show" name="txt_show" required>
                                                  <option value="yes" <?php if($show_field == 'yes') { echo 'selected'; } ?>>Yes</option>
                                                  <option value="no" <?php if($show_field == 'no') { echo 'selected'; } ?>>No</option>
                                                </select>
                															</div>
                														</div>
                														<!--<div class="col-md-1">
                															<label class="col-form-label">Close</label>
                															<div class="form-group">
                																<a class="delete" href="#"><i class="fa fa-close"></i></a>
                															</div>
                														</div>-->
                													</div>
                												</td>
                											</tr>
                										</table>
                                    <input type="hidden" name="custom_id" value="<?=$custom_id;?>">
                                    <!--<button type="button" class="btn-secondry add-item m-r5"><i class="fa fa-fw fa-plus-circle"></i>Add Item</button>-->
                									</div>

                                  <div class="col-12 m-t30">
                                      <a href="<?=base_url('/custom/custom_field');?>" class="btn-secondry" style="color:#fff;">Back</a>
                                      <input type="submit" class="btn btn-primary" id="btn_submit" name="btn_submit" value="Submit">
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
<script src='<?php echo base_url('/'); ?>assets/dashboard/js/jquery.min.js'></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/bootstrap/js/popper.min.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/magnific-popup/magnific-popup.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/counter/waypoints-min.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/counter/counterup.min.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/imagesloaded/imagesloaded.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/masonry/masonry.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/masonry/filter.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/owl-carousel/owl.carousel.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/js/functions.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/chart/chart.min.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/js/admin.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/calendar/moment.min.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/switcher/switcher.js"></script>
