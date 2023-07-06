<?php $this->load->view('templates/layout_dashboard.php');  ?>

<?php

$session_ukmper = $this->session->userdata('session_ukmper');
$data_peribadi = $this->auth_m->get_data_peribadi($session_ukmper['ukmper']);
$this->template->set('data_peribadi', $data_peribadi);
//dbug($arr['ukmper']);die();

if (!empty($data_peribadi)) {

    $nama = $data_peribadi[0]->nama;
}
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

    /* 191,
    17,
    17,
    1 */
</style>

<!--Main container start -->
<main class="ttr-wrapper">
    <div class="container-fluid">
        <div class="db-breadcrumb">
            <h4 class="breadcrumb-title">Dashboard</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="<?= base_url('urusetia/dash_admin') ?>"><i class="fa fa-home"></i>Home</a></li>
                <li>Dashboard Custom Form Appilcation</li>
            </ul>
        </div>
        <!-- Your Profile Views Chart -->
        <!-- <div class="row">
            <div class="col-lg-12 m-b30">
                <div class="widget-box shadow" style="height:200px; background-image:url(<?= base_url() ?>/assets/img/acc-bg2.jpg); background-size:none; ">
                    <div class=" widget-inner">
                        <h3 style="text-shadow: 2px 2px 5px #ED1C24">FINANCE DEPARTMENT</h3>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="row">
            <div class="col-lg-12 m-b30">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?= base_url() ?>/assets/img/customformapplication.png" alt="..." style="width: 100%; height: 250px !important; border-radius: 10px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card -->

        <!-- <div class="row">
            <div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                <div class="widget-card widget-bg1 shadow">
                    <div class="wc-item">
                        <h4 class="wc-title">
                            Total <br>Application
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
                <div class="widget-card shadow" style="background: linear-gradient(90deg, rgba(92,217,60,1) 32%,  rgba(5,179,33,1) 93%);">
                    <div class="wc-item">
                        <h4 class="wc-title">
                            Total Student <br>Completed
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
                <div class="widget-card widget-bg3 shadow">
                    <div class="wc-item">
                        <h4 class="wc-title">
                            Total Student <br>Incompleted
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
                <div class="widget-card widget-bg4 shadow">
                    <div class="wc-item">
                        <h4 class="wc-title">
                            Total Courses <br> &nbsp;
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
        </div> -->

        <!-- Card END -->
        <div class="row">
            <!-- Your Profile Views Chart END-->
            <div class="col-lg-12 m-b30">
                <div class="widget-box">
                    <div class="wc-title">
                        <h4><i class="fas fa-search"></i> Quick Menu </h4>
                    </div>
                    <div class="widget-inner">
                        <table border="0">
                            <tr align="center">
                                <td style="width:50%;">
                                    <a href="<?= base_url('kewangan/semakkew_mc') ?>">
                                        <div class="card shadow" style="border-radius: 10px;">
                                            <div class="card-body"><i class="fas fa-list-alt fa-2xl fa-icolor fa-scolor"></i><br><br>Application Information</div>
                                        </div>
                                    </a>
                                </td>
                                <td style="width:50%;">
                                    <a href="<?= base_url('urusetia/semak_kp') ?>">
                                        <div class="card shadow" style="border-radius: 10px; ">
                                            <div class="card-body"><i class="fas fa-receipt fa-2xl fa-icolor fa-scolor"></i><br><br>Generate Receipt</div>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                        </table>
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
<script src='/assets/dashboard/js/jquery.min.js'></script>
<script src="/assets/dashboard/vendors/bootstrap/js/popper.min.js"></script>
<script src="/assets/dashboard/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/dashboard/vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="/assets/dashboard/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="/assets/dashboard/vendors/magnific-popup/magnific-popup.js"></script>
<script src="/assets/dashboard/vendors/counter/waypoints-min.js"></script>
<script src="/assets/dashboard/vendors/counter/counterup.min.js"></script>
<script src="/assets/dashboard/vendors/imagesloaded/imagesloaded.js"></script>
<script src="/assets/dashboard/vendors/masonry/masonry.js"></script>
<script src="/assets/dashboard/vendors/masonry/filter.js"></script>
<script src="/assets/dashboard/vendors/owl-carousel/owl.carousel.js"></script>
<script src='/assets/dashboard/vendors/scroll/scrollbar.min.js'></script>
<script src="/assets/dashboard/js/functions.js"></script>
<script src="/assets/dashboard/vendors/chart/chart.min.js"></script>
<script src="/assets/dashboard/js/admin.js"></script>
<script src="/assets/dashboard/vendors/calendar/moment.min.js"></script>
<script src="/assets/dashboard/vendors/calendar/fullcalendar.js"></script>
<script src="/assets/dashboard/vendors/switcher/switcher.js"></script>
<script src="https://kit.fontawesome.com/cfecd9e590.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            defaultDate: '2019-03-12',
            navLinks: true, // can click day/week names to navigate views

            weekNumbers: true,
            weekNumbersWithinDays: true,
            weekNumberCalculation: 'ISO',

            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [{
                    title: 'All Day Event',
                    start: '2019-03-01'
                },
                {
                    title: 'Long Event',
                    start: '2019-03-07',
                    end: '2019-03-10'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2019-03-09T16:00:00'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2019-03-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: '2019-03-11',
                    end: '2019-03-13'
                },
                {
                    title: 'Meeting',
                    start: '2019-03-12T10:30:00',
                    end: '2019-03-12T12:30:00'
                },
                {
                    title: 'Lunch',
                    start: '2019-03-12T12:00:00'
                },
                {
                    title: 'Meeting',
                    start: '2019-03-12T14:30:00'
                },
                {
                    title: 'Happy Hour',
                    start: '2019-03-12T17:30:00'
                },
                {
                    title: 'Dinner',
                    start: '2019-03-12T20:00:00'
                },
                {
                    title: 'Birthday Party',
                    start: '2019-03-13T07:00:00'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2019-03-28'
                }
            ]
        });

    });
</script>

</body>

<!-- Mirrored from educhamp.themetrades.com/demo/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:09:05 GMT -->

</html>