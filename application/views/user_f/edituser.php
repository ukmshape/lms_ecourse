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

$user_id = '';
$fullname = '';
$email = '';
$password = '';
$type = '';
$faculty = '';
$active = '';

if(isset($data_user)) {
  $user_id = $data_user[0]->id;
  $fullname = $data_user[0]->fullname;
  $email = $data_user[0]->email;
  $password = $data_user[0]->password;
  $type = $data_user[0]->type;
  $faculty = $data_user[0]->faculty;
  $active = $data_user[0]->active;
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
          <h4 class="breadcrumb-title">Add User</h4>
          <ul class="db-breadcrumb-list">
              <li><a href="<?= base_url('user/list_user') ?>">User List</a></li>
              <li>Update User</li>
          </ul>
        </div>
        <div class="row">
            <!-- Your Profile Views Chart -->
                          <div class="col-lg-12 m-b30">
                              <div class="widget-box">

                              <form id="form_addfield" class="edit-profile m-b30" action="" method="post">
                                  <div class="wc-title">
                                      <h4>Update User</h4>
                                  </div>
                                  <div class="widget-inner">

                                  <div class="row">
                                  <div class="form-group col-6 m-t20">
                                      <div>
                                          <label class="col-form-label">Update User</label>

                                      </div>
                                  </div>
                                  <div class="col-12">
                										<table id="item-add" style="width:100%;">
                											<tr class="list-item">
                												<td>
                													<div class="row">
                														<div class="col-md-2">
                															<label class="col-form-label">Full Name <span class="text-red">*</span></label>
                															<div>
                																<input class="form-control" type="text" id="txt_fullname" name="txt_fullname" value="<?=$fullname;?>" placeholder="Full Name" required>
                															</div>
                														</div>
                                            <div class="col-md-2">
                															<label class="col-form-label">Email <span class="text-red">*</span></label>
                															<div>
                																<input class="form-control" type="email" id="txt_email" name="txt_email" value="<?=$email;?>" placeholder="Email" required>
                															</div>
                														</div>
                														<div class="col-md-2">
                															<label class="col-form-label">Type <span class="text-red">*</span></label>
                															<div>
                                                <select class="form-control" id="txt_type" name="txt_type" required>
                                                  <option value="Admin" <?php if($type == 'Admin') { echo 'selected'; } ?>>Admin</option>
                                                  <option value="Faculty" <?php if($type == 'Faculty') { echo 'selected'; } ?>>Faculty</option>
                                                  <option value="Student" <?php if($type == 'Student') { echo 'selected'; } ?>>Student</option>
                                                </select>
                															</div>
                														</div>
                														<div class="col-md-2">
                															<label class="col-form-label">Categories <span class="text-red">*</span></label>
                                              <div>
                                                <?php dbug($faculty); dbug($usertype); ?>
                                                <select class="form-control" id="txt_faculty" name="txt_faculty" required>
                                                  <option value="">Select</option>
                                                  <?php foreach ($usertype as $type) {
                                                    if($faculty == $type->id) { $selected = 'selected'; } else { $selected = ''; }
                                                    echo '<option value="'.$type->type_id.'" '.$selected.'>'.$type->type.'</option>';
                                                  } ?>
                                                </select>
                															</div>
                														</div>
                                            <div class="col-md-2">
                															<label class="col-form-label">Active <span class="text-red">*</span></label>
                															<div>
                                                <select class="form-control" id="txt_active" name="txt_active" required>
                                                  <option value="active" <?php if($active == 'active') { echo 'selected'; } ?>>Active</option>
                                                  <option value="passive" <?php if($active == 'passive') { echo 'selected'; } ?>>Passive</option>
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
                                    <input type="hidden" name="user_id" value="<?=$user_id;?>">
                                    <!--<button type="button" class="btn-secondry add-item m-r5"><i class="fa fa-fw fa-plus-circle"></i>Add Item</button>-->
                									</div>

                                  <div class="col-12 m-t30">
                                      <a href="<?=base_url('/user/list_user');?>" class="btn-secondry" style="color:#fff;">Back</a>
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
