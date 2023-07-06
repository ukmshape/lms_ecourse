<?php $noinv = ''; $type = ''; ?>

<div class="profile-head">
  <h3>History Purchase</h3>
</div>
<form class="edit-profile" method="post" enctype="multipart/form-data" action="<?php echo $action_save_tab_historypurchase;?>">

  <div class="container">

    <br><br>

        <table id="example" class="table table-striped table-bordered table-responsive">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Order ID</th>
                    <th>Application Date</th>
                    <th>Course</th>
                    <th>Invoice Number</th>
                    <th>Invoice Date</th>
                    <th>Status Payment</th>
                </tr>
            </thead>
            <tbody>
                  <?php
                    if($semakhistorystudorder) {
                      $num = 0;
                      foreach ($semakhistorystudorder as $row) { ?>
                        <tr>
                            <td style="text-align:center; vertical-align:middle;"><?php echo ++$num."."; ?></td>
                            <td style="vertical-align:middle;"><?php echo $row->order_id; ?></td>
                            <td style="text-align:center; vertical-align:middle;">
                              <?php if($row->dated_mc != null) { ?>
                                <?php echo date("d/m/Y", strtotime($row->dated_mc)); ?><br><?php echo date("g:i A", strtotime($row->dated_mc)); ?>
                              <?php } else if($row->dated_sp != null) { ?>
                                <?php echo date("d/m/Y", strtotime($row->dated_sp)); ?><br><?php echo date("g:i A", strtotime($row->dated_sp)); ?>
                              <?php } ?>

                            </td>
                            <td style="text-align:left; vertical-align:middle;">
                                <ol class="ml-4 mb-0">
                                  <?php
                                  if($row->status_mc != null) {
                                    $type = 'MC';
                                  } else if($row->status_sp != null) {
                                    $type = 'SP';
                                  } ?>
                                    <?php
                                    $invoicedetails = $this->student_m->get_param_kursus_by_invoice($row->user_id, $row->order_id, $type);
                                    if($invoicedetails) {
                                    $i = 1;
                                        foreach ($invoicedetails as $value) {
                                           $mdl_courselist = $this->student_m->get_course_detail_mcodlukm($value->kursusid);
                                        ?>
                                            <li><?php /*(<?=$value->kodkursus;?>)<br> */ ?><?=$mdl_courselist[0]->cname;?></li>
                                        <?php
                                        }
                                    }
                                    ?>

                                </ol>
                            </td>
                            <td style="text-align:center; vertical-align:middle;">
                              <?php
                                $noinvoice = $this->student_m->get_data_invoice($row->order_id);
                               ?>
                              <?php if($noinvoice) {
                                $noinv = $noinvoice[0]->noinvoice;
                                echo $noinvoice[0]->noinvoice;
                               } ?>
                            </td>
                            <td style="text-align:center; vertical-align:middle;">
                              <?php if($noinvoice) { ?>
                                <?php echo date("d/m/Y", strtotime($noinvoice[0]->tarikhinvoice)); ?><br><?php echo date("g:i A", strtotime($noinvoice[0]->tarikhinvoice)); ?>
                               <?php } ?>
                            </td>
                            <td style="text-align:center; vertical-align:middle;">
                                <?php
                                if($row->status_mc != null) {
                                  $type = 'MC';
                                  $status_app = $row->status_mc;
                                } else if($row->status_sp != null) {
                                  $type = 'SP';
                                  $status_app = $row->status_sp;
                                }
                                //$liststatus = $this->student_m->get_liststatus($row->status_app);
                                //echo $liststatus[0]->status_id;

                                if($status_app == '3' && ($row->status_fakulti != '5' || $row->status_admin != '5')) {
                                    echo "<span class='text-red font-weight-bold'>Unpaid</span>";
                                } else if($status_app == '9' && ($row->status_fakulti == '5' || $row->status_admin == '5')) {
                                    echo "<span class='text-yellow font-weight-bold'>Application in Process</span>";
                                } else if($status_app == '1' || $status_app == '2') {
                                    echo "<span class='text-red font-weight-bold'>Process Order</span>";
                                } else if($status_app == '9' && ($noinvoice && $noinvoice[0]->status_urus == 5)) {
                                    echo "<span class='text-success font-weight-bold'>Paid</span><br><b>Application in Process</b>";
                                } else if($status_app == '9' && ($noinvoice && $noinvoice[0]->status_urus == 8)) {
                                    echo "<span class='text-success font-weight-bold'>Paid</span><br><b>Payment Incomplete.</b> ".$noinvoice[0]->comment_urus;
                                } else if($status_app == '9' && ($noinvoice && $noinvoice[0]->status_urus == 7)) {
                                    echo "<span class='text-success font-weight-bold'>Paid</span><br><b>Payment Unsuccessful.</b> ".$noinvoice[0]->comment_urus;
                                } else if($status_app != '3') {
                                    echo "<span class='text-success font-weight-bold'>Paid</span>";
                                }

                                // $liststatus1 = $this->urusetiamc_m->get_liststatus($row->ukmpersah_app);
                                // if($liststatus1)
                                //     echo "<br><span class='font-weight-bold'>".$liststatus1[0]->status."</span>";
                                ?>
                            </td>
                        </tr>
                    <?php }
                  } else { ?>
                    <tr><td colspan="8">No Upcoming Bill</td></tr>
                  <?php } ?>
                    <!--<tr>
                        <td>Payment History Microcredential </td>
                    </tr>
                    <?php $num = 0; ?>
                    <?php foreach ($semakhistory_paymentmc as $row) {
                    ++$num; ?>
                    <tr>
                        <td style="text-align:center; vertical-align:middle;"><?php echo $num."."; ?></td>
                        <td style="vertical-align:middle;"><?php echo $row->order_id; ?></td>
                        <td style="text-align:center; vertical-align:middle;"><?php echo date("d/m/Y", strtotime($row->create_dated)); ?><br><?php echo date("g:i A", strtotime($row->create_dated)); ?></td>
                        <td style="text-align:left; vertical-align:middle;">
                            <ol class="ml-4 mb-0">
                                <?php
                                $invoicedetails = $this->student_m->get_param_kursus_by_invoicemc($row->user_id,$row->noinvoice);
                                if($invoicedetails) {
                                $i = 1;
                                    foreach ($invoicedetails as $value) {
                                        $mdl_courselist = $this->student_m->get_course_detail_mcodlukm($value->kursusid);
                                    ?>
                                        <li><?php /*(<?=$value->kodkursus;?>)<br> */ ?><?=$mdl_courselist[0]->cname;?></li>
                                    <?php
                                    }
                                }
                                ?>
                            </ol>
                        </td>
                        <td style="text-align:center; vertical-align:middle;"><?php echo $row->noinvoice; ?></td>
                        <td style="text-align:center; vertical-align:middle;">
                            <?php
                            $liststatus = $this->student_m->get_liststatus($row->status_app);
                            if($liststatus[0]->status_id == '3') {
                                echo "<span class='text-red font-weight-bold'>".$liststatus[0]->status."</span>";
                            } else if($liststatus[0]->status_id == '4') {
                                echo "<span class='text-success font-weight-bold'>".$liststatus[0]->status."</span>";
                            }

                            // $liststatus1 = $this->urusetiamc_m->get_liststatus($row->ukmpersah_app);
                            // if($liststatus1)
                            //     echo "<br><span class='font-weight-bold'>".$liststatus1[0]->status."</span>";
                            ?>
                        </td>
                        <td style="text-align:center; vertical-align:middle;">
                          <?php if($liststatus[0]->status_id == '3') {
                            ?>
                            <a name="detail_pemohon" href="<?php echo base_url('student/payment?type=MC&noinvoice='.$row->noinvoice); ?>" class="btn bg-danger" style="color:white;" title="Action">Pay Now</a>
                          <?php } ?>
                        </td>
                    </tr>
                    <?php }  ?>
                    <tr>
                        <td>Payment History Profesional Certificate </td>
                    </tr>
                    <?php $num = 0; ?>
                    <?php foreach ($semakhistory_paymentsp as $row1) {
                    ++$num; ?>
                    <tr>
                        <td style="text-align:center; vertical-align:middle;"><?php echo $num."."; ?></td>
                        <td style="vertical-align:middle;"><?php echo $row1->order_id; ?></td>
                        <td style="text-align:center; vertical-align:middle;"><?php echo date("d/m/Y", strtotime($row1->create_dated)); ?><br><?php echo date("g:i A", strtotime($row1->create_dated)); ?></td>
                        <td style="text-align:left; vertical-align:middle;">
                            <ol class="ml-4 mb-0">
                                <?php
                                $invoicedetails = $this->student_m->get_param_kursus_by_invoicesp($row1->user_id,$row1->noinvoice);
                                if($invoicedetails) {
                                $i = 1;
                                    foreach ($invoicedetails as $value) {
                                        $mdl_courselist = $this->student_m->get_course_detail_mcodlukm($value->kursusid);
                                    ?>
                                        <li><?php /*(<?=$value->kodkursus;?>)<br> */ ?><?=$mdl_courselist[0]->cname;?></li>
                                    <?php
                                    }
                                }
                                ?>
                            </ol>
                        </td>
                        <td style="text-align:center; vertical-align:middle;"><?php echo $row1->noinvoice; ?></td>
                        <td style="text-align:center; vertical-align:middle;">
                            <?php
                            $liststatus = $this->student_m->get_liststatus($row1->status_app);
                            if($liststatus[0]->status_id == '3') {
                                echo "<span class='text-red font-weight-bold'>".$liststatus[0]->status."</span>";
                            } else if($liststatus[0]->status_id == '4') {
                                echo "<span class='text-success font-weight-bold'>".$liststatus[0]->status."</span>";
                            }

                            // $liststatus1 = $this->urusetiamc_m->get_liststatus($row->ukmpersah_app);
                            // if($liststatus1)
                            //     echo "<br><span class='font-weight-bold'>".$liststatus1[0]->status."</span>";
                            ?>
                        </td>
                        <td style="text-align:center; vertical-align:middle;">
                            <?php if($liststatus[0]->status_id == '3') {
                              ?>
                              <a name="detail_pemohon" href="<?php echo base_url('student/payment?type=SP&noinvoice='.$row1->noinvoice); ?>" class="btn bg-danger" style="color:white;" title="Action">Pay Now</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php }  ?>-->

            </tbody>
            <tfoot>
                <tr>
                    <th>No.</th>
                    <th>Order ID</th>
                    <th>Application Date</th>
                    <th>Course</th>
                    <th>Invoice Number</th>
                    <th>Invoice Date</th>
                    <th>Status Payment</th>
                </tr>
            </tfoot>
        </table>



  </div>



</form>
