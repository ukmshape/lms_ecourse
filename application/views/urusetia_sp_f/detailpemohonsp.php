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


<!--Main container start -->
<main class="ttr-wrapper">
    <div class="container-fluid">
        <div class="db-breadcrumb">
            <h4 class="breadcrumb-title">Detail Application</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="<?= base_url('urusetia_sp/dash_adminsp') ?>"><i class="fa fa-home"></i>Dashboard</a></li>
                <li><a href="<?= base_url('urusetia_sp/semak_sp') ?>">Application Review</a></li>
                <li>Detail Application</li>
            </ul>
        </div>
        <div class="row">
            <!-- Your Profile Views Chart -->
            <div class="col-lg-12 m-b30">
                <div class="widget-box">
                    <div class="wc-title">
                        <h4>Applicant Details</h4>
                    </div>
                    <div class="widget-inner">
                        <form class="edit-profile m-b30">
                            <div class="row">
                                <div class="col-12">
                                    <div class="ml-auto m-b5">
                                        <h3>1. Applicant Info</h3>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="col-3 m-b5" style="padding-left: 0px;">
                                        <label class="col-form-label">Application Date</label>
                                        <div>
                                            <input class="form-control" type="text" value="" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Full Name</label>
                                    <div>
                                        <input class="form-control" type="text" id="txt_name" name="txt_name" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">IC Number</label>
                                    <div>
                                        <input class="form-control" type="text" id="txt_icno" name=="txt_icno" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Email</label>
                                    <div>
                                        <input class="form-control" type="text" id="txt_email" name="txt_email" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Phone Number</label>
                                    <div>
                                        <input class="form-control" type="text" id="txt_phonenumber" name="txt_phonenumber" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-3">
                                    <label class="col-form-label">Gender</label>
                                    <div>
                                        <input class="form-control" id="txt_gender" name="txt_gender" type="text" value="" disabled>
                                    </div>
                                </div>
                                <div class="seperator"></div>

                                <div class="col-12 m-t20">
                                    <div class="ml-auto m-b5">
                                        <h3>2. Education</h3>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="col-6 m-t5" style="padding-left: 0px;">
                                        <label class="col-form-label">Academic Certificate</label>
                                        <div>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> Filename
                                            </button>
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Academic Certificate</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ...
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-6 m-t20">
                                    <label class="col-form-label">Experience in the Field of Pharmacy</label>
                                    <div>
                                        <input class="form-control" type="text" id="txt_experience" name="txt_experience" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6 m-t20">
                                    <label class="col-form-label">Pharmacy Registration Number</label>
                                    <div>
                                        <input class="form-control" type="text" id="txt_registrationNo" name="txt_registrationNo" value="" disabled>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="col-6 m-t10" style="padding-left: 0px;">
                                        <label class="col-form-label">Pharmacy Certificate</label>
                                        <div>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"> Filename
                                            </button>
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Pharmacy Certificate</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ...
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12 m-t20">
                                    <label class="col-form-label">Other Experience</label>
                                    <div>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="txt_othereexperience" rows="3" value="" disabled></textarea>
                                    </div>
                                </div>
                                <div class="col-12 m-t40">
                                    <div class="ml-auto m-b5">
                                        <h3>3. Working Experience</h3>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Company Name</label>
                                    <div>
                                        <input class="form-control" type="text" id="txt_companyname" name="txt_companyname" value="" disabled>
                                    </div>
                                </div>
                                <div class="col-12 m-t40">
                                    <div class="ml-auto m-b5">
                                        <h3>4. Payment Details</h3>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="col-3 m-b5" style="padding-left: 0px;">
                                        <label class="col-form-label">Payment Date</label>
                                        <div>
                                            <input class="form-control" type="text" id="txt_paymentdate" name="txt_paymentdate" value="" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Sponsorship</label>
                                    <div>
                                        <input class="form-control" type="text" id="txt_sponsor" name="txt_sponsor" value="" disabled>
                                    </div>
                                </div><br><br><br><br>

                                <div class="form-group col-12">
                                  <table id="tbl_list" class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th style="font-weight: 500; text-align:center;">FIRST PAYMENT</th>
                                        <th style="font-weight: 500; text-align:center;">SECOND PAYMENT</th>
                                        <th style="font-weight: 500; text-align:center;">THIRD PAYMENT</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td style="font-weight: 500; text-align:center;"><input class="form-control" type="text" id="txt_firstpay" name="txt_firstpay" style="font-weight: 500; text-align:center;" value="0" disabled></td>
                                        <td style="font-weight: 500; text-align:center;"><input class="form-control" type="text" id="txt_secondpay" name="txt_secondpay" style="font-weight: 500; text-align:center;" value="0" disabled></td>
                                        <td style="font-weight: 500; text-align:center;"><input class="form-control" type="text" id="txt_thirdpay" name="txt_thirdpay" style="font-weight: 500; text-align:center;" value="0" disabled></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" style="font-weight: 500; text-align:right;">TOTAL PROGRAM PAYMENT</td>
                                        <td style="text-align:center;"><input class="form-control" type="text" id="txt_totalProgram" name="txt_totalProgram" style="font-weight: 500; text-align:center;" value="0" readonly></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" style="font-weight: 500; text-align:right;">CURRENT PAYMENT</td>
                                        <td style="text-align:center;"><input class="form-control" type="text" id="txt_currentpayment" name="txt_currentpayment" style="font-weight: 500; text-align:center;" value="0" readonly></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" style="font-weight: 500; text-align:right;">BALANCE PAYMENT</td>
                                        <td style="text-align:center;"><input class="form-control" type="text" id="txt_balancepayment" name="txt_balancepayment" style="font-weight: 500; text-align:center;" value="0" readonly></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>

                                <div class="col-12 m-t30" align="right">
                                    <a name="button_back" href="<?php echo base_url('/urusetia_sp/semak_sp/'); ?>" class="btn bg-gradient-success" title="Action"> Back</a>
                                    <button type="Submit" class="btn btn-primary btn-sm" name="btn_updatepayment" value="btn_updatepayment" > Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Your Profile Views Chart END-->
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
<script>
    // Pricing add
    function newMenuItem() {
        var newElem = $('tr.list-item').first().clone();
        newElem.find('input').val('');
        newElem.appendTo('table#item-add');
    }
    if ($("table#item-add").is('*')) {
        $('.add-item').on('click', function(e) {
            e.preventDefault();
            newMenuItem();
        });
        $(document).on("click", "#item-add .delete", function(e) {
            e.preventDefault();
            $(this).parent().parent().parent().parent().remove();
        });
    }
</script>
<script>
    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function() {
        myInput.focus()
    })
</script>
</body>

<!-- Mirrored from educhamp.themetrades.com/demo/admin/add-listing.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:09:05 GMT -->

</html>
