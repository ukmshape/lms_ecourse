
<?php
$user_id = $this->session->userdata('session_student')['user_id'];
$invoice = $this->session->userdata('inv_no');

$invoicedetails = $this->main_m->get_param_kursus_by_invoice($user_id,$invoice,$type);

 ?>

<?php $this->load->view('templates/layout_utama_menu'); ?>
<link rel="stylesheet" type="text/css" href="<?=base_url('/');?>assets/dashboard/css/dashboard.css">

<!-- Content -->
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="page-banner ovbl-dark" style="background-image:url(<?=base_url('/');?>assets/images/banner/banner2.jpg);">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white">Payment</h1>
     </div>
        </div>
    </div>
    <!-- Breadcrumb row -->
    <div class="breadcrumb-row">
      <div class="container">
        <ul class="list-inline">
          <li><a href="<?=base_url('/');?>">Home</a></li>
          <li><a href="<?=base_url('/main/carts');?>">Shopping Cart</a></li>
          <li>Check Out</li>
          <li>Payment</li>
        </ul>
      </div>
    </div>
    <!-- Breadcrumb row END -->
    <!-- inner page banner END -->
<div class="content-block">
        <!-- About Us -->
  <div class="section-area section-sp2">
            <div class="container">
      <div class="row">
        <div class="col-md-12 heading-bx text-center">
          <h2 class="title-head text-uppercase m-b0">Subscribe, start learning and <br/> <span> unlock your potential</span></h2>

        </div>
      </div>
       <div class="pricingtable-row">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12 m-b40">
            <div class="pricingtable-wrapper">
              <form id="formfield" action="" method="post" enctype="multipart/form-data">
              <div class="pricingtable-inner pricingtable-highlight">
                <div class="pricingtable-main">
                  <div class="pricingtable-price">
                    <?php
                      $totalprice = $invoicedetails[0]->total;
                    ?>
                    <span class="priceing-doller">RM</span>
                    <span class="pricingtable-bx"><?=$totalprice;?></span>
                  </div>
                  <!--<div class="pricingtable-title">
                    <h2>Micro-Credential:</h2>
                    <p>Become a PHP Master and Make Money</p>
                  </div>-->
                </div>
                <table class="table table-striped">
                  <tr>
                    <th style="text-align: right;width: 550px;">INVOICE NO:</th>
                    <td style="text-align: left;"><?=$invoice;?></td>
                  </tr>
                  <tr>
                    <th style="text-align: right;width: 550px;">ORDER ID:</th>
                    <td style="text-align: left;"><?=$invoicedetails[0]->order_id;?></td>
                  </tr>
                  <tr>
                    <th style="text-align: right;">DATE:</th>
                    <td style="text-align: left;"><?=date('d-m-Y',strtotime($invoicedetails[0]->tarikhinvoice));?></td>
                  </tr>
                  <tr>
                    <th style="text-align: right;">DESCRIPTION:</th>
                    <td style="text-align: left;">Payment for eCourse</td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-center">
                      <ul class="bg-info p-2 text-dark col-lg-6" style="background-color: #17a2b87a!important;margin: auto;">
                        <li>Name of recipient: <b>Pusat Kembangan Pendidikan</b></li>
                        <li>Name of the recipient bank: <b>CIMB Bank Berhad</b></li>
                        <li>Address of bank: <b>Wisma Unikeb, Bandar Baru Bangi, 43600 Selangor, Malaysia</b></li>
                        <li>Account No.: <b>8002233817</b></li>
                      </ul>
                      <span>Please upload a copy of the slip/receipt as proof of payment.</span>
                    </td>
                  </tr>
                  <tr>
                    <th style="text-align: right;">DOCUMENT/RECEIPT:</th>
                    <td style="text-align: left;"><input type="file" name="resit_upload" accept="image/png, image/gif, image/jpeg, application/pdf" required></td>
                  </tr>
                </table>
                <table class="table table-sm table-striped table-dark">
                  <tr style="color:#89ccd6;font-size: 16pt;">
                    <th>No.</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Fee</th>
                  </tr>
                <?php
                if($invoicedetails) {
                  $i = 1;
                  foreach ($invoicedetails as $value) {
                    $totalprice = $totalprice+$value->totalprice;
                    $mdl_courselist = $this->main_m->get_course_detail_mcodlukm($value->kursusid);
                  ?>
                  <tr>
                    <td><?=$i++;?></td>
                    <td><?=$value->kodkursus;?></td>
                    <td><?=$mdl_courselist[0]->cname;?></td>
                    <td>RM <?=$value->totalprice;?></td>
                  </tr>
                  <?php
                  }
                }
                ?>
              </table>
                <div class="pricingtable-footer">
                  <input type="hidden" name="txt_kpkini" value="<?=$invoicedetails[0]->user_id;?>">
                  <input type="hidden" name="txt_inv_no" value="<?=$invoice;?>">
                  <input type="submit" class="btn radius-xl" name="btn_submitPay" value="Pay Now">
                </div>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
        </div>
</div>
<!-- contact area END ==== -->

</div>
<!-- Content END-->

<?php $this->load->view('templates/layout_footer'); ?>
