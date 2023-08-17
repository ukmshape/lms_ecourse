<?php $this->load->view('templates/layout_utama_menu'); ?>

<div class="page-content bg-white">
    <!-- Page Heading Box ==== -->
    <div class="page-banner ovbl-dark" style="background-image:url(<?=base_url('/');?>assets/images/banner/banner1.jpg);">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white">Professional Certificate</h1>
     </div>
        </div>
    </div>
<div class="breadcrumb-row">
  <div class="container">
    <ul class="list-inline">
      <li><a href="<?=base_url('/');?>">Home</a></li>
      <li>Professional Certificate</li>
    </ul>
  </div>
</div>
<!-- Page Heading Box END ==== -->
<!-- Page Content Box ==== -->
    <div class="content-block">
  <!-- Blog Grid ==== -->
  <div class="section-area section-sp1">
    <div class="container">

      <div class="row">
        <div class="col-md-12 col-md-offset-2 well">
        <?php
        $attr = array("class" => "form-horizontal", "role" => "form", "id" => "form1", "name" => "form1");
        echo form_open("SP/search", $attr);?>
            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                    <input class="form-control" id="course_name" name="course_name" placeholder="Search for Course Name..." type="text" value="<?php echo set_value('course_name'); ?>" />
                </div>
                <div class="col-md-6">
                    <input id="btn_search" name="btn_search" type="submit" class="btn btn-danger" value="Search" />
                    <a href="<?php echo base_url(). "SP/index"; ?>" class="btn btn-primary">Show All</a>
                </div>
              </div>
            </div>
        <?php echo form_close(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-md-offset-2 bg-border">
          <div class="ttr-blog-grid-3 row" id="masonry">

          <?php for ($i = 0; $i < count($course); ++$i) { ?>
            <div class="post action-card col-lg-4 col-md-6 col-sm-12 col-xs-12 m-b40">
              <div class="recent-news">
                <div class="action-box">
                  <?php

                  $imgfile = $this->main_m->get_course_preview_img($course[$i]->id);

                  if($imgfile) {
                    $host_url = LMSPATH; //'http://'.$_SERVER['HTTP_HOST'];
                    if($_SERVER['HTTP_HOST'] == "shape.ukm.my") {
                      $filepath = $host_url.'/pluginfile.php/'.$imgfile[0]->contextid.'/'.$imgfile[0]->component.'/'.$imgfile[0]->filearea.'/'.$imgfile[0]->filename;
                    } else {
                      $filepath = $host_url.'/pluginfile.php/'.$imgfile[0]->contextid.'/'.$imgfile[0]->component.'/'.$imgfile[0]->filearea.'/'.$imgfile[0]->filename;
                    }
                  }

                  ?>
                  <img src="<?=$filepath;?>" alt="">
                </div>
                <div class="info-bx" style="min-height: 215px;">
                  <ul class="media-post">
                    <li><a href="javascript:;"><i class="fa fa-calendar"></i>Updated <?=date("d/m/Y", $course[$i]->timemodified);?></a></li>
                    <!--<li><a href="#"><i class="fa fa-user"></i>By William</a></li>-->
                  </ul>
                  <h5 class="post-title" style="text-transform: uppercase;font-size: 20px;"><a href="<?=base_url('/main/course_details/'.$course[$i]->id);?>"><?=$course[$i]->fullname;?></a></h5>
                  <div class="post-extra" style="bottom: 20px;position: absolute;right: 0;width: -webkit-fill-available;margin: 0 20px;">
                    <a href="<?=base_url('/main/course_details/'.$course[$i]->id);?>" class="comments-bx">READ MORE</a>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php echo $pagination; ?>
        </div>
    </div>




    </div>
  </div>
  <!-- Blog Grid END ==== -->
    </div>
<!-- Page Content Box END ==== -->
</div>

<?php $this->load->view('templates/layout_footer'); ?>
