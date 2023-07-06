<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MC extends CI_Controller {

  public function __construct() {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('form');
      $this->load->library('pagination');
      $this->load->library('encrypt');
      $this->load->model('main_m');
      $this->load->model('urusetiamc_m');
      $this->load->model('cart_m');

      $this->load->config('token');//load token odl dev
			$this->url_odl = $this->config->item('url_odl');
			$this->get_user_token =  $this->config->item('get_user_token');
			$this->create_user_token =  $this->config->item('create_user_token');
			$this->get_courseid_token = $this->config->item('get_courseid_token');
			$this->manual_enrol_token = $this->config->item('manual_enrol_token');
			$this->manual_unenrol_token = $this->config->item('manual_unenrol_token');
      //$this->output->enable_profiler(TRUE);
  }

  public function index() {

      $config['base_url'] = site_url('MC/index');
          $config['total_rows'] = $this->main_m->get_mcodlukm_MC_count('');
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
          $course = $this->main_m->get_mcodlukm_MC($config["per_page"], $page, NULL);

          $pagination = $this->pagination->create_links();

          $this->template->set('page', $page);
          $this->template->set('course', $course);
          $this->template->set('pagination', $pagination);


      $this->template->render('main_f/course-list-mc');
  }

  public function search() {
    // get search string
        $search = ($this->input->post("course_name"))? $this->input->post("course_name") : "NIL";

        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

        // pagination settings
        $config = array();
        $config['base_url'] = site_url("MC/search/$search");
        $config['total_rows'] = $this->main_m->get_mcodlukm_MC_count($search);
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
        $course = $this->main_m->get_mcodlukm_MC($config['per_page'], $page, $search);

        $pagination = $this->pagination->create_links();

        $this->template->set('page', $page);
        $this->template->set('course', $course);
        $this->template->set('pagination', $pagination);

        $this->template->render('main_f/course-list-mc');
  }

  public function checkout_PO() {

    $cart_list = $this->cart_m->get_data_order_mc_wujud($this->session->userdata('session_student')['user_id'], $this->input->post('kursusid'));
    if($cart_list) {
      $echo =  base_url('/main/course_details/'.$this->input->post('kursusid'));
      echo "<script>alert('Course already in cart!');
              window.location.href = '".$echo."'
           </script>";
    } else {
      $cart_list = $this->cart_m->get_data_order_mc_cart($this->session->userdata('session_student')['user_id']);

      if(!$cart_list) {
        //insert data_cart
        $input_data_cart = array (
          'user_id' => $this->session->userdata('session_student')['user_id']
        );
        $insert_data_cart = $this->cart_m->insert_data_cart($input_data_cart);
        //end insert data_cart
        $idcart = $insert_data_cart;
        $noPO = '';
      } else {
        $idcart = $cart_list[0]->idcart;
        $noPO = $cart_list[0]->ordermc_id;
      }

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

      $createinv = 'POM'.date('Y').'-'; //POS2022-0001
      $invlast = $this->cart_m->get_data_order_mc();
      $length = 4;
      $char = 0;
      $type = 'd';
      $format = "%{$char}{$length}{$type}"; // or "$010d";

      if($noPO == '' && $invlast) {
        $nom = str_replace('POM'.date('Y').'-','',$invlast[0]->order_id);
        $newNom = sprintf($format, ($nom+1));
        $noPO = $createinv.$newNom;
      } else if(!$invlast) {
        $noPO = $createinv.'0001';
      }

      //insert data_order_sp
      $input_inv = array (
        'ordermc_id' => $noPO,
        'kursusid' => $this->input->post('kursusid'),
        'totalprice' => $this->input->post('price'),
        'status_app' => 1,
        'create_dated' => date('Y-m-d H:i:s')
      );

      $insert_data_order_mc = $this->cart_m->insert_data_order_mc($input_inv);
      //end insert data_order_sp

      if($insert_data_order_mc) {
        if(!$cart_list) {
          $input_inv = array (
            'idcart' => $idcart,
            'order_id' => $noPO
          );
          $this->cart_m->update_data_cart($input_inv);
        }

        $this->session->set_userdata('order_no', $noPO);

        $session_student = $this->session->userdata('session_student');
        $session_student['carttotal'] = count($this->cart_m->get_data_order_mc_cart($this->session->userdata('session_student')['user_id']));

        $this->session->unset_userdata('session_student');
        $this->session->set_userdata('session_student', $session_student);

        $echo =  base_url('/main/course_details/'.$this->input->post('kursusid'));
        echo "<script>alert('Course has added to cart.');
                window.location.href = '".$echo."'
             </script>";
      } else {
        echo 'error';
      }
    }

  }

  public function carts()
	{
    if($this->session->userdata('session_student')) {
      $cart_list = $this->cart_m->get_data_order_mc_param_kursus($this->session->userdata('session_student')['user_id']);
      $this->template->set('cart_list', $cart_list);
    }
		$this->template->render('main_f/carts');
	}

  public function remove_cart() {
    if($this->input->get('id') != null) {

      $this->cart_m->remove_param_kursus($this->input->get('paramid'),$this->input->get('idcart'));
      $cart_update = $this->cart_m->remove_data_order_mc($this->input->get('id'));

      $session_student = $this->session->userdata('session_student');
      $session_student['carttotal'] = count($this->cart_m->get_data_order_mc_cart($session_student['user_id']));

      if($session_student['carttotal'] < 1) {
        $this->cart_m->remove_data_cart_mc($this->input->get('idcart'));
      }

      $this->session->unset_userdata('session_student');
      $this->session->set_userdata('session_student', $session_student);

      if($cart_update) {
        $echo =  base_url('/carts/');
        echo "<script>alert('Course have been remove.');
                window.location.href = '".$echo."'
             </script>";
      } else {
        $echo =  base_url('/carts/');
        echo "<script>alert('Course cannot be remove.');
                window.location.href = '".$echo."'
             </script>";
      }
    }
  }

  public function carts_next_1()
	{
    if($this->session->userdata('session_student')) {
      $data_pelajar = $this->main_m->get_data_pelajar($this->session->userdata('session_student')['user_id']);
      $this->template->set('data_pelajar', $data_pelajar);

      if($this->input->post('txt_submit') != null) {

        $carts = $this->cart_m->get_data_order_mc_cart($this->session->userdata('session_student')['user_id']);

        $getKursus = $this->main_m->get_data_order_mc($carts[0]->ordermc_id);

        $order_id = $carts[0]->ordermc_id;

        $this->template->set('order_id',$carts[0]->ordermc_id);
        $this->template->set('order_mc',$getKursus);


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
          'negeri' => $this->input->post('txt_country'),
          'poskod' => $this->input->post('txt_poscode'),
          'negara' => $this->input->post('txt_nationality'),
          'notel' => $this->input->post('txt_tel'),
          'emel' => $this->input->post('txt_emel'),
          'akadtertinggi' => $this->input->post('txt_academic'),
          'nmsijil' => $this->input->post('txt_nmacademic')
        );

        $update = $this->main_m->update_data_pelajar($data);

        $price = 0;
        foreach ($carts as $value) {
          $price += $value->totalprice;
        }

        $status_app = 3;

        if($price > 0) {
          $status_app = 3;
        }  else {
          $status_app = 9;
        }

        $dataOrderMC = array(
          'ordermc_id' => $order_id,
          'status_app' => $status_app
        );

        $this->cart_m->update_data_order_mc($dataOrderMC);

        //////// INV /////////
        $noinv = '';
        $createinv = 'INVM'.date('Y').'-'; //INVS2022-0001
        $invlast = $this->cart_m->get_data_invoice($createinv);

        $length = 4;
        $char = 0;
        $type = 'd';
        $format = "%{$char}{$length}{$type}"; // or "$010d";

        if($invlast) {
          $nom = str_replace('INVM'.date('Y').'-','',$invlast[0]->noinvoice);
          $newNom = sprintf($format, ($nom+1));
          $noinv = $createinv.$newNom;
        } else {
          $noinv = $createinv.'0001';
        }

        if($price > 0) {
          $status_inv = 3;
          $status_urus = '';
        } else {
          $status_inv = 4;
          $status_urus = 6;
        }

        $input_inv = array (
          'noinvoice' => $noinv,
          'order_id' => $order_id,
          'order_type' => 'MC',
          'user_id' => $this->session->userdata('session_student')['user_id'],
          'total' => $price,
          'status_inv' => $status_inv,
          'status_urus' => $status_urus,
          'notification' => 0,
          'tarikhinvoice' => date('Y-m-d H:i:s')
        );

        $insert_data_invoice = $this->cart_m->insert_data_invoice($input_inv);
        //////// INV /////////

        $session_student = $this->session->userdata('session_student');
        $session_student['carttotal'] = count($this->cart_m->get_data_order_mc_cart($this->session->userdata('session_student')['user_id']));

        $this->session->unset_userdata('session_student');
        $this->session->set_userdata('session_student', $session_student);

        if($insert_data_invoice) {
          $this->session->set_userdata('inv_no', $noinv);
          if($price > 0) {
            redirect('MC/carts/payment');
          } else {
            $comment_urus = $this->urusetiamc_m->get_data_invoice($noinv);
      				$data = array(
      					'ordermc_id' => $comment_urus[0]->order_id,
      					'status_app' => 6
      				);
      				$this->urusetiamc_m->update_data_order_mc_by_orderID($data);

                $creatematrik = 'MC'; //MC00001
                $nomatriklast = $this->urusetiamc_m->get_nomatrik();

                $length = 5;
                $char = 0;
                $type = 'd';
                $format = "%{$char}{$length}{$type}"; // or "$010d";

                if($nomatriklast) {
                  $nom = str_replace('MC','',$nomatriklast[0]->nomatrik_mc);
                  $newNom = sprintf($format, ($nom+1));
                  $nomatrik = $creatematrik.$newNom;
                } else {
                  $nomatrik = $creatematrik.'00001';
                }

                $detail_pelajar = $this->urusetiamc_m->get_detail_mohon($comment_urus[0]->noinvoice);

                foreach($detail_pelajar as $valueMC) {
                if($detail_pelajar[0]->nomatrik_mc == '') {
                  $input_pelajar = array (
          					'user_id' => $valueMC->user_id,
          					'nomatrik_mc' => $nomatrik
          				);
          				$this->urusetiamc_m->update_data_pelajar($input_pelajar);
                } else {
                  $nomatrik = $detail_pelajar[0]->nomatrik_mc;
                }

    								$data_kursus = $this->urusetiamc_m->get_data_order_mc($valueMC->id);
    								$dataenrol = array(
    									'order_id' => $valueMC->ordermc_id,
    									'order_mc' => $valueMC->id,
    									'nomatrik' => $nomatrik,
    									'fullname' => $this->session->userdata('session_student')['nama'],
    									'kursusid' => $data_kursus[0]->kursusid,
    									'kodkursus' => $data_kursus[0]->kodkursus,
    									'status_enrol' => 12,
    									'role' => 'Student'
    								);
    								$this->urusetiamc_m->insert_data_enrol($dataenrol);
                    $this->CreateUser($dataenrol,'Enrol');
    						}


            $noinvoice = $noinv; //dbug($nokp); die();

            $data['detail_pelajar'] = $detail_pelajar; //dbug($beliantelefon); die();

            $detail_kursus = $this->urusetiamc_m->get_param_kursus_by_invoice($detail_pelajar[0]->user_id,$noinvoice);
            $data['detail_kursus'] = $detail_kursus;

            $filename_eCOURSE = base_url().'/assets/img/ecourselogo.jpg';
            $this->email->attach($filename_eCOURSE);
            $data['eCOURSE'] = $this->email->attachment_cid($filename_eCOURSE);

            $filename_UKMSHAPE = base_url().'/assets/img/UKMSHAPE.jpg';
            $this->email->attach($filename_UKMSHAPE);
            $data['UKMSHAPE'] = $this->email->attachment_cid($filename_UKMSHAPE);

            $filename_UKM = base_url().'/assets/img/logo.jpg';
            $this->email->attach($filename_UKM);
            $data['UKM'] = $this->email->attachment_cid($filename_UKM);

            $message = $this->load->view('templates/email_invoice', $data, true);

            $this->email->from('no-reply-ecourse@ukm.edu.my', 'eCOURSE');
            $this->email->to($detail_pelajar[0]->emel);
            //$this->email->cc('studymc@ukm.edu.my');
            $this->email->subject('eCOURSE : Your Invoice');
            $this->email->message($message);
            $this->email->set_mailtype("html");
            $this->email->send();
            redirect('MC/carts/done');
          }
        } else {
          $echo =  base_url('/MC/carts/personaldetail');
          echo "<script>alert('Please try again.');
                  window.location.href = '".$echo."'
               </script>";
        }

      }
    }

    $this->template->set('script_content','main_f/script/script-personal-details-mc');
		$this->template->render('main_f/personal-details');
	}

  public function complete_0() {
    $this->template->render('main_f/complete_free');
  }

  public function complete() {
    $this->template->render('main_f/complete');
  }


  public function payment() {

    if($this->session->userdata('session_student')) {

      if($this->input->post('btn_submitPay') != null) {

          if(!empty($_FILES["resit_upload"]['name'])) {
            if(!is_dir('documents/'.$this->session->userdata('session_student')['user_id'])){
                if (!mkdir('documents/'.$this->session->userdata('session_student')['user_id'], 0777, TRUE)) {//0777
                    echo '<b>Failed to upload files</b>.';
                } else {
                  chmod('documents/'.$this->session->userdata('session_student')['user_id'], 0777);
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

          $getOrderMC = $this->main_m->get_data_invoice_mc($this->input->post('txt_inv_no'));

          // inv = Paid / urus = Waiting for Verification
          $dataInvoiceMC = array(
            'noinvoice' => $this->input->post('txt_inv_no'),
            'status_inv' => 4,
            'status_urus' => 5,
            'notification' => 1
          );

          $update_data = $this->cart_m->update_data_invoice($dataInvoiceMC);

          // app = Pending
          $dataOrderMC = array(
            'ordermc_id' => $getOrderMC[0]->ordermc_id,
            'status_app' => 9
          );

          $update_data_invoice = $this->cart_m->update_data_order_mc($dataOrderMC);

          $noinvoice = $this->input->post('txt_inv_no'); //dbug($nokp); die();

          $detail_pelajar = $this->urusetiamc_m->get_detail_mohon($noinvoice);
          $data['detail_pelajar'] = $detail_pelajar; //dbug($beliantelefon); die();

          $detail_kursus = $this->urusetiamc_m->get_param_kursus_by_invoice($detail_pelajar[0]->user_id,$noinvoice);
          $data['detail_kursus'] = $detail_kursus;

          $filename_eCOURSE = base_url().'/assets/img/ecourselogo.jpg';
          $this->email->attach($filename_eCOURSE);
          $data['eCOURSE'] = $this->email->attachment_cid($filename_eCOURSE);

          $filename_UKMSHAPE = base_url().'/assets/img/UKMSHAPE.jpg';
          $this->email->attach($filename_UKMSHAPE);
          $data['UKMSHAPE'] = $this->email->attachment_cid($filename_UKMSHAPE);

          $filename_UKM = base_url().'/assets/img/logo.jpg';
          $this->email->attach($filename_UKM);
          $data['UKM'] = $this->email->attachment_cid($filename_UKM);

          $message = $this->load->view('templates/email_invoice', $data, true);

          $this->email->from('no-reply-ecourse@ukm.edu.my', 'eCOURSE');
          $this->email->to($detail_pelajar[0]->emel);
          //$this->email->cc('studymc@ukm.edu.my');
          $this->email->subject('eCOURSE : Your Invoice');
          $this->email->message($message);
          $this->email->set_mailtype("html");
          $this->email->send();

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

        $this->template->set('type', 'MC');
        $dataorderMC = $this->main_m->get_data_invoice_mc($inv_no);


        $this->template->set('inv_no',$inv_no);
        $this->template->set('dataorderMC',$dataorderMC);

        $this->template->render('main_f/payment');

      } else {
        redirect('main/signin');
      }

  }



  public function CreateUser($maklumatUkmfolioLog,$type) {

		$data_pelajar = $this->urusetiamc_m->get_detail_pelajar_nomatrik($maklumatUkmfolioLog['nomatrik']);
		$data = array(
			'wstoken' => $this->get_user_token,
			'moodlewsrestformat' => 'json',
			'wsfunction' => 'core_user_get_users',
			'criteria[0][key]' => 'idnumber',
			'criteria[0][value]' => $data_pelajar[0]->user_id
		);
		$moodle_get_user_json = file_get_contents($this->url_odl.http_build_query($data), FALSE);
		$moodle_get_user_data = json_decode($moodle_get_user_json, TRUE);
		if(!empty($moodle_get_user_data)) {
			if(empty($moodle_get_user_data['users'])) {
					//IF USERID NOT EXIST

						$username = $data_pelajar[0]->emel;
						$firstname = $data_pelajar[0]->nama;
						$email = $data_pelajar[0]->emel;
						$idnumber = $data_pelajar[0]->user_id;
						$rtn_sts = true;
						$password = '';

						$user_id = $idnumber;
						$cacheall = $this->urusetiamc_m->get_cache();
			      foreach ($cacheall as $value => $key) {
			        if($this->encryption->decrypt($key->id) == $user_id) {
								//dbug($this->encryption->decrypt($key->id).' '.$key->cache_file);
			          $password = file_get_contents('./documents/cache/libraries/crypt/'.$key->id.'/'.$key->cache_file);
			        }
			      }

						//dbug($password);die;

					// IF rtn_sts TRUE, CREATE USER
					if($rtn_sts) {
						$data = array(
							'wstoken' => $this->create_user_token,
							'moodlewsrestformat' => 'json',
							'wsfunction' => 'core_user_create_users',
							'users[0][username]' => $username,
							'users[0][firstname]' => $firstname,
							'users[0][lastname]' => '&nbsp;',
							'users[0][email]' => $email,
							'users[0][idnumber]' => $idnumber,
							'users[0][auth]' => 'manual',
							'users[0][password]' => $password, //'saml2',
						);

						$moodle_create_user_json = file_get_contents($this->url_odl.http_build_query($data), FALSE);
						$create_odl_moodle_data = json_decode($moodle_create_user_json, TRUE);

						if(!empty($create_odl_moodle_data)) {
							if(count($create_odl_moodle_data) == 4 || !empty($create_odl_moodle_data['exception'])) {
								//dbug($create_odl_moodle_data['message']);
								$this->session->set_flashdata('webservice', '<b>'.$create_odl_moodle_data['message'].'</b>.');
								return false;

							} else {
								$userid = $create_odl_moodle_data[0]['id'];
								$username = $create_odl_moodle_data[0]['username'];//nomatrik/ukmper
							}
						}
						if(empty($create_odl_moodle_data)) {
							//dbug($create_odl_moodle_data['message']);
							$this->session->set_flashdata('webservice', '<b>'.$create_odl_moodle_data['message'].'</b>.');
						return false;
						}
					}


			} else {
				// IF USER EXIST IN MOODLE
				$userid = $moodle_get_user_data['users'][0]['id'];
				$username = $moodle_get_user_data['users'][0]['username'];//nomatrik/ukmper
			}

			if(isset($userid)) {
				$user_details = array(
					'value' => $maklumatUkmfolioLog,
					'userid' => $userid,
					'username' => $username
				);

				return $this->CheckCourseUser($user_details,$type);
			}


		}

	}

	public function CheckCourseUser($user_details,$type) {

		$value = $user_details['value'];
		$userid = $user_details['userid'];
		$username = $user_details['username'];
		$courseid = $value['kursusid'];
		$roleid = 5;

		if($type == 'Enrol') {
			$data = array(
				'wstoken' => $this->manual_enrol_token,
				'moodlewsrestformat' => 'json',
				'wsfunction' => 'enrol_manual_enrol_users',
				'enrolments[0][roleid]' => $roleid,
				'enrolments[0][userid]' => $userid,
				'enrolments[0][courseid]' => $courseid
			);

			//roleid = 3 / 5 (lecturer / student )
			//userid = id pengguna dalam moodle
			//courseid = id course dalam moodle

			$moodle_json = file_get_contents($this->url_odl.http_build_query($data), FALSE);
			$enrol_data = json_decode($moodle_json, TRUE);

			//var_dump($enrol_data);
			if(empty($enrol_data)) {
				return true;
			} else {
				//dbug($enrol_data['message']);
				$this->session->set_flashdata('webservice', '<b>'.$enrol_data['message'].'</b>.');
				return false;
			}

		} else if($type == 'Unenrol') {

			$data = array(
						'wstoken' => $this->manual_unenrol_token,
						'moodlewsrestformat' => 'json',
						'wsfunction' => 'enrol_manual_unenrol_users',
						'enrolments[0][roleid]' => $roleid,
						'enrolments[0][userid]' => $userid,
						'enrolments[0][courseid]' => $courseid
					);

					//roleid = 3 / 5 (lecturer / student )
					//userid = id pengguna dalam moodle
					//courseid = id course dalam moodle

					$moodle_json = file_get_contents($this->url_odl.http_build_query($data), FALSE);
					$unenrol_data = json_decode($moodle_json, TRUE);

					if(empty($unenrol_data)) {
						return true;
					} else {
						//dbug($unenrol_data['message']);
						$this->session->set_flashdata('webservice', '<b>'.$unenrol_data['message'].'</b>.');
						return false;
					}
		}


	}

}
