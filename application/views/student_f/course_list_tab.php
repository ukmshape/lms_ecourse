<div class="profile-head">
  <h3>My Courses</h3>
  <!--<div class="feature-filters style1 ml-auto">
    <ul class="filters" data-toggle="buttons">
      <li data-filter="" class="btn active">
        <input type="radio">
        <a href="#"><span>All</span></a>
      </li>
      <li data-filter="complete" class="btn">
        <input type="radio">
        <a href="#"><span>Complete</span></a>
      </li>
      <li data-filter="active" class="btn">
        <input type="radio">
        <a href="#"><span>Active</span></a>
      </li>
    </ul>
  </div>-->
</div>

  <div class="courses-filter">
    <div class="clearfix">
      <ul class="container">
        <?php
        $count = 0;
        foreach ($semakcourse_student as $row) {

          if($count < 3) {
            $count += 1;
          } else {
            $count = 0;
          }

          $class = '';
          if($row->status_enrol != NULL) {
            if($row->status_enrol == 13) {
              $class = 'complete';
            } else if($row->status_enrol == 12) {
              $class = 'active';
            }
          } else if($row->status_enrol != NULL) {
            if($row->status_enrol == 13) {
              $class = 'complete';
            } else if($row->status_enrol == 12) {
              $class = 'active';
            }
          }

        ?>

        <li class="card" style="width: 18rem;">
          <?php
          // image //
          $imgfile = $this->student_m->get_course_preview_img($row->kursusid);

          if($imgfile) {
            $host_url = 'https://'.$_SERVER['HTTP_HOST']; //'http://'.$_SERVER['HTTP_HOST'];
            if($_SERVER['HTTP_HOST'] == "shape.ukm.my") {
              $filepath = $host_url.'/ecourselms/pluginfile.php/'.$imgfile[0]->contextid.'/'.$imgfile[0]->component.'/'.$imgfile[0]->filearea.'/'.$imgfile[0]->filename;
            } else {
              $filepath = $host_url.'/lms/pluginfile.php/'.$imgfile[0]->contextid.'/'.$imgfile[0]->component.'/'.$imgfile[0]->filearea.'/'.$imgfile[0]->filename;
            }
          }

          ?>
            <a href="https://ecourse.ukm.my/lms/course/view.php?id=<?=$row->kursusid;?>"><img class="card-img-top" src="<?php echo $filepath;?>" alt="Card image cap"></a>
            <div class="card-body text-center">
              <!--<h5><a href="https://ecourse.ukm.my/lms"><?php echo ($row->namakursus); ?></a></h5>-->
              <h4 class="mt-1"><a href="https://ecourse.ukm.my/lms/course/view.php?id=<?=$row->kursusid;?>" target="_blank"><?php echo ($row->namakursus); ?></a></h4>
              <!--<span>Healthcare &amp; Biomedical Science</span><br/>-->
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item" style="">
                <?php
                  if($row->status_enrol != NULL) {
                    if($row->status_enrol == 13) {
                      echo '<p class="card-text"><a href="https://ecourse.ukm.my/lms/course/view.php?id='.$row->kursusid.'" class="btn button-sm green radius-xl">Complete</a></p>';
                    } else if($row->status_enrol == 12) {
                      echo '<p class="card-text"><a href="https://ecourse.ukm.my/lms/course/view.php?id='.$row->kursusid.'" class="btn button-sm warning radius-xl">Active</a></p>';
                    }
                  } else {
                    echo '<p class="card-text"><a href="https://ecourse.ukm.my/lms/course/view.php?id='.$row->kursusid.'" class="btn button-sm danger radius-xl">Inactive</a></p>';
                  }
                  ?>
              </li>
              <li class="list-group-item"><i class="fa fa-calendar"></i> Start Date: <?php echo date('d/m/Y', strtotime($row->tarikhmula)); ?></li>
              <li class="list-group-item"><i class="fa fa-calendar"></i> End Date: <?php echo date('d/m/Y', strtotime($row->tarikhtamat)); ?></li>
            </ul>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
