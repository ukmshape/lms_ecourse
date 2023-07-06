<?php $this->load->view('templates/layout_utama_menu'); ?>
<style>
.cours-search-bx .btn:hover {
  color: #ff0202;
  font-weight: bold;
}
</style>

<div class="page-content bg-white">
    <!-- Main Slider -->
    <div class="section-area section-sp1 ovpr-dark bg-fix online-cours" style="background-image:url(<?=base_url('/');?>assets/images/background/bg1.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center text-white">
          <h2>eCOURSE UKM</h2>
          <h5>Learn Remotely From Anywhere</h5>
        </div>
      </div>
      <div class="mw800 m-auto">
        <div class="row">
          <div class="col-md-4 col-sm-6">
            <div class="cours-search-bx m-b30" style="background-color: #e1a30c;">
              <div class="icon-box">
                <h3><span class="counter"><?=$this->main_m->get_mcodlukm_MC_count('');?></span></h3>
              </div>
              <span class="cours-search-text" style="font-weight:600;">Micro-Credentials</span><br/>
              <a href="<?=base_url('/MC');?>" class="btn" style="margin-top: 10px;background-color: #ffffff;">Join Now</a>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="cours-search-bx m-b30" style="background-color: #0cb0e1;">
              <div class="icon-box">
                <h3><span class="counter"><?=$this->main_m->get_mcodlukm_SP_count('');?></span></h3>
              </div>
              <span class="cours-search-text" style="font-weight:600;">Professional Certificate</span><br/>
              <?php /* <a href="javascript:();" class="btn" style="margin-top: 10px;background-color: #ffffff;">Coming Soon</a> */ ?>
              <a href="<?=base_url('/SP');?>" class="btn" style="margin-top: 10px;background-color: #ffffff;">Join Now</a>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="cours-search-bx m-b30" style="background-color: #68cb2f;">
              <div class="icon-box">
                <h3><span class="counter"><?=$this->main_m->get_mcodlukm_KP_count('');?></span></h3>
              </div>
              <span class="cours-search-text" style="font-weight:600;">Short Course</span><br/>
              <a href="javascript:();" class="btn" style="margin-top: 10px;background-color: #ffffff;">Coming Soon</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <!-- Main Slider -->
<div class="content-block">
        <!-- Popular Courses -->
        <div class="section-area section-sp1">
                  <div class="container">
             <div class="row">
               <div class="col-lg-6 m-b30">
                <h2 class="title-head ">Learn a new skill online<br> <span class="text-primary"> on your time</span></h2>
                <!--<h4><span class="counter">57,000</span> Online Courses</h4>-->
                <p>Our program offer learning delivery completely online. Online courses offer students the flexibility of studying from anywhere and at any time over the internet</p>
                <!--<a href="#" class="btn button-md">Join Now</a>-->
               </div>
               <div class="col-lg-6">
                 <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 m-b30">
                    <div class="feature-container">
                      <div class="feature-md text-white m-b20">
                        <a href="#" class="icon-cell"><img src="<?=base_url('/');?>assets/images/icon/icon1.png" alt=""></a>
                      </div>
                      <div class="icon-content">
                        <h5 class="ttr-tilte">Register</h5>
                        <p>Choose your programme and register at eCourse CMS</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 m-b30">
                    <div class="feature-container">
                      <div class="feature-md text-white m-b20">
                        <a href="#" class="icon-cell"><img src="<?=base_url('/');?>assets/images/icon/icon2.png" alt=""></a>
                      </div>
                      <div class="icon-content">
                        <h5 class="ttr-tilte">Make Payment</h5>
                        <p>Enrol the selected module at eCourse LMS</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 m-b30">
                    <div class="feature-container">
                      <div class="feature-md text-white m-b20">
                        <a href="#" class="icon-cell"><img src="<?=base_url('/');?>assets/images/icon/icon3.png" alt=""></a>
                      </div>
                      <div class="icon-content">
                        <h5 class="ttr-tilte">Attend</h5>
                        <p>Access your module at eCourse LMS</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 m-b30">
                    <div class="feature-container">
                      <div class="feature-md text-white m-b20">
                        <a href="#" class="icon-cell"><img src="<?=base_url('/');?>assets/images/icon/icon4.png" alt=""></a>
                      </div>
                      <div class="icon-content">
                        <h5 class="ttr-tilte">Certificate</h5>
                        <p>Complete the module and get Certified</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
              </div>

  <!-- Testimonials -->
  <div class="section-area section-sp1 bg-fix ovbl-dark text-white" style="background-image:url(<?=base_url('/');?>assets/images/background/bg1.jpg);">
    <div class="container">
					 <div class="row text-center">
						<div class="col-lg-4 col-md-6 col-sm-6 m-b30">
							<div class="feature-container">
								<div class="feature-md text-white m-b20">
									<i class="fa fa-globe"></i>
								</div>
								<div class="icon-content">
									<h5 class="ttr-tilte">Trusted by Thousands</h5>
									<p>Top 5 University ASEAN</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6 m-b30">
							<div class="feature-container">
								<div class="feature-md text-white m-b20">
									<i class="fa fa-certificate"></i>
								</div>
								<div class="icon-content">
									<h5 class="ttr-tilte">Certification Recognized by MQA</h5>
									<p>The quality of being adequately or well qualified physically and condusive teaching and learning environment</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6 m-b30">
							<div class="feature-container">
								<div class="feature-md text-white m-b20">
									<i class="ti-user"></i>
								</div>
								<div class="icon-content">
									<h5 class="ttr-tilte">Qualified Instructors</h5>
									<p>The most doctorate academic staff</p>
								</div>
							</div>
						</div>
					</div>
				</div>

  </div>
  <!-- Testimonials END -->
  <!-- Testimonials ==== -->
  <div class="section-area section-sp2">
    <div class="container">
      <div class="row">
          <img src="<?=base_url('/');?>assets/img/Ranking2023.png" alt="" width="900" height="283" role="presentation" style="font-size: 14px; margin:auto;" class="img-responsive atto_image_button_text-bottom">
      </div>
    </div>
  </div>
  <!-- Testimonials END ==== -->
    </div>
<!-- contact area END -->
</div>

<?php $this->load->view('templates/layout_footer'); ?>
