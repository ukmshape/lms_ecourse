<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SP extends CI_Controller {

  public function __construct() {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('form');
      $this->load->library('pagination');
      $this->load->library('encrypt');
      $this->load->model('main_m');
      $this->load->model('cart_m');
      //$this->output->enable_profiler(TRUE);
  }

  public function index() {

      $config['base_url'] = site_url('SP/index');
          $config['total_rows'] = $this->main_m->get_mcodlukm_SP_count('');
          $config['per_page'] = "6";
          $config["uri_segment"] = 3;
          $choice = $config["total_rows"]/$config["per_page"];
          $config["num_links"] = floor($choice);

          // integrate bootstrap pagination
          $config['full_tag_open'] = '<ul class="pagination">';
          $config['full_tag_close'] = '</ul>';
          $config['first_link'] = false;
          $config['last_link'] = false;
          $config['first_tag_open'] = '<li>';
          $config['first_tag_close'] = '</li>';
          $config['prev_link'] = '«';
          $config['prev_tag_open'] = '<li class="prev">';
          $config['prev_tag_close'] = '</li>';
          $config['next_link'] = '»';
          $config['next_tag_open'] = '<li>';
          $config['next_tag_close'] = '</li>';
          $config['last_tag_open'] = '<li>';
          $config['last_tag_close'] = '</li>';
          $config['cur_tag_open'] = '<li class="active"><a href="#">';
          $config['cur_tag_close'] = '</a></li>';
          $config['num_tag_open'] = '<li>';
          $config['num_tag_close'] = '</li>';
          $this->pagination->initialize($config);

          $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

          // get books list
          $course = $this->main_m->get_mcodlukm_SP($config["per_page"], $page, NULL);

          $pagination = $this->pagination->create_links();

          $this->template->set('page', $page);
          $this->template->set('course', $course);
          $this->template->set('pagination', $pagination);


      $this->template->render('main_f/course-list-sp');
  }

  public function search() {
    // get search string
        $search = ($this->input->post("course_name"))? $this->input->post("course_name") : "NIL";

        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

        // pagination settings
        $config = array();
        $config['base_url'] = site_url("SP/search/$search");
        $config['total_rows'] = $this->main_m->get_mcodlukm_SP_count($search);
        $config['per_page'] = "6";
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        // get books list
        $course = $this->main_m->get_mcodlukm_SP($config['per_page'], $page, $search);

        $pagination = $this->pagination->create_links();

        $this->template->set('page', $page);
        $this->template->set('course', $course);
        $this->template->set('pagination', $pagination);

        $this->template->render('main_f/course-list-sp');
  }


  public function carts_next_1()
	{
    if($this->session->userdata('session_student')) {
      if(!$this->session->userdata('inv_no')) {
        $data_pelajar = $this->main_m->get_data_pelajar($this->session->userdata('session_student')['user_id']);
        $this->template->set('data_pelajar', $data_pelajar);
        $order_id = $this->session->userdata('order_no');

        $getKursus = $this->main_m->get_data_order_sp($order_id);
        $getForm = $this->main_m->get_customformfixed($getKursus[0]->kursusid);

        $this->template->set('order_id',$order_id);
        $this->template->set('order_sp',$getKursus);
        $this->template->set('getForm',$getForm);

        if($this->input->post('txt_submit') != null) {
          $price = 0;
          $statusorder = 0;
          $statusorderansuran = 0;

          if(!empty($_FILES["txt_academicfile"]['name'])) {
            if(!is_dir('documents/'.$this->session->userdata('session_student')['user_id'])){
                if (!mkdir('documents/'.$this->session->userdata('session_student')['user_id'], 0777, TRUE)) {//0777
                    echo '<b>Failed to upload files</b>.';
                } else {
                  chmod('documents/'.$this->session->userdata('session_student')['user_id'], 0777);
                }
            }

            $config['upload_path'] = './documents/'.$this->session->userdata('session_student')['user_id'];
            $config['allowed_types'] = 'jpg|jpeng|png|docx|doc|pdf';
            $new_name = 'academic';
            $path = $_FILES["txt_academicfile"]['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $config['file_name'] = $new_name.'.'.$ext;
            echo $config['upload_path'].$config['file_name'];
            if (file_exists($config['upload_path'].'/'.$config['file_name'])) {
              unlink($config['upload_path'].'/'.$config['file_name']);
            }

            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            if(!$this->upload->do_upload("txt_academicfile")) {
              echo '<b>'.$this->upload->display_errors().'</b>.';
            }
          }

          $data = array(
            'user_id' => $this->session->userdata('session_student')['user_id'],
            'nokp' => $this->input->post('txt_kpkini'),
            'nama' => $this->input->post('txt_name'),
            'alamat1' => $this->input->post('txt_alamat1'),
            'alamat2' => $this->input->post('txt_alamat2'),
            'alamat3' => $this->input->post('txt_alamat3'),
            'bandar' => $this->input->post('txt_city'),
            'negeri' => $this->input->post('txt_state'),
            'poskod' => $this->input->post('txt_poscode'),
            'negara' => $this->input->post('txt_country'),
            'notel' => $this->input->post('txt_tel'),
            'emel' => $this->input->post('txt_emel'),
            'akadtertinggi' => $this->input->post('txt_academic'),
            'nmsijil' => $this->input->post('txt_nmacademic')
          );

          $update = $this->main_m->update_data_pelajar($data);

          if($this->input->post('txt_sponsor') != null && $this->input->post('txt_sponsor') == 'Sponsorship') {
            $price = 0;
            $dataPersonalSponsor = array(
              'user_id' => $this->session->userdata('session_student')['user_id'],
              'nmsyrkt' => $this->input->post('txt_cmpynm'),
              'notelsyrkt' => $this->input->post('txt_cmpytel'),
              'emelsyrkt' => $this->input->post('txt_cmpyemail')
            );

            $getpelajarsponsor = $this->main_m->get_data_pelajar($this->session->userdata('session_student')['user_id']);
            if($getpelajarsponsor->nmsyrkt != null) {
              $update = $this->main_m->update_data_pelajar_sponsor($dataPersonalSponsor);
            } else {
              $update = $this->main_m->insert_data_pelajar_sponsor($dataPersonalSponsor);
            }
          } else if($this->input->post('txt_sponsor') == null || $this->input->post('txt_sponsor') == 'Own') {
            $price = $this->input->post('txt_unitprice');
            $statusorder = 3;
            if($this->input->post('txt_ansuran') == 'yes') {
              $price = $this->input->post('txt_deposit');
              $statusorderansuran = 3;
              if($price < 0 ) {
                $statusorder = 4;
              }
            }
          } else {
            $statusorder = 3;
          }


          $customform = $this->main_m->get_customform($getKursus[0]->kursusid);

          if($customform) {

            foreach ($customform as $form) {
              $values = '';
              if($form->type == 'checkbox') {
                $values = json_encode($this->input->post($form->shortname));
              } else if($form->type == 'file') {
                if(!empty($_FILES["$form->shortname"]['name'])) {
                  if(!is_dir('documents/'.$this->session->userdata('session_student')['user_id'])){
                      if (!mkdir('documents/'.$this->session->userdata('session_student')['user_id'], 0777, TRUE)) {//0777
                          echo '<b>Failed to upload files</b>.';
                      } else {
                        chmod('documents/'.$this->session->userdata('session_student')['user_id'], 0777);
                      }
                  }

                  $config['upload_path'] = './documents/'.$this->session->userdata('session_student')['user_id'];
                  $config['allowed_types'] = 'jpg|jpeng|png|docx|doc|pdf';
                  $new_name = $form->shortname;
                  $path = $_FILES["$form->shortname"]['name'];
                  $ext = pathinfo($path, PATHINFO_EXTENSION);
                  $config['file_name'] = $new_name.'.'.$ext;
                  if (file_exists($config['upload_path'].'/'.$config['file_name'])) {
                    unlink($config['upload_path'].'/'.$config['file_name']);
                  }

                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                  if(!$this->upload->do_upload("$form->shortname")) {
                    echo '<b>'.$this->upload->display_errors().'</b>.';
                  } else {
                    $values = $form->shortname;
                  }
                } else {
                  $values = $form->shortname;
                }

              } else {
                $values = $this->input->post($form->shortname);
              }

              $dataCustomForm = array(
                  'user_id' => $this->session->userdata('session_student')['user_id'],
                  'form_id' => $form->form_id,
                  'value' => $values
              );

              if($this->main_m->get_customformPemohon($form->form_id,$this->session->userdata('session_student')['user_id'])) {
                $this->cart_m->update_customformPemohon($dataCustomForm);
              } else {
                $this->cart_m->insert_customformPemohon($dataCustomForm);
              }
            }
          }

          if($this->input->post('txt_semakfakulti') && $this->input->post('txt_semakfakulti') == 'yes') {
            $dataOrderSP = array(
              'ordersp_id' => $order_id,
              'jnspmbyrn' => $this->input->post('txt_sponsor'),
              'ansuran' => $this->input->post('txt_ansuran'),
              'status_payment1' => $statusorderansuran,
              'status_payment2' => $statusorderansuran,
              'status_payment3' => $statusorderansuran,
              'status_app' => 9,
              'status_fakulti' => 5,
              'status_deposit' => $statusorder
            );

            $this->cart_m->update_data_order_sp($dataOrderSP);
        } else if($this->input->post('txt_semakadmin') && $this->input->post('txt_semakadmin') == 'yes') {
          $dataOrderSP = array(
            'ordersp_id' => $order_id,
            'jnspmbyrn' => $this->input->post('txt_sponsor'),
            'ansuran' => $this->input->post('txt_ansuran'),
            'status_payment1' => $statusorderansuran,
            'status_payment2' => $statusorderansuran,
            'status_payment3' => $statusorderansuran,
            'status_app' => 9,
            'status_admin' => 5,
            'status_deposit' => $statusorder
          );

          $this->cart_m->update_data_order_sp($dataOrderSP);

        } else {
          $dataOrderSP = array(
            'ordersp_id' => $order_id,
            'jnspmbyrn' => $this->input->post('txt_sponsor'),
            'ansuran' => $this->input->post('txt_ansuran'),
            'status_payment1' => $statusorderansuran,
            'status_payment2' => $statusorderansuran,
            'status_payment3' => $statusorderansuran,
            'status_app' => 3,
            'status_deposit' => $statusorder
          );

          $this->cart_m->update_data_order_sp($dataOrderSP);
        }
          if($this->input->post('txt_semakfakulti') && $this->input->post('txt_semakfakulti') == 'yes') {

            redirect('/SP/carts/done');

          } else {
            //////// INV /////////
            $noinv = '';
            $createinv = 'INVS'.date('Y').'-'; //INVS2022-0001
            $invlast = $this->cart_m->get_data_invoice($createinv);

            $length = 4;
            $char = 0;
            $type = 'd';
            $format = "%{$char}{$length}{$type}"; // or "$010d";

            if($invlast) {
              $nom = str_replace('INVS'.date('Y').'-','',$invlast[0]->noinvoice);
              $newNom = sprintf($format, ($nom+1));
              $noinv = $createinv.$newNom;
            } else {
              $noinv = $createinv.'0001';
            }

            $input_inv = array (
              'noinvoice' => $noinv,
              'order_id' => $order_id,
              'order_type' => 'SP',
              'user_id' => $this->session->userdata('session_student')['user_id'],
              'total' => $price,
              'notification' => 0,
              'tarikhinvoice' => date('Y-m-d H:i:s')
            );

            $insert_data_invoice = $this->cart_m->insert_data_invoice($input_inv);
            //////// INV /////////

            if($price > 0) {
              $status_app = 3;
            }  else {
              $status_app = 9;
            }

            $dataOrderSP = array(
              'ordersp_id' => $order_id,
              'status_app' => $status_app
            );

            $this->cart_m->update_data_order_sp($dataOrderSP);

            if($insert_data_invoice) {
              $this->session->set_userdata('inv_no', $noinv);
              if($price > 0) {
                redirect('SP/carts/payment');
              } else {
                redirect('SP/carts/done');
              }
            } else {
              $echo =  base_url('/SP/carts/personaldetail');
              echo "<script>alert('Please try again.');
                      window.location.href = '".$echo."'
                  </script>";
            }
          }

        }

        $this->template->set('script_content','main_f/script/script-personal-details-sp');
        $this->template->render('main_f/personal-details-sp');
      } else {
        if($price > 0) {
          redirect('SP/carts/payment');
        } else {
          redirect('SP/carts/done');
        }
      }
    } else {
      redirect('main/signin');
    }
	}


  public function checkout_PO() {

    $insert_data = array(
      'user_id' => $this->session->userdata('session_student')['user_id'],
      'kursusid' => $this->input->post('kursusid'),
      'kodkursus' => $this->input->post('kodkursus'),
      'namakursus' => $this->input->post('nmkursus'),
      'tarikhmula' => date("Y-m-d", $this->input->post('tarikhmula')),
      'tarikhtamat' => date("Y-m-d", $this->input->post('tarikhtamat')),
      'kredit' => $this->input->post('kredit'),
      'price' => $this->input->post('price'),
      'qty' => 1
    );

    //insert data_cart
    $input_data_cart = array (
      'user_id' => $this->session->userdata('session_student')['user_id']
    );
    $insert_data_cart = $this->cart_m->insert_data_cart($input_data_cart);
    //end insert data_cart
    $idcart = $insert_data_cart;

    //insert param_kursus
    $input_kursus = array (
      'idcart' => $idcart,
      'kursusid' => $this->input->post('kursusid'),
      'kodkursus' => $this->input->post('kodkursus'),
      'namakursus' => $this->input->post('nmkursus'),
      'tarikhmula' => date("Y-m-d", $this->input->post('tarikhmula')),
      'tarikhtamat' => date("Y-m-d", $this->input->post('tarikhtamat')),
      'unitprice' => $this->input->post('price')
    );
    $insert_param_kursus = $this->cart_m->insert_param_kursus($input_kursus);
    //end insert param_kursus

    $noPO = '';
    $createinv = 'POS'.date('Y').'-'; //POS2022-0001
    $invlast = $this->cart_m->get_data_order_sp();

    $length = 4;
    $char = 0;
    $type = 'd';
    $format = "%{$char}{$length}{$type}"; // or "$010d";

    if($invlast) {
      $nom = str_replace('POS'.date('Y').'-','',$invlast[0]->order_id);
      $newNom = sprintf($format, ($nom+1));
      $noPO = $createinv.$newNom;
    } else {
      $noPO = $createinv.'0001';
    }

    //insert data_order_sp
    $input_inv = array (
      'ordersp_id' => $noPO,
      'kursusid' => $this->input->post('kursusid'),
      'totalprice' => $this->input->post('price'),
      'status_payment1' => 2,
      'status_payment2' => 2,
      'status_payment3' => 2,
      'status_deposit' => 2,
      'status_app' => 2,
      'create_dated' => date('Y-m-d H:i:s')
    );

    $insert_data_order_sp = $this->cart_m->insert_data_order_sp($input_inv);
    //end insert data_order_sp

    if($insert_data_order_sp) {

      $input_inv = array (
        'idcart' => $idcart,
        'order_id' => $noPO
      );
      $this->cart_m->update_data_cart($input_inv);

      $this->session->set_userdata('order_no', $noPO);

      $session_student = $this->session->userdata('session_student');
      $session_student['carttotal'] = count($this->cart_m->get_data_cart($this->session->userdata('session_student')['user_id']));

      $this->session->unset_userdata('session_student');
      $this->session->set_userdata('session_student', $session_student);

      redirect('SP/carts/personaldetail');
    } else {
      echo 'error';
    }

  }


  public function payment() {

    if($this->session->userdata('session_student')) {

      if($this->input->post('btn_submitPay') != null) {

        if(!empty($_FILES["resit_upload"]['name'])) {
          if(!is_dir('documents/'.$this->session->userdata('session_student')['user_id'])) {
              if (!mkdir('documents/'.$this->session->userdata('session_student')['user_id'], 0777, TRUE)) {//0777
                  echo '<b>Failed to upload files</b>.';
              } else {
                chmod('documents/'.$this->session->userdata('session_student')['user_id']);
              }
          }

          $config['upload_path'] = './documents/'.$this->session->userdata('session_student')['user_id'];
          $config['allowed_types'] = 'jpg|jpeng|png|docx|doc|pdf';
          $new_name = $this->input->post('txt_inv_no');
          $path = $_FILES["resit_upload"]['name'];
          $ext = pathinfo($path, PATHINFO_EXTENSION);
          $config['file_name'] = $new_name.'.'.$ext;
        //  echo $config['upload_path'].$config['file_name'];
          if (file_exists($config['upload_path'].'/'.$config['file_name'])) {
             unlink($config['upload_path'].'/'.$config['file_name']);
          }

          $this->load->library('upload',$config);
          $this->upload->initialize($config);
          if(!$this->upload->do_upload("resit_upload")) {
            echo '<b>'.$this->upload->display_errors().'</b>.';
          } else {
            $upload_data = $this->upload->data();
            $attch_file = str_replace('/var/www/html/ecourse/','',$upload_data['full_path']);
          }
        }

        $getOrderSP = $this->main_m->get_data_invoice_sp($this->input->post('txt_inv_no'));

        if($getOrderSP) {
          $customform = $this->main_m->get_customform($getOrderSP[0]->kursusid);
          
          if($customform[0]->deposit == $getOrderSP[0]->total) {
            $statusdeposit = 4;
          } else {
            $statusdeposit = $getOrderSP[0]->status_deposit;
          }
          if($customform[0]->ins_1 == $getOrderSP[0]->total) {
            $status_payment1 = 4;
          } else {
            $status_payment1 = $getOrderSP[0]->status_payment1;
          }
          if($customform[0]->ins_2 == $getOrderSP[0]->total) {
            $status_payment2 = 4;
          } else {
            $status_payment2 = $getOrderSP[0]->status_payment2;
          }
          if($customform[0]->ins_3 == $getOrderSP[0]->total) {
            $status_payment3 = 4;
          } else {
            $status_payment3 = $getOrderSP[0]->status_payment3;
          }

          if($getOrderSP[0]->jnspmbyrn == 'Own' || $getOrderSP[0]->jnspmbyrn == '') {
            $statusdeposit = 4;
            if($getOrderSP[0]->ansuran == 'yes' || $getOrderSP[0]->status_deposit != '4') {
              $statusdeposit = 4;
            } else if($getOrderSP[0]->ansuran == 'yes' || $getOrderSP[0]->status_payment1 != '4') {
              $status_payment1 = 4;
            } else if($getOrderSP[0]->ansuran == 'yes' || $getOrderSP[0]->status_payment2 != '4') {
              $status_payment2 = 4;
            } else if($getOrderSP[0]->ansuran == 'yes' || $getOrderSP[0]->status_payment3 != '4') {
              $status_payment3 = 4;
            }
          }
        }

        // urus = Waiting for Verification
        $dataInvoiceSP = array(
          'noinvoice' => $this->input->post('txt_inv_no'),
          'status_urus' => 5,
          'tarikhpayment' => date('Y-m-d H:i:s'),
          'files' => $config['file_name'],
          'notification' => 1
        );

        $update_data = $this->cart_m->update_data_invoice($dataInvoiceSP);
        //checking tauuuuu
        /* if($this->input->post('txt_semakfakulti') && $this->input->post('txt_semakfakulti') == 'yes') {
          redirect('/SP/carts/done');
        } else {
          $this->session->set_userdata('inv_no', $noinv);
          redirect('SP/carts/payment');
        } */

        // app = Paid
        $dataOrderSP = array(
          'ordersp_id' => $getOrderSP[0]->ordersp_id,
          'status_payment1' => $status_payment1,
          'status_payment2' => $status_payment2,
          'status_payment3' => $status_payment3,
          'status_deposit' => $statusdeposit,
          'status_app' => 4
        );

        $update_data_invoice = $this->cart_m->update_data_order_sp($dataOrderSP);

        if($update_data_invoice) {
          $echo =  base_url('/SP/carts/complete');
          echo "<script>
                  window.location.href = '".$echo."'
               </script>";
        } else {
          echo "<script>alert('Please try again.');
                  location.reload();'
               </script>";
        }
      }


      $data_pelajar = $this->main_m->get_data_pelajar($this->session->userdata('session_student')['user_id']);
      $this->template->set('data_pelajar', $data_pelajar);
      $inv_no = $this->session->userdata('inv_no');

      $this->template->set('type', 'SP');
      $dataorderSP = $this->main_m->get_data_invoice_sp($inv_no);

      if($dataorderSP[0]->jnspmbyrn == 'Sponsorship') {
        //done!
        redirect('main/index');
      } else if($dataorderSP[0]->ansuran == 'yes') {
        $customfixed = $this->main_m->get_customformfixed($dataorderSP[0]->kursusid);
        if($customfixed) {
          if($customfixed[0]->installment == 'yes') {
              if($dataorderSP[0]->status_deposit == '3') {
                $this->template->set('totalprice',$customfixed[0]->deposit);
              } else if($dataorderSP[0]->status_deposit != '3' ) {
                $this->template->set('totalprice',$customfixed[0]->deposit);
              }
          } else {

          }
        }
      } else if($dataorderSP[0]->ansuran == 'no') {
        $this->template->set('totalprice',$dataorderSP[0]->totalprice);
      }
      //$getForm = $this->main_m->get_customformfixed($getKursus[0]->kursusid);

      $this->template->set('inv_no',$inv_no);
      $this->template->set('dataorderSP',$dataorderSP);

      $this->template->render('main_f/payment');

    } else {
      redirect('main/signin');
    }
  }

  public function complete() {
    $this->template->render('main_f/complete');
  }

  public function complete_fakulti() {
    $this->template->render('main_f/complete_fakulti');
  }


/*
  public function checkout_INV() {

      $cart_list = $this->cart_m->get_data_cart_empty($this->session->userdata('session_student')['nokp']);

      $noinv = '';
      $createinv = 'SHP'.date('Y').'-INV-'; //SHP2022-INV-00001
      $invlast = $this->cart_m->get_data_invoice();

      $length = 5;
      $char = 0;
      $type = 'd';
      $format = "%{$char}{$length}{$type}"; // or "$010d";

      if($invlast) {
        $nom = array_pop(explode('-', $invlast[0]->noinvoice));
        $newNom = sprintf($format, ($nom+1));
        $noinv = $createinv.$newNom;
      } else {
        $noinv = $createinv.'0000001';
      }

      //insert param_kursus
      $input_inv = array (
        'noinvoice' => $noinv,
        'nokp' => $cart_list[0]->nokp,
        'tarikhinvoice' => date('Y-m-d H:i:s')
      );

      $insert_param_kursus = $this->cart_m->insert_data_invoice($input_inv);
      //end insert param_kursus

      if($insert_param_kursus) {

        $input_inv = array (
          'idcart' => $cart_list[0]->idcart,
          'noinvoice' => $noinv
        );
        $this->cart_m->update_data_cart($input_inv);

        $this->session->set_userdata('invoice_no', $noinv);

        $session_student = $this->session->userdata('session_student');
        $session_student['carttotal'] = count($this->cart_m->get_data_cart($session_student['nokp']));

        $this->session->unset_userdata('session_student');
        $this->session->set_userdata('session_student', $session_student);

        redirect('SP/carts/personaldetail');
      } else {

      }

  } */

}
