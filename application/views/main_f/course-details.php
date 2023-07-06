<style>
table {
	color:#666;
	font-size:11pt;
	background:#eaebec;
	border:#ccc 1px solid;

	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;

	-moz-box-shadow: 0 1px 2px #d1d1d1;
	-webkit-box-shadow: 0 1px 2px #d1d1d1;
	box-shadow: 0 1px 2px #d1d1d1;
}
table td:first-child {
	border-top:1px solid #fafafa;
	border-bottom:1px solid #e0e0e0;
  width: 250px;
	background: #ededed;
	background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#ebebeb));
	background: -moz-linear-gradient(top,  #ededed,  #ebebeb);
}
table th:first-child {
	text-align: left;
	padding-left:20px;
}
table tr:first-child td:first-child {
	-moz-border-radius-topleft:3px;
	-webkit-border-top-left-radius:3px;
	border-top-left-radius:3px;
}
table tr:first-child td:last-child {
	-moz-border-radius-topright:3px;
	-webkit-border-top-right-radius:3px;
	border-top-right-radius:3px;
}
table tr {
	text-align: center;
	padding-left:20px;
}
table td:first-child {
	text-align: left;
	padding-left:20px;
	border-left: 0;
}
table td {
	border-top: 1px solid #ffffff;
	border-bottom:1px solid #e0e0e0;
	border-left: 1px solid #e0e0e0;

	background: #fafafa;
	background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
	background: -moz-linear-gradient(top,  #fbfbfb,  #fafafa);
}
table tr.even td {
	background: #f6f6f6;
	background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6));
	background: -moz-linear-gradient(top,  #f8f8f8,  #f6f6f6);
}
table tr:last-child td {
	border-bottom:0;
}
table tr:last-child td:first-child {
	-moz-border-radius-bottomleft:3px;
	-webkit-border-bottom-left-radius:3px;
	border-bottom-left-radius:3px;
}
table tr:last-child td:last-child {
	-moz-border-radius-bottomright:3px;
	-webkit-border-bottom-right-radius:3px;
	border-bottom-right-radius:3px;
}

</style>
<?php $this->load->view('templates/layout_utama_menu'); ?>

<?php

// image //
$imgfile = $this->main_m->get_course_preview_img($mdl_courselist[0]->cid);

if($imgfile) {
  $host_url = 'http://'.$_SERVER['HTTP_HOST'];
  $filepath = $host_url.'/lms/pluginfile.php/'.$imgfile[0]->contextid.'/'.$imgfile[0]->component.'/'.$imgfile[0]->filearea.'/'.$imgfile[0]->filename;
}

//price //

$price = 0;
$html_table = $mdl_courselist[0]->csummary;
$html = str_get_html($html_table); // Parse the HTML, stored as a string in $string
$rows = $html->find('tr'); // Find all rows in the table

$kredit = '';
//Loop through each row
foreach ($rows as $row) {
    //Loop through each child (cell) of the row
    $i = 0;
    $checkkredit = false;
    foreach ($row->children() as $cell) {
        if(strpos($cell->plaintext, 'RM') !== false) {
          $price = str_replace('RM','',$cell->plaintext);
        }

        if($cell->plaintext == 'Credit' && $checkkredit == false) {
          $checkkredit = true;
        }
        if($checkkredit == true) {
          if($i == 2) {
            $kredit = $cell->plaintext;
          }
        }

        $i++;
         // Display the contents of each cell - this is the value you want to extract
    }
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
      <li><a href="<?=base_url('/main/index/'.$this->encryption->encrypt($mdl_courselist[0]->cateid).'/');?>"><?=$mdl_courselist[0]->category;?></a></li>
      <li><?=$mdl_courselist[0]->cname;?></li>
    </ul>
  </div>
</div>
<!-- Breadcrumb row END -->
    <!-- inner page banner END -->
<div class="content-block">
        <!-- About Us -->

  <?php
    //if(isset($mdl_courselist)) {
  ?>
  <div class="section-area section-sp1">
      <div class="container">
       <div class="row d-flex flex-row-reverse">
        <div class="col-lg-3 col-md-4 col-sm-12 m-b30">
          <div class="course-detail-bx">


            <div class="course-price">
              <h4 class="price">RM <?=$price;?>.00</h4>
            </div>
            <div class="course-buy-now text-center">
              <a href="#" class="btn radius-xl text-uppercase" data-toggle="modal" data-target="#subscribemodal">Add to Cart</a>
            </div>





            <div class="teacher-bx">
              <div class="teacher-info">
                <div class="teacher-thumb">
                  <img src="<?=base_url('/');?>assets/images/testimonials/pic1.jpg" alt=""/>
                </div>
                <div class="teacher-name">
                  <h5>Hinata Hyuga</h5>
                  <span>Science Teacher</span>
                </div>
              </div>
            </div>
            <div class="course-info-list" style="padding: 8px 20px;border-bottom: 1px solid #e6e6e6;">
              <span style="font-size:12px;">Categories</span>
              <h5 class="text-primary" style="font-size:16px;font-weight: 400;"><?=$mdl_courselist[0]->category;?></h5>
            </div>
            <div class="course-info-list" style="padding: 8px 20px;border-bottom: 1px solid #e6e6e6;height: 35px;">
              <span style="font-size: 12px;float:left;"><i class="fa fa-calendar"></i> <?=date('d M Y', $mdl_courselist[0]->startdate);?> &emsp;until&emsp; <?=date('d M Y', $mdl_courselist[0]->enddate);?></span>
            </div>
            <div class="course-info-list">
              <div style="padding: 8px 20px;"><h5>Overview</h5></div>
              <style>
               .value {
                 float: right;
               }
              </style>
                <ul class="navbar">
                  <li class="nav-link"><i class="ti-time"></i> <span class="label">Duration</span> <span class="value">60 hours</span></li>
                  <li class="nav-link"><i class="ti-stats-up"></i> <span class="label">Skill level</span> <span class="value">Beginner</span></li>
                  <li class="nav-link"><i class="ti-smallcap"></i> <span class="label">Language</span> <span class="value">English</span></li>
                  <li class="nav-link"><i class="ti-check-box"></i> <span class="label">Assessments</span> <span class="value">Yes</span></li>
                </ul>

            </div>
          </div>
        </div>

        <div class="col-lg-9 col-md-8 col-sm-12">
          <div class="courses-post">
            <div class="ttr-post-media media-effect">
              <a href="#"><img src="<?=$filepath;?>" alt=""></a>
            </div>
            <div class="ttr-post-info">
              <!--<div class="ttr-post-title ">
                <h2 class="post-title">Course Details</h2>
              </div>-->
              <div class="ttr-post-text" style="margin-top: 45px;margin-bottom: 0px;">
                <table>
                <?php
                  foreach ($rows as $row) {
                      //Loop through each child (cell) of the row
                      $i = 0;
                      echo "<tr>";
                      foreach ($row->children() as $cell) {
                        if($cell->plaintext == 'Price') {
                          break;
                        }
                          if($i < 2) {
                            if(strpos($cell->plaintext, ':') === false) {
                              echo "<td>".$cell->plaintext."</td>";
                              $i++;
                            }
                          }
                           // Display the contents of each cell - this is the value you want to extract
                      } echo "</tr>";
                  }

                 ?>
               </table>
              </div>
            </div>
          </div>
          <div class="courese-overview" id="overview">
            <div class="row">
              <div class="col-md-12 col-lg-12">



                <!--
                <h5 class="m-b5">Course Description</h5>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                <h5 class="m-b5">Certification</h5>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
              -->
              <!--
                <h5 class="m-b5">Learning Outcomes</h5>
                <ul class="list-checked primary">
                  <li>Over 37 lectures and 55.5 hours of content!</li>
                  <li>LIVE PROJECT End to End Software Testing Training Included.</li>
                  <li>Learn Software Testing and Automation basics from a professional trainer from your own desk.</li>
                  <li>Information packed practical training starting from basics to advanced testing techniques.</li>
                  <li>Best suitable for beginners to advanced level users and who learn faster when demonstrated.</li>
                  <li>Course content designed by considering current software testing technology and the job market.</li>
                  <li>Practical assignments at the end of every session.</li>
                  <li>Practical learning experience with live project work and examples.cv</li>
                </ul>
              -->
              </div>
            </div>
          </div>
          <!-- <div class="m-b30" id="curriculum">
            <h4>Course Content</h4>
            <ul class="curriculum-list">
              <?php
                $coursesection = $this->main_m->get_course_sections_mcodlukm($mdl_courselist[0]->cid);
                dbug($coursesection);
                foreach ($coursesection as $section) {
               ?>
                <li>
                  <h5><?=$section->name;?></h5>
                  <span><?=$section->summary;?></span>
                  <?php
                  $mdl_page = $this->main_m->get_mdl_page_mcodlukm($mdl_courselist[0]->cid, $section->section);
                  if($mdl_page) {
                    foreach ($mdl_page as $page) {
                      $topik2 = mb_substr($page->name, 0, 3);
                      dbug($topik2);
                      $mdl_label = $this->main_m->get_mdl_label_mcodlukm($mdl_courselist[0]->cid, $topik2);
                      echo $mdl_label[0]->intro;
                  ?>
                  <ul>
                    <li>
                      <div class="curriculum-list-box">
                        <span><?=$page->name;?></span>
                      </div>
                    </li>
                  </ul>
                  <?php }
                    // code...
                  }?>
                </li>
                <?php
                  }
                ?>
                <li>
                  <h5>Second Level</h5>
                  <ul>
                    <li>
                      <div class="curriculum-list-box">
                        <span>Lesson 1.</span> Prototyping and Design
                      </div>
                      <span>110 minutes</span>
                    </li>
                    <li>
                      <div class="curriculum-list-box">
                        <span>Lesson 2.</span> UI Design Capstone
                      </div>
                      <span>120 minutes</span>
                    </li>
                    <li>
                      <div class="curriculum-list-box">
                        <span>Lesson 3.</span> Evaluating User Interfaces Part 2
                      </div>
                      <span>120 minutes</span>
                    </li>
                  </ul>
                </li>
                <li>
                  <h5>Final</h5>
                  <ul>
                    <li>
                      <div class="curriculum-list-box">
                        <span>Part 1.</span> Final Test
                      </div>
                      <span>120 minutes</span>
                    </li>
                    <li>
                      <div class="curriculum-list-box">
                        <span>Part 2.</span> Online Test
                      </div>
                      <span>120 minutes</span>
                    </li>
                  </ul>
                </li>
              </ul>
          </div> -->

        </div>

      </div>
    </div>

    </div>
  <?php //} ?>

</div>
<!-- contact area END -->


</div>
<!-- Content END-->

<!-- Modal -->
<div class="modal fade" id="subscribemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form class="edit-profile" action="<?=base_url('/main/payment');?>" method="post">
        <div class="modal-body">
          <div class="">
            <div class="form-group row">
              <div class="col-12 col-sm-9 col-md-9 col-lg-9 ml-auto">
                <h3>1. Personal Details</h3>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Full Name</label>
              <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                <input class="form-control" type="text" id="txt_name" name="txt_name" value="">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">IC.No/ Passport</label>
              <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                <input class="form-control" type="text" id="txt_kpkini" name="txt_kpkini" value="">
              </div>
            </div>

            <div class="seperator"></div>

            <div class="form-group row">
              <div class="col-12 col-sm-9 col-md-9 col-lg-9 ml-auto">
                <h3>2. Address</h3>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Postal Address</label>
              <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                <input class="form-control mb-2" type="text" id="txt_alamat1" name="txt_alamat1" value="">
                <input class="form-control mb-2" type="text" id="txt_alamat2" name="txt_alamat2" value="">
                <input class="form-control mb-2" type="text" id="txt_alamat3" name="txt_alamat3" value="">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">City</label>
              <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                <input class="form-control" type="text" id="txt_city" name="txt_city" value="">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">State/ Country</label>
              <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                <input class="form-control" type="text" id="txt_country" name="txt_country" value="">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Post/Zip code</label>
              <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                <input class="form-control" type="text" id="txt_poscode" name="txt_poscode" value="">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Phone No. (Mobile)</label>
              <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                <input class="form-control" type="text" id="txt_tel" name="txt_tel" value="">
                <span class="help">With country code</span>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Email Address</label>
              <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                <input class="form-control" type="email" id="txt_emel" name="txt_emel" value="">
              </div>
            </div>

            <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>

            <div class="form-group row">
              <div class="col-12 col-sm-9 col-md-9 col-lg-9 ml-auto">
                <h3 class="m-form__section">3. Academic Qualifications</h3>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Highest Education</label>
              <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                <select class="form-control" id="txt_academic" name="txt_academic">
                  <option value="">Select</option>
                  <option value="82">O Level</option>
                  <option value="AL">A Level</option>
                  <option value="SJ">Certificate</option>
                  <option value="DI">Diploma</option>
                  <option value="WW">Advance Diploma</option>
                  <option value="SM">Degree</option>
                  <option value="SS">Master</option>
                  <option value="FF">Doctor of Philosophy</option>
                  <option value="KP">Professional Qualification</option>
                  <option value="ZZ">Others</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Name of Certificate / Program of Study</label>
              <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                <input class="form-control" type="text" id="txt_nmacademic" name="txt_nmacademic" value="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
          <button type="close" class="btn-secondry" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
