
<?php $this->load->view('templates/layout_utama_menu'); ?>
<link rel="stylesheet" type="text/css" href="<?=base_url('/');?>assets/dashboard/css/dashboard.css">

<!-- Content -->
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="page-banner ovbl-dark" style="background-image:url(<?=base_url('/');?>assets/images/banner/banner2.jpg);">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white">Payment Completed</h1>
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
          <h2 class="title-head text-uppercase m-b0">Your Application has be process</h2>
          <p style="font-size: 15pt;"><b>We will email the result soon.</b></p>
        </div>
      </div>

    </div>
        </div>
</div>
<!-- contact area END ==== -->

</div>
<!-- Content END-->

<?php $this->load->view('templates/layout_footer'); ?>
