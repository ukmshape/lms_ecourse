<?php $this->load->view('templates/layout_dashboard.php');  ?>
<title>eCOURSE</title>
<link rel="stylesheet" type="text/css" href="<?=base_url('/');?>assets/dashboard/css/assets.css">
<link rel="stylesheet" type="text/css" href="<?=base_url('/');?>assets/dashboard/vendors/calendar/fullcalendar.css">
<link rel="stylesheet" type="text/css" href="<?=base_url('/');?>assets/dashboard/vendors/summernote/summernote.css">
<link rel="stylesheet" type="text/css" href="<?=base_url('/');?>assets/dashboard/vendors/file-upload/imageuploadify.min.css">

<link rel="stylesheet" type="text/css" href="<?=base_url('/');?>assets/dashboard/css/typography.css">

<!-- SHORTCODES ============================================= -->
<link rel="stylesheet" type="text/css" href="<?=base_url('/');?>assets/dashboard/css/shortcodes/shortcodes.css">

<!-- STYLESHEETS ============================================= -->
<link rel="stylesheet" type="text/css" href="<?=base_url('/');?>assets/dashboard/css/style.css">
<link rel="stylesheet" type="text/css" href="<?=base_url('/');?>assets/dashboard/css/dashboard.css">
<link class="skin" rel="stylesheet" type="text/css" href="<?=base_url('/');?>assets/dashboard/css/color/color-1.css">

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
            <h4 class="breadcrumb-title">List Application</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="<?= base_url('urusetia/dash_admin') ?>"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="<?= base_url('urusetia_mc/dash_admin') ?>">Dashboard Micro-credential</a></li>
                <li>Application Review</li>
            </ul>
        </div>

            <div class="row">
              <div class="col-lg-12 m-b30">
      					<div class="widget-box">
      						<div class="email-wrapper">
      							<div class="mail-list-container">
      								<form class="mail-compose" action="" method="post">
                        <?php
                          $email = "";
                          $nama = "";
                          if($detail_pelajar) {
                            $email = $users_detail[0]->email;
                            $nama = $users_detail[0]->fullname;
                          }

                          $message = '<p>Dear '.$nama.',</p>
                          <p>We want to remind you that we haven&apos;t received payment for invoice <b>'.$detail_pelajar[0]->noinvoice.'</b>. We would like to respectfully ask you to make payment so we can process the enrolment as soon as possible.</p>
                          <table style="border:1px solid black;border-collapse: collapse;">
                              <thead>
                                  <tr style="border:1px solid black;border-collapse: collapse;">
                                    <th scope="col" colspan="1" style="border:1px solid black;border-collapse: collapse;">&nbsp;&nbsp;Invoice No</th>
                                    <th scope="col" colspan="3" style="border:1px solid black;border-collapse: collapse;">&nbsp;&nbsp;'.$detail_pelajar[0]->noinvoice.'</th>
                                  </tr>
                                  <tr style="border:1px solid black;border-collapse: collapse;">
                                      <th scope="col" style="border:1px solid black;border-collapse: collapse;text-align:center; vertical-align:middle;">No</th>
                                      <th scope="col" style="border:1px solid black;border-collapse: collapse;text-align:center; vertical-align:middle;">Course Code</th>
                                      <th scope="col" style="border:1px solid black;border-collapse: collapse;text-align:center; vertical-align:middle;">Course Name</th>
                                  </tr>
                              </thead>';
                              $num = 0;
                              foreach ($detail_kursus as $row) {
                              ++$num;

                              $message .= '<tbody>
                                  <tr style="border:1px solid black;border-collapse: collapse;">
                                      <td style="border:1px solid black;border-collapse: collapse;text-align:center; vertical-align:middle;">'.$num.'.</td>
                                      <td style="border:1px solid black;border-collapse: collapse;">'.$row->kodkursus.'</td>
                                      <td style="border:1px solid black;border-collapse: collapse;">'.$row->namakursus.'</td>
                                  </tr>
                              </tbody>';
                              }
                          $message .= '</table>

                          <p>Thank You.</p><br/>
                          <p><i>Micro-credential & Professional Courses Unit</p>
                          <p>Center for Shaping Advanced & Professional Education (UKMSHAPE)</p>
                          <p>studymc@ukm.edu.my</i><br/></p>
                          <p><a href="'.base_url().'/main/signin"><?=base_url();?></a></p>';

                         ?>
      									<div class="form-group col-12">
      										<input class="form-control" type="email" id="txt_email" name="txt_email" placeholder="To" value="<?=$email;?>">
      									</div>
      									<div class="form-group col-12">
      										<input class="form-control" type="email" id="txt_emailcc" name="txt_emailcc" placeholder="CC" valu="">
      									</div>
      									<div class="form-group col-12">
      										<input class="form-control" type="text" id="txt_subject" name="txt_subject" placeholder="Subject" value="Reminder">
      									</div>
      									<div class="form-group col-12">
      										<div class="summernote">
                            <?=$message;?>
                          </div>
      									</div>
                        <textarea id="txt_message" name="txt_message" style="display:none;"><?=$message;?></textarea>
      									<div class="form-group col-12">
      										<input type="submit" class="btn btn-lg" id="btn_submit" name="btn_submit" value="Send">
      									</div>
      								</form>
      							</div>
      						</div>
      					</div>
      				</div>
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
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/summernote/summernote.js"></script>
<script src="<?php echo base_url('/'); ?>/assets/dashboard/vendors/file-upload/imageuploadify.min.js"></script>
<script src='<?php echo base_url('/'); ?>/assets/dashboard/vendors/switcher/switcher.js'></script>

<script>

      $('.summernote').summernote({
        height: 300,
        tabsize: 2,
        callbacks: {
          onKeyup: function(e) {
            setTimeout(function(){
              $("#txt_message").val($('.summernote').summernote('code'));
            },200);
          }
        }
      });

</script>

<?php $this->load->view('admin_f/script/script-dashboardlayout.php'); ?>

</body>
</html>
