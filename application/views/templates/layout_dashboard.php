<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from educhamp.themetrades.com/demo/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:08:15 GMT -->

<head>

  <!-- All PLUGINS CSS ============================================= -->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/dashboard/css/assets.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/dashboard/vendors/calendar/fullcalendar.css">

  <!-- TYPOGRAPHY ============================================= -->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/dashboard/css/typography.css">

  <!-- SHORTCODES ============================================= -->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/dashboard/css/shortcodes/shortcodes.css">

  <!-- STYLESHEETS ============================================= -->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/dashboard/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/dashboard/css/dashboard.css">
  <link class="skin" rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/dashboard/css/color/color-1.css">

  <a href="https://icons8.com/icon/fJG5IDa7km40/computer"></a>

  <style>
    .noti-box-list li a {
      display: inherit!important;
      padding: 10px 15px!important;
      text-decoration: none;
      width: 100%;
    }
    .orders-list ul li, .new-user-list ul li, .noti-box-list ul li {
      margin-bottom: unset;
      padding-right: unset;
      padding-bottom: unset;
    }
    .noti-box-list ul li .notification-time {
      right: 20px!important;
      top: 4px!important;
    }
  </style>
</head>

<body class="ttr-opened-sidebar ttr-pinned-sidebar">

  <!-- header start -->
  <header class="ttr-header">
    <div class="ttr-header-wrapper">
      <!--sidebar menu toggler start -->
      <div class="ttr-toggle-sidebar ttr-material-button">
        <i class="ti-close ttr-open-icon"></i>
        <i class="ti-menu ttr-close-icon"></i>
      </div>
      <!--sidebar menu toggler end -->
      <!--logo start -->
      <div class="ttr-logo-box">
        <div>
          <a href="<?= base_url('urusetia/dash_admin') ?>" class="ttr-logo">
            <img class="ttr-logo-mobile" alt="" src="<?= base_url() ?>/assets/img/CLG.png" width="30" height="30">
            <img class="ttr-logo-desktop" alt="" src="<?= base_url() ?>/assets/img/CLG.png" width="50" height="10">
          </a>
        </div>
      </div>
      <!--logo end -->
      <div class="ttr-header-menu">
        <!-- header left menu start -->
        <ul class="ttr-header-navigation">
          <li>
            <a href="<?= base_url('/') ?>" class="ttr-material-button ttr-submenu-toggle"><!--<i class="fa fa-home fa-lg"></i>-->HOME</a>
          </li>
        </ul>
        <!-- header left menu end -->
      </div>
      <div class="ttr-header-right ttr-with-seperator">
        <!-- header right menu start -->
        <ul class="ttr-header-navigation">
          <li>
            <a href="#" class="ttr-material-button ttr-submenu-toggle"><i class="fa fa-bell"></i><span class="count badge badge-danger radius-xl" style="position: absolute;right: 5px;top: 15px;">0</span></a>
            <div class="ttr-header-submenu noti-menu">
              <div class="ttr-notify-header">
                <!--<span class="ttr-notify-text-top count">Notifications</span>-->
                <span class="ttr-notify-text">Notifications</span>
              </div>
              <div class="noti-box-list" style="padding: unset;">
                <ul class="notification-menu">

                </ul>
              </div>
            </div>
          </li>
          <li>
            <a href="#" class="ttr-material-button ttr-submenu-toggle"><span class="ttr-user-avatar"><img alt="" src="<?= base_url() ?>/assets/images/testimonials/pic3.jpg" width="32" height="32"></span></a>
            <div class="ttr-header-submenu" style="display: block;">
              <ul>
                <li><a href="user-profile.html">My profile</a></li>
              </ul>
            </div>
          </li>
          <li class="ttr-hide-on-mobile">
            <a href="<?= base_url('/auth/keluar'); ?>">Logout</a>
          </li>
        </ul>
        <!-- header right menu end -->
      </div>
      <!--header search panel start -->
      <div class="ttr-search-bar">
        <form class="ttr-search-form">
          <div class="ttr-search-input-wrapper">
            <input type="text" name="qq" placeholder="search something..." class="ttr-search-input">
            <button type="submit" name="search" class="ttr-search-submit"><i class="ti-arrow-right"></i></button>
          </div>
          <span class="ttr-search-close ttr-search-toggle">
            <i class="ti-close"></i>
          </span>
        </form>
      </div>
      <!--header search panel end -->
    </div>
  </header>
  <!-- Left sidebar menu start -->
  <div class="ttr-sidebar">
    <div class="ttr-sidebar-wrapper content-scroll">
      <!-- side menu logo start -->
      <div class="ttr-sidebar-logo">
        <a href="#"><img alt="" src="<?= base_url() ?>/assets/img/UKMSHAPE.png" width="122" height="27"></a>
        <!-- <div class="ttr-sidebar-pin-button" title="Pin/Unpin Menu">
					<i class="material-icons ttr-fixed-icon">gps_fixed</i>
					<i class="material-icons ttr-not-fixed-icon">gps_not_fixed</i>
				</div> -->
        <div class="ttr-sidebar-toggle-button">
          <i class="ti-arrow-left"></i>
        </div>
      </div>
      <!-- side menu logo end -->
      <!-- sidebar menu start -->
      <nav class="ttr-sidebar-navi">
        <ul>
          <li>
            <a href="<?= base_url('urusetia/dash_admin'); ?>" class="ttr-material-button">
              <span class="ttr-icon"><i class="fa fa-home"></i></span>
              <span class="ttr-label">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('urusetia_mc/dash_admin'); ?>" class="ttr-material-button">
              <span class="ttr-icon"><i class="fa fa-desktop"></i></span>
              <span class="ttr-label">Micro-credential</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('urusetia_sp/dash_adminsp'); ?>" class="ttr-material-button">
              <span class="ttr-icon"><i class="fa fa-certificate"></i></span>
              <span class="ttr-label">Professional Certificate</span>
            </a>
          </li>
          <li>
            <a href="courses.html" class="ttr-material-button" style="pointer-events: none">
              <span class="ttr-icon"><i class="fa fa-book"></i></span>
              <span class="ttr-label">Short Courses</span>
            </a>
          </li>


          <li>
            <a href="<?= base_url('custom/dashboard'); ?>" class="ttr-material-button">
              <span class="ttr-icon"><i class="fa fa-cogs"></i></span>
              <span class="ttr-label">Custom Form Application</span>
              <!-- <span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span> -->
            </a>
            <!-- <ul>
              <li>
                <a href="<?= base_url('kewangan/semak_mc'); ?>" class="ttr-material-button"><span class="ttr-label">Micro-credential</span></a>
              </li>
              <li>
                <a href="<?= base_url('kewangan/semak_sp'); ?>" class="ttr-material-button"><span class="ttr-label" style="pointer-events: none">Sijil Profesional</span></a>
              </li>
              <li>
                <a href="<?= base_url('kewangan/semak_kp'); ?>" class="ttr-material-button"><span class="ttr-label" style="pointer-events: none">Kursus Pendek</span></a>
              </li>
            </ul> -->
          </li>

          <li>
            <a href="<?= base_url('user/dashboard'); ?>" class="ttr-material-button">
              <span class="ttr-icon"><i class="fa fa-user"></i></span>
              <span class="ttr-label">User</span>
            </a>
          </li>

          <!-- <li>
            <a href="<?= base_url('urusetia_mc/reg_kursus_induk'); ?>" class="ttr-material-button">
              <span class="ttr-icon"><i class="ti-book"></i></span>
              <span class="ttr-label">Daftar Kursus Induk</span>
            </a>
          </li>

          <li>
            <a href="<?= base_url('urusetia_mc/reg_kursus_unit'); ?>" class="ttr-material-button">
              <span class="ttr-icon"><i class="ti-book"></i></span>
              <span class="ttr-label">Daftar Kursus Unit</span>
            </a>
          </li>

          <li>
            <a href="courses.html" class="ttr-material-button" style="pointer-events: none">
              <span class="ttr-icon"><i class="ti-book"></i></span>
              <span class="ttr-label">Parameter Kursus</span>
            </a>
          </li> -->
          <!-- <li>
            <a href="#" class="ttr-material-button">
              <span class="ttr-icon"><i class="ti-calendar"></i></span>
              <span class="ttr-label">Calendar</span>
              <span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
            </a>
            <ul>
              <li>
                <a href="basic-calendar.html" class="ttr-material-button"><span class="ttr-label">Basic Calendar</span></a>
              </li>
              <li>
                <a href="list-view-calendar.html" class="ttr-material-button"><span class="ttr-label">List View</span></a>
              </li>
            </ul>
          </li>
          <li>
            <a href="bookmark.html" class="ttr-material-button">
              <span class="ttr-icon"><i class="ti-bookmark-alt"></i></span>
              <span class="ttr-label">Bookmarks</span>
            </a>
          </li>
          <li>
            <a href="review.html" class="ttr-material-button">
              <span class="ttr-icon"><i class="ti-comments"></i></span>
              <span class="ttr-label">Review</span>
            </a>
          </li>
          <li>
            <a href="add-listing.html" class="ttr-material-button">
              <span class="ttr-icon"><i class="ti-layout-accordion-list"></i></span>
              <span class="ttr-label">Add listing</span>
            </a>
          </li>
          <li>
            <a href="#" class="ttr-material-button">
              <span class="ttr-icon"><i class="ti-user"></i></span>
              <span class="ttr-label">My Profile</span>
              <span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
            </a>
            <ul>
              <li>
                <a href="user-profile.html" class="ttr-material-button"><span class="ttr-label">User Profile</span></a>
              </li>
              <li>
                <a href="teacher-profile.html" class="ttr-material-button"><span class="ttr-label">Teacher Profile</span></a>
              </li>
            </ul>
          </li> -->
          <li class="ttr-seperate"></li>
        </ul>
        <!-- sidebar menu end -->
      </nav>
      <!-- sidebar menu end -->
    </div>
  </div>
  <!-- Left sidebar menu end -->
