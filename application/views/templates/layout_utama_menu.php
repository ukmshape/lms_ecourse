<style>
  .btn-link:hover {
    text-decoration: none;
  }
</style>
<?php  ?>
<!-- Header Top ==== -->
  <header class="header rs-nav">
  <div class="top-bar">
    <div class="container">
      <div class="row d-flex justify-content-between">
        <div class="topbar-left">
          <ul>
            <li><a href="https://www.ukm.my/ukmshape/"><img src="<?=base_url('/');?>assets/img/UKMSHAPE.png" width="195" alt=""></a></li>
            <li><a href="https://www.ukm.my/ukmshape/"><img src="<?=base_url('/');?>assets/img/logo.png" width="100" alt=""></a></li>
          </ul>
          <!--<a href="<?=base_url('/main/test');?>">&nbsp;</a>-->
        </div>
        <div class="topbar-right">
          <ul>
            <li>
              <select class="header-lang-bx">
                <option data-icon="flag flag-uk">English</option>
                <!--<option data-icon="flag flag-ms">Bahasa Melayu</option>-->
              </select>
            </li>
            <!-- <li><a href="<?=base_url('/main/signin');?>">Login</a></li>
            <li><a href="<?=base_url('/main/signup');?>">Register</a></li> -->
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="sticky-header navbar-expand-lg">
          <div class="menu-bar clearfix">
              <div class="container clearfix">
        <!-- Header Logo ==== -->
        <div class="menu-logo">
          <a href="<?= base_url('/'); ?>"><img src="<?= base_url('/'); ?>assets/img/CLG.png" alt=""></a>
        </div>
        <!-- Mobile Nav Button ==== -->
                  <button class="navbar-toggler collapsed menuicon justify-content-end" type="button" data-toggle="collapse" data-target="#menuDropdown" aria-controls="menuDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <!-- Author Nav ==== -->
                  <div class="secondary-menu">
                      <div class="secondary-inner">
                          <ul class="nav navbar-nav">
                            <?php if(!$this->session->userdata('session_student') && !$this->session->userdata('session_ukmper')) { ?> <?php //if(!$this->session->userdata('session_student')) { ?>
                              <li><a class="btn-link" href="<?=base_url('/main/signin');?>">Login</a></li>
                              <li class="search-btn"><a class="btn-link" href="<?=base_url('/main/signup');?>">Register</a></li>
                            <?php } elseif($this->session->userdata('session_ukmper')) { ?>
                              <li><a class="btn-link" href="<?=base_url('/urusetia/dash_admin');?>"><i class="fa fa-chevron-right"></i> <?=$this->session->userdata('session_ukmper')['fullname']; ?></a></li>
                            <?php } else { ?>
                              <li><a class="btn-link" href="<?=base_url('/student/profile');?>"><i class="fa fa-chevron-right"></i> <?=$this->session->userdata('session_student')['nama']; ?></a></li>
                            <?php } ?>
              <!-- Search Button ==== -->
              <li class="search-btn">
                <button type="button" class="btn-link">
                  <a href="<?php if($this->session->userdata('session_student')) { echo base_url('/carts'); } else { echo base_url('/main/signin'); }?>">
                  <i class="ti-shopping-cart"></i>
                  <?php
                    if($this->session->userdata('session_student')) {
                        echo '('.$this->session->userdata('session_student')['carttotal'].')';
                    } else {
                      echo '(0)';
                    }
                  ?>
                </a></button>
              </li>
            </ul>
          </div>
                  </div>
        <!-- Search Box ==== -->
                <div class="nav-search-bar">
                      <form action="#">
                          <input name="search" value="" type="text" class="form-control" placeholder="Type to search">
                          <span><i class="ti-search"></i></span>
                      </form>
                  <span id="search-remove"><i class="ti-close"></i></span>
                </div>
        <!-- Navigation Menu ==== -->
                  <div class="menu-links navbar-collapse collapse justify-content-start" id="menuDropdown">
          <div class="menu-logo">
            <a href="<?=base_url('/');?>"><img src="assets/images/logo.png" alt=""></a>
          </div>
                      <ul class="nav navbar-nav">
            <li class="active"><a href="<?=base_url('/');?>"><i class="ti-home" style="font-size: 14px;margin-right: 3px;"></i> Home</a></li>
            <!--<li><a href="javascript:;">Category</a></li>-->
            <li><a href="javascript:;">Programme <i class="fa fa-chevron-down"></i></a>
                <ul class="sub-menu">
                  <li><a href="javascript:;">Micro-Credential <i class="fa fa-angle-right"></i></a>
										<ul class="sub-menu">
											<!--<li><a href="javascript:;">Info</a></li>-->
											<li><a href="<?=base_url('/MC');?>">Programme Offered</a></li>
										</ul>
									</li>
                  <?php /*  MENU SP  */ ?>
                  <li><a href="javascript:;">Professional Certificate <i class="fa fa-angle-right"></i></a>
										<ul class="sub-menu">
											<!--<li><a href="javascript:;">Info</a></li>-->
											<li><a href="<?=base_url('/SP');?>">Programme Offered</a></li>
										</ul>
									</li>
                  <?php /*
                  <!--<li><a href="javascript:;">Short Course <i class="fa fa-angle-right"></i></a>
										<ul class="sub-menu">
											<li><a href="javascript:;">Info</a></li>
											<li><a href="javascript:;">Programme Offered</a></li>
										</ul>
									</li>--> */ ?>
                </ul>
            </li>
            <!--<li><a href="<?=base_url('/main/faqs');?>">FAQS </a></li>-->

            <!-- <li><a href="javascript:;">About Us <i class="fa fa-chevron-down"></i></a>
              <ul class="sub-menu">
                <li><a href="<?=base_url('/main/contactUs');?>">Contact Us</a></li>
                <li><a href="<?=base_url('/main/faqs');?>">FAQ's</a></li>
              </ul>
            </li> -->
          </ul>
                  </div>
        <!-- Navigation Menu END ==== -->
              </div>
          </div>
      </div>
  </header>
  <!-- Header Top END ==== -->
