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
    #circle1 {
        width: 100px;
        height: 100px;
        border-radius: 50px;
        /* specify the radius */
    }
</style>

<!--Main container start -->
<main class="ttr-wrapper">
    <div class="container-fluid">
        <div class="db-breadcrumb">
            <h4 class="breadcrumb-title">MC Secretariat</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="#"><i class="fa fa-home"></i>Secretariat</a></li>
                <li>Course Parameter Registration</li>
            </ul>
        </div>
        <!-- Your Profile Views Chart -->
        <div class="row">
            <div class="col-lg-12 m-b30">
                <h4><b>Course Parameter Registration</b></h4>
            </div>
        </div>
        <!-- Card -->
        <div class="row">
            <div class="col-md-12">
                <div class="widget-card widget-bg1">

                    <!-- wina -->
                   <div class="m-4">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label col-form-label">Parameter Id.</label>
                            <div class="col-sm-5">
                                <input type="email" class="form-control form-control" placeholder="Parameter Id.">
                            </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Course Code</label>
                            <div class="col-sm-5">
                                <input type="email" class="form-control" placeholder="Course Code">
                            </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Start Date</label>
                            <div class="col-sm-5">
                                <!--<input type="email" class="form-control"placeholder="Start Date"> -->
                                <input id="startDate" class="form-control" type="date" />
                            </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">End Date</label>
                            <div class="col-sm-5">
                                <!--<input type="email" class="form-control"placeholder="End Date"> -->
                                <input id="startDate" class="form-control" type="date" />
                            </div> 
                           
                            
                    </div>

                    <!--<div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-5">
                                <input type="email" class="form-control"placeholder="Status">
                            </div>
                    </div>-->
                      <!--<div class="dropdown"> --> 
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-2">



                                    <select class="select form-control" id="select" name="select">
                                        <option value="T">
                                                Tawar
                                        </option>
                                        <option value="X">
                                                Tidak Tawar
                                        </option>
                                    </select> 


                                </div> 
                        </div>   
                        
                    </div> 


                        <!-- wina -->                  
                        
                             <div class="text-center mb-3">
                                <a href="#" class="btn btn-primary">Save</a>
                             </div>
                           
                   
                    </div>
                    <!-- wina --> 
                       
                </div>
            </div>
            
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