
<!--
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////  HOME PAGE LAMA //////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
-->


<?php $this->load->view('templates/layout_utama_menu'); ?>
<style>
.post-title {
  font-size: 22px !important;
  min-height: 65px;
}
</style>
<!-- Content -->
<div class="page-content bg-white">
    <!-- Main Slider -->
    <div class="section-area section-sp1 ovpr-dark bg-fix online-cours" style="background-image:url(<?=base_url('/');?>assets/images/background/bg1.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center text-white">
          <h2>Online Courses To Learn</h2>
          <h5>Own Your Feature Learning New Skills Online</h5>
          <form class="cours-search">
            <div class="input-group">
              <input type="text" class="form-control" id="search" name="search" placeholder="What do you want to learn today?	" value="<?=$search;?>">
              <div class="input-group-append">
                <button class="btn" type="submit">Search</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
    <!-- Main Slider -->

    <div class="content-block">
    <div class="section-area section-sp1">
    <div class="container">
      <div class="feature-filters clearfix center m-b40">
        <ul class="filters" data-toggle="buttons">
          <li data-filter="" class="btn active">
            <input type="radio">
            <a href="#"><span>All</span></a>
          </li>
          <li data-filter="happening" class="btn">
            <input type="radio">
            <a href="#"><span>Happening</span></a>
          </li>
          <li data-filter="upcoming" class="btn">
            <input type="radio">
            <a href="#"><span>Upcoming</span></a>
          </li>
          <li data-filter="expired" class="btn">
            <input type="radio">
            <a href="#"><span>Expired</span></a>
          </li>
        </ul>
      </div>
      <div class="row">
        <!-- Left part start -->

        <div class="col-lg-4 col-xl-4 col-md-5 sticky-top">
          <aside class="side-bar sticky-top">
            <div class="widget">
              <!--<h6 class="widget-title">Course</h6>-->
              <div class="search-bx style-1">

                <div id="filterbar" class="">
                  <div class="box border-bottom">
                      <div class="my-1"> <a href="<?=base_url('/main/index/'.$search);?>"><label>All Courses</label> </a></div>
                  </div>
                  <div class="box border-bottom">
                      <div class="box-label text-uppercase d-flex align-items-center">Micro-Credential <button class="btn ml-auto" type="button" data-toggle="collapse" data-target="#inner-box1" aria-expanded="false" aria-controls="inner-box1" id="out" onclick="outerFilter()"> <span class="fa fa-plus"></span> </button> </div>
                      <div id="inner-box1" class="collapse mt-2 mr-1">
                        <div class="my-1"> <a href="<?=base_url('/main/index/con/Micro-credential/'.$search);?>"><label>All</label> </a></div>
                        <?php
                        if(isset($mdl_course_catergorieslst)) {
                          foreach ($mdl_course_catergorieslst as $categories) { ?>

                            <div class="my-1"> <a href="<?=base_url('/main/index/'.$this->encryption->encrypt($categories->id).'/Micro-credential/'.$search);?>"><label><?=$categories->name;?></label> </a></div>

                        <?php
                          }
                        }
                        ?>

                      </div>
                  </div>

                  <div class="box border-bottom">
                      <div class="box-label text-uppercase d-flex align-items-center">Short Term Courses <button class="btn ml-auto" type="button" data-toggle="collapse" data-target="#inner-box2" aria-expanded="false" aria-controls="inner-box1" id="out" onclick="outerFilter()"> <span class="fa fa-plus"></span> </button> </div>
                      <div id="inner-box2" class="collapse mt-2 mr-1">
                        <?php //list for SP // ?>
                      </div>
                  </div>

                  <div class="box border-bottom">
                      <div class="box-label text-uppercase d-flex align-items-center">Professional Certificate <button class="btn ml-auto" type="button" data-toggle="collapse" data-target="#inner-box3" aria-expanded="false" aria-controls="inner-box1" id="out" onclick="outerFilter()"> <span class="fa fa-plus"></span> </button> </div>
                      <div id="inner-box3" class="collapse mt-2 mr-1">
                        <?php //list for KP // ?>
                      </div>
                  </div>

              </div>

              </div>
            </div>

          </aside>
        </div>
        <!-- Left part END -->


        <!-- Right part start -->
        <div class="col-lg-8 col-xl-8 col-md-7">
          <!-- blog grid -->
          <div id="masonry" class="ttr-blog-grid-3 row">
            <?php

            if(isset($mdl_courselist)) {
              foreach ($mdl_courselist as $course) {
                if($course->visibleold == 1) {
                  $stcard = '';
                  $currdate = strtotime('today');
                  if($course->startdate > $currdate) {
                    $stcard .= 'upcoming ';
                  }
                  if($currdate >= $course->enddate) {
                    $stcard .= 'expired';
                  }
                  else {
                    $stcard .= 'happening';
                  }

                   ?>
                  <div class="post action-card col-xl-6 col-lg-6 col-md-12 col-xs-12 m-b40 <?=$stcard;?>">
                    <div class="recent-news">
                      <div class="action-box">
                        <?php

                        $imgfile = $this->main_m->get_course_preview_img($course->id);

                        if($imgfile) {
                          $host_url = LMSPATH;
                          $filepath = $host_url.'/pluginfile.php/'.$imgfile[0]->contextid.'/'.$imgfile[0]->component.'/'.$imgfile[0]->filearea.'/'.$imgfile[0]->filename;
                        }

                        ?>
                        <img src="<?=$filepath;?>" alt="">
                      </div>
                      <div class="info-bx">
                        <ul class="media-post">
                          <li><a href="javascript:;"><i class="fa fa-calendar"></i>Updated <?=date("d/m/Y", $course->timemodified);?></a></li>
                          <!--<li><a href="javascript:;"><i class="fa fa-user"></i>By William</a></li>-->
                        </ul>
                        <h5 class="post-title"><a href="<?=base_url('/main/course_details/'.$course->id);?>"><?=$course->fullname;?></a></h5>
                        <!--<p><?=$course->summary;?></p>-->
                        <div class="post-extra">
                          <a href="<?=base_url('/main/course_details/'.$course->id);?>" class="comments-bx">READ MORE</a>
                        </div>
                      </div>
                    </div>
                  </div>

            <?php  }
              }
            } ?>

          </div>
          <!-- blog grid END -->
          <!-- Pagination -->

          <div class="pagination-bx rounded-sm gray clearfix">
            <?= $links; ?>
          </div>
          <!-- Pagination END -->
        </div>
        <!-- Right part END -->

      </div>
    </div>
    </div>
    </div>


<!-- contact area END -->
</div>
<!-- Content END-->
