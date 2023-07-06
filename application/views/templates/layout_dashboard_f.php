<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from educhamp.themetrades.com/demo/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:08:15 GMT -->

<head>

  <!-- META ============================================= -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keywords" content="" />
  <meta name="author" content="" />
  <meta name="robots" content="" />

  <!-- DESCRIPTION -->
  <meta name="description" content="EduChamp : Education HTML Template" />

  <!-- OG -->
  <meta property="og:title" content="EduChamp : Education HTML Template" />
  <meta property="og:description" content="EduChamp : Education HTML Template" />
  <meta property="og:image" content="" />
  <meta name="format-detection" content="telephone=no">

  <!-- FAVICONS ICON ============================================= -->
  <link rel="icon" href="<?= base_url() ?>/error-404.html" type="image/x-icon" />
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>/assets/images/favicon.png" />

  <!-- PAGE TITLE HERE ============================================= -->
  <title>ECourse System </title>

  <!-- MOBILE SPECIFIC ============================================= -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--[if lt IE 9]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->

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
  <link class="skin" rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/vendors/bootstrap-select/bootstrap-select.min.css">


  <a href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <a href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">

  <a href="https://icons8.com/icon/fJG5IDa7km40/computer"></a>



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
          <a href="<?= base_url('Admin/dash_admin') ?>" class="ttr-logo">
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
            <a href="<?= base_url('fakulti/dash_fakulti') ?>" class="ttr-material-button ttr-submenu-toggle">HOME</a>
          </li>
        </ul>
        <!-- header left menu end -->
      </div>
      <div class="ttr-header-right ttr-with-seperator">
        <!-- header right menu start -->
        <ul class="ttr-header-navigation">
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
            <a href="<?= base_url('fakulti/dash_fakulti'); ?>" class="ttr-material-button">
              <span class="ttr-icon"><i class="ti-book"></i></span>
              <span class="ttr-label">Professional Certificate</span>
            </a>
          </li>
          <li class="ttr-seperate"></li>
        </ul>
        <!-- sidebar menu end -->
      </nav>
      <!-- sidebar menu end -->
    </div>
  </div>
  <!-- Left sidebar menu end -->
