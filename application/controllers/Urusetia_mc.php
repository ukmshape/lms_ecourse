<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Urusetia_mc extends CI_Controller {

	public function __construct() {

      parent::__construct();
			if(empty($this->session->userdata("session_ukmper")))
	   	{
	   		redirect(base_url()."main/signin",'refresh');
	   	}
      $this->load->model('auth_m');

	  	$this->load->model('urusetiamc_m');
			$this->load->config('token');//load token odl dev
			$this->url_odl = $this->config->item('url_odl');
			$this->get_user_token =  $this->config->item('get_user_token');
			$this->create_user_token =  $this->config->item('create_user_token');
			$this->get_courseid_token = $this->config->item('get_courseid_token');
			$this->manual_enrol_token = $this->config->item('manual_enrol_token');
			$this->manual_unenrol_token = $this->config->item('manual_unenrol_token');

      //$this->output->enable_profiler(TRUE);

			$this->ssltoken = array(
			    "ssl"=>array(
			        "verify_peer"=>false,
			        "verify_peer_name"=>false,
			    ),
			);

  	}

	public function index()

	{

	}

	public function dash_admin()

	{

		$countTotal = $this->urusetiamc_m->count_totalapp();
		$this->template->set('countTotal', $countTotal);

		$countCompleted = $this->urusetiamc_m->count_completed();
		$this->template->set('countCompleted', $countCompleted);

		$countInompleted = $this->urusetiamc_m->count_incompleted();
		$this->template->set('countInompleted', $countInompleted);

		$countTotalcourse = $this->urusetiamc_m->get_mcodlukm_MC_count(''); //$this->urusetiamc_m->count_totalcourse();
		$this->template->set('countTotalcourse', $countTotalcourse);

		$this->template->render('admin_f/MC/dashboard');

	}



	public function semak_mc($parameter = null)
	{
		if($parameter) {
			$parameter_list = $this->encryption->decrypt($parameter);
			if($parameter_list == 'waiting') {
				$list_mohon = $this->urusetiamc_m->get_infopelajarmc_filter("data_invoice.status_urus = '5' AND data_order_mc.status_app != '3'");
				$this->template->set('list_mohon', $list_mohon);
			} else if($parameter_list == 'unpaid') {
				$list_mohon = $this->urusetiamc_m->get_infopelajarmc_filter("data_order_mc.status_app = '3'");
				$this->template->set('list_mohon', $list_mohon);
			} else if($parameter_list == 'all') {
				$list_mohon = $this->urusetiamc_m->get_infopelajarmc();
				$this->template->set('list_mohon', $list_mohon);
			}
		} else {
			$list_mohon = $this->urusetiamc_m->get_infopelajarmc();
			$this->template->set('list_mohon', $list_mohon);
		}

		//$list_semakpelajarmc = $this->urusetiamc_m->get_infosemakmc();
		//$this->template->set('list_semakpelajarmc', $list_semakpelajarmc);

		//$list_semakpelajarinv = $this->urusetiamc_m->get_infopelajarinv();
		//$this->template->set('list_semakpelajarinv', $list_semakpelajarinv);

		$this->template->render('urusetia_mc_f/semakanmc');

	}

	public function email_compose($parameter) {

		if($this->input->post('btn_submit')){
			$txt_email = trim($this->input->post('txt_email'));
			$txt_emailcc = trim($this->input->post('txt_emailcc'));
			$subject = $this->input->post('txt_subject');
			$message = $this->input->post('txt_message');

			$this->email->from('no-reply-ecourse@ukm.edu.my', 'eCOURSE');
			$this->email->to($txt_email);
			if($txt_emailcc != '') {
				$this->email->cc($txt_emailcc);
			}
			//$this->email->cc('studymc@ukm.edu.my');
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->set_mailtype("html");
			if($this->email->send()) {
				$echo =  base_url('/urusetia_mc/semak_mc');
        echo "<script>alert('Successfully Sent Email!');
                window.location.href = '".$echo."'
             </script>";
			}


		}

		$parameter_list = $this->encryption->decrypt($parameter);

		$data['data_id'] = $parameter_list;

		$noinvoice = $parameter_list; //dbug($nokp); die();

		$detail_pelajar = $this->urusetiamc_m->get_detail_mohon($noinvoice);
		$data['detail_pelajar'] = $detail_pelajar; //dbug($beliantelefon); die();

		$users_detail = $this->urusetiamc_m->get_data_users($detail_pelajar[0]->user_id);
		$data['users_detail'] = $users_detail;

		$detail_kursus = $this->urusetiamc_m->get_param_kursus_by_invoice($detail_pelajar[0]->user_id,$noinvoice);
		$data['detail_kursus'] = $detail_kursus;

		//$this->template->render('admin_f/email_s');
		$this->load->view('admin_f/email_s', $data);
	}


	public function detail_pemohon($parameter)
	{
		if($this->input->post('btn_submit')){

			$session_ukmper = $this->session->userdata('session_ukmper');
      $txt_email = $this->input->post('txt_email');
			$txt_comment = '';
      $txt_comment = $this->input->post('txt_comment_urus1');
			if($txt_comment == '') {
	      $txt_comment = $this->input->post('txt_comment_urus2');
			}
      $txt_noinvoice = $this->input->post('txt_noinvoice');
      $txt_status = $this->input->post('txt_status');


			$comment_urus = $this->urusetiamc_m->get_data_invoice($txt_noinvoice);

			if($txt_comment && $txt_comment != '') {
				$commentEst = $this->urusetiamc_m->get_email_comment_exist(trim($txt_comment));
				if(!$commentEst) {
					$this->urusetiamc_m->insert_email_comment(array(
						'comment' => trim($txt_comment)
					));
				}
			}

			if($txt_status == '7') {
				$data = array(
					'noinvoice' => $txt_noinvoice,
					'status_urus' => $txt_status,
					'status_inv' => 3,
					'comment_urus' => $txt_comment,
					'ukmpersah' => $session_ukmper['id'],
					'tarikhsah' => date('Y-m-d H:i:s')
				);
			} else {
				$data = array(
					'noinvoice' => $txt_noinvoice,
					'status_urus' => $txt_status,
					'comment_urus' => $txt_comment,
					'ukmpersah' => $session_ukmper['id'],
					'tarikhsah' => date('Y-m-d H:i:s')
				);
			}

			$done = $this->urusetiamc_m->update_data_invoice($data);
			if($txt_status == 6) {
				$data = array(
					'ordermc_id' => $comment_urus[0]->order_id,
					'status_app' => 6,
					'ukmpersah_app' => $session_ukmper['id'],
					'tkh_ukmpersah_app' => date('Y-m-d H:i:s')
				);
				$this->urusetiamc_m->update_data_order_mc_by_orderID($data);
			}

			if($done) {
				$this->session->set_flashdata('mesej', '<b>Successfully Update Status Payment</b>');
				$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
			} else {
				$this->session->set_flashdata('mesej', '<b>Unsuccessful, please try again</b>');
				$this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible fade show');
			}

			if($txt_status == 7) {
				$subject = 'eCOURSE : Your Order '.$txt_noinvoice.', Unsuccessful';
				$message =

					'<br/>' .

					'Greetings Mr/Mrs,<br/><br/>' .

					'Kindly be informed that your purchase order has been<br/><br/>' .

					'Invoice No.: <b>' .$txt_noinvoice. '</b><br/><br/>' .

					'Status: <b>PAYMENT NOT APPROVED</b><br/><br/>' .

					'Reason: <b>' .trim($txt_comment). '</b><br/><br/>' .

					'Thank You.<br/><br/><br/>' .

					'<i>Micro-credential & Professional Courses Unit<br/>' .

					'Center for Shaping Advanced & Professional Education (UKMSHAPE)<br/>' .

					'studymc@ukm.edu.my</i><br/>' .

					'<a href="'.base_url().'/main/signin">'.base_url().'</a><br/><br/>';

					$noinvoice = $txt_noinvoice; //dbug($nokp); die();

					$detail_pelajar = $this->urusetiamc_m->get_detail_mohon($noinvoice);
					$data['detail_pelajar'] = $detail_pelajar; //dbug($beliantelefon); die();

					$detail_kursus = $this->urusetiamc_m->get_param_kursus_by_invoice($detail_pelajar[0]->user_id,$noinvoice);
					$data['detail_kursus'] = $detail_kursus;

					$this->email->from('no-reply-ecourse@ukm.edu.my', 'eCOURSE');
					$this->email->to($txt_email);
					//$this->email->cc('studymc@ukm.edu.my');
					$this->email->subject($subject);
					$this->email->message($message);
					$this->email->set_mailtype("html");
					$this->email->send();

			} else {

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

				$detail_pelajar = $this->urusetiamc_m->get_detail_mohon($noinvoice);

				if($detail_pelajar[0]->nomatrik_mc == '') {
					$input_pelajar = array (
						'user_id' => $valueMC->user_id,
						'nomatrik_mc' => $nomatrik
					);
					$this->urusetiamc_m->update_data_pelajar($input_pelajar);
				} else {
					$nomatrik = $detail_pelajar[0]->nomatrik_mc;
				}

				$parameter = $this->encryption->encrypt($txt_noinvoice);
				redirect('urusetia_mc/detail_pemohon_app/'.$parameter, 'refresh');
			}

		}

		$parameter_list = $this->encryption->decrypt($parameter);

		$this->template->set('data_id', $parameter_list);

		$noinvoice = $parameter_list; //dbug($nokp); die();

		$detail_pelajar = $this->urusetiamc_m->get_detail_mohon($noinvoice);
		$this->template->set('detail_pelajar', $detail_pelajar); //dbug($beliantelefon); die();

		$detail_kursus = $this->urusetiamc_m->get_param_kursus_by_invoice($detail_pelajar[0]->user_id,$noinvoice);
		$this->template->set('detail_kursus', $detail_kursus);

		//$detail_pelajar = $this->urusetiamc_m->get_detail_pelajar($nokp);
		//$this->template->set('detail_pelajar', $detail_pelajar);

		$liststatus = $this->urusetiamc_m->get_list_status();
		$this->template->set('liststatus', $liststatus);

		$listcomment = $this->urusetiamc_m->get_email_comment();
		$this->template->set('listcomment', $listcomment);

		if($detail_pelajar[0]->status_app == 6) {
			redirect('urusetia_mc/detail_pemohon_app/'.$parameter, 'refresh');
		}

		$this->template->set('script_content','urusetia_mc_f/script/script-detailsMC');
		$this->template->render('urusetia_mc_f/first_1');

	}

	public function detail_pemohon_app($parameter) {

		if($this->input->post('btn_submit')){

				$session_ukmper = $this->session->userdata('session_ukmper');
	      $txt_comment = $this->input->post('txt_comment');
	      $txt_noinvoice = $this->input->post('txt_noinvoice');
	      $txt_email = $this->input->post('txt_email');


				if($this->input->post('txt_nomatrik') != null && $this->input->post('txt_nomatrik') != '') {

					$input_pelajar = array (
			      'user_id' => $this->input->post('txt_user_id'),
			      'nomatrik_mc' => $this->input->post('txt_nomatrik')
			    );

					$this->urusetiamc_m->update_data_pelajar($input_pelajar);

				}

				if($this->input->post('txt_status_enrol') != null) {
					for($i = 0; $i < count($this->input->post('txt_ordermcid')); $i++) {

							if($this->input->post('txt_status_enrol')[$i] != null || $this->input->post('txt_status_enrol')[$i] != '') {
								$data_kursus = $this->urusetiamc_m->get_data_order_mc($this->input->post('txt_ordermcid')[$i]);
								$dataenrol = array(
									'order_id' => $this->input->post('txt_ordermc_id')[$i],
									'order_mc' => $this->input->post('txt_ordermcid')[$i],
									'nomatrik' => $this->input->post('txt_nomatrik'),
									'fullname' => $this->input->post('txt_name'),
									'kursusid' => $data_kursus[0]->kursusid,
									'kodkursus' => $data_kursus[0]->kodkursus,
									'status_enrol' => $this->input->post('txt_status_enrol')[$i],
									'role' => 'Student',
									'comment_enrol' => $this->input->post('txt_comment_enrol')[$i],
									'ukmpersah' => $session_ukmper['id']
								);
								$data_check = $this->urusetiamc_m->get_data_enrol($dataenrol);
								if($data_check) {
									$this->urusetiamc_m->update_data_enrol($dataenrol);
									$dataenrol = array(
										'order_id' => $this->input->post('txt_ordermc_id')[$i],
										'order_mc' => $this->input->post('txt_ordermcid')[$i],
										'nomatrik' => $this->input->post('txt_nomatrik'),
										'fullname' => $this->input->post('txt_name'),
										'kursusid' => $data_kursus[0]->kursusid,
										'kodkursus' => $data_kursus[0]->kodkursus,
										'status_enrol' => $this->input->post('txt_status_enrol')[$i],
										'role' => 'Student',
										'comment_enrol' => $this->input->post('txt_comment_enrol')[$i],
										'ukmpersah' => $session_ukmper['id']
									);
									if($this->input->post('txt_status_enrol')[$i] == 14) {
											if($this->CreateUser($dataenrol,'Unenrol')) {
												$this->session->set_flashdata('mesej', '<b>Successfully Unenrol User</b>');
								        $this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
											} else {
												$this->session->set_flashdata('mesej', '<b>Webservice to LMS having problem. Please try again by Re-Update Status</b>');
								        $this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible fade show');
											}

									} else if($this->input->post('txt_status_enrol')[$i] == 12) {
										if($this->CreateUser($dataenrol,'Enrol')) {
											$this->session->set_flashdata('mesej', '<b>Successfully Enrol User</b>');
											$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
										} else {
											$this->session->set_flashdata('mesej', '<b>Webservice to LMS having problem. Please try again by Re-Update Status</b>');
											$this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible fade show');
										}
									} else {
										$this->session->set_flashdata('mesej', '<b>Successfully Update</b>');
										$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
									}
								} else {
									$this->urusetiamc_m->insert_data_enrol($dataenrol);
									if($this->input->post('txt_status_app') == 12) {
										if($this->CreateUser($dataenrol,'Enrol')) {
											$this->session->set_flashdata('mesej', '<b>Successfully Enrol User</b>');
											$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
										}  else if($this->input->post('txt_status_enrol') == 'X') {
											$this->session->set_flashdata('mesej', '<b>Successfully Updated</b>');
											$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
										} else {
											$this->session->set_flashdata('mesej', '<b>Webservice to LMS having problem. Please try again by Re-Update Status</b>');
											$this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible fade show');
										}
									}
								}
							} else {
								$this->session->set_flashdata('mesej', '<b>Successfully Update</b>');
								$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
							}
						}

						$subject = 'eCOURSE : Your Order '.$txt_noinvoice.', Successful';
						$message =

							'<br/>' .

							'Greetings Mr/Mrs,<br/><br/>' .

							'Kindly be informed that your purchase order has been<br/><br/>' .

							'Invoice No.: <b>' .$txt_noinvoice. '</b><br/><br/>' .

							'Status: <b>APPLICATION APPROVED</b><br/><br/><br/>' .

							'You can now login <a href="https://ecourse.ukm.my/main/signin_moodle">eCOURSE: Learning Management System (LMS)</a> to access the class.<br/><br/>' .

							'Thank You.<br/><br/><br/>' .

							'<i>Micro-credential & Professional Courses Unit<br/>' .

							'Center for Shaping Advanced & Professional Education (UKMSHAPE)<br/>' .

							'studymc@ukm.edu.my</i><br/>' .

							'<a href="'.base_url().'/main/signin">'.base_url().'</a><br/><br/>';

							$noinvoice = $txt_noinvoice; //dbug($nokp); die();

							$detail_pelajar = $this->urusetiamc_m->get_detail_mohon($noinvoice);
							$data['detail_pelajar'] = $detail_pelajar; //dbug($beliantelefon); die();

							$detail_kursus = $this->urusetiamc_m->get_param_kursus_by_invoice($detail_pelajar[0]->user_id,$noinvoice);
							$data['detail_kursus'] = $detail_kursus;

							$this->email->from('no-reply-ecourse@ukm.edu.my', 'eCOURSE');
							$this->email->to($txt_email);
							//$this->email->cc('studymc@ukm.edu.my');
							$this->email->subject($subject);
							$this->email->message($message);
							$this->email->set_mailtype("html");
							$this->email->send();
					}
				}

		$parameter_list = $this->encryption->decrypt($parameter);

		$this->template->set('data_id', $parameter_list);

		$noinvoice = $parameter_list; //dbug($nokp); die();

		$detail_pelajar = $this->urusetiamc_m->get_detail_mohon($noinvoice);
		$this->template->set('detail_pelajar', $detail_pelajar); //dbug($beliantelefon); die();

		$detail_kursus = $this->urusetiamc_m->get_param_kursus_by_invoice($detail_pelajar[0]->user_id,$noinvoice);
		$this->template->set('detail_kursus', $detail_kursus);

		//$detail_pelajar = $this->urusetiamc_m->get_detail_pelajar($nokp);
		//$this->template->set('detail_pelajar', $detail_pelajar);

		$liststatus = $this->urusetiamc_m->get_list_status();
		$this->template->set('liststatus', $liststatus);

		$this->template->set('script_content','urusetia_mc_f/script/script-detailsMC');
		$this->template->render('urusetia_mc_f/first_2');
	}

	public function cpayment($parameter) {
		$parameter_list = $this->encryption->decrypt($parameter);

		$this->template->set('data_id', $parameter_list);

		$noinvoice = $parameter_list; //dbug($nokp); die();

		$detail_pelajar = $this->urusetiamc_m->get_detail_mohon($noinvoice);
		$this->template->set('detail_pelajar', $detail_pelajar); //dbug($beliantelefon); die();

		$detail_kursus = $this->urusetiamc_m->get_param_kursus_by_invoice($detail_pelajar[0]->user_id,$noinvoice);
		$this->template->set('detail_kursus', $detail_kursus);

		//$detail_pelajar = $this->urusetiamc_m->get_detail_pelajar($nokp);
		//$this->template->set('detail_pelajar', $detail_pelajar);

		$liststatus = $this->urusetiamc_m->get_list_status();
		$this->template->set('liststatus', $liststatus);

		$listcomment = $this->urusetiamc_m->get_email_comment();
		$this->template->set('listcomment', $listcomment);

		$this->template->set('script_content','urusetia_mc_f/script/script-detailsMC');
		$this->template->render('urusetia_mc_f/first_1');
	}



	// public function detail_pemohon($parameter)
	//
	// {
	// 	if($this->input->post('btn_submit')){
	//
	// 		$session_ukmper = $this->session->userdata('session_ukmper');
  //     $txt_comment = $this->input->post('txt_comment');
  //     $txt_noinvoice = $this->input->post('txt_noinvoice');
	//
	//
	// 		if($this->input->post('txt_nomatrik') != null && $this->input->post('txt_nomatrik') != '') {
	//
	// 			$input_pelajar = array (
	// 	      'user_id' => $this->input->post('txt_user_id'),
	// 	      'nomatrik_mc' => $this->input->post('txt_nomatrik')
	// 	    );
	//
	// 			$this->urusetiamc_m->update_data_pelajar($input_pelajar);
	//
	// 		}
	//
	// 		if($this->input->post('txt_status_enrol') != null) {
	// 			for($i = 0; $i < count($this->input->post('txt_ordermcid')); $i++) {
	//
	// 					$data = array(
	// 						'id' => $this->input->post('txt_ordermcid')[$i],
	// 						'status_app' => $this->input->post('txt_status_app'),
	// 						'comment_app' => $this->input->post('txt_comment'),
	// 						'ukmpersah_app' => $session_ukmper['id'],
	// 						'tkh_ukmpersah_app' => date('Y-m-d H:i:s')
	// 					);
	// 					$this->urusetiamc_m->update_data_order_mc($data);
	//
	// 					if($this->input->post('txt_status_enrol')[$i] != null || $this->input->post('txt_status_enrol')[$i] != '') {
	// 						$data_kursus = $this->urusetiamc_m->get_data_order_mc($this->input->post('txt_ordermcid')[$i]);
	// 						$dataenrol = array(
	// 							'order_id' => $this->input->post('txt_ordermc_id')[$i],
	// 							'order_mc' => $this->input->post('txt_ordermcid')[$i],
	// 							'nomatrik' => $this->input->post('txt_nomatrik'),
	// 							'fullname' => $this->input->post('txt_name'),
	// 							'kursusid' => $data_kursus[0]->kursusid,
	// 							'kodkursus' => $data_kursus[0]->kodkursus,
	// 							'status_enrol' => $this->input->post('txt_status_enrol')[$i],
	// 							'role' => 'Student',
	// 							'comment_enrol' => $this->input->post('txt_comment_enrol')[$i],
	// 							'ukmpersah' => $session_ukmper['id']
	// 						);
	// 						$data_check = $this->urusetiamc_m->get_data_enrol($dataenrol);
	// 						if($data_check) {
	// 							$this->urusetiamc_m->update_data_enrol($dataenrol);
	// 							$dataenrol = array(
	// 								'order_id' => $this->input->post('txt_ordermc_id')[$i],
	// 								'order_mc' => $this->input->post('txt_ordermcid')[$i],
	// 								'nomatrik' => $this->input->post('txt_nomatrik'),
	// 								'fullname' => $this->input->post('txt_name'),
	// 								'kursusid' => $data_kursus[0]->kursusid,
	// 								'kodkursus' => $data_kursus[0]->kodkursus,
	// 								'status_enrol' => $this->input->post('txt_status_enrol')[$i],
	// 								'role' => 'Student',
	// 								'comment_enrol' => $this->input->post('txt_comment_enrol')[$i],
	// 								'ukmpersah' => $session_ukmper['id']
	// 							);
	// 							if($this->input->post('txt_status_enrol')[$i] == 14) {
	// 									if($this->CreateUser($dataenrol,'Unenrol')) {
	// 										$this->session->set_flashdata('mesej', '<b>Successfully Unenrol User</b>');
	// 						        $this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
	// 									} else {
	// 										$this->session->set_flashdata('mesej', '<b>Webservice to LMS having problem. Please try again by Re-Update Status</b>');
	// 						        $this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible fade show');
	// 									}
	//
	// 							} else if($this->input->post('txt_status_enrol')[$i] == 12) {
	// 								if($this->CreateUser($dataenrol,'Enrol')) {
	// 									$this->session->set_flashdata('mesej', '<b>Successfully Enrol User</b>');
	// 									$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
	// 								} else {
	// 									$this->session->set_flashdata('mesej', '<b>Webservice to LMS having problem. Please try again by Re-Update Status</b>');
	// 									$this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible fade show');
	// 								}
	// 							} else {
	// 								$this->session->set_flashdata('mesej', '<b>Successfully Update</b>');
	// 								$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
	// 							}
	// 						} else {
	// 							$this->urusetiamc_m->insert_data_enrol($dataenrol);
	// 							if($this->input->post('txt_status_app') == 12) {
	// 								if($this->CreateUser($dataenrol,'Enrol')) {
	// 									$this->session->set_flashdata('mesej', '<b>Successfully Enrol User</b>');
	// 									$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
	// 								} else {
	// 									$this->session->set_flashdata('mesej', '<b>Webservice to LMS having problem. Please try again by Re-Update Status</b>');
	// 									$this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible fade show');
	// 								}
	// 							}
	// 						}
	// 					} else {
	// 						$this->session->set_flashdata('mesej', '<b>Successfully Update</b>');
	// 						$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
	// 					}
	// 				}
	// 			}
	// 		}
	//
	//
	// 	$parameter_list = $this->encryption->decrypt($parameter);
	//
	// 	$this->template->set('data_id', $parameter_list);
	//
	// 	$noinvoice = $parameter_list; //dbug($nokp); die();
	//
	// 	$detail_pelajar = $this->urusetiamc_m->get_detail_mohon($noinvoice);
	// 	$this->template->set('detail_pelajar', $detail_pelajar); //dbug($beliantelefon); die();
	//
	// 	$detail_kursus = $this->urusetiamc_m->get_param_kursus_by_invoice($detail_pelajar[0]->user_id,$noinvoice);
	// 	$this->template->set('detail_kursus', $detail_kursus);
	//
	// 	//$detail_pelajar = $this->urusetiamc_m->get_detail_pelajar($nokp);
	// 	//$this->template->set('detail_pelajar', $detail_pelajar);
	//
	// 	$liststatus = $this->urusetiamc_m->get_list_status();
	// 	$this->template->set('liststatus', $liststatus);
	//
	// 	$this->template->set('script_content','urusetia_mc_f/script/script-detailsMC');
	// 	$this->template->render('urusetia_mc_f/detailmc');
	//
	// }

	public function payment_pemohon($parameter)

	{
		if($this->input->post('btn_submit')){

			$session_ukmper = $this->session->userdata('session_ukmper');
      $txt_comment = $this->input->post('txt_comment_urus');
      $txt_noinvoice = $this->input->post('txt_noinvoice');
      $txt_status = $this->input->post('txt_status');

			$data = array(
				'noinvoice' => $txt_noinvoice,
				'status_urus' => $txt_status,
				'comment_urus' => $txt_comment,
				'ukmpersah' => $session_ukmper['id'],
				'tarikhsah' => date('Y-m-d H:i:s')
			);

			$done = $this->urusetiamc_m->update_data_invoice($data);

			if($done) {
				$this->session->set_flashdata('mesej', '<b>Successfully Update Status Payment</b>');
				$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
			} else {
				$this->session->set_flashdata('mesej', '<b>Unsuccessful, please try again</b>');
				$this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible fade show');
			}


		}

		$parameter_list = $this->encryption->decrypt($parameter);

		$this->template->set('data_id', $parameter_list);

		$noinvoice = $parameter_list; //dbug($nokp); die();

		$detail_pelajar = $this->urusetiamc_m->get_detail_mohon($noinvoice);
		$this->template->set('detail_pelajar', $detail_pelajar); //dbug($beliantelefon); die();

		$detail_kursus = $this->urusetiamc_m->get_param_kursus_by_invoice($detail_pelajar[0]->user_id,$noinvoice);
		$this->template->set('detail_kursus', $detail_kursus);

		//$detail_pelajar = $this->urusetiamc_m->get_detail_pelajar($nokp);
		//$this->template->set('detail_pelajar', $detail_pelajar);

		$liststatus = $this->urusetiamc_m->get_list_status();
		$this->template->set('liststatus', $liststatus);

		//dbug($detail_mohon[0]->order_id);die();


		$this->template->set('script_content','urusetia_mc_f/script/script-detailsMC');
		$this->template->render('urusetia_mc_f/paymentmc');

	}



  	public function reg_kursus_induk($value = '')

  	{

		if ($this->input->post('btn_regkursus')) {
			$namabm = $this->input->post('namabm');
			$namabi = $this->input->post('namabi');
			$totalunit = $this->input->post('totalunit');
			$codefakulti = $this->input->post('codefakulti');
			$kategori = $this->input->post('kategori');

				$regkursus = array(
					'nmkursus' => $namabm,
					'nmkursusbi' => $namabi,
					'unitpenuh' => $totalunit,
					'kodfak' => $codefakulti,
					'kategori' => $kategori
				);

				// simpan data cuti sakit

				$kursusid = $this->urusetiamc_m->insert_reg_kursus($regkursus);

				//chmod('dokumen/cuti/'.$session_ukmper, 0777);

				$attch_upload = '';
				if(!empty($_FILES["upload_pic"]['name'])) {

          $config['upload_path'] = './assets/kursus/';
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          $new_name = $kursusid.'_'.$namabm;
          $path = $_FILES['upload_pic']['name'];
          $ext = pathinfo($path, PATHINFO_EXTENSION);
          $config['file_name'] = $new_name.'.'.$ext;
          $this->load->library('upload',$config);
          $this->upload->initialize($config);
          if(!$this->upload->do_upload('upload_pic')) {
            echo '<b>'.$this->upload->display_errors().'</b>.';
            echo 'alert alert-danger alert-dismissible fade show';
            redirect('urusetia_mc/reg_kursus_induk', 'refresh');
          } else {
            $upload_data = $this->upload->data();
            $attch_upload = str_replace('/var/www/html/ecourse/','',$upload_data['full_path']);

						$regkursus = array(
							'kodkursusinduk' => $kursusid,
							'imgfile' => $attch_upload
						);

						// simpan data cuti sakit
						$this->urusetiamc_m->update_reg_kursus($regkursus);

						$this->session->set_flashdata('mesej', '<b>Your information has been recorded</b>.');
						$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
						redirect('urusetia_mc/reg_kursus_induk', 'refresh');
          }
        } else {

					$this->session->set_flashdata('mesej', '<b>Information Incomplete</b>.');
					$this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible');
					redirect('urusetia_mc/reg_kursus_induk', 'refresh');

				}


			}

			$list_kursus = $this->urusetiamc_m->get_kursus_id();
			$this->template->set('list_kursus', $list_kursus);
			$this->template->render('urusetia_mc_f/daftarkursusmc');

  	}



  	public function reg_kursus_unit()

  	{

		$this->template->render('urusetia_mc_f/daftarkursusmc_unit');

  	}



	public function registration_kursusunit($value='')

	{

		if ($this->input->post('btn_regkursusunit')) {

			$coursecode = $this->input->post('txt_coursecode');

			$coursename = $this->input->post('txt_coursename');

			$credit = $this->input->post('txt_credit');

			$courselevel = $this->input->post('txt_courselevel');

			$sysnopsisbm = $this->input->post('txt_synopsisbm');

			$sysnopsisbi = $this->input->post('txt_synopsisbi');



			$kursusunit = array(

				'kodkursus' => $coursecode,

				'kursusinduk' => $coursename,

				'kredit' => $credit,

				'tarafkursus' => $courselevel,

				'sinopsis' => $sysnopsisbm,

				'sinopsisbi' => $sysnopsisbi,

			); //dbug($kursusunit);die();

			$this->urusetiamc_m->insert_reg_kursusunit($kursusunit);

			$this->session->set_flashdata('mesej', '<b>Your Information Has Been Recorded</b>.');

			$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');

			redirect('urusetia_mc/reg_kursus_unit', 'refresh');

		} else {

			$this->session->set_flashdata('mesej', '<b>Information Incomplete</b>.');

			$this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible');

			redirect('urusetia_mc/reg_kursus_unit', 'refresh');

		}

	}



  	public function param_kursus()

  	{
			$list_course = $this->urusetiamc_m->get_course_mc();
			$this->template->set('list_course', $list_course);//dbug($list_course);die();

        $this->template->render('urusetia_mc_f/paramkursusmc');

  	}



	public function registration_param()

	{

		$session_ukmper = $this->session->userdata('session_ukmper');



		if (!empty($session_ukmper)) {



			$list_course = $this->urusetiamc_m->get_course_mc();

			$this->template->set('list_course', $list_course);//dbug($list_course);die();



			if ($this->input->post('btn_regkursusunit')) {

				$coursecode = $this->input->post('txt_coursecode');

				$coursename = $this->input->post('txt_coursename');

				$credit = $this->input->post('txt_credit');

				$courselevel = $this->input->post('txt_courselevel');

				$sysnopsisbm = $this->input->post('txt_synopsisbm');

				$sysnopsisbi = $this->input->post('txt_synopsisbi');



				$kursusunit = array(

					'kodkursus' => $coursecode,

					'kursusinduk' => $coursename,

					'kredit' => $credit,

					'tarafkursus' => $courselevel,

					'sinopsis' => $sysnopsisbm,

					'sinopsisbi' => $sysnopsisbi,

				); //dbug($kursusunit);die();

				$this->urusetiamc_m->insert_reg_kursusunit($kursusunit);

				$this->session->set_flashdata('mesej', '<b>Your Information Has Been Recorded</b>.');

				$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');

				redirect('urusetia_mc_f/paramkursusmc', 'refresh');

			} else {

				$this->session->set_flashdata('mesej', '<b>Information Incomplete</b>.');

				$this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible');

				redirect('urusetia_mc_f/paramkursusmc', 'refresh');

			}

		}



		$this->template->render('urusetia_mc_f/paramkursusmc');

	}



	public function daftarpensyarah()

	{

		$this->template->render('urusetia_mc_f/daftarpensyarah');

	}

	public function CreateUser($maklumatUkmfolioLog,$type) {

		$data_pelajar = $this->urusetiamc_m->get_detail_pelajar_nomatrik($maklumatUkmfolioLog['nomatrik']);
		$user = $this->urusetiamc_m->get_data_users($data_pelajar[0]->user_id);
		$data = array(
			'wstoken' => $this->get_user_token,
			'moodlewsrestformat' => 'json',
			'wsfunction' => 'core_user_get_users',
			'criteria[0][key]' => 'idnumber',
			'criteria[0][value]' => $data_pelajar[0]->user_id
		);
		$moodle_get_user_json = file_get_contents($this->url_odl.http_build_query($data), FALSE, stream_context_create($this->ssltoken));
		$moodle_get_user_data = json_decode($moodle_get_user_json, TRUE);
		if(!empty($moodle_get_user_data)) {
			if(empty($moodle_get_user_data['users'])) {
					//IF USERID NOT EXIST

						$username = $data_pelajar[0]->emel;
						$firstname = $data_pelajar[0]->nama;
						$email = $data_pelajar[0]->emel;
						$idnumber = $data_pelajar[0]->nomatrik_mc;
						$rtn_sts = true;
						$password = '';

						$user_id = $idnumber;
						$unserialize = unserialize(base64_decode($user[0]->password));

						$password = $unserialize['password'];

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

						$moodle_create_user_json = file_get_contents($this->url_odl.http_build_query($data), FALSE, stream_context_create($this->ssltoken));
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

			$moodle_json = file_get_contents($this->url_odl.http_build_query($data), FALSE, stream_context_create($this->ssltoken));
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

					$moodle_json = file_get_contents($this->url_odl.http_build_query($data), FALSE, stream_context_create($this->ssltoken));
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




/* End of file Urusetia_mc.php */

/* Location: ./application/controllers/Urusetia_mc.php */

?>
