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
          <h4 class="breadcrumb-title">Add User</h4>
          <ul class="db-breadcrumb-list">
              <li><a href="<?= base_url('user/list_user') ?>">User List</a></li>
              <li>Add User</li>
          </ul>
        </div>
        <div class="row">
            <!-- Your Profile Views Chart -->
                          <div class="col-lg-12 m-b30">
                              <div class="widget-box">

                              <form id="form_addfield" class="edit-profile m-b30" action="" method="post">
                                  <div class="wc-title">
                                      <h4>Add User</h4>
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
                                            <div class="col-md-3">
                															<label class="col-form-label">Categories <span class="text-red">*</span></label>
                                              <div>
                                                <select class="form-control" id="txt_faculty" name="txt_faculty" required>
                                                  <option value="">Select</option>
                                                  <?php foreach ($usertype as $type) {
                                                    echo '<option value="'.$type->type_id.'">'.$type->type.'</option>';
                                                  } ?>
                                                </select>
                															</div>
                														</div>
                                            <div class="col-md-3">
                															<label class="col-form-label">User Name <span class="text-red">*</span></label>
                                              <div>
                                                <select class="form-control" id="txt_fullname" name="txt_fullname" required>
                                                  <option value="">Select</option>
                                                </select>
                                                <small>User Type:<span class="usertype"></span></small>
                															</div>
                														</div>
                														<div class="col-md-2">
                															<label class="col-form-label">Role <span class="text-red">*</span></label>
                															<div>
                                                <select class="form-control" id="txt_type" name="txt_type" required>
                                                  <!--<option value="1">Manager</option>-->
                                                  <option value="2">Course Creator</option>
                                                  <option value="3">Editing Teacher</option>
                                                  <option value="4">Teacher</option>
                                                  <option value="5">Student</option>
                                                </select>
                															</div>
                														</div>

                                            <div class="col-md-2">
                															<label class="col-form-label">Status <span class="text-red">*</span></label>
                															<div>
                                                <select class="form-control" id="txt_active" name="txt_active" required>
                                                  <option value="active">Active</option>
                                                  <option value="passive">Passive</option>
                                                  <option value="passive">Complete</option>
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
                                    <input type="hidden" name="user_id" value="">
                                    <!--<button type="button" class="btn-secondry add-item m-r5"><i class="fa fa-fw fa-plus-circle"></i>Add Item</button>-->
                									</div>

                                  <div class="col-12 m-t30">
                                    <?php $parameter = $course_id; ?>
                                      <a href="<?=base_url('/user/user_roles/'.$this->encryption->encrypt($parameter));?>" class="btn-secondry" style="color:#fff;">Back</a>
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
