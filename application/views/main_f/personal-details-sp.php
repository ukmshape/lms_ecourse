<?php

  $fullname = $this->session->userdata('session_student')['nama'];
  $user_id = $this->session->userdata('session_student')['user_id'];
  $nokp = $this->session->userdata('session_student')['nokp'];
  $alamat1 = '';
  $alamat2 = '';
  $alamat3 = '';
  $city = '';
  $state = '';
  $postcode = '';
  $country = '';
  $notel = '';
  $emel = '';
  $highestedu = '';
  $nmprogram = '';
  $txt_cmpynm = '';
  $txt_cmpytel = '';
  $txt_cmpyemail = '';

  $totalprice = $order_sp[0]->totalprice;
  $deposit = 0;

if($data_pelajar) {
  $fullname = $data_pelajar->nama;
  $nokp = $data_pelajar->nokp;
  $alamat1 = $data_pelajar->alamat1;
  $alamat2 = $data_pelajar->alamat2;
  $alamat3 = $data_pelajar->alamat3;
  $city = $data_pelajar->bandar;
  $state = $data_pelajar->negeri;
  $postcode = $data_pelajar->poskod;
  $country = $data_pelajar->negara;
  $notel = $data_pelajar->notel;
  $emel = $data_pelajar->emel;
  $highestedu = $data_pelajar->akadtertinggi;
  $nmprogram = $data_pelajar->nmsijil;
  $txt_cmpynm = $data_pelajar->nmsyrkt;
  $txt_cmpytel = $data_pelajar->notelsyrkt;
  $txt_cmpyemail = $data_pelajar->emelsyrkt;
}

  if($getForm) {
    if($getForm[0]->installment == 'yes') {
      $deposit = $getForm[0]->deposit;
      $jumlahsemua = number_format((float)($totalprice - (float)$deposit), 2, '.', '');
    }
  }


 ?>


<?php $this->load->view('templates/layout_utama_menu'); ?>

<!-- Content -->
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="page-banner ovbl-dark" style="background-image:url(<?=base_url('/');?>assets/images/banner/banner3.jpg);">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white">Check Out</h1>
     </div>
        </div>
    </div>
<!-- Breadcrumb row -->
<div class="breadcrumb-row">
  <div class="container">
    <ul class="list-inline">
      <li><a href="<?=base_url('/');?>">Home</a></li>
      <li><a href="<?=base_url('/main/carts');?>">Shopping Cart</a></li>
      <li>Check Out</li>
      <li>Personal Details</li>
    </ul>
  </div>
