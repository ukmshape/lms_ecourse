
<?php $this->load->view('templates/layout_utama_menu'); ?>
<style>
table td {
    padding: 5px 10px;
}
</style>

<?php
$imgfile = $this->main_m->get_course_preview_img($mdl_courselist[0]->cid);

if($imgfile) {
  $host_url = 'https://'.$_SERVER['HTTP_HOST'];
  $filepath = $host_url.'/lms/pluginfile.php/'.$imgfile[0]->contextid.'/'.$imgfile[0]->component.'/'.$imgfile[0]->filearea.'/'.$imgfile[0]->filename;
}

 ?>

<!-- Content -->
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="page-banner ovbl-dark" style="background-image:url(<?=$filepath;?>);">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white"><?=$mdl_courselist[0]->cname;?></h1>
            </div>
        </div>
    </div>
<!-- Breadcrumb row -->
<div class="breadcrumb-row">
  <div class="container">
    <ul class="list-inline">
      <li><a href="<?=base_url('/');?>">Dashboard</a></li>
      <li><a href="<?=base_url('/main/index/'.$this->encrypt->encode($mdl_courselist[0]->cateid).'/');?>"><?=$mdl_courselist[0]->category;?></a></li>
      <li><?=$mdl_courselist[0]->cname;?></li>
    </ul>
  </div>
</div>
<!-- Breadcrumb row END -->
    <!-- contact area -->
    <div class="content-block">
        <!-- Your Faq -->
        <div class="section-area section-sp1">
            <div class="container">
             <div class="row d-flex flex-row-reverse">


            </div>
          </div>

          </div>
        <!-- Your Faq End -->
    </div>
<!-- contact area END -->
</div>
