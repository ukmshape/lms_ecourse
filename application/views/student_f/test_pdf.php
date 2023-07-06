<?php 
  if(isset($_POST['btn_capai_slip']) || $this->input->post('txt_matrik')){

    $txt_matrik = $this->input->post('txt_matrik');
  } 
  else
  {

    $txt_matrik = "";

  }
  ?>


<!-- new template -->
<header>
  <!-- logo -->
  <?php $this->load->view('utama_f/header_logo.php');  ?>


    
</header>

<!-- end of header -->
<!-- ================================
   content-outer-wrapper
   ================================-->
<div class="content-outer-wrapper content-outer-wrapper-4 mt-1"> <!-- tambah mt-1 utk bagi line atas turun -->
   <div class="chance"></div>
   <section class="profile-page">
      <div class="container">
         <div class="row">
            <div class="col-md-12 si-box-padding">
               <!-- ================================
                  breadcrumbs
                  ================================-->
               <section class="common-head-wrapper-sm clearfix">
                  <div class="wrapper-head">
                     <h4><i class="glyphicon glyphicon-user"></i><span>Slip Pendaftaran</span></h4>
                  </div>
                  <!-- end of wrapper-head -->
                  <div class="bread-crumbs">
                     <ul>
                        <li><a href="#">Admin</a></li>
                        <li><a href="#">Cetak Slip</a></li>
                     </ul>
                  </div>
                  <!-- end of bread-crumbs -->
               </section>
               <!-- end of common-head-wrapper-sm -->
               <!-- ================================
                  Terms and Conditions
                  ================================-->
               <section class="white-smooth-wrapper no-margin">
                  <div class="row shadow">
                    <div class="col-md-12">
                        <div class="main_policy_wrapper">
                          <h2>Cetak Slip Pendaftaran</h2>

                          <form id="menu_individu" class="form-horizontal" method="post" >

                            <div class="row">
                              <div class="col-8 offset-md-2">
                                <div class="card bg-light text-dark">
                                  <div class="card-body">

                                    <!-- no.matrik -->
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                           No. Matrik
                                        </span>
                                      </div>
                                      <input style="text-transform:uppercase" type="text" class="form-control txt_matrik" name="txt_matrik" value="<?php echo $txt_matrik; ?>" >
                                    </div>

                                    <div align="center">
                                      <button type="submit" name="btn_capai_slip" value="btn_capai_slip" class="btn btn-primary"> CAPAI</button>
                                    </div>

                                  </div>
                                </div>

                              </div>  

                            </div>


                            <?php if(isset($_POST['btn_capai_slip']) || $this->input->post('txt_matrik')){?>

                              <div class="card" style="margin-top: 50px">
                                <div class="card-body">

                                  <?php $matrik = $this->input->post('txt_matrik'); ?>

                                  <?php if(!empty($result_individu)): //dbug($result_individu); die();?>

                                    <table id="example" class="table datatable table-bordered">
                                      <thead>
                                        <tr>
                                          <th colspan="2"  class="table-danger">MAKLUMAT PEMOHON</th>
                                        </tr>
                                      </thead>
                                      <tbody>

                                        <?php $num = 0; ?>
                                        <?php foreach ($result_individu as $row) { ++$num; ?> 
                                        <?php //dbug($row->px01warga); ?>

                                          <?php if(!empty($row->px01matrik)){ ?>
                                            <tr>
                                              <th width="20%">No.Matrik</th>
                                              <td><span class="badge badge-primary"><?php echo $row->px01matrik; ?></span></td>
                                            </tr>
                                          <?php } ?>

                                          <tr>
                                            <th>No.KP/Pasport</th>
                                            <td><?php echo $row->px01kpkini; ?></td>
                                          </tr>

                                          <tr>
                                            <th>Nama</th>
                                            <td><?php echo $row->px01nama; ?></td>
                                          </tr>

                                          <tr>
                                            <th>Emel</th>
                                            <td><?php echo $row->px01email; ?></td>
                                          </tr>

                                          <tr>
                                            <th>No.Telefon</th>
                                            <td><?php echo $row->px01handphon; ?></td>
                                          </tr>

                                          <?php if(!empty($row->px01idagen)){ ?>
                                            <tr>
                                              <th>Agen</th>
                                              <td><?php echo $row->px01idagen; ?></td>
                                            </tr>
                                          <?php } ?>

                                          <?php

                                          if($row->px01stsdaftar == 'D'){

                                            $nomatrik = trim($row->px01matrik);

                                            $get_px08=$this->pengesahan_m->get_online_px08fbiodata($nomatrik);

                                            if(!empty($get_px08)){

                                              $pdpbx = $get_px08[0]->px08tkhpdpb;
                                              $tkhpdpb = date("d F Y", strtotime($pdpbx));

                                            }else{
                                              $tkhpdpb = "";
                                            }
                                            ?>

                                            <tr>
                                              <th>Tarikh PDPB</th>
                                              <td><?php if($tkhpdpb != ''){
                                                     echo date("d-m-Y",strtotime($tkhpdpb));
                                                  }?>
                                                      
                                              </td>
                                            </tr>

                                            <tr>
                                              <th>Cetak slip</th>
                                              <td>
                                                  
                                                <?php $parametercetak = $nomatrik;  //dbug($parametercetak);?>
                                                <a name="btn_surat" href="<?php echo base_url('prospek/cetak_slip_pengesahan/'.$this->encryption->encrypt($parametercetak)); ?>" class="btn btn-primary btn-xs" role="button" target="_blank">
                                                <i class="fa fa-print" aria-hidden="true"></i> <?= $this->lang->line('cetakslip_daftar'); ?>
                                                </a>

                                              </td>
                                            </tr>

                                          <?php } ?>

                                        <?php } // end foreach ?>

                                      </tbody>
                                    </table>
                                  


                                  <?php else : ?>

                                    <div class="alert alert-warning" align="center"><strong>Mesej!</strong> Tiada rekod.</div>

                                  <?php endif; ?> <!-- end data_result-->

                                </div>
                              </div>

                            <?php } //isset ?>

                            

                          </form>

                               

                        </div>
                        <!-- end of main_policy_wrapper -->
                    </div>
                    <!-- end of col-md-12 -->
                  </div>
                  <!-- end of row -->

               </section>
               <!-- end of white-smooth-wrapper -->
            </div>
            <!-- end of col-md-12 -->
         </div>
         <!-- end of row -->
      </div>
      <!-- end of container -->
   </section>
   <!-- end of profile-page -->
</div>
<!-- end of content-outer-wrapper -->
<!-- end template -->


<script type="text/javascript">
  $(document).ready(function() {
      $('#example').DataTable();
  } );
</script>