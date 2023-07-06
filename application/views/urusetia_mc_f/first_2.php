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

<?php $parameter = $this->encryption->encrypt($detail_pelajar[0]->noinvoice); ?>

<style>
    input[type=text]:enabled {
        background: #FFFFFF;
        font-weight: 500;
    }
    input[type=text]:disabled {
        background: #f3f3f3!important;
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
          <h4 class="breadcrumb-title">Application Verification</h4>
          <ul class="db-breadcrumb-list">
              <li><a href="<?= base_url('urusetia_mc/dash_admin') ?>"><i class="fa fa-home"></i>Dashboard</a></li>
              <li><a href="<?= base_url('urusetia_mc/semak_mc') ?>">Application Review</a></li>
              <li><a href="<?= base_url('urusetia_mc/detail_pemohon/'.$parameter) ?>">Application Invoice</a></li>
              <li>Application Verification</li>
          </ul>
      </div>
        <div class="row">
            <!-- Your Profile Views Chart -->
            <?php if ($this->session->flashdata('mesej')) { ?>
              <div class="<?php echo $this->session->flashdata('mesej_css'); ?>" role="alert" id="mesej-alert" style="font-family: unset;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="pr-4">
                  <center><?php echo $this->session->flashdata('mesej'); ?></center>
                  <center><?php echo $this->session->flashdata('webservice'); ?></center>
                </div>
              </div>

            <?php } ?>
            <div class="col-lg-12 m-b30">
                <div class="widget-box">
                    <div class="wc-title">
                        <h4>Applicant Details</h4>
                    </div>
                    <div class="widget-inner edit-profile">
                            <div class="row">
                                <div class="col-12">
                                    <div class="ml-auto m-b5">
                                        <h3>1. Applicant Info</h3>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Full Name</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" id="txt_name" name="txt_name" value="<?php echo ($detail_pelajar[0]->nama); ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">NRIC/Passport No</label>
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
                                <div class="form-group col-12 pt-3">
                                  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    More Details
                                  </button>
                                </div>

                                <div class="form-group col-12 p-3 collapse" id="collapseExample">
                                  <div class="row form-group">
                                    <div class="form-group col-6">
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

                                    <div class="form-group col-3">
                                        <label class="col-form-label">City</label>
                                        <div>
                                            <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo ($detail_pelajar[0]->bandar); ?>" disabled>
                                        </div><br>
                                        <div><br></div>
                                        <label class="col-form-label">Postcode</label>
                                        <div>
                                            <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo ($detail_pelajar[0]->poskod); ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group col-3">
                                        <label class="col-form-label">State</label>
                                        <div>
                                            <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo ($detail_pelajar[0]->negeri); ?>" disabled>
                                        </div><br>
                                        <div><br></div>
                                        <label class="col-form-label">Country</label>
                                        <div>
                                            <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo ($detail_pelajar[0]->negara); ?>" disabled>
                                        </div>
                                    </div>
                                  </div>
                                  <!--
                                  <div class="form-group col-6">
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
                                  <div class="form-group col-3">
                                      <label class="col-form-label">City</label>
                                      <div>
                                          <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo ($detail_pelajar[0]->bandar); ?>" disabled>
                                      </div>
                                      <div></div>
                                      <div></div>
                                      <label class="col-form-label">Postcode</label>
                                      <div>
                                          <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo ($detail_pelajar[0]->poskod); ?>" disabled>
                                      </div>
                                  </div>
                                  <div class="form-group col-3">
                                      <label class="col-form-label">State</label>
                                      <div>
                                          <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo ($detail_pelajar[0]->negeri); ?>" disabled>
                                      </div>
                                  </div>

                                  <div class="form-group col-3">

                                  </div>
                                  <div class="form-group col-3">
                                      <label class="col-form-label">Country</label>
                                      <div>
                                          <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo ($detail_pelajar[0]->negara); ?>" disabled>
                                      </div>
                                  </div>

                                -->

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
                                                <a class="btn btn-primary" href="javascript();" target="_blank">File Not Found</a>
                                              <?php } ?>
                                          </div>
                                      </div>
                                  </div>
                                </div>


                              </div>
                            </div>
                          </div>
                        </div>

                      <form action="" method="post">
                        <div class="col-lg-12 m-b30">
                            <div class="widget-box">
                                <div class="wc-title">
                                    <h4>Application Process Status</h4>
                                </div>
                                <div class="widget-inner edit-profile">
                                        <div class="row">
                                          <div class="col-12">
                                              <div class="ml-auto m-b5">
                                                  <h3>1. Application Info</h3>
                                              </div>
                                          </div>
                                          <?php

                                          $nomatrik = '';
                                          if($detail_pelajar[0]->nomatrik_mc == '') {

                                              $creatematrik = 'MC'; //MC00001
                                              $nomatriklast = $this->urusetiamc_m->get_nomatrik();

                                              $length = 5;
                                              $char = 0;
                                              $type = 'd';
                                              $format = "%{$char}{$length}{$type}"; // or "$010d";

                                              if($nomatriklast) {
                                                $nom = str_replace('MC','',$nomatriklast[0]->nomatrik_mc);
                                                $newNom = sprintf($format, ($nom+1));
                                                $nomatrik = $creatematrik.$newNom;
                                              } else {
                                                $nomatrik = $creatematrik.'00001';
                                              }
                                          } else {
                                            $nomatrik = $detail_pelajar[0]->nomatrik_mc;
                                          }

                                           ?>
                                           <input type="hidden" id="txt_email" name="txt_email" value="<?php echo ($detail_pelajar[0]->emel); ?>">

                                           <div class="form-group col-12 m-t20">
                                               <label class="col-form-label">Matric No</label>
                                               <div class="input-group col-3 mb-3">
                                                 <input type="text" class="form-control" id="txt_nomatrik" name="txt_nomatrik" value="<?=$nomatrik;?>" readonly>
                                                 <input type="hidden" id="txt_name" name="txt_name" value="<?php echo ($detail_pelajar[0]->nama); ?>">
                                               </div>
                                           </div>
                                          <div class="form-group col-3">
                                              <div>
                                                  <label class="col-form-label">Application Date</label>
                                                  <div>
                                                      <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo date("d/m/Y g:i A", strtotime($detail_pelajar[0]->create_dated)); ?>" disabled>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group col-3">
                                              <div>
                                                  <label class="col-form-label">Order ID</label>
                                                  <div>
                                                      <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo $detail_pelajar[0]->order_id; ?>" disabled>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group col-3">
                                              <div>
                                                  <label class="col-form-label">Invoice No</label>
                                                  <div>
                                                      <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo $detail_pelajar[0]->noinvoice; ?>" disabled>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group col-3">
                                              <div>
                                                <label class="col-form-label">&nbsp;</label>
                                                  <div>
                                                      <a href="<?=base_url('/urusetia_mc/cpayment/').$parameter;?>" target="_blank" class="btn red" style="color:#fff;">Invoice</a>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="seperator"></div>

                                          <div class="col-12 m-t20">
                                              <div class="ml-auto m-b5">
                                                  <h3>2. Selected Course</h3>
                                              </div>
                                          </div>
                                          <div class="col-12 m-t20">
                                              <table class="table table-bordered">
                                                  <thead>
                                                      <tr>
                                                          <th scope="col" style="text-align:center; vertical-align:middle;">No</th>
                                                          <th scope="col" style="text-align:center; vertical-align:middle;">Course Code</th>
                                                          <th scope="col" style="text-align:center; vertical-align:middle;">Course Name</th>
                                                          <th scope="col" style="text-align:center; vertical-align:middle;">Action</th>
                                                      </tr>
                                                  </thead>
                                                  <?php $num = 0; ?>
                                                  <?php foreach ($detail_kursus as $row) {
                                                  ++$num; ?>
                                                  <tbody>
                                                      <tr>
                                                          <td style="text-align:center; vertical-align:middle;"><?php echo $num."."; ?></td>
                                                          <td style="text-align:center; vertical-align:middle;"><?php echo $row->kodkursus; ?></td>
                                                          <td style="text-align:center; vertical-align:middle;"><?php echo $row->namakursus; ?></td>
                                                          <td style="vertical-align:middle;">
                                                            <input type="hidden" name="txt_ordermcid[]" value="<?php echo $row->id; ?>">
                                                            <input type="hidden" name="txt_ordermc_id[]" value="<?php echo $row->order_id; ?>">

                                                            <label class="col-form-label" style="text-align:left;">Status</label>
                                                            <select class="form-control" id="txt_status_app" name="txt_status_enrol[]" required>
                                                              <option value="">Select</option>
                                                              <?php
                                                              $dataenrol = array(
                                                                'order_mc' => $row->id,
                                                                'nomatrik' => $nomatrik,
                                                                'kursusid' => $row->kursusid
                                                              );

                                                              $enrol = $this->urusetiamc_m->get_data_enrol($dataenrol);
                                                              ?>

                                                              <option value="12" <?php if($enrol && $enrol[0]->status_enrol == '12') { echo 'selected'; } ?>>Enroll</option>
                                                              <option value="X" <?php if($enrol && $enrol[0]->status_enrol == 'X') { echo 'selected'; } ?>>Tidak perlu LMS</option>
                                                              <option value="13"<?php if($enrol && $enrol[0]->status_enrol == '13') { echo 'selected'; } ?>>Complete</option>
                                                              <option value="11"<?php if($enrol && $enrol[0]->status_enrol == '11') { echo 'selected'; } ?>>Passive</option>
                                                              <option value="14"<?php if($enrol && $enrol[0]->status_enrol == '14') { echo 'selected'; } ?>>Unenroll</option>
                                                            </select>
                                                            <div class="form-group">
                                                                <label class="col-form-label" style="text-align:left;">Comments (if needed)</label>
                                                                <div>
                                                                  <?php
                                                                  $comment = '';
                                                                   if($enrol && $enrol[0]->comment_enrol) {
                                                                      $comment = $enrol[0]->comment_enrol;
                                                                  }?>
                                                                    <textarea class="form-control shadow-sm p-3 bg-white rounded" id="txt_comment_enrol" name="txt_comment_enrol[]"><?=$comment;?></textarea>
                                                                </div>
                                                            </div>
                                                          </td>
                                                      </tr>
                                                  </tbody>
                                                  <?php }  ?>
                                              </table>
                                          </div>

                                          <div class="seperator"></div>

                                        <!--  <div class="form-group col-6 m-t20">
                                              <label class="col-form-label">Application Status</label>
                                              <div>
                                                <select class="form-control" id="txt_status_app" name="txt_status_app" required>
                                                  <option value="">Select</option>
                                                  <option value="5" <?php if($detail_pelajar[0]->status_app == '5') { echo 'selected'; } ?>>Waiting for Verification</option>
                                                  <option value="6" <?php if($detail_pelajar[0]->status_app == '6') { echo 'selected'; } ?>>Successful</option>
                                                  <!--<option value="7" <?php if($detail_pelajar[0]->status_app == '7') { echo 'selected'; } ?>>Unsuccessful</option>-->
                                        <!--         <option value="8" <?php if($detail_pelajar[0]->status_app == '8') { echo 'selected'; } ?>>Incomplete</option>
                                                </select>
                                              </div>
                                          </div>
                                          <div class="form-group col-6 m-t20">
                                              <label class="col-form-label">Comments (if needed)</label>
                                              <div>
                                                  <textarea class="form-control shadow-sm p-3 bg-white rounded" id="txt_comment_app" name="txt_comment_app"><?=$detail_pelajar[0]->comment_app;?></textarea>
                                              </div>
                                          </div>
                                        -->

                                          <div class="seperator"></div>

                                          <input type="hidden" name="txt_noinvoice" value="<?=$data_id;?>">
                                          <input type="hidden" name="txt_user_id" value="<?=$detail_pelajar[0]->user_id; ?>">

                                          <div class="col-12 m-t30">
                                              <a href="<?=base_url('/urusetia_mc/detail_pemohon/').$parameter;?>" class="btn-secondry" style="color:#fff;">Back</a>
                                                <input type="submit" class="btn btn-primary" id="submitBtn" name="btn_submit" value="Submit">
                                          </div>

                                        </div>
                                      </div>
                                    </div>
                        </div>
                      </form>
            <!-- Your Profile Views Chart END-->
        </div>
    </div>
</main>
<div class="ttr-overlay"></div>

<!-- External JavaScripts -->
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
