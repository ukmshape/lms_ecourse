<link rel="stylesheet" type="text/css" href="<?=base_url();?>/assets/vendors/bootstrap/css/bootstrap_card.css">


<?php $this->load->view('templates/layout_utama_menu'); ?>

<link rel="stylesheet" type="text/css" href="<?=base_url('/');?>assets/dashboard/css/dashboard.css">

<!-- Content -->
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="page-banner ovbl-dark" style="background-image:url(<?=base_url('/');?>assets/images/banner/banner1.jpg);">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white">Profile</h1>
            </div>
        </div>
    </div>

</div>

<!-- Breadcrumb row -->
<div class="breadcrumb-row">
  <div class="container">
    <ul class="list-inline">
      <li><a href="#">Home</a></li>
      <li>Profile</li>
    </ul>
  </div>
</div>
<!-- Breadcrumb row END -->
    <!-- inner page banner END -->

<?php //dbug($this->session->flashdata('mesej')); ?>
<?php if ($this->session->flashdata('mesej')) { ?>
  <div class="<?php echo $this->session->flashdata('mesej_css'); ?>" role="alert" id="mesej-alert" style="font-family: unset;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <center><?php echo $this->session->flashdata('mesej'); ?></center>
  </div>

<?php } ?>

<div class="content-block">
        <!-- About Us -->
  <div class="section-area section-sp1">
            <div class="container" style="max-width: 1500px;">
       <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-12 m-b30">
          <div class="profile-bx text-center">
            <div class="user-profile-thumb">
              <!-- src image -->
              <?php
              if($userdata[0]->gambar != NULL) {
                //dbug(STORAGEPATH);
                $src_image = STORAGEPATH.$session_nokp.'/'.$userdata[0]->gambar;
              } else {
                $src_image = base_url().'/assets/images/profile/profile.png';
              }
              ?>

              <img src="<?=$src_image?>" alt=""/>
            </div>
            <div class="profile-info">
              <h4><?php echo $semakdata_student->nama; ?></h4>
              <p><?php echo $semakdata_student->nokp; ?></p>
              <!--<span>mark.example@info.com</span>-->
            </div>
            <div class="profile-tabnav">
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="javascript:;"><i class="ti-folder"></i>My Profile <i class="fa fa-chevron-down"></i></a>

                  <li class="nav-item ml-4 <?php echo $tab7; ?>">
                    <a class="nav-link <?php echo $tab7; ?>" data-toggle="tab" href="#photo"><i class="ti-camera"></i>Change Photo</a>
                  </li>

                  <li class="nav-item ml-4 <?php echo $tab1; ?>">
                    <a class="nav-link <?php echo $tab1; ?>" data-toggle="tab" href="#profile"><i class="ti-user"></i>Profile Details</a>
                  </li>

                  <li class="nav-item ml-4 <?php echo $tab2; ?>">
                    <a class="nav-link <?php echo $tab2; ?>" data-toggle="tab" href="#change-password"><i class="ti-lock"></i>Change Password</a>
                  </li>

                </li>

                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="javascript:;"><i class="ti-folder"></i>My Courses <i class="fa fa-chevron-down"></i></a>

                  <li class="nav-item ml-4 <?php echo $tab3; ?>">
                    <a class="nav-link <-?php echo $tab3; ?>" data-toggle="tab" href="#courseslist"><i class="ti-book"></i>Course List</a>
                    <!-- <a class="nav-link <-?php echo $tab3; ?>" data-toggle="tab" href="<-?= base_url('student/course_list/E12345678'); ?>"><i class="ti-book"></i>Course List</a> -->
                  </li>
                  <?php /*
                  <li class="nav-item ml-4 <?php echo $tab4; ?>">
                    <a class="nav-link <?php echo $tab4; ?>" data-toggle="tab" href="#orders"><i class="ti-shopping-cart-full"></i>Course Status</a>
                  </li>*/ ?>

                  <li class="nav-item ml-4 <?php echo $tab4; ?>">
                    <a class="nav-link <?php echo $tab4; ?>" data-toggle="tab" href="#certificate"><i class="ti-medall"></i>Certificate</a>
                  </li>
                </li>


                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="javascript:;"><i class="ti-folder"></i>My Purchases <i class="fa fa-chevron-down"></i></a>

                  <li class="nav-item ml-4 <?php echo $tab6; ?>">
                    <a class="nav-link <?php echo $tab6; ?>" data-toggle="tab" href="#bill"><i class="ti-bookmark-alt"></i>My Bills</a>
                  </li>

                  <li class="nav-item ml-4 <?php echo $tab5; ?>">
                    <a class="nav-link <?php echo $tab5; ?>" data-toggle="tab" href="#history"><i class="ti-bookmark-alt"></i>History Purchase</a>
                  </li>


                </li>

                <li class="nav-item">
                  <a class="nav-link" href="<?=base_url('/');?>main/signout"><i class="fa fa-sign-out"></i>Logout</a>
                </li>

              </ul>

            </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 m-b30">
          <div class="profile-content-bx">
            <div class="tab-content">

              <div class="<?php echo $tab_pane7; ?>" id="photo">
                <?php $this->load->view('student_f/photo_tab.php');  ?>
              </div>

              <div class="<?php echo $tab_pane1; ?>" id="profile">
                <?php $this->load->view('student_f/profile_tab.php');  ?>
              </div>

              <div class="<?php echo $tab_pane2; ?>" id="change-password">
                <?php $this->load->view('student_f/change_pswd_tab.php');  ?>
              </div>

              <div class="<?php echo $tab_pane3; ?>" id="courseslist">
                <?php $this->load->view('student_f/course_list_tab.php');  ?>
              </div>

              <div class="<?php echo $tab_pane4; ?>" id="certificate">
                <?php $this->load->view('student_f/certificate_tab.php');  ?>
              </div>

              <div class="<?php echo $tab_pane5; ?>" id="history">
                <?php $this->load->view('student_f/historypurchase_tab.php');  ?>
              </div>

              <div class="<?php echo $tab_pane6; ?>" id="bill">
                <?php $this->load->view('student_f/bill_tab.php');  ?>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
        </div>
    </div>
<!-- contact area END -->
</div>
