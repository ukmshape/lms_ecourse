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
        background: #f3f3f3!important;
    }
    textarea:disabled {
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
            <h4 class="breadcrumb-title">Application Invoice</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="<?= base_url('urusetia_mc/dash_admin') ?>"><i class="fa fa-home"></i>Dashboard</a></li>
                <li><a href="<?= base_url('urusetia_mc/semak_mc') ?>">Application Review</a></li>
                <li>Application Invoice</li>
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
            <form action="" method="post">
              <div class="col-lg-12 m-b30">
                  <div class="widget-box">

                      <div class="wc-title">
                          <h4>Application Invoice</h4>
                      </div>
                      <div class="widget-inner edit-profile">
                              <div class="row">
                                <div class="col-12">
                                    <div class="ml-auto m-b5">
                                        <h3>1. Applicant Info</h3>
                                    </div>
                                </div>

                                <div class="form-group col-4">
                                    <div>
                                        <label class="col-form-label">Application Date</label>
                                        <div>
                                            <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo date("d/m/Y g:i A", strtotime($detail_pelajar[0]->create_dated)); ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-8"></div>
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
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" id="txt_email1" name="txt_email1" value="<?php echo ($detail_pelajar[0]->emel); ?>" disabled>

                                        <input type="hidden" id="txt_email" name="txt_email" value="<?php echo ($detail_pelajar[0]->emel); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Phone Number</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" id="txt_phonenumber" name="txt_phonenumber" value="<?php echo ($detail_pelajar[0]->notel); ?>" disabled>
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
                                                <th scope="col" style="text-align:center; vertical-align:middle;">Price</th>
                                            </tr>
                                        </thead>
                                        <?php $num = 0; ?>
                                        <?php foreach ($detail_kursus as $row) {
                                        ++$num; ?>
                                        <tbody>
                                            <tr>
                                                <td style="text-align:center; vertical-align:middle;"><?php echo $num."."; ?></td>
                                                <td style="text-align:center; vertical-align:middle;"><?php echo $row->kodkursus; ?></td>
                                                <td style="text-align:center; vertical-align:middle;"><a href="<?=base_url();?>/main/course_details/<?=$row->kursusid;?>" target="_blank"><?php echo $row->namakursus; ?></a></td>
                                                <td style="text-align:center; vertical-align:middle;">RM <?php echo $row->unitprice; ?></td>
                                            </tr>
                                        </tbody>
                                        <?php }  ?>
                                        <tfooter>
                                          <tr>
                                              <th colspan="3" style="text-align:right; vertical-align:middle;border-left: 1px solid #fff;border-bottom: 1px solid #fff;font-size: 14pt;">Total</th>
                                              <th style="text-align:center; vertical-align:middle;font-size: 14pt;">RM <?php echo $row->totalprice; ?></th>
                                          </tr>
                                        </tfooter>
                                    </table>
                                </div>

                                <div class="seperator"></div>

                                <div class="col-12 m-t20">
                                    <div class="ml-auto m-b5">
                                        <h3>3. Payment Status</h3>
                                    </div>
                                </div>

                                  <div class="form-group col-4">
                                      <div>
                                          <label class="col-form-label">Order ID</label>
                                          <div>
                                              <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo $detail_pelajar[0]->order_id; ?>" disabled>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group col-4">
                                      <div>
                                          <label class="col-form-label">Invoice No</label>
                                          <div>
                                              <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo $detail_pelajar[0]->noinvoice; ?>" disabled>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group col-4">
                                    <div>
                                      <label class="col-form-label">Invoice Date</label>
                                      <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo date("d/m/Y g:i A", strtotime($detail_pelajar[0]->tarikhinvoice)); ?>" disabled>
                                      </div>
                                    </div>
                                  </div>

                                <div class="form-group col-12 m-t20">
                                    <div>
                                        <label class="col-form-label">Payment Receipt</label>
                                        <div>
                                          <?php

                                          $filelink = '';
                                          $fileName = '';
                                          $linkacademic = DOCPATH.$detail_pelajar[0]->user_id.'/';
                                          if(file_exists($linkacademic)) {
                                            $fileList = glob($linkacademic. $detail_pelajar[0]->files.'.*');
                                            if(count($fileList) != 0){
                                              $fileName = substr($fileList[0], strpos($fileList[0], $detail_pelajar[0]->files));
                                              $filelink = base_url('/documents/'.$detail_pelajar[0]->user_id.'/'.$fileName);
                                            }
                                          }
                                           ?>
                                           <?php if($fileName != '') { ?>
                                              <a class="btn btn-primary" href="<?=$filelink;?>" target="popup" onclick="window.open('<?=$filelink;?>','name','width=1000,height=900')">Open File</a>
                                            <?php } else { ?>
                                              <a class="btn btn-primary" href="javascript:void(0);">File Not Found</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-6 m-t20">
                                    <label class="col-form-label">Payment Status <span class="text-red">*</span></label>
                                    <div>
                                      <select class="form-control" id="txt_status" name="txt_status" <?php if($detail_pelajar[0]->status_urus == 6) { echo 'disabled'; } ?> required>
                                        <option value="" <?php if($detail_pelajar[0]->status_urus == '5') { echo 'selected'; } ?>>Waiting for Verification</option>
                                        <option value="6" <?php if($detail_pelajar[0]->status_urus == '6') { echo 'selected'; } ?>>Successful</option>
                                        <option value="7" <?php if($detail_pelajar[0]->status_urus == '7') { echo 'selected'; } ?>>Unsuccessful</option>
                                        <!--<option value="8" <?php if($detail_pelajar[0]->status_urus == '8') { echo 'selected'; } ?>>Incomplete</option>-->
                                      </select>
                                    </div>
                                </div>
                                <div class="form-group col-6 m-t20">
                                    <label class="col-form-label">Comments (if needed)</label>
                                    <div>
                                        <select class="form-control mb-3" id="txt_comment_urus1" name="txt_comment_urus1" <?php if($detail_pelajar[0]->status_urus == 6) { echo 'disabled'; } ?>>
                                          <option value=""></option>
                                          <?php if($listcomment) {
                                            foreach ($listcomment as $comment) {
                                              if($comment->comment == $detail_pelajar[0]->comment_urus) {
                                                echo '<option value="'.$comment->comment.'" selected readonly>'.$comment->comment.'</option>';
                                              } else {
                                                echo '<option value="'.$comment->comment.'">'.$comment->comment.'</option>';
                                              }
                                            }
                                          } ?>
                                        </select>
                                    </div>
                                    <div>
                                        <textarea class="form-control shadow-sm p-3 bg-white rounded" id="txt_comment_urus2" name="txt_comment_urus2" <?php if($detail_pelajar[0]->status_urus == 6) { echo 'disabled'; } ?>></textarea>
                                    </div>
                                </div>

                                <input type="hidden" name="txt_noinvoice" value="<?=$data_id;?>">
                                <input type="hidden" name="txt_user_id" value="<?=$detail_pelajar[0]->user_id; ?>">

                                <?php if($detail_pelajar[0]->status_urus != 6) { ?>
                                  <div class="col-12 m-t30">
                                      <a href="<?=base_url('/urusetia_mc/semak_mc');?>" class="btn-secondry" style="color:#fff;">Back</a>
                                      <input type="submit" class="btn btn-primary" id="submitBtn" name="btn_submit" value="Next">
                                  </div>
                                <?php } ?>

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

<script>
  $('#txt_status').on('change', function() {
    $('#txt_comment_urus1').val('');
    $('#txt_comment_urus2').val('');
    if($(this).val() == 7) {
      $('#txt_comment_urus2').prop('required',true);
      $('#lbl_comment').html('Comments (if needed) <span class="text-red">*</span>');
    } else {
      $('#txt_comment_urus2').prop('required',false);
      $('#lbl_comment').html('Comments (if needed)');
    }
  });

  $('#txt_comment_urus1').on('change', function() {
    $('#txt_comment_urus2').val($(this).val());
  });
</script>
