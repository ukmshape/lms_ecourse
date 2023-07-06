<div class="account-form">
  <div class="account-head" style="background-image:url(<?= base_url(); ?>assets/images/background/bg2.jpg);">
    <a href="<?= base_url('/'); ?>" style="background-color: #ffffff;"><img src="<?= base_url(); ?>assets/img/UKMSHAPE.png" width="320" alt=""><img src="<?= base_url(); ?>assets/img/eCourse-2.png" width="255" alt=""></a>
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

        <h2 class="title-head">Forget <span>Password</span></h2>
        <p>Login Your Account <a href="<?= base_url('/main/signin'); ?>">Click here</a></p>
      </div>
      <form class="contact-bx" action="<?=base_url('/main/submit_forgetpassword');?>" method="post">
        <div class="row placeani">
          <div class="col-lg-12">
            <div class="form-group">
              <div class="input-group">
                <label>Your Email Address</label>
                <input name="txt_email" type="email" required="" class="form-control">
              </div>
            </div>
          </div>
          <div class="col-lg-12 m-b30">
            <button name="submit" type="submit" value="Submit" class="btn button-md">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $this->load->view('templates/layout_footer.php');  ?>