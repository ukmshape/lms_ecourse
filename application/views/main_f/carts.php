
<?php $this->load->view('templates/layout_utama_menu'); ?>

<style>
  .disabled {
    background-color: #cdcdcd;
    color: #878686;
    cursor: no-drop;
  }
</style>
<!-- Content -->
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="page-banner ovbl-dark" style="background-image:url(<?=base_url('/');?>assets/images/banner/banner3.jpg);">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white">Shopping Cart</h1>
     </div>
        </div>
    </div>
<!-- Breadcrumb row -->
<div class="breadcrumb-row">
  <div class="container">
    <ul class="list-inline">
      <li><a href="<?=base_url('/');?>">Home</a></li>
      <li>Shopping Cart</li>
    </ul>
  </div>
</div>
<!-- Breadcrumb row END -->

    <!-- inner page banner -->
    <div class="page-banner contact-page section-sp2">
        <div class="container">
            <div class="row">
              <table class="table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Course</th>
                    <th class="text-center" scope="col" style="width: 20%;">Total Fee</th>
                    <th class="text-center" scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      $totalprice = 0;
                      if($cart_list) {
                        $i = 1;
                        $totalexpired = 0;
                        foreach ($cart_list as $value) {
                          $totalprice = $totalprice + $value->totalprice;
                          $mdl_courselist = $this->main_m->get_course_detail_mcodlukm($value->kursusid);

                          $stcard = '';
                          $currdate = strtotime('today');
                          if($currdate >= strtotime($value->tarikhtamat)) {
                            $stcard = 'expired';
                            $totalexpired += 1;
                          }

                          ?>
                            <tr <?php if($stcard == 'expired') { echo 'class="table-warning"'; } ?>>
                              <th scope="row"><?=$i++;?></th>
                              <td>
                                <?php
                                // image //
                                $imgfile = $this->main_m->get_course_preview_img($value->kursusid);

                                if($imgfile) {
                                  $host_url = LMSPATH;
                                  $filepath = $host_url.'/pluginfile.php/'.$imgfile[0]->contextid.'/'.$imgfile[0]->component.'/'.$imgfile[0]->filearea.'/'.$imgfile[0]->filename;
                                }

                                ?>
                                <div class="row">
                                  <div class="col-sm-4 col-md-2">
                                    <img src="<?=$filepath;?>" alt="">
                                  </div>
                                  <div class="col-sm-8 col-md-10">
                                    <a href="<?=base_url('main/course_details/'.$value->kursusid);?>">
                                      <span><?=$mdl_courselist[0]->cname;?> (<?=$mdl_courselist[0]->ccode;?>)</span><br/>
                                      <span>Category: <?=$mdl_courselist[0]->category;?></span>
                                    </a>
                                  </div>
                                </div>
                              </td>
                              <?php if($value->totalprice != 0) {
                                $pricedisplay = 'RM'.number_format($value->totalprice,2);
                              } else {
                                $pricedisplay = 'FREE';
                              } ?>
                              <td class="text-center"><?=$pricedisplay;?></td>
                              <td class="text-center">
                                <?php if($stcard == 'expired') { echo '<span class="text-red">Expired</span><br/>'; } ?>
                                <a href="<?=base_url('/MC/remove_cart?id='.$value->id.'&paramid='.$value->idparam.'&idcart='.$value->idcart);?>">Delete</a>
                              </td>
                            </tr>
                          <?php
                        }
                      } else {
                        echo "<tr><td colspan='4'>No Result</td></tr>";
                      }
                     ?>
                     <tfoot>
                       <tr class="thead-light">
                         <th colspan="2" class="text-right" style="font-size: 14pt;">Total:</th>
                         <th colspan="" class="text-center" style="font-size: 14pt;">RM<?=number_format($totalprice,2);?></th>
                         <?php if($cart_list) { ?>
                           <?php if($totalexpired <= 0) {
                             $urlcheck = base_url('/MC/carts/checkout?idcart='.$cart_list[0]->idcart);
                             $class = "";
                           } else {
                             $urlcheck = '#';
                             $class = "disabled";
                           } ?>
                           <th><div class="text-center"><a href="<?=$urlcheck;?>" class="btn <?=$class;?>">Check Out</a></div></th>
                        <?php } else { ?>
                          <th></th>
                        <?php } ?>
                       </tr>
                     </tfoot>
                </tbody>
              </table>
            </div>
        </div>
</div>
    <!-- inner page banner END -->
</div>
