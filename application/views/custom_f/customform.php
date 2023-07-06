<?php $this->load->view('templates/layout_dashboard.php');  ?>

<?php

$session_ukmper = $this->session->userdata('session_ukmper');
//$data_peribadi = $this->auth_m->get_data_peribadi($session_ukmper['ukmper']);
//$this->template->set('data_peribadi', $data_peribadi);
//dbug($arr['ukmper']);die();

$nama = $session_ukmper['fullname'];

/*if (!empty($data_peribadi)) {

    $nama = $data_peribadi[0]->nama;
}*/
?>
<style>
    input[type=text]:enabled {
        background: #FFFFFF;
        font-weight: 500;
    }
    input[type=text]:disabled {
        background: #FFFFFF;

    }
    .no-border {
        border: 0;
        box-shadow: none; /* You may want to include this as bootstrap applies these styles too */
    }
</style>



<!--Main container start -->
<main class="ttr-wrapper">
    <div class="container-fluid">
        <div class="db-breadcrumb">
            <h4 class="breadcrumb-title">Detail Application</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="<?= base_url('urusetia_sp/dash_adminsp') ?>"><i class="fa fa-home"></i>Dashboard</a></li>
                <li><a href="<?= base_url('urusetia_sp/semak_sp') ?>">Application Review</a></li>
                <li>Detail Application</li>
            </ul>
        </div>
        <div class="row">
          <?php if ($this->session->flashdata('mesej')) { ?>
            <div class="<?php echo $this->session->flashdata('mesej_css'); ?>" role="alert" id="mesej-alert" style="font-family: unset;">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <center><?php echo $this->session->flashdata('mesej'); ?></center>
              <center><?php echo $this->session->flashdata('webservice'); ?></center>
            </div>

          <?php } ?>

            <!-- Your Profile Views Chart -->
            <div class="col-lg-12 m-b30">
                <div class="widget-box">
                    <div class="wc-title">
                        <h4>Applicant Details</h4>
                    </div>
                    <div class="widget-inner edit-profile">
                            <div class="row">
                                <div class="col-12">
                                    <div class="ml-auto m-b5">
                                        <h3>1. Applicant Info</h3>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <div>
                                        <label class="col-form-label">Course Code</label>
                                        <div>
                                            <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?=$course[0]->idnumber;?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <div>
                                        <label class="col-form-label">Course Name</label>
                                        <div>
                                            <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="<?=$course[0]->cname;?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Full Name</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" id="txt_name" name="txt_name" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">IC Number/Passport No</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" id="txt_icno" name=="txt_icno" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Email</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" id="txt_email" name="txt_email" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Phone Number</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" id="txt_phonenumber" name="txt_phonenumber" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label">Address</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="" disabled>
                                    </div><br>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="" disabled>
                                    </div><br>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">City</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">State</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Postcode</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label">Country</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" value="" disabled>
                                    </div>
                                </div>

                                <div class="seperator"></div>

                                <div class="col-12 m-t20">
                                    <div class="ml-auto m-b5">
                                        <h3>2. Education</h3>
                                    </div>
                                </div>
                                <div class="form-group col-6 m-t20">
                                    <label class="col-form-label">Higher Education</label>
                                    <div>
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
                                <div class="form-group col-6 m-t20">
                                    <label class="col-form-label">Name of Certificate/Program of Study</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="text" id="txt_higheredu" name="txt_higheredu" value="" disabled>
                                    </div>
                                </div>

                                <div class="form-group col-6 m-t20">
                                    <label class="col-form-label">Academic Certificate</label>
                                    <div>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="file" id="txt_higheredu" name="txt_higheredu" value="" disabled>
                                    </div>
                                </div>

                                <?php

                                if($customform) { ?>

                                  <div class="seperator"></div>

                                  <div class="col-12 m-t20">
                                      <div class="ml-auto m-b5">
                                          <h3>3. Others</h3>
                                      </div>
                                  </div>

                                  <?php
                                  foreach ($customform as $form) {
                                ?>
                                <div class="form-group col-6 m-t20">
                                    <label class="col-form-label"><?=$form->title;?></label>
                                    <div>
                                        <?php if($form->type != 'textarea' && $form->type != 'checkbox' && $form->type != 'radio') { ?>
                                        <input class="form-control shadow-sm p-3 bg-white rounded" type="<?=$form->type;?>" id="<?=$form->shortname;?>" name="<?=$form->shortname;?>" value="" disabled>

                                      <?php } else if($form->type == 'textarea') { ?>
                                        <textarea class="form-control shadow-sm p-3 bg-white rounded" id="<?=$form->shortname;?>" name="<?=$form->shortname;?>" disabled></textarea>
                                      <?php } else if($form->type == 'checkbox' || $form->type == 'radio') { ?>
                                        <?php
                                        $array = json_decode($form->value);

                                        foreach ($array as $key => $value) { ?>

                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="<?=$form->type;?>" name="<?=$form->shortname;?>[]" id="<?=$key;?>" value="<?=$value;?>" disabled>
                                            <label class="form-check-label" for="<?=$key;?>"><?=$value;?></label>
                                          </div>

                                         <?php } ?>
                                      <?php }?>
                                      </div>
                                    </div>
                              <?php
                                  }
                                } ?>

                              </div>
                            </div>
                          </div>
                        </div>
                          <div class="col-lg-12 m-b30">
                              <div class="widget-box">

                              <form class="edit-profile m-b30" action="" method="post">
                                  <div class="wc-title">
                                      <h4>Application Custom Form</h4>
                                  </div>
                                  <div class="widget-inner">

                                  <div class="seperator"></div>

                                  <div class="row">
                                    <div class="col-12 m-t20">
                                      <div class="ml-auto m-b5">
                                        <h3>1. Application Method</h3>
                                      </div>
                                    </div>
                                    <div class="form-group col-12 m-t20" style="margin-bottom: 0px;margin-left: -15px;text-decoration: underline;">
                                      <div class="col-12">
                                        <small><i>Faculty/Admin must verify first before payment</i></small>
                                      </div>
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="col-form-label">Validation By Faculty ?  <span class="text-red">*</span></label>
                                        <div class="col-12">
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="txt_validate" id="txt_validate1" value="yes" <?php if($getForm && $getForm[0]->semakfakulti == 'yes') { echo 'checked'; } ?> required>
                                            <label class="form-check-label" for="txt_validate1">Yes</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="txt_validate" id="txt_validate2" value="no" <?php if($getForm && $getForm[0]->semakfakulti == 'no') { echo 'checked'; } ?>>
                                            <label class="form-check-label" for="txt_validate2">No</label>
                                          </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-2">
                                        <label class="col-form-label">Validation By Admin ?  <span class="text-red">*</span></label>
                                        <div class="col-12">
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="txt_validateadmin" id="txt_validatead1" value="yes" <?php if($getForm && $getForm[0]->semakadmin == 'yes') { echo 'checked'; } ?> required>
                                            <label class="form-check-label" for="txt_validatead1">Yes</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="txt_validateadmin" id="txt_validatead2" value="no" <?php if($getForm && $getForm[0]->semakadmin == 'no') { echo 'checked'; } ?>>
                                            <label class="form-check-label" for="txt_validatead2">No</label>
                                          </div>
                                        </div>
                                    </div>

                                    <div class="seperator"></div>

                                    <div class="col-12 m-t20">
                                      <div class="ml-auto m-b5">
                                        <h3>2. Payment Method</h3>
                                      </div>
                                    </div>
                                    <div class="form-group col-2 m-t20">
                                        <label class="col-form-label">Include Sponsorship ?  <span class="text-red">*</span></label>
                                        <div class="col-12">
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="txt_sponsor" id="txt_sponsor1" value="yes" <?php if($getForm && $getForm[0]->sponsorship == 'yes') { echo 'checked'; } ?> required>
                                            <label class="form-check-label" for="txt_sponsor1">Yes</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="txt_sponsor" id="txt_sponsor2" <?php if($getForm && $getForm[0]->sponsorship == 'no') { echo 'checked'; } ?> value="no">
                                            <label class="form-check-label" for="txt_sponsor2">No</label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-2 m-t20">
                                        <label class="col-form-label">Include Installment ?  <span class="text-red">*</span></label>
                                        <div class="col-12">
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="txt_installment" id="txt_installment1" value="yes" <?php if($getForm && $getForm[0]->installment == 'yes') { echo 'checked'; } ?> required>
                                            <label class="form-check-label" for="txt_installment1">Yes</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="txt_installment" id="txt_installment2" value="no" <?php if($getForm && $getForm[0]->installment == 'no') { echo 'checked'; } ?>>
                                            <label class="form-check-label" for="txt_installment2">No</label>
                                          </div>
                                        </div>
                                    </div>
                                    <?php
                                    $deposit = 0;
                                    $ins_1 = 0;
                                    $ins_2 = 0;
                                    $ins_3 = 0;
                                    $displayinstallment = '';

                                    if($getForm) {
                                      $deposit = $getForm[0]->deposit;
                                      $ins_1 = $getForm[0]->ins_1;
                                      $ins_2 = $getForm[0]->ins_2;
                                      $ins_3 = $getForm[0]->ins_3;
                                    } else {
                                      $displayinstallment = 'disabled';
                                    }

                                    $price = 0;
                                    $pricedisplay = 0;
                                    $html_table = $course[0]->csummary;
                                    if($html_table) {
                                      $html = str_get_html($html_table); // Parse the HTML, stored as a string in $string

                                      $rows = $html->find('tr'); // Find all rows in the table
                                      if($rows) {

                                      	//Loop through each row
                                      	foreach ($rows as $row) {
                                      	    //Loop through each child (cell) of the row
                                      	    $i = 0;
                                      	    $checkkredit = false;
                                      	    foreach ($row->children() as $cell) {
                                      	        if(strpos($cell->plaintext, 'RM') !== false) {
                                      						$str = '';
                                      						$str = strstr($cell->plaintext, 'RM', true);
                                      						if($str) {
                                      							$price = str_replace($str.'RM','',$cell->plaintext);
                                      							$price = strstr($price, '/', true);
                                      							$pricedisplay = $price; //str_replace($str.'RM','',$cell->plaintext);
                                      						} else {
                                                    $price = str_replace('RM','',$cell->plaintext);
                                      							$pricedisplay = str_replace('RM','',$cell->plaintext);
                                      						}

                                      	        }
                                      	        $i++;
                                      	         // Display the contents of each cell - this is the value you want to extract
                                      	    }
                                      	}
                                      }
                                    }

                                    ?>

                                    <div class="form-group col-12">
                                      <label class="col-form-label">Installment (if needed)</label>
                                      <table id="tbl_list" class="table table-bordered rounded shadow-sm p-3 bg-white rounded">
                                        <thead>
                                          <tr>
                                            <th style="font-weight: 500; text-align:center;">TOTAL COURSE(RM)</th>
                                            <th style="font-weight: 500; text-align:center;"><?=$pricedisplay;?></th>
                                          </tr>
                                          <tr>
                                            <th style="font-weight: 500; text-align:center;">DEPOSIT(RM)</th>
                                            <th style="font-weight: 500; text-align:center;">FIRST PAYMENT(RM)</th>
                                            <th style="font-weight: 500; text-align:center;">SECOND PAYMENT(RM)</th>
                                            <th style="font-weight: 500; text-align:center;">THIRD PAYMENT(RM)</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td style="font-weight: 500; text-align:center;"><input type="number" name="txt_deposit" value="<?=$deposit;?>" <?php echo $displayinstallment; ?>></td>
                                            <td style="font-weight: 500; text-align:center;"><input type="number" name="txt_ins1" value="<?=$ins_1;?>" <?php echo $displayinstallment; ?>></td>
                                            <td style="font-weight: 500; text-align:center;"><input type="number" name="txt_ins2" value="<?=$ins_2;?>" <?php echo $displayinstallment; ?>></td>
                                            <td style="font-weight: 500; text-align:center;"><input type="number" name="txt_ins3" value="<?=$ins_3;?>" <?php echo $displayinstallment; ?>></td>
                                          </tr>
                                          <!-- <tr>
                                            <td colspan="2" style="font-weight: 500; text-align:right;">CURRENT PAYMENT</td>
                                            <td style="text-align:center;"><input class="form-control no-border" type="text" id="txt_currentpayment" name="txt_currentpayment" style="font-weight: 500; text-align:center;" value="0" readonly></td>
                                          </tr>
                                          <tr>
                                            <td colspan="2" style="font-weight: 500; text-align:right;">BALANCE PAYMENT</td>
                                            <td style="text-align:center;"><input class="form-control no-border" type="text" id="txt_balancepayment" name="txt_balancepayment" style="font-weight: 500; text-align:center;" value="0" readonly></td>
                                          </tr> -->
                                        </tbody>
                                      </table>
                                    </div>


                                  <div class="col-12 m-t20">
                                    <div class="ml-auto m-b5">
                                      <h3>3. Add Custom Field</h3>
                                    </div>
                                  </div>
                                  <div class="form-group col-6 m-t20">
                                      <div>
                                          <label class="col-form-label">Create New</label>

                                      </div>
                                  </div>
                                  <?php if($custom_field) { ?>
                                  <div class="col-12">
                										<table id="item-add" style="width:100%;">

                                      <?php if($customformloop) {
                                        foreach ($customformloop as $loop) { ?>
                                          <tr class="list-item">
                    												<td>
                    													<div class="row">
                    														<div class="col-md-2">
                    															<label class="col-form-label">Title</label>
                    															<div>
                                                    <input class="form-control" type="hidden" id="txt_form_id" name="txt_form_id[]" value="<?=$loop->idcustomform;?>">
                                                    <select class="form-control" id="txt_label" name="txt_label[]">
                                                      <option value=""></option>
                                                      <?php
                                                      foreach ($custom_field as $row) { ?>
                                                        <option value="<?=$row->custom_id;?>" <?php if($loop->custom_id == $row->custom_id) { echo 'selected'; } ?>><?=$row->title;?></option>
                                                      <?php } ?>
                                                    </select>
                    															</div>
                    														</div>
                    														<div class="col-md-2">
                    															<label class="col-form-label">Type</label>
                    															<div>
                                                    <input class="form-control" type="text" id="txt_type" name="txt_type[]" value="<?=$loop->type;?>" disabled>
                    															</div>
                    														</div>
                    														<div class="col-md-2">
                    															<label class="col-form-label">Shortname</label>
                                                  <small></small>
                    															<div>
                    																<input class="form-control" type="text" id="txt_shortname" name="txt_shortname[]" value="<?=$loop->shortname;?>" disabled>
                    															</div>
                    														</div>
                                                <div class="col-md-2">
                    															<label class="col-form-label">Value</label>
                    															<div>
                    																<input class="form-control" type="text" id="txt_value" name="txt_value[]" value='<?=$loop->value;?>' disabled>
                    															</div>
                    														</div>
                                                <div class="col-md-1">
                    															<label class="col-form-label">required ?</label>
                    															<div>
                                                    <input class="form-control" type="text" id="txt_required" name="txt_required[]" value="<?=$loop->required;?>" disabled>
                    															</div>
                    														</div>
                                                <div class="col-md-1">
                    															<label class="col-form-label">Show Field ?</label>
                    															<div>
                                                    <input class="form-control" type="text" id="txt_show" name="txt_show[]" value="<?=$loop->show_field;?>" disabled>
                    															</div>
                    														</div>
                                                <div class="col-md-1">
                    															<label class="col-form-label">Order By</label>
                    															<div>
                                                    <select class="form-control" id="txt_order" name="txt_order[]">
                                                      <?php
                                                        for($no = 1; $no <= count($customformloop); $no++) {
                                                          if($loop->orderby == $no) {
                                                            $selected = 'selected';
                                                          } else {
                                                            $selected = '';
                                                          }
                                                          echo '<option value="'.$no.'" '.$selected.'>'.$no.'</option>';
                                                        }
                                                      ?>
                                                    </select>
                    															</div>
                    														</div>
                    														<div class="col-md-1">
                    															<label class="col-form-label">Close</label>
                    															<div class="form-group">
                    																<a class="delete" href="#"><i class="fa fa-close"></i></a>
                    															</div>
                    														</div>
                    													</div>
                    												</td>
                    											</tr>
                                      <?php }
                                      } ?>

                											<tr class="list-item">
                												<td>
                													<div class="row">
                														<div class="col-md-2">
                															<label class="col-form-label">Title</label>
                															<div>
                                                <select class="form-control" id="txt_label" name="txt_label[]">
                                                  <option value=""></option>
                                                  <?php

                                                  foreach ($custom_field as $row) { ?>
                                                    <option value="<?=$row->custom_id;?>"><?=$row->title;?></option>
                                                  <?php } ?>
                                                </select>
                															</div>
                														</div>
                														<div class="col-md-2">
                															<label class="col-form-label">Type</label>
                															<div>
                                                <input class="form-control" type="text" id="txt_type" name="txt_type[]" value="" disabled>
                															</div>
                														</div>
                														<div class="col-md-2">
                															<label class="col-form-label">Shortname</label>
                                              <small></small>
                															<div>
                																<input class="form-control" type="text" id="txt_shortname" name="txt_shortname[]" value="" disabled>
                															</div>
                														</div>
                                            <div class="col-md-2">
                															<label class="col-form-label">Value</label>
                															<div>
                																<input class="form-control" type="text" id="txt_value" name="txt_value[]" value="" disabled>
                															</div>
                														</div>
                                            <div class="col-md-1">
                															<label class="col-form-label">required ?</label>
                															<div>
                                                <input class="form-control" type="text" id="txt_required" name="txt_required[]" value="" disabled>
                															</div>
                														</div>
                                            <div class="col-md-1">
                															<label class="col-form-label">Show Field ?</label>
                															<div>
                                                <input class="form-control" type="text" id="txt_show" name="txt_show[]" value="" disabled>
                															</div>
                														</div>
                                            <div class="col-md-1">
                                              <label class="col-form-label">Order By</label>
                                              <div>
                                                <select class="form-control" id="txt_order" name="txt_order[]"></select>
                                              </div>
                                            </div>
                														<div class="col-md-1">
                															<label class="col-form-label">Close</label>
                															<div class="form-group">
                																<a class="delete" href="#"><i class="fa fa-close"></i></a>
                															</div>
                														</div>
                													</div>
                												</td>
                											</tr>
                										</table>

                                    <button type="button" class="btn-secondry add-item m-r5"><i class="fa fa-fw fa-plus-circle"></i>Add Item</button>
                									</div>
                                <?php } else { ?>
                                  <div class="col-12">
                                    <a type="button" class="btn red m-r5" href="<?=base_url('/custom/add_custom_field');?>">Add Custom Field</a>
                                  </div>
                                <?php } ?>
                                  <input type="hidden" name="course_id" value="<?=$course_id;?>">

                                  <div class="col-12 m-t100">
                                      <a href="<?=base_url('/custom/custom_list');?>" class="btn-secondry" style="color:#fff;">Back</a>
                                      <input type="submit" class="btn btn-primary" id="submitBtn" name="btn_submit" value="Submit">
                                  </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Your Profile Views Chart END-->
        </div>
    </div>
</main>
<div class="ttr-overlay"></div>

<!-- External JavaScripts -->
<script src='<?php echo base_url('/'); ?>assets/dashboard/js/jquery.min.js'></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/bootstrap/js/popper.min.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/magnific-popup/magnific-popup.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/counter/waypoints-min.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/counter/counterup.min.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/imagesloaded/imagesloaded.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/masonry/masonry.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/masonry/filter.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/owl-carousel/owl.carousel.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/js/functions.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/chart/chart.min.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/js/admin.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/calendar/moment.min.js"></script>
<script src="<?php echo base_url('/'); ?>assets/dashboard/vendors/switcher/switcher.js"></script>
