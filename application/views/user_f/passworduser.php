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
$password = '';

if(isset($data_user)) {
  $user_id = $data_user[0]->id;
  $password = $data_user[0]->password;
  $email = $data_user[0]->email;
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
              <li>Change User Password</li>
          </ul>
        </div>
        <div class="row">
            <!-- Your Profile Views Chart -->
                          <div class="col-lg-12 m-b30">
                              <div class="widget-box">

                              <form id="form_addfield" class="edit-profile m-b30" action="" method="post">
                                  <div class="wc-title">
                                      <h4>Change User Password</h4>
                                  </div>
                                  <div class="widget-inner">

                                  <div class="row">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                          <div class="alert alert-warning" role="alert" style="font-family: unset;">
                                            <ul>
                                              <li style="font-size: 14pt;"><b>The password must have:</b></li>
                                              <li>- at least 8 characters</li>
                                              <li>- at least 1 numeric character(s)</li>
                                              <li>- at least 1 lower case letter(s)</li>
                                              <li>- at least 1 upper case letter(s)</li>
                                              <li>- at least 1 special character(s)</li>
                                            </ul>
                                            <span>* This registration is also use for system LMS login</span>
                                          </div>
                                        </div>
                                    </div>
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
                															<label class="col-form-label">Password <span class="text-red">*</span></label>
                															<div>
                																<input class="form-control" type="password" id="txt_password" name="txt_password" minlength="8" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-/(/)]).{8,}$" value="" placeholder="Password" onkeyup="passwordChecking();" required>
                															</div>
                														</div>
                                            <div class="col-md-2">
                															<label class="col-form-label">Confirm Password <span class="text-red">*</span></label>
                															<div>
                																<input class="form-control" type="password" id="txt_password_confirm" name="txt_password_confirm" value="" placeholder="Password" onkeyup="passwordChecking();" required>
                                                <span id="passwordhelp" class="help text-danger" style="display:none;">Password and Confirm Password must be match.</span>
                															</div>
                														</div>
                													</div>
                												</td>
                											</tr>
                										</table>
                                    <input type="hidden" name="user_id" value="<?=$user_id;?>">
                                    <input type="hidden" name="email" value="<?=$email;?>">
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
