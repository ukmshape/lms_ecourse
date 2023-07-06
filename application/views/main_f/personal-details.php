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
  $nationality = '';
  $notel = '';
  $emel = '';
  $highestedu = '';
  $nmprogram = '';

if($data_pelajar) {
  $fullname = $data_pelajar->nama;
  $nokp = $data_pelajar->nokp;
  $alamat1 = $data_pelajar->alamat1;
  $alamat2 = $data_pelajar->alamat2;
  $alamat3 = $data_pelajar->alamat3;
  $city = $data_pelajar->bandar;
  $state = $data_pelajar->negeri;
  $postcode = $data_pelajar->poskod;
  $nationality = $data_pelajar->negara;
  $notel = $data_pelajar->notel;
  $emel = $data_pelajar->emel;
  $highestedu = $data_pelajar->akadtertinggi;
  $nmprogram = $data_pelajar->nmsijil;
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
                <form class="edit-profile" action="" method="post">
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
                        <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">State/ Country <span class="text-red">*</span></label>
                        <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                          <input class="form-control" type="text" id="txt_country" name="txt_country" value="<?=$state;?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Post/Zip code <span class="text-red">*</span></label>
                        <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                          <input class="form-control" type="text" id="txt_poscode" name="txt_poscode" value="<?=$postcode;?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Nationality <span class="text-red">*</span></label>
                        <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                          <select class="form-control" id="txt_nationality" name="txt_nationality" required>
                            <option value="<?=$nationality;?>"><?php if(!$nationality) echo "Select"; else echo $nationality; ?></option>
                            <?php $this->load->view('/main_f/country_code'); ?>
                          </select>
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
                        <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Highest Education</label>
                        <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                          <select class="form-control" id="txt_academic" name="txt_academic">
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
                        <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Name of Certificate / Program of Study</label>
                        <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                          <input class="form-control" type="text" id="txt_nmacademic" name="txt_nmacademic" value="<?=$nmprogram;?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Academic Certificate</label>
                        <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                          <?php

                          $filelink = '';
                          $fileName = '';
                          $linkacademic = DOCPATH.$user_id.'/';
                          if(file_exists($linkacademic)) {
                            $fileList = glob($linkacademic. 'academic.*');
                          }

                           ?>
                          <input class="form-control" type="file" id="txt_academicfile" name="txt_academicfile" accept="image/png, image/gif, image/jpeg, application/pdf">
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
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="close" class="btn-secondry" data-dismiss="modal">Back</button>
                    <input type="submit" class="btn btn-primary" name="txt_submit" value="Save & Continue">
                  </div>
                </form>
              </div>
            </div>
        </div>
</div>
    <!-- inner page banner END -->
</div>
