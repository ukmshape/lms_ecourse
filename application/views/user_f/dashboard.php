<?php $this->load->view('templates/layout_dashboard.php');  ?>

<?php

$session_ukmper = $this->session->userdata('session_ukmper');
//$data_peribadi = $this->auth_m->get_data_peribadi($session_ukmper['ukmper']);
//$this->template->set('data_peribadi', $data_peribadi);
//dbug($arr['ukmper']);die();

$nama = $session_ukmper['fullname'];

/*if (!empty($data_peribadi)) {

    $nama = $data_peribadi[0]->nama;
}*/
?>

<style>
    .circle-icon {
        /* background: #4c1864; */
        background-image: linear-gradient(90deg, rgba(76, 24, 100, 1) 32%, rgba(63, 24, 154, 1) 90%);
        padding: 30px;
        border-radius: 50%;
    }

    .fa-scolor {
        text-shadow: 3px 3px rgba(175, 175, 175, 1);
    }

    .fa-icolor {
        color: rgba(224, 19, 19, 1);
    }
</style>

<!--Main container start -->
<main class="ttr-wrapper">
    <div class="container-fluid">
        <div class="db-breadcrumb">
            <h4 class="breadcrumb-title">Dashboard</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="#"><i class="fa fa-home"></i>Home</a></li>
                <li>Dashboard</li>
            </ul>
        </div>
        <!-- Your Profile Views Chart -->
        <div class="row">
            <div class="col-lg-12 m-b30">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?= base_url() ?>/assets/img/spbanner.png" alt="..." style="width: 100%; height: 250px !important; border-radius: 10px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-lg-12 m-b30">
                <div class="widget-box shadow" style="height:200px; background-image:url(<-?= base_url() ?>/assets/img/banner.png);">
                    <div class=" widget-inner">
                        <h3 style="text-shadow: 2px 2px 5px #ED1C24">Welcome Back, <-?= $nama; ?></h3>
                    </div>
                </div>
            </div>
        </div> -->
        <?php /*
        <!-- Card -->

        <div class="row">
            <div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                <div class="widget-card widget-bg1">
                    <div class="wc-item">
                        <h4 class="wc-title">
                            Jumlah Kursus <br> &nbsp;
                        </h4>
                        <span class="wc-des">
                            &nbsp;
                        </span>
                        <span class="wc-stats">
                            <span class="counter">18</span>
                        </span>
                        <span class="wc-des">
                            &nbsp;
                        </span>
                        <span class="wc-progress-bx">
                            <span class="wc-change">
                                &nbsp;
                            </span>
                            <span class="wc-number ml-auto">
                                &nbsp;
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                <div class="widget-card widget-bg2">
                    <div class="wc-item">
                        <h4 class="wc-title">
                            Jumlah Permohonan <br> &nbsp;
                        </h4>
                        <span class="wc-des">
                            &nbsp;
                        </span>
                        <span class="wc-stats counter">
                            300
                        </span>
                        <span class="wc-des">
                            &nbsp;
                        </span>
                        <span class="wc-progress-bx">
                            <span class="wc-change">
                                &nbsp;
                            </span>
                            <span class="wc-number ml-auto">
                                &nbsp;
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                <div class="widget-card widget-bg3">
                    <div class="wc-item">
                        <h4 class="wc-title">
                            Jumlah Pelajar <br> Mendaftar
                        </h4>
                        <span class="wc-des">
                            &nbsp;
                        </span>
                        <span class="wc-stats counter">
                            772
                        </span>
                        <span class="wc-des">
                            &nbsp;
                        </span>
                        <span class="wc-progress-bx">
                            <span class="wc-change">
                                &nbsp;
                            </span>
                            <span class="wc-number ml-auto">
                                &nbsp;
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                <div class="widget-card widget-bg4">
                    <div class="wc-item">
                        <h4 class="wc-title">
                            Jumlah Pelajar <br> Yang Selesai
                        </h4>
                        <span class="wc-des">
                            &nbsp;
                        </span>
                        <span class="wc-stats counter">
                            350
                        </span>
                        <span class="wc-des">
                            &nbsp;
                        </span>
                        <span class="wc-progress-bx">
                            <span class="wc-change">
                                &nbsp;
                            </span>
                            <span class="wc-number ml-auto">
                                &nbsp;
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card END -->
        */ ?>
        <div class="row">
            <!-- Your Profile Views Chart END-->
            <div class="col-lg-12 m-b30">
                <div class="widget-box shadow">
                    <div class="wc-title">
                        <h4><i class="fas fa-search"></i> Quick Menu</h4>
                    </div>
                    <div class="widget-inner">

                        <div class="row text-center">
                          <div class="col-lg-6 col-md-6 mt-3">
                            <a href="<?= base_url('user/list_user') ?>">
                                <div class="card shadow" style="border-radius: 10px;">
                                    <div class="card-body"><i class="fas fa-user-circle fa-2xl fa-icolor fa-scolor"></i><br><br>User List</div>
                                </div>
                            </a>
                          </div>
                          <div class="col-lg-6 col-md-6 mt-3">
                            <a href="<?= base_url('user/role_list') ?>">
                                <div class="card shadow" style="border-radius: 10px; pointer-events: none;">
                                    <div class="card-body"><i class="fas fa-sitemap fa-2xl fa-icolor fa-scolor"></i><br><br>Assign Roles</div>
                                </div>
                            </a>
                          </div>
                          <div class="col-lg-6 col-md-6 mt-3">
                            <a href="<?= base_url('user/categories_list') ?>">
                                <div class="card shadow" style="border-radius: 10px; pointer-events: none;">
                                    <div class="card-body"><i class="fas fa-list fa-2xl fa-icolor fa-scolor"></i><br><br>Categories List</div>
                                </div>
                            </a>
                          </div>
                        </div>

                        <!--<div class="row text-center mt-3">
                          <div class="col-6 m-auto">
                            <a href="<?= base_url('urusetia_sp/semak_inv') ?>">
                                <div class="card shadow" style="border-radius: 10px; pointer-events: none;">
                                    <div class="card-body"><i class="fas fa-receipt fa-2xl fa-icolor fa-scolor"></i><br><br>Payment History</div>
                                </div>
                            </a>
                          </div>
                        </div>-->

                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-6 m-b30">
                <div class="widget-box">
                    <div class="wc-title">
                        <h4>Senarai Kursus</h4>
                    </div>
                    <div class="widget-inner">
                        <div class="new-user-list">
                            <ul>
                                <li>
                                    <span class="new-users-pic">
                                        <img src="<?= base_url() ?>/assets/images/testimonials/pic1.jpg" alt="" />
                                    </span>
                                    <span class="new-users-text">
                                        <a href="#" class="new-users-name">Anna Strong </a>
                                        <span class="new-users-info">Visual Designer,Google Inc </span>
                                    </span>
                                    <span class="new-users-btn">
                                        <a href="#" class="btn button-sm outline">Follow</a>
                                    </span>
                                </li>
                                <li>
                                    <span class="new-users-pic">
                                        <img src="<?= base_url() ?>/assets/images/testimonials/pic2.jpg" alt="" />
                                    </span>
                                    <span class="new-users-text">
                                        <a href="#" class="new-users-name"> Milano Esco </a>
                                        <span class="new-users-info">Product Designer, Apple Inc </span>
                                    </span>
                                    <span class="new-users-btn">
                                        <a href="#" class="btn button-sm outline">Follow</a>
                                    </span>
                                </li>
                                <li>
                                    <span class="new-users-pic">
                                        <img src="<?= base_url() ?>/assets/images/testimonials/pic1.jpg" alt="" />
                                    </span>
                                    <span class="new-users-text">
                                        <a href="#" class="new-users-name">Nick Bold </a>
                                        <span class="new-users-info">Web Developer, Facebook Inc </span>
                                    </span>
                                    <span class="new-users-btn">
                                        <a href="#" class="btn button-sm outline">Follow</a>
                                    </span>
                                </li>
                                <li>
                                    <span class="new-users-pic">
                                        <img src="<?= base_url() ?>/assets/images/testimonials/pic2.jpg" alt="" />
                                    </span>
                                    <span class="new-users-text">
                                        <a href="#" class="new-users-name">Wiltor Delton </a>
                                        <span class="new-users-info">Project Manager, Amazon Inc </span>
                                    </span>
                                    <span class="new-users-btn">
                                        <a href="#" class="btn button-sm outline">Follow</a>
                                    </span>
                                </li>
                                <li>
                                    <span class="new-users-pic">
                                        <img src="<?= base_url() ?>/assets/images/testimonials/pic3.jpg" alt="" />
                                    </span>
                                    <span class="new-users-text">
                                        <a href="#" class="new-users-name">Nick Stone </a>
                                        <span class="new-users-info">Project Manager, Amazon Inc </span>
                                    </span>
                                    <span class="new-users-btn">
                                        <a href="#" class="btn button-sm outline">Follow</a>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-lg-6 m-b30">
                    <div class="widget-box">
                        <div class="wc-title">
                            <h4>Orders</h4>
                        </div>
                        <div class="widget-inner">
                            <div class="orders-list">
                                <ul>
                                    <li>
                                        <span class="orders-title">
                                            <a href="#" class="orders-title-name">Anna Strong </a>
                                            <span class="orders-info">Order #02357 | Date 12/08/2019</span>
                                        </span>
                                        <span class="orders-btn">
                                            <a href="#" class="btn button-sm red">Unpaid</a>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="orders-title">
                                            <a href="#" class="orders-title-name">Revenue</a>
                                            <span class="orders-info">Order #02357 | Date 12/08/2019</span>
                                        </span>
                                        <span class="orders-btn">
                                            <a href="#" class="btn button-sm red">Unpaid</a>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="orders-title">
                                            <a href="#" class="orders-title-name">Anna Strong </a>
                                            <span class="orders-info">Order #02357 | Date 12/08/2019</span>
                                        </span>
                                        <span class="orders-btn">
                                            <a href="#" class="btn button-sm green">Paid</a>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="orders-title">
                                            <a href="#" class="orders-title-name">Revenue</a>
                                            <span class="orders-info">Order #02357 | Date 12/08/2019</span>
                                        </span>
                                        <span class="orders-btn">
                                            <a href="#" class="btn button-sm green">Paid</a>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="orders-title">
                                            <a href="#" class="orders-title-name">Anna Strong </a>
                                            <span class="orders-info">Order #02357 | Date 12/08/2019</span>
                                        </span>
                                        <span class="orders-btn">
                                            <a href="#" class="btn button-sm green">Paid</a>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 m-b30">
                    <div class="widget-box">
                        <div class="wc-title">
                            <h4>Basic Calendar</h4>
                        </div>
                        <div class="widget-inner">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div> -->
        </div>
    </div>
</main>
<div class="ttr-overlay"></div>

<!-- External JavaScripts -->
<script src='<?php echo base_url('/'); ?>/assets/dashboard/js/jquery.min.js'></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/bootstrap/js/popper.min.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/magnific-popup/magnific-popup.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/counter/waypoints-min.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/counter/counterup.min.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/imagesloaded/imagesloaded.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/masonry/masonry.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/masonry/filter.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/owl-carousel/owl.carousel.js"></script>
<script src='<?php echo base_url('/'); ?>/assets/dashboard/vendors/scroll/scrollbar.min.js'></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/js/functions.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/chart/chart.min.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/js/admin.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/calendar/moment.min.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/switcher/switcher.js"></script>
<script src="https://kit.fontawesome.com/cfecd9e590.js" crossorigin="anonymous"></script>


</body>

<!-- Mirrored from educhamp.themetrades.com/demo/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:09:05 GMT -->

</html>
