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

            <h2 class="title-head">Sign Up <span>Now</span></h2>
            <p>Login Your Account <a href="<?= base_url('/main/signin'); ?>">Click here</a></p>
        </div>
        <form class="contact-bx" method="post" action="<?php echo base_url(); ?>main/registration">
            <div class="row placeani">
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label>Name</label>
                            <input id="txt_nama" name="txt_nama" type="text" required="" class="form-control">
                        </div>
                    </div>
                </div>
                <!--<div class="col-lg-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label>IC.No (Malaysian) / Passport (Non Malaysian)</label>
                            <input id="txt_kpkini" name="txt_kpkini" type="text" required="" class="form-control">
                        </div>
                    </div>
                </div>-->
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label>Email</label>
                            <input id="txt_email" name="txt_email" type="email" required="" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label>Phone Number</label>
                            <input id="txt_telefon" name="txt_telefon" type="text" required="" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label>Password</label>
                            <input id="txt_password" name="txt_password" type="password" minlength="8" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-/(/)]).{8,}$" class="form-control" required="" onkeyup="passwordChecking();">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label>Confirm Password</label>
                            <input id="txt_password_confirm" name="txt_password_confirm" type="password" class="form-control" required="" onkeyup="passwordChecking();">
                            <span id="passwordhelp" class="help text-danger" style="display:none;">Password and Confirm Password must be match.</span>
                        </div>
                    </div>
                </div>
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

                <div class="col-lg-12 m-b30">
                    <button name="btn_signup" type="submit" value="Submit" class="btn button-md" disabled>Sign Up</button>
                </div>
                <!--
        <div class="col-lg-12">
        <h6>Sign Up with Social media</h6>
        <div class="d-flex">
            <a class="btn flex-fill m-r5 facebook" href="#"><i class="fa fa-facebook"></i>Facebook</a>
            <a class="btn flex-fill m-l5 google-plus" href="#"><i class="fa fa-google-plus"></i>Google Plus</a>
        </div>
        </div>
        !-->
            </div>
        </form>
    </div>
</div>
</div>

<?php $this->load->view('templates/layout_footer.php');  ?>
