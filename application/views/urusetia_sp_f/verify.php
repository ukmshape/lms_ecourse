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
    input[type=select]:disabled {
        background: #f3f3f3!important;
    }
    input[type=radio]:disabled {
        background: #f3f3f3!important;
    }
    input[type=checkbox]:disabled {
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
          <h4 class="breadcrumb-title">Application Verification</h4>
          <ul class="db-breadcrumb-list">
              <li><a href="<?= base_url('urusetia_sp/dash_admin') ?>"><i class="fa fa-home"></i>Dashboard</a></li>
              <li><a href="<?= base_url('urusetia_sp/semak_sp') ?>">Application Review</a></li>
              <li><a href="<?= base_url('urusetia_sp/detail_pemohon/'.$parameter) ?>">Application Invoice</a></li>
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
                <!-- Your Profile Views Chart -->
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
                                    <div class="form-group col-4">
                                        <div>
                                            <label class="col-form-label">Application Date</label>
                                            <div>
                                                <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo date("d/m/Y g:i A", strtotime($detail_pelajar[0]->create_dated)); ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <div>
                                            <label class="col-form-label">Order ID</label>
                                            <div>
                                                <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php echo $detail_pelajar[0]->ordersp_id; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <div>
                                            <label class="col-form-label">Invoice No</label>
                                            <div>
                                                <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php if(isset($detail_pelajar[0]->noinvoice)) { echo $detail_pelajar[0]->noinvoice; } ?>" disabled>
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
                                              $linkacademic = DOCPATH.$detail_pelajar[0]->user_id.'/';
                                              if(file_exists($linkacademic)) {
                                                $fileList = glob($linkacademic. 'academic.*');
                                                if(count($fileList) != 0){
                                                  $fileName = substr($fileList[0], strpos($fileList[0], "academic"));
                                                  $filelink = base_url('/documents/'.$detail_pelajar[0]->user_id.'/'.$fileName);
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

                                    <?php

                                    if($customform) { ?>

                                        <div class="seperator"></div>

                                        <div class="col-12 m-t20">
                                            <div class="ml-auto m-b5">
                                                <h3>3. Others</h3>
                                            </div>
                                        </div>
                                    <?php
                                      //$nokp = $detail_pelajar[0]->nokp;
                                      foreach ($customform as $form) {
                                        $customValue = $this->urusetiasp_m->get_customformPemohon($form->form_id, $detail_pelajar[0]->user_id);
                                    ?>
                                    <div class="form-group col-6 m-t20">
                                        <label class="col-form-label"><?=$form->title;?></label>
                                        <div>
                                            <?php

                                            $filelink = '';
                                            $fileName = '';
                                            $required = 'required';
                                            $linkcustom = DOCPATH.$detail_pelajar[0]->user_id.'/';

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
                                                  $filelink = base_url('/documents/'.$detail_pelajar[0]->user_id.'/'.$fileName);
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
                            </div>



                            <form action="" method="post">
                              <div class="col-lg-12 m-b30">
                                  <div class="widget-box">
                                      <div class="wc-title">
                                          <h4>Application Process Status</h4>
                                      </div>
                                      <div class="widget-inner edit-profile">
                                              <div class="row">

                                                <?php
                                                $notitle = 0;
                                                if($getForm && $getForm[0]->semakfakulti == 'yes') { ?>

                                                <div class="col-12">
                                                  <div class="ml-auto m-b5">
                                                    <h3><?=++$notitle;?>. Faculty Checking</h3>
                                                  </div>
                                                </div>
                                                <div class="form-group col-4 m-t20">
                                                    <label class="col-form-label">Application Status</label>
                                                    <div class="col-12">
                                                      <select class="form-control" id="" name="" disabled>
                                                        <option value="">Select</option>
                                                        <option value="5" <?php if($detail_pelajar[0]->status_fakulti == '5') { echo 'selected'; } ?>>Waiting for Verify</option>
                                                        <option value="7" <?php if($detail_pelajar[0]->status_fakulti == '7') { echo 'selected'; } ?>>Valid</option>
                                                        <option value="6" <?php if($detail_pelajar[0]->status_fakulti == '6') { echo 'selected'; } ?>>Invalid</option>
                                                      </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-4 m-t20">
                                                    <label class="col-form-label">Comments (if needed)</label>
                                                    <div class="col-12">
                                                        <textarea class="form-control shadow-sm p-3 bg-white rounded" id="" name="" disabled><?=$detail_pelajar[0]->comment_fakulti;?></textarea>
                                                    </div>
                                                </div>

                                              <?php } ?>

                                                <div class="seperator"></div>

                                                <div class="col-12 m-t20">
                                                    <div class="ml-auto m-b5">
                                                        <h3><?=++$notitle;?>. Application Info</h3>
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
                                                            <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php if(isset($detail_pelajar[0]->noinvoice)) { echo $detail_pelajar[0]->noinvoice; } ?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="seperator"></div>

                                                <div class="col-12 m-t20">
                                                    <div class="ml-auto m-b5">
                                                        <h3><?=++$notitle;?>. Selected Course</h3>
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
                                                              <td style="text-align:center; vertical-align:middle;"><a href="<?=base_url();?>main/course_details/<?=$row->kursusid;?>" target="_blank"><?php echo $row->namakursus; ?></a></td>
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

                                                <div class="col-12">
                                                  <div class="ml-auto m-b5">
                                                    <h3><?=++$notitle;?>. Payment Method</h3>
                                                  </div>
                                                </div>

                                                <?php if($getForm) { ?>
                                                  <?php if($getForm[0]->installment == 'yes' && $detail_pelajar[0]->ansuran == 'yes') { ?>
                                                    <div class="form-group col-4">
                                                        <div>
                                                            <label class="col-form-label">Payment Method</label>
                                                            <div>
                                                                <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="Installment" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-12">
                                                      <table id="tbl_list" class="table table-bordered rounded shadow-sm p-3 bg-white rounded">
                                                        <thead>
                                                          <tr>
                                                            <th style="font-weight: 500; text-align:center;">DEPOSIT(RM)</th>
                                                            <th style="font-weight: 500; text-align:center;">FIRST PAYMENT(RM)</th>
                                                            <th style="font-weight: 500; text-align:center;">SECOND PAYMENT(RM)</th>
                                                            <th style="font-weight: 500; text-align:center;">THIRD PAYMENT(RM)</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                          <tr>
                                                            <td style="font-weight: 500; text-align:center;"><?=$getForm[0]->deposit;?></td>
                                                            <td style="font-weight: 500; text-align:center;"><?=$getForm[0]->ins_1;?></td>
                                                            <td style="font-weight: 500; text-align:center;"><?=$getForm[0]->ins_2;?></td>
                                                            <td style="font-weight: 500; text-align:center;"><?=$getForm[0]->ins_3;?></td>
                                                          </tr>
                                                          <tr>
                                                            <td style="font-weight: 500; text-align:center;">
                                                              <?php if($getForm[0]->status_deposit <= 0) { echo '-'; ?>
                                                              <?php } else if($detail_pelajar[0]->status_deposit == 3 ) { echo 'Unpaid'; ?>
                                                              <?php } else if($detail_pelajar[0]->status_deposit == 4 ) { echo 'Paid'; ?>
                                                              <?php } else if($detail_pelajar[0]->status_deposit == 9 ) { echo 'Pending'; } ?>
                                                            </td>
                                                            <td style="font-weight: 500; text-align:center;">
                                                              <?php if($getForm[0]->ins_1 <= 0) { echo '-'; ?>
                                                              <?php } else if($detail_pelajar[0]->status_payment1 == 3 ) { echo 'Unpaid';  ?>
                                                              <?php } else if($detail_pelajar[0]->status_payment1 == 4 ) { echo 'Paid';  ?>
                                                              <?php } else if($detail_pelajar[0]->status_payment1 == 9 ) { echo 'Pending'; } ?>
                                                            </td>
                                                            <td style="font-weight: 500; text-align:center;">
                                                              <?php if($getForm[0]->ins_2 <= 0) { echo '-'; ?>
                                                              <?php } else if($detail_pelajar[0]->status_payment2 == 3 ) { echo 'Unpaid';  ?>
                                                              <?php } else if($detail_pelajar[0]->status_payment2 == 4 ) { echo 'Paid';  ?>
                                                              <?php } else if($detail_pelajar[0]->status_payment2 == 9 ) { echo 'Pending'; } ?>
                                                            </td>
                                                            <td style="font-weight: 500; text-align:center;">
                                                              <?php if($getForm[0]->ins_3 <= 0) { echo '-'; ?>
                                                              <?php } else if($detail_pelajar[0]->status_payment3 == 3 ) { echo 'Unpaid';  ?>
                                                              <?php } else if($detail_pelajar[0]->status_payment3 == 4 ) { echo 'Paid';  ?>
                                                              <?php } else if($detail_pelajar[0]->status_payment3 == 9 ) { echo 'Pending'; } ?>
                                                            </td>
                                                          </tr>
                                                          <!-- <tr>
                                                            <td colspan="2" style="font-weight: 500; text-align:right;">CURRENT PAYMENT</td>
                                                            <td style="text-align:center;"><input class="form-control no-border" type="text" id="txt_currentpayment" name="txt_currentpayment" style="font-weight: 500; text-align:center;" value="0" readonly></td>
                                                          </tr>
                                                          <tr>
                                                            <td colspan="2" style="font-weight: 500; text-align:right;">BALANCE PAYMENT</td>
                                                            <td style="text-align:center;"><input class="form-control no-border" type="text" id="txt_balancepayment" name="txt_balancepayment" style="font-weight: 500; text-align:center;" value="0" readonly></td>
                                                          </tr> -->
                                                        </tbody>
                                                      </table>
                                                    </div>
                                                    <div class="form-group col-12">
                                                      <label class="col-form-label">Installment Date Picker</label>
                                                      <table id="tbl_list" class="table table-bordered rounded shadow-sm p-3 bg-white rounded">
                                                        <thead>
                                                          <tr>
                                                            <th style="font-weight: 500; text-align:center;">DEPOSIT(RM)</th>
                                                            <th style="font-weight: 500; text-align:center;">FIRST PAYMENT(RM)</th>
                                                            <th style="font-weight: 500; text-align:center;">SECOND PAYMENT(RM)</th>
                                                            <th style="font-weight: 500; text-align:center;">THIRD PAYMENT(RM)</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                          <tr>
                                                            <td style="font-weight: 500; text-align:center;"><?php if($getForm[0]->deposit <= 0) { echo '-'; } else { ?><input type="date" name="txt_deposit"value="<?=$detail_pelajar[0]->tkh_deposit;?>" <?php if($detail_pelajar[0]->tkh_deposit) { echo "disabled"; } ?> required><?php } ?></td>
                                                            <td style="font-weight: 500; text-align:center;"><?php if($getForm[0]->ins_1 <= 0) { echo '-'; } else { ?><input type="date" name="txt_payment1" value="<?=$detail_pelajar[0]->tkh_payment1;?>" <?php if($detail_pelajar[0]->tkh_payment1) { echo "disabled"; } ?> required><?php } ?></td>
                                                            <td style="font-weight: 500; text-align:center;"><?php if($getForm[0]->ins_2 <= 0) { echo '-'; } else { ?><input type="date" name="txt_payment2" value="<?=$detail_pelajar[0]->tkh_payment2;?>" <?php if($detail_pelajar[0]->tkh_payment2) { echo "disabled"; } ?> required><?php } ?></td>
                                                            <td style="font-weight: 500; text-align:center;"><?php if($getForm[0]->ins_3 <= 0) { echo '-'; } else { ?><input type="date" name="txt_payment3" value="<?=$detail_pelajar[0]->tkh_payment3;?>" <?php if($detail_pelajar[0]->tkh_payment3) { echo "disabled"; } ?> required><?php } ?></td>
                                                          </tr>
                                                        </tbody>
                                                      </table>
                                                    </div>
                                                  <?php } else if($detail_pelajar[0]->jnspmbyrn == 'Sponsorship') { ?>
                                                    <div class="form-group col-4">
                                                        <div>
                                                            <label class="col-form-label">Payment Method</label>
                                                            <div>
                                                                <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="Sponsorship" disabled>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="seperator"></div>

                                                    <div class="col-12 m-t20">
                                                        <div class="ml-auto m-b5">
                                                            <h3><?=++$notitle;?>. Sponsorship Details</h3>
                                                        </div>
                                                    </div>

                                                    <?php /* <div class="form-group col-12">
                                                      <table id="tbl_list" class="table table-bordered rounded shadow-sm p-3 bg-white rounded">
                                                        <tbody>
                                                          <tr>
                                                            <td style="font-weight: 500; text-align: center;vertical-align:middle;">UNDER SPONSORSHIP</td>
                                                          </tr>
                                                          <!-- <tr>
                                                            <td colspan="2" style="font-weight: 500; text-align:right;">CURRENT PAYMENT</td>
                                                            <td style="text-align:center;"><input class="form-control no-border" type="text" id="txt_currentpayment" name="txt_currentpayment" style="font-weight: 500; text-align:center;" value="0" readonly></td>
                                                          </tr>
                                                          <tr>
                                                            <td colspan="2" style="font-weight: 500; text-align:right;">BALANCE PAYMENT</td>
                                                            <td style="text-align:center;"><input class="form-control no-border" type="text" id="txt_balancepayment" name="txt_balancepayment" style="font-weight: 500; text-align:center;" value="0" readonly></td>
                                                          </tr> -->
                                                        </tbody>
                                                      </table>
                                                    </div> */ ?>
                                                        <div class="form-group col-6">
                                                            <label class="col-form-label">Company Name</label>
                                                            <div>
                                                                <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php if($detail_sponsor) { echo ($detail_sponsor[0]->nmsyrkt); } ?>" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label class="col-form-label">Company Phone No</label>
                                                            <div>
                                                                <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php if($detail_sponsor) { echo ($detail_sponsor[0]->notelsyrkt); } ?>" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label class="col-form-label">Company Email</label>
                                                            <div>
                                                                <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?php if($detail_sponsor) {echo ( $detail_sponsor[0]->emelsyrkt); } ?>" disabled>
                                                            </div>
                                                        </div>
                                                  <?php } else if($detail_pelajar[0]->jnspmbyrn == 'Own') { ?>
                                                    <div class="form-group col-4">
                                                        <div>
                                                            <label class="col-form-label">Payment Method</label>
                                                            <div>
                                                                <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="Full Payment" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-12">
                                                      <table id="tbl_list" class="table table-bordered rounded shadow-sm p-3 bg-white rounded">
                                                        <tbody>
                                                          <tr>
                                                            <td class="col-4" style="font-weight: 500; vertical-align:middle;">TOTAL PROGRAM PAYMENT</td>
                                                            <td style="text-align:center;"><?=$detail_pelajar[0]->totalprice;?></td>
                                                          </tr>
                                                          <!-- <tr>
                                                            <td colspan="2" style="font-weight: 500; text-align:right;">CURRENT PAYMENT</td>
                                                            <td style="text-align:center;"><input class="form-control no-border" type="text" id="txt_currentpayment" name="txt_currentpayment" style="font-weight: 500; text-align:center;" value="0" readonly></td>
                                                          </tr>
                                                          <tr>
                                                            <td colspan="2" style="font-weight: 500; text-align:right;">BALANCE PAYMENT</td>
                                                            <td style="text-align:center;"><input class="form-control no-border" type="text" id="txt_balancepayment" name="txt_balancepayment" style="font-weight: 500; text-align:center;" value="0" readonly></td>
                                                          </tr> -->
                                                        </tbody>
                                                      </table>
                                                    </div>
                                                  <?php } ?>
                                                <?php } ?>

                                                <div class="seperator"></div>

                                                <div class="col-12 m-t20">
                                                    <div class="ml-auto m-b5">
                                                        <h3><?=++$notitle;?>. Application Status</h3>
                                                    </div>
                                                </div>

                                                <div class="form-group col-6 m-t20">
                                                    <label class="col-form-label">Application Status <span class="text-red">*</span></label>
                                                    <div>
                                                      <select class="form-control" id="txt_status" name="txt_status_admin" <?php if($detail_pelajar[0]->status_admin == 6) { echo 'disabled'; } ?> required>
                                                        <option value="" <?php if($detail_pelajar[0]->status_admin == '5') { echo 'selected'; } ?>>Waiting for Verification</option>
                                                        <option value="6" <?php if($detail_pelajar[0]->status_admin == '6') { echo 'selected'; } ?>>Successful</option>
                                                        <option value="7" <?php if($detail_pelajar[0]->status_admin == '7') { echo 'selected'; } ?>>Unsuccessful</option>
                                                        <!--<option value="8" <?php if($detail_pelajar[0]->status_admin == '8') { echo 'selected'; } ?>>Incomplete</option>-->
                                                      </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-6 m-t20">
                                                    <label id="lbl_comment" class="col-form-label">Comments (if needed)</label>
                                                    <div>
                                                        <select class="form-control mb-3" id="txt_comment_urus1" name="txt_comment_urus1" <?php if($detail_pelajar[0]->status_admin == 6) { echo 'disabled'; } ?>>
                                                          <option value=""></option>
                                                          <?php if($listcomment) {
                                                            foreach ($listcomment as $comment) {
                                                              if($comment->comment == $detail_pelajar[0]->comment_admin) {
                                                                echo '<option value="'.$comment->comment.'" selected readonly>'.$comment->comment.'</option>';
                                                              } else {
                                                                echo '<option value="'.$comment->comment.'">'.$comment->comment.'</option>';
                                                              }
                                                            }
                                                          } ?>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <textarea class="form-control shadow-sm p-3 bg-white rounded" id="txt_comment_urus2" name="txt_comment_urus2" <?php if($detail_pelajar[0]->status_admin == 6) { echo 'disabled'; } ?>></textarea>
                                                    </div>
                                                </div>

                                                <div class="seperator"></div>

                                                <input type="hidden" id="txt_email" name="txt_email" value="<?php echo ($detail_pelajar[0]->emel); ?>">
                                                <input type="hidden" name="txt_noinvoice" value="<?=$data_id;?>">
                                                <input type="hidden" name="txt_user_id" value="<?=$detail_pelajar[0]->user_id; ?>">
                                                <input type="hidden" name="order_id" value="<?=$detail_pelajar[0]->order_id;?>">
                                                <input type="hidden" name="jnspmbyrn" value="<?=$detail_pelajar[0]->jnspmbyrn;?>">

                                                <div class="col-12 m-t30">
                                                    <a href="<?=base_url('/urusetia_sp/semak_sp');?>" class="btn-secondry" style="color:#fff;">Back</a>
                                                    <?php if($detail_pelajar[0]->status_admin == 5) { ?>
                                                      <input type="submit" class="btn btn-primary" id="submitBtn" name="btn_submit" value="Submit">
                                                    <?php } ?>
                                                </div>

                                              </div>
                                            </div>
                                          </div>
                              </div>
                            </form>

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
