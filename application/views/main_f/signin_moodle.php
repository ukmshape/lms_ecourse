<?php

if($this->session->userdata('session_student')) {
  $session_student = $this->session->userdata('session_student');
} else if($this->session->userdata('session_ukmper')) {
  $session_student = $this->session->userdata('session_ukmper');
} else {
  $session_student = 0;
}
 ?>

<div class="account-form">

  <div class="account-head" style="background-image:url(<?= base_url(); ?>/assets/images/background/bg2.jpg);">

    <a href="<?= base_url('/'); ?>" style="background-color: #ffffff;"><img src="<?= base_url(); ?>assets/img/UKMSHAPE.png" width="320" alt=""><img src="<?= base_url(); ?>assets/img/CLG.png" width="100" alt=""></a>

  </div>

  <div class="account-form-inner">

    <div class="account-container">

      <div class="heading-bx left">

        <?php if ($this->session->flashdata('mesej')) { ?>
          <div class="<?php echo $this->session->flashdata('mesej_css'); ?>" role="alert" id="mesej-alert" style="font-family: unset;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <center><?php echo $this->session->flashdata('mesej'); ?></center>
          </div>

        <?php } ?>


        <h2 class="title-head">Login to your <span>Account</span></h2>

        <p>Don't have an account? <a href="<?= base_url('/main/signup'); ?>">Create one here</a></p>

      </div>

      <form class="contact-bx" method="post" action="<?=LMSPATH;?>/login/index.php">

        <!-- <form id="form_horizontal"> -->

        <div class="row placeani">

          <div class="col-lg-12">

            <div class="form-group">

              <div class="input-group">

                <label>Email</label>

                <input name="username" type="text" required="" class="form-control">

              </div>

            </div>

          </div>

          <div class="col-lg-12">

            <div class="form-group">

              <div class="input-group">

                <label>Password</label>

                <input name="password" type="password" class="form-control" required="">

              </div>

            </div>

          </div>

          <div class="col-lg-12">

            <div class="form-group form-forget">

              <div class="custom-control custom-checkbox">

                <input type="checkbox" class="custom-control-input" id="customControlAutosizing">

                <label class="custom-control-label" for="customControlAutosizing">Remember me</label>

              </div>

              <a href="<?= base_url('/main/forgetpassword'); ?>" class="ml-auto">Forgot Password?</a>

            </div>

          </div>

          <div class="col-lg-12 m-b30">

            <button name="btn_login" type="submit" value="Submit" class="btn button-md">Login</button>

            <!-- <a href="<--?= base_url('/Admin/dash_admin'); ?>" class="btn button-md">Login</a> -->

          </div>

          <!--

          <div class="col-lg-12">

            <h6>Login with Social media</h6>

            <div class="d-flex">

              <a class="btn flex-fill m-r5 facebook" href="#"><i class="fa fa-facebook"></i>Facebook</a>

              <a class="btn flex-fill m-l5 google-plus" href="#"><i class="fa fa-google-plus"></i>Google Plus</a>

            </div>

          </div>

        -->

        </div>

      </form>

    </div>

  </div>

</div>

<script src='<?php echo base_url('/'); ?>assets/dashboard/js/jquery.min.js'></script>

<script>

$(document).ready(function() {
    $('input[name="username"]').val("<?=$email;?>");
    $('input[name="password"]').val("<?=$password;?>");

    if($('input[name="username"]').val() != '' && $('input[name="password"]').val() != '') {
      $("form").submit();
    }

});

</script>
