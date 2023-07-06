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
            <h4 class="breadcrumb-title">Detail Application</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="<?= base_url('urusetia_sp/dash_adminsp') ?>"><i class="fa fa-home"></i>Dashboard</a></li>
                <li><a href="<?= base_url('urusetia_sp/semak_sp') ?>">Application Review</a></li>
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
                    <div class="widget-inner edit-profile">
                            <d class="row">
                                <div class="col-12">
                                    <div class="ml-auto m-b5">
                                        <h3>1. Applicant Info</h3>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="col-3 m-b5" style="padding-left: 0px;">
                                        <label class="col-form-label">Application Date</label>
                                        <div>
                                            <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo date("d/m/Y g:i A", strtotime($detail_pelajar[0]->create_dated)); ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Full Name</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" id="txt_name" name="txt_name" value="<?php echo ($detail_pelajar[0]->nama); ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">IC Number/Passport No</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" id="txt_icno" name=="txt_icno" value="<?php echo ($detail_pelajar[0]->nokp); ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Email</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" id="txt_email" name="txt_email" value="<?php echo ($detail_pelajar[0]->emel); ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Phone Number</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" id="txt_phonenumber" name="txt_phonenumber" value="<?php echo ($detail_pelajar[0]->notel); ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label">Address</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo ($detail_pelajar[0]->alamat1); ?>" disabled>
                                    </div><br>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo ($detail_pelajar[0]->alamat2); ?>" disabled>
                                    </div><br>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo ($detail_pelajar[0]->alamat3); ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">City</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo ($detail_pelajar[0]->bandar); ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">State</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo ($detail_pelajar[0]->negeri); ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Postcode</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo ($detail_pelajar[0]->poskod); ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Country</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo ($detail_pelajar[0]->negara); ?>" disabled>
                                    </div>
                                </div>

                                <div class="seperator"></div>

                                <div class="col-12 m-t20">
                                    <div class="ml-auto m-b5">
                                        <h3>2. Education</h3>
                                    </div>
                                </div>
                                <div class="form-group col-6 m-t20">
                                    <label class="col-form-label">Higher Education</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" id="txt_higheredu" name="txt_higheredu" value="<?php echo ($detail_pelajar[0]->akadtertinggi); ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6 m-t20">
                                    <label class="col-form-label">Name of Certificate/Program of Study</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" id="txt_higheredu" name="txt_higheredu" value="<?php echo ($detail_pelajar[0]->nmsijil); ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6 m-t20">
                                    <div>
                                        <label class="col-form-label">Academic Certificate</label>
                                        <div>
                                          <?php

                                          $filelink = '';
                                          $fileName = '';
                                          $linkacademic = DOCPATH.$detail_pelajar[0]->nokp.'/';
                                          if(file_exists($linkacademic)) {
                                            $fileList = glob($linkacademic. 'academic.*');
                                            if(count($fileList) != 0){
                                              $fileName = substr($fileList[0], strpos($fileList[0], "academic"));
                                              $filelink = base_url('/documents/'.$detail_pelajar[0]->nokp.'/'.$fileName);
                                            }
                                          }
                                           ?>
                                           <?php if($fileName != '') { ?>
                                              <a class="btn btn-primary" href="<?=$filelink;?>" target="_blank">Open File</a>
                                            <?php } else { ?>
                                              <a class="btn btn-primary" href="javascript:void(0);">File Not Found</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <?php

                                if($customform) {
                                  $nokp = $detail_pelajar[0]->nokp;
                                  foreach ($customform as $form) {
                                    $customValue = $this->fakulti_m->get_customformPemohon($form->form_id, $nokp);
                                ?>
                                <div class="form-group col-6 m-t20">
                                    <label class="col-form-label"><?=$form->title;?></label>
                                    <div>
                                        <?php

                                        $filelink = '';
                                        $fileName = '';
                                        $required = 'required';
                                        $linkcustom = DOCPATH.$nokp.'/';

                                         ?>
                                        <?php if($form->type != 'textarea' && $form->type != 'checkbox' && $form->type != 'radio' && $form->type != 'file') { ?>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="<?=$form->type;?>" id="<?=$form->shortname;?>" name="<?=$form->shortname;?>" value="<?php if($customValue): echo $customValue[0]->value; endif;?>" disabled>

                                      <?php } else if($form->type == 'textarea') { ?>
                                        <textarea class="form-control shadow-sm p-3 bg-white rounded" id="<?=$form->shortname;?>" name="<?=$form->shortname;?>" disabled><?php if($customValue): echo $customValue[0]->value; endif;?></textarea>
                                      <?php } else if($form->type == 'checkbox' || $form->type == 'radio') { ?>
                                        <?php
                                        $array = json_decode($form->value);

                                        foreach ($array as $key => $value) {
                                          $selected = '';
                                          if($customValue) {
                                            $array2 = json_decode($customValue[0]->value);
                                            for($i = 0; $i < count($array2); $i++) {
                                              if($value == $array2[$i]) {
                                                $selected = 'checked';
                                              }
                                            }

                                          } ?>

                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="<?=$form->type;?>" name="<?=$form->shortname;?>[]" id="<?=$key;?>" value="<?=$value;?>" <?=$selected;?>>
                                            <label class="form-check-label" for="<?=$key;?>"><?=$value;?></label>
                                          </div>

                                         <?php } ?>
                                      <?php } else if($form->type == 'file') { ?>
                                        <?php
                                        if(!empty($customValue) && !empty($customValue[0]->value)) {
                                          if(file_exists($linkcustom)) {
                                            $fileList = glob($linkcustom. $customValue[0]->value.'.*');
                                            if(count($fileList) != 0){
                                              $fileName = substr($fileList[0], strpos($fileList[0], $customValue[0]->value));
                                              $filelink = base_url('/documents/'.$nokp.'/'.$fileName);
                                         ?>
                                            <a class="btn btn-primary" href="<?=$filelink;?>" target="_blank">Open File</a>
                                          <?php } } } else { ?>
                                              <a class="btn btn-primary" href="javascript();" target="_blank">File Not Found</a>
                                          <?php } ?>

                                      <?php }?>
                                      </div>
                                    </div>
                              <?php
                                  }
                                } ?>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-12 m-b30">
                              <div class="widget-box">

                              <form class="edit-profile m-b30" action="" method="post">
                                  <div class="wc-title">
                                      <h4>Application Process Status</h4>
                                  </div>
                                  <div class="widget-inner">
                                  <div class="form-group col-12 m-t20">
                                      <label class="col-form-label">Application Status</label>
                                      <div class="col-4">
                                        <select class="form-control" id="txt_status" name="txt_status" required>
                                          <option value="">Select</option>
                                          <option value="5" <?php if($detail_pelajar[0]->status_fakulti == '5') { echo 'selected'; } ?>>Waiting for Verify</option>
                                          <option value="7" <?php if($detail_pelajar[0]->status_fakulti == '7') { echo 'selected'; } ?>>Valid</option>
                                          <option value="6" <?php if($detail_pelajar[0]->status_fakulti == '6') { echo 'selected'; } ?>>Invalid</option>
                                        </select>
                                      </div>
                                  </div>
                                  <div class="form-group col-12 m-t20">
                                      <label class="col-form-label">Comments (if needed)</label>
                                      <div class="col-4">
                                          <textarea class="form-control shadow-sm p-3 bg-white rounded" id="txt_comment" name="txt_comment"><?=$detail_pelajar[0]->comment_fakulti;?></textarea>
                                      </div>
                                  </div>
                                  <input type="hidden" name="txt_noinvoice" value="<?=$data_id;?>">
                                  <input type="hidden" name="order_id" value="<?=$detail_pelajar[0]->order_id;?>">

                                  <div class="col-12 m-t30">
                                      <a href="javascript:window.history.go(-1);" class="btn-secondry" style="color:#fff;">Back</a>
                                      <input type="submit" class="btn btn-primary" id="submitBtn" name="btn_submit" value="Submit">
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
