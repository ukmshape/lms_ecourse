<?php $this->load->view('templates/layout_utama_menu'); ?>

<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="page-banner ovbl-dark" style="background-image:url(<?=base_url('/');?>assets/images/banner/banner1.jpg);">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white">PAGE NOT FOUND</h1>
     </div>
        </div>
    </div>

    <div class="content-block">
      <div class="error-page" style="margin: 90px 0;">
        <h3>Ooopps :(</h3>
        <h2 class="error-title">404</h2>
        <h5>The Page you were looking for, couldn't be found.</h5>
        <p>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
        <div class="">
          <a href="<?=base_url('/');?>" class="btn outline black">Back To Home</a>
        </div>
      </div>
    </div>
</div>

<?php $this->load->view('templates/layout_footer'); ?>
