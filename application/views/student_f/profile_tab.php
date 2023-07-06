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

if($semakdata_student) {
$fullname = $semakdata_student->nama;
$nokp = $semakdata_student->nokp;
$alamat1 = $semakdata_student->alamat1;
$alamat2 = $semakdata_student->alamat2;
$alamat3 = $semakdata_student->alamat3;
$city = $semakdata_student->bandar;
$state = $semakdata_student->negeri;
$postcode = $semakdata_student->poskod;
$country = $semakdata_student->negara;
$notel = $semakdata_student->notel;
$emel = $semakdata_student->emel;
$highestedu = $semakdata_student->akadtertinggi;
$nmprogram = $semakdata_student->nmsijil;
$txt_cmpynm = $semakdata_student->nmsyrkt;
$txt_cmpytel = $semakdata_student->notelsyrkt;
$txt_cmpyemail = $semakdata_student->emelsyrkt;
}


 ?>

<div class="profile-head">
  <h3>Profile</h3>
</div>


<!-- <form class="edit-profile">
  <div class="">
    <div class="form-group row">
      <div class="col-12 col-sm-8 col-md-8 col-lg-9 ml-auto">
        <h3>Login Details</h3>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-12 col-sm-4 col-md-4 col-lg-3 col-form-label">IC.No/ Passport</label>
      <div class="col-12 col-sm-8 col-md-8 col-lg-7">
        <input class="form-control" type="text" id="txt_kpkini" name="txt_kpkini" value="" readonly>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-12 col-sm-4 col-md-4 col-lg-3 col-form-label">Email Address</label>
      <div class="col-12 col-sm-8 col-md-8 col-lg-7">
        <input class="form-control" type="email" id="txt_emel" name="txt_emel" value="">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-sm-4 col-md-4 col-lg-3">
    </div>
    <div class="col-12 col-sm-8 col-md-8 col-lg-7">
      <button type="reset" class="btn">Save changes</button>
      <button type="reset" class="btn-secondry">Cancel</button>
    </div>
  </div>
</form>
<hr/> -->


<form class="edit-profile" method="post" enctype="multipart/form-data" action="<?php echo $action_save_tab_profile;?>">
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
          <input class="form-control" type="file" id="txt_academicfile" name="txt_academicfile" <?=$required;?>>
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

      <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
      <div class="form-group row">
        <div class="col-12 col-sm-9 col-md-9 col-lg-9 ml-auto">
          <h3 class="m-form__section">4. Sponsorship</h3>
        </div>
      </div>

          <div class="form-group row sponsor_display">
            <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Company Name</label>
            <div class="col-12 col-sm-9 col-md-9 col-lg-7">
              <input class="form-control" type="text" id="txt_cmpynm" name="txt_cmpynm" value="<?=$txt_cmpynm;?>">
            </div>
          </div>

          <div class="form-group row sponsor_display">
            <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Company Phone No.</label>
            <div class="col-12 col-sm-9 col-md-9 col-lg-7">
              <input class="form-control" type="tel" id="txt_cmpytel" name="txt_cmpytel" value="<?=$txt_cmpytel;?>">
            </div>
          </div>

          <div class="form-group row sponsor_display">
            <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Company Email</label>
            <div class="col-12 col-sm-9 col-md-9 col-lg-7">
              <input class="form-control" type="email" id="txt_cmpyemail" name="txt_cmpyemail" value="<?=$txt_cmpyemail;?>">
            </div>
          </div>

    </div>
  </div>
  <div class="modal-footer">
    <!--<button type="close" class="btn-secondry">Back</button>-->
    <input type="submit" class="btn btn-primary" id="btn_update" name="btn_update" value="Update">
  </div>

  <!--<div class="row">
    <div class="col-12 col-sm-4 col-md-4 col-lg-3">
    </div>
    <div class="col-12 col-sm-8 col-md-8 col-lg-7">
      <button name="btn_update" type="submit"  value="Submit" class="btn button-md">Update</button>
      <button type="reset" class="btn-secondry">Cancel</button>
    </div>
  </div>-->
</form>