</div>
<!-- Breadcrumb row END -->


    <!-- inner page banner -->
    <div class="page-banner contact-page section-sp2">
        <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto" style="border: 1px solid #e9e9e9;">
                <div class="profile-head">
                  <h3>Profile Details</h3>
                </div>
                <form class="edit-profile" id="formfield" action="" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="">
                      <div class="form-group row">
                        <div class="col-12 col-sm-9 col-md-9 col-lg-9 ml-auto">
                          <h3>1. Personal Details</h3>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Full Name <span class="text-red">*</span></label>
                        <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                          <input class="form-control" type="text" id="txt_name" name="txt_name" value="<?=$fullname;?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">IC.No/ Passport <span class="text-red">*</span></label>
                        <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                          <input class="form-control" type="text" id="txt_kpkini" name="txt_kpkini" value="<?=$nokp;?>" required>
                        </div>
                      </div>

                      <div class="seperator"></div>

                      <div class="form-group row">
                        <div class="col-12 col-sm-9 col-md-9 col-lg-9 ml-auto">
                          <h3>2. Address</h3>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Postal Address <span class="text-red">*</span></label>
                        <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                          <input class="form-control mb-2" type="text" id="txt_alamat1" name="txt_alamat1" value="<?=$alamat1;?>" required>
                          <input class="form-control mb-2" type="text" id="txt_alamat2" name="txt_alamat2" value="<?=$alamat2;?>">
                          <input class="form-control mb-2" type="text" id="txt_alamat3" name="txt_alamat3" value="<?=$alamat3;?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">City <span class="text-red">*</span></label>
                        <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                          <input class="form-control" type="text" id="txt_city" name="txt_city" value="<?=$city;?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">State <span class="text-red">*</span></label>
                        <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                          <input class="form-control" type="text" id="txt_state" name="txt_state" value="<?=$state;?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Country <span class="text-red">*</span></label>
                        <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                          <input class="form-control" type="text" id="txt_country" name="txt_country" value="<?=$country;?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Post/Zip code <span class="text-red">*</span></label>
                        <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                          <input class="form-control" type="text" id="txt_poscode" name="txt_poscode" value="<?=$postcode;?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Phone No. (Mobile) <span class="text-red">*</span></label>
                        <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                          <input class="form-control" type="text" id="txt_tel" name="txt_tel" value="<?=$notel;?>" placeholder="+60" required>
                          <span class="help">With country code</span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Email Address <span class="text-red">*</span></label>
                        <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                          <input class="form-control" type="email" id="txt_emel" name="txt_emel" value="<?=$emel;?>" required>
                        </div>
                      </div>

                      <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>

                      <div class="form-group row">
                        <div class="col-12 col-sm-9 col-md-9 col-lg-9 ml-auto">
                          <h3 class="m-form__section">3. Academic Qualifications</h3>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Highest Education <span class="text-red">*</span></label>
                        <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                          <select class="form-control" id="txt_academic" name="txt_academic" required>
                            <option value="">Select</option>
                            <option value="82" <?php if($highestedu == '82') { echo 'selected'; } ?>>O Level</option>
                            <option value="AL" <?php if($highestedu == 'AL') { echo 'selected'; } ?>>A Level</option>
                            <option value="SJ" <?php if($highestedu == 'SJ') { echo 'selected'; } ?>>Certificate</option>
                            <option value="DI" <?php if($highestedu == 'DI') { echo 'selected'; } ?>>Diploma</option>
                            <option value="WW" <?php if($highestedu == 'WW') { echo 'selected'; } ?>>Advance Diploma</option>
                            <option value="SM" <?php if($highestedu == 'SM') { echo 'selected'; } ?>>Degree</option>
                            <option value="SS" <?php if($highestedu == 'SS') { echo 'selected'; } ?>>Master</option>
                            <option value="FF" <?php if($highestedu == 'FF') { echo 'selected'; } ?>>Doctor of Philosophy</option>
                            <option value="KP" <?php if($highestedu == 'KP') { echo 'selected'; } ?>>Professional Qualification</option>
                            <option value="ZZ" <?php if($highestedu == 'ZZ') { echo 'selected'; } ?>>Others</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Name of Certificate / Program of Study <span class="text-red">*</span></label>
                        <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                          <input class="form-control" type="text" id="txt_nmacademic" name="txt_nmacademic" value="<?=$nmprogram;?>" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Academic Certificate<span class="text-red">*</span></label>
                        <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                          <?php

                          $filelink = '';
                          $fileName = '';
                          $required = '';
                          $linkacademic = DOCPATH.$user_id.'/';
                          if(file_exists($linkacademic)) {
                            $fileList = glob($linkacademic. 'academic.*');
                            if(count($fileList) == 0) {
                              $required = 'required';
                            }
                          } else {
                            $required = 'required';
                          }

                           ?>
                          <input class="form-control" type="file" id="txt_academicfile" name="txt_academicfile" accept="application/pdf" <?=$required;?>>
                          <?php

                            if(file_exists($linkacademic)) {
                              $fileList = glob($linkacademic. 'academic.*');
                              if(count($fileList) != 0){
                                $fileName = substr($fileList[0], strpos($fileList[0], "academic"));
                                $filelink = base_url('/documents/'.$user_id.'/'.$fileName);
                           ?>
                              <span>Document: <a href="<?=$filelink;?>"><?=$fileName;?></a></span>
                            <?php } } ?>
                        </div>
                      </div>

                      <?php if($order_sp) {
                        $customform = $this->main_m->get_customform($order_sp[0]->kursusid);

                        if($customform) { ?>

                          <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>

                          <div class="form-group row">
                            <div class="col-12 col-sm-9 col-md-9 col-lg-9 ml-auto">
                              <h3 class="m-form__section">3. Others</h3>
                            </div>
                          </div>

                          <?php
                          foreach ($customform as $form) {
                            $customValue = $this->main_m->get_customformPemohon($form->form_id, $user_id);
                        ?>
                            <div class="form-group row">
                              <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label"><?=$form->title;?><?php if($form->required == 'yes'): ?><span class="text-red">*</span><?php endif;?></label>
                              <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                                <?php

                                $filelink = '';
                                $fileName = '';
                                $required = 'required';
                                $linkcustom = DOCPATH.$user_id.'/';
                                if(file_exists($linkcustom)) {
                                } else {
                                  $required = 'required';
                                }
                                if($form->type == 'file' && !empty($customValue) && !empty($customValue[0]->value)) {
                                    $required = '';
                                }

                                 ?>
                                <?php if($form->type != 'select' && $form->type != 'textarea' && $form->type != 'checkbox' && $form->type != 'radio') { ?>
                                <input class="form-control" type="<?=$form->type;?>" id="<?=$form->shortname;?>" name="<?=$form->shortname;?>" value="<?php if($customValue): echo $customValue[0]->value; endif;?>" <?php if($form->required == 'yes' && $required == 'required'): ?>required<?php endif;?>>
                                <?php
                                if($form->type == 'file' && !empty($customValue) && !empty($customValue[0]->value)) {
                                  if(file_exists($linkcustom)) {
                                    $fileList = glob($linkcustom. $customValue[0]->value.'.*');
                                    if(count($fileList) != 0){
                                      $fileName = substr($fileList[0], strpos($fileList[0], $customValue[0]->value));
                                      $filelink = base_url('/documents/'.$user_id.'/'.$fileName);
                                 ?>
                                    <span>Document: <a href="<?=$filelink;?>"><?=$fileName;?></a></span>
                                  <?php } } } ?>
                              <?php } else if($form->type == 'select') { ?>
                                <select class="form-control" id="<?=$form->shortname;?>" name="<?=$form->shortname;?>" <?php if($form->required == 'yes' && $required == 'required'): ?>required<?php endif;?>>
                                  <option value="">Select</option>
                                  <?php
                                  $array = json_decode($form->value);

                                  foreach ($array as $value) {
                                    $selected = '';
                                    if($customValue) {
                                      if($customValue[0]->value == $value) {
                                        $selected = 'selected';
                                      }
                                    }
                                    echo "<option value='$value' $selected>$value</option>";
                                  }

                                  ?>
                                </select>
                              <?php } else if($form->type == 'textarea') { ?>
                                <textarea class="form-control" id="<?=$form->shortname;?>" name="<?=$form->shortname;?>" <?php if($form->required == 'yes' && $required == 'required'): ?>required<?php endif;?>><?php if($customValue): echo $customValue[0]->value; endif;?></textarea>
                              <?php } else if($form->type == 'checkbox' || $form->type == 'radio') { ?>
                                <?php
                                $array = json_decode($form->value);
                                $first = true;
                                foreach ($array as $key => $value) {
                                  $requiredradio = '';
                                  if($first) {
                                      //$requiredradio = 'required';
                                      $first = false;
                                  }
                                  $selected = '';
                                  if($customValue) {
                                    $array2 = json_decode($customValue[0]->value);
                                    if($array2 != null) {
                                      for($i = 0; $i < count($array2); $i++) {
                                        if($value == $array2[$i]) {
                                          $selected = 'checked';
                                        }
                                      }
                                    }

                                  }
                                   ?>

                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="<?=$form->type;?>" name="<?=$form->shortname;?>[]" id="<?=$key;?>" value="<?=$value;?>" <?php /*if($form->required == 'yes' && $requiredradio == 'required'): ?>required<?php endif;*/?> <?=$selected;?>>
                                    <label class="form-check-label" for="<?=$key;?>"><?=$value;?></label>
                                  </div>

                                 <?php } ?>
                              <?php } ?>
                              </div>
                            </div>
                      <?php
                          }
                        }
                      }
                      ?>

                      <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                      <?php if($getForm) { ?>
                        <input type="hidden" class="btn btn-primary" name="txt_semakfakulti" value="<?php echo $getForm[0]->semakfakulti;?>">
                        <input type="hidden" class="btn btn-primary" name="txt_semakadmin" value="<?php echo $getForm[0]->semakadmin;?>">
                        <?php if($getForm[0]->sponsorship == 'yes' || $getForm[0]->installment == 'yes') { ?>
                      <div class="form-group row">
                        <div class="col-12 col-sm-9 col-md-9 col-lg-9 ml-auto">
                          <h3 class="m-form__section">4. Payment Method</h3>
                        </div>
                      </div>
                    <?php } } ?>
                      <?php if($getForm) { ?>
                        <?php if($getForm[0]->sponsorship == 'yes') { ?>
                          <div class="form-group row">
                            <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Under Sponsorship? <span class="text-red">*</span></label>
                            <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="txt_sponsor" id="txt_sponsor1" value="Sponsorship" required>
                                <label class="form-check-label" for="txt_sponsor1">Yes</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="txt_sponsor" id="txt_sponsor2" value="Own">
                                <label class="form-check-label" for="txt_sponsor2">No</label>
                              </div>
                            </div>
                          </div>

                          <div class="form-group row sponsor_display" style="display: none;">
                            <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Company Name <span class="text-red">*</span></label>
                            <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                              <input class="form-control" type="text" id="txt_cmpynm" name="txt_cmpynm" value="<?=$txt_cmpynm;?>" required>
                            </div>
                          </div>

                          <div class="form-group row sponsor_display" style="display: none;">
                            <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Company Phone No. <span class="text-red">*</span></label>
                            <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                              <input class="form-control" type="tel" id="txt_cmpytel" name="txt_cmpytel" value="<?=$txt_cmpytel;?>" required>
                            </div>
                          </div>

                          <div class="form-group row sponsor_display" style="display: none;">
                            <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Company Email <span class="text-red">*</span></label>
                            <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                              <input class="form-control" type="email" id="txt_cmpyemail" name="txt_cmpyemail" value="<?=$txt_cmpyemail;?>" required>
                            </div>
                          </div>
                        <?php } ?>

                        <?php if($getForm[0]->installment == 'yes') { ?>
                          <div class="form-group row own_display" style="<?php if($getForm[0]->sponsorship == 'yes') { ?>display: none; <?php } ?>">
                            <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Full Payment / Installment? <span class="text-red">*</span></label>
                            <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="txt_ansuran" id="txt_ansuran_radio1" value="no" required>
                                <label class="form-check-label" for="txt_ansuran_radio1">Full Payment</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="txt_ansuran" id="txt_ansuran_radio2" value="yes">
                                <label class="form-check-label" for="txt_ansuran_radio2">Installment</label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row fullpayment" style="display: none;">
                            <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Fee <span class="text-red">*</span></label>
                            <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">RM</span>
                                </div>
                                <input type="text" class="form-control" id="txt_unitprice" name="txt_unitprice" value="<?=number_format($totalprice, 2, '.', '');?>" readonly>
                              </div>
                            </div>
                          </div>

                            <table class="table table-bordered installment_display" style="display:none;">
                              <tr>
                                <th>Fee</th>
                                <td>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">RM</span>
                                    </div>
                                    <input type="text" class="form-control" id="txt_unitprice" name="txt_unitprice" value="<?=number_format($totalprice, 2, '.', '');?>" readonly>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <th>Deposit (-)<small style="color:#ed0000;"> <br>Must pay for this registration</small></th>
                                <td>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">RM</span>
                                    </div>
                                    <input type="text" class="form-control" id="txt_deposit" name="txt_deposit" value="<?=number_format($getForm[0]->deposit, 2, '.', '');?>" readonly>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td><label class="col-form-label"><b>1st</b><br>Installment <span class="text-red">*</span></label></td>
                                <td>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">RM</span>
                                    </div>
                                    <input type="number" class="form-control" id="txt_ansuran1" value="<?=number_format($getForm[0]->ins_1, 2, '.', '');?>" readonly>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td><label class="col-form-label"><b>2nd</b><br>Installment <span class="text-red">*</span></label></td>
                                <td>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">RM</span>
                                    </div>
                                    <input type="number" class="form-control" id="txt_ansuran2" value="<?=number_format($getForm[0]->ins_2, 2, '.', '');?>" readonly>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td><label class="col-form-label"><b>3rd</b><br>Installment <span class="text-red">*</span></label></td>
                                <td>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">RM</span>
                                    </div>
                                    <input type="number" class="form-control" id="txt_ansuran3" value="<?=number_format($getForm[0]->ins_3, 2, '.', '');?>" readonly>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <th>Total Installment</th>
                                <td>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">RM</span>
                                    </div>
                                    <input type="text" class="form-control" id="txt_totalpay" value="<?=number_format(((float)$getForm[0]->ins_1+(float)$getForm[0]->ins_2+(float)$getForm[0]->ins_3), 2, '.', '');?>" readonly>
                                  </div>
                                </td>
                              </tr>
                            </table>

                        <?php } ?>
                      <?php } else { ?>

                        <div class="form-group row">
                          <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Fee <span class="text-red">*</span></label>
                          <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">RM</span>
                              </div>
                              <input type="text" class="form-control" id="txt_unitprice" name="txt_unitprice" value="<?=number_format($totalprice, 2, '.', '');?>" readonly>
                            </div>
                          </div>
                        </div>

                      <?php } ?>

                    </div>
                  </div>
                  <div class="modal-footer">
                    <!--<button type="close" class="btn-secondry">Back</button>-->
                    <input type="submit" class="btn btn-primary" id="submitBtn" name="txt_submit" value="Save & Continue">
                  </div>
                </form>
              </div>
            </div>
        </div>
</div>
</div>

<?php $this->load->view('templates/layout_footer'); ?>
