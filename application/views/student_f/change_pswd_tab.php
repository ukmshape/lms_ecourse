<div class="profile-head">
  <h3>Change Password</h3>
</div>
<form class="edit-profile" method="post" enctype="multipart/form-data" action="<?php echo $action_save_tab_changepswd;?>">

  <div class="">

    <div class="form-group row">
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
            <span>* This registration is also for system LMS login</span>
            </div>
        </div>
      </div>
    </div>
    

    <div class="form-group row">
      <label class="col-12 col-sm-4 col-md-4 col-lg-3 col-form-label">New Password</label>
      <div class="col-12 col-sm-8 col-md-8 col-lg-7">
        <input class="form-control" type="password" name="txt_newpass" id="txt_newpass" minlength="8" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-/(/)]).{8,}$" value="" onkeyup="passwordChecking();" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-12 col-sm-4 col-md-4 col-lg-3 col-form-label">Re Type New Password</label>
      <div class="col-12 col-sm-8 col-md-8 col-lg-7">
        <input class="form-control" type="password" name="txt_repass" id="txt_repass" value="" onkeyup="passwordChecking();" required>
        <span id="passwordhelp" class="help text-danger" style="display:none;">Password and Confirm Password must be match.</span>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-12 col-sm-4 col-md-4 col-lg-3">
    </div>
    <div class="col-12 col-sm-8 col-md-8 col-lg-7">
      <button name="btn_chngepswd" type="submit"  value="Submit" class="btn">Save changes</button>
      <button type="reset" class="btn-secondry">Cancel</button>
    </div>
  </div>

</form>
