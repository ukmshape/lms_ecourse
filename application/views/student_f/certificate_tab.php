<link rel="stylesheet" type="text/css" href="<?=base_url();?>/assets/vendors/bootstrap/css/bootstrap_card.css">
<div class="profile-head">
  <h3>Certificate</h3>
</div>

<form class="edit-profile" method="post" enctype="multipart/form-data" action="<?php echo $action_save_tab_certificate;?>">

  <div class="courses-filter">
    <div class="clearfix">

      <table class="table">
        <thead>
          <tr>
            <th width="50%">Contoh Sijil</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Sijil Achievement</td>
            <td>
              <a name="btn_surat" href="<?php echo base_url('cetakpdf/cetak_achievementcert'); ?>" class="btn button-sm blue radius-xl" role="button" target="_blank">
                <i class="fa fa-print"></i> Papar
              </a>
            </td>
          </tr>
          <tr>
            <td>Sijil Completion</td>
            <td>
              <a name="btn_surat" href="<?php echo base_url('cetakpdf/cetak_completioncert'); ?>" class="btn button-sm blue radius-xl" role="button" target="_blank">
                <i class="fa fa-print"></i> Papar
              </a>
            </td>
          </tr>
          <tr>
            <td>Sijil MMS</td>
            <td>
              <a name="btn_surat" href="<?php echo base_url('cetakpdf/cetak_mmscert'); ?>" class="btn button-sm blue radius-xl" role="button" target="_blank">
                <i class="fa fa-print"></i> Papar
              </a>
            </td>
          </tr>

        </tbody>
      </table>






      <ul id="masonry" class="ttr-gallery-listing magnific-image row">
        <?php foreach ($semakcertificate_student as $row) {

          $class = '';
          $nomatrik = '';
          if($row->status_enrol != NULL) {
            if($row->status_enrol == 13) {
              $nomatrik = $row->nomatrik;
              //utk kursus pakai: $row
              //utk data pelajar pakai : $semakdata_student
            }
          } else if($row->status_enrol != NULL) {
            if($row->status_enrol == 13) {
              $nomatrik = $row->nomatrik;
              //utk kursus pakai: $row
              //utk data pelajar pakai : $semakdata_student
            }
          }
           ?>
          <li class="action-card col-12 col-lg-4 col-md-12 col-sm-12 <?php echo $class;?>">
            <div class="cours-bx">
              <div class="action-box ">
                <?php
                // image //
                $imgfile = $this->student_m->get_course_preview_img($row->kursusid);

                if($imgfile) {
                  $host_url = LMSPATH;
                  $filepath = $host_url.'/pluginfile.php/'.$imgfile[0]->contextid.'/'.$imgfile[0]->component.'/'.$imgfile[0]->filearea.'/'.$imgfile[0]->filename;
                }

                ?>
                <img src="<?php echo $filepath;?>" alt="">
              </div>
              <div class="info-bx text-center">
                <h5><a href="<?=LMSPATH;?>"><?php echo ($row->namakursus); ?></a></h5>



                <?php //$parametercetak = $nomatrik;  //dbug($parametercetak);?>
                <a name="btn_surat" href="<?php echo base_url('testpdf/cetak_testpdf'); ?>" class="btn button-sm blue radius-xl" role="button" target="_blank">
                <i class="fa fa-print"></i> Print
                </a>

              </div>
              <div class="cours-more-info">
                <div style="width: 100%;padding: 15px 20px;border-bottom: 1px solid #e6e6e6;">
                  <span style="font-size: 12px;float:left;"><i class="fa fa-calendar"></i> Start Date: <?php echo date('d/m/Y', strtotime($row->tarikhmula)); ?></span>
                  <!-- <span style="font-size: 12px;float:right;"><i class="fa fa-clock-o"></i> <-?php echo date_timestamp_get($row->tarikhmula); ?></span> -->
                  <span style="font-size: 12px;float:right;"><i class="fa fa-calendar"></i> End Date: <?php echo date('d/m/Y', strtotime($row->tarikhtamat)); ?></span>
                </div>
              </div>
            </div>
          </li>
        <?php }  ?>
      </ul>

    </div>
  </div>

</form>
