<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// SP BELUM LAGI BUAT CREATE USER & Enroll
// SP BELUM BUAT UPDATE STATUS Payment
// SP BELUM SEMAK BALIK CUSTOM FIELD CHECKING FACULTY
// SP FACULTY BELUM SEMAK BALIK
// SEMAK DASHBOARD STUDENT
// PAPARAN PAYMENT TUNJUK CALON PILIH BAYARAN MCM MANA2

class Urusetia_sp extends CI_Controller {



	public function __construct() {

      parent::__construct();

			if(empty($this->session->userdata("session_ukmper")))
	   	{
	   		redirect(base_url()."main/signin",'refresh');
	   	}

      $this->load->model('auth_m');

	$this->load->model('urusetiasp_m');
		$this->load->model('cart_m');
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



	public function dash_adminsp()

	{

        $this->template->render('urusetia_sp_f/dashboard');

	}



	public function semak_sp()

	{
		$list_mohon = $this->urusetiasp_m->get_infopelajarsp();
		$array = array();
		foreach($list_mohon as $row) {
			$list_mohon = $this->urusetiasp_m->get_infopelajarsp_v2($row->order_id);
			if($list_mohon) {
				array_push($array, $list_mohon[0]);
			}
		}
		$this->template->set('list_mohon', $array);
		$list_mohon2 = $this->urusetiasp_m->get_infopelajarspstatusfakulti();
		$this->template->set('list_mohon2', $list_mohon2);
		//$list_infosemaksp = $this->urusetiasp_m->get_infosemaksp();
		//$this->template->set('list_infosemaksp', $list_infosemaksp);

		//$list_infopelajarsp = $this->urusetiasp_m->get_infopelajarsp();
		//$this->template->set('list_infopelajarsp', $list_infopelajarsp);

		$this->template->render('urusetia_sp_f/semaksp');

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


			$comment_urus = $this->urusetiasp_m->get_data_invoice($txt_noinvoice);

			if($txt_comment && $txt_comment != '') {
				$commentEst = $this->urusetiasp_m->get_email_comment_exist(trim($txt_comment));
				if(!$commentEst) {
					$this->urusetiasp_m->insert_email_comment(array(
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

			$done = $this->urusetiasp_m->update_data_invoice($data);
			if($txt_status == 6) {
				$data = array(
					'ordersp_id' => $comment_urus[0]->order_id,
					'status_app' => 6,
					'ukmpersah_app' => $session_ukmper['id'],
					'tkh_ukmpersah_app' => date('Y-m-d H:i:s')
				);
				$this->urusetiasp_m->update_data_order_sp_by_orderID($data);
			}

			if($done) {
				$this->session->set_flashdata('mesej', '<b>Successfully Update Status Payment</b>');
				$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
			} else {
				$this->session->set_flashdata('mesej', '<b>Unsuccessful, please try again</b>');
				$this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible fade show');
			}

			$coursedetail = $this->urusetiasp_m->get_param_kursus_by_invoice($comment_urus[0]->user_id, $txt_noinvoice);

			if($txt_status == 7) {
				$subject = 'eCOURSE : Your Order '.$txt_noinvoice.', Unsuccessful';
				$message =

					'<br/>' .

					'Greetings Mr/Mrs,<br/><br/>' .

					'Kindly be informed that your purchase order has been<br/><br/>' .

					'Invoice No.: <b>' .$txt_noinvoice. '</b><br/><br/>' .

					'Course: <b>'.$coursedetail[0]->namakursus.'</b><br/><br/>' .

					'Status: <b>PAYMENT NOT APPROVED</b><br/><br/>' .

					'Reason: <b>' .trim($txt_comment). '</b><br/><br/>' .

					'Thank You.<br/><br/><br/>' .

					'<i>Micro-credential & Professional Courses Unit<br/>' .

					'Center for Shaping Advanced & Professional Education (UKMSHAPE)<br/>' .

					'studymc@ukm.edu.my</i><br/>' .

					'<a href="'.base_url().'/main/signin">'.base_url().'</a><br/><br/>';

					$noinvoice = $txt_noinvoice; //dbug($nokp); die();

					$detail_pelajar = $this->urusetiasp_m->get_detail_mohon($noinvoice);
					$data['detail_pelajar'] = $detail_pelajar; //dbug($beliantelefon); die();

					$detail_kursus = $this->urusetiasp_m->get_param_kursus_by_invoice($detail_pelajar[0]->user_id,$noinvoice);
					$data['detail_kursus'] = $detail_kursus;

					$this->email->from('no-reply-ecourse@ukm.edu.my', 'eCOURSE');
					$this->email->to($txt_email);
					//$this->email->cc('studymc@ukm.edu.my');
					$this->email->subject($subject);
					$this->email->message($message);
					$this->email->set_mailtype("html");
					$this->email->send();

			} else {

				$creatematrik = 'SP'; //MC00001
				$nomatriklast = $this->urusetiasp_m->get_nomatrik();

				$length = 5;
				$char = 0;
				$type = 'd';
				$format = "%{$char}{$length}{$type}"; // or "$010d";

				if($nomatriklast) {
					$nom = str_replace('SP','',$nomatriklast[0]->nomatrik_sp);
					$newNom = sprintf($format, ($nom+1));
					$nomatrik = $creatematrik.$newNom;
				} else {
					$nomatrik = $creatematrik.'00001';
				}

				$detail_pelajar = $this->urusetiasp_m->get_detail_mohon($noinvoice);

				if($detail_pelajar[0]->nomatrik_sp == '') {
					$input_pelajar = array (
						'user_id' => $valueMC->user_id,
						'nomatrik_sp' => $nomatrik
					);
					$this->urusetiasp_m->update_data_pelajar($input_pelajar);
				} else {
					$nomatrik = $detail_pelajar[0]->nomatrik_sp;
				}

				$parameter = $this->encryption->encrypt($txt_noinvoice);
				redirect('urusetia_sp/detail_pemohon_app/'.$parameter, 'refresh');
			}

		}

		$parameter_list = $this->encryption->decrypt($parameter);

		$this->template->set('data_id', $parameter_list);

		$noinvoice = $parameter_list; //dbug($nokp); die();

		$detail_pelajar = $this->urusetiasp_m->get_detail_mohon($noinvoice);
		$this->template->set('detail_pelajar', $detail_pelajar); //dbug($beliantelefon); die();

		$detail_kursus = $this->urusetiasp_m->get_param_kursus_by_invoice($detail_pelajar[0]->user_id,$noinvoice);
		$this->template->set('detail_kursus', $detail_kursus);

		//$detail_pelajar = $this->urusetiasp_m->get_detail_pelajar($nokp);
		//$this->template->set('detail_pelajar', $detail_pelajar);

		$liststatus = $this->urusetiasp_m->get_list_status();
		$this->template->set('liststatus', $liststatus);

		$listcomment = $this->urusetiasp_m->get_email_comment();
		$this->template->set('listcomment', $listcomment);

		if($detail_pelajar[0]->status_app == 6 && $detail_pelajar[0]->status_urus != 5) {
			redirect('urusetia_sp/detail_pemohon_app/'.$parameter, 'refresh');
		}

		if($detail_pelajar[0]->status_app == 9 && $detail_pelajar[0]->status_admin == 5) {
			redirect('urusetia_sp/detail_pemohon_verify/'.$parameter, 'refresh');
		}

		if($detail_pelajar[0]->status_app == 9 && $detail_pelajar[0]->status_admin == 6 && $detail_pelajar[0]->status_urus != 5) {
			redirect('urusetia_sp/detail_pemohon_app/'.$parameter, 'refresh');
		}

		if($detail_pelajar[0]->status_app == 3 && $detail_pelajar[0]->status_admin == 6) {
			redirect('urusetia_sp/detail_pemohon_verify/'.$parameter, 'refresh');
		}

		if($detail_pelajar[0]->ansuran == 'yes') {
			$detail_sponsor = $this->urusetiasp_m->get_detail_syarikat($detail_pelajar[0]->user_id);
			$this->template->set('detail_sponsor', $detail_sponsor); //dbug($detail_mohonspnf001); die();

			$customform = $this->urusetiasp_m->get_customform($detail_pelajar[0]->kursusid);
			$this->template->set('customform', $customform);

			$getForm = $this->urusetiasp_m->get_customformfixed($detail_pelajar[0]->kursusid);
			$this->template->set('getForm', $getForm);

			$this->template->set('script_content','urusetia_sp_f/script/script-detailsSP');
			$this->template->render('urusetia_sp_f/ansuran');
		} else {
			$this->template->set('script_content','urusetia_sp_f/script/script-detailsSP');
			$this->template->render('urusetia_sp_f/first_1');
		}

		//$this->template->set('script_content','urusetia_sp_f/script/script-detailsSP');
		//$this->template->render('urusetia_sp_f/first_1');

	}


	public function detail_pemohon_app($parameter) {

		if($this->input->post('btn_submit')){

				$session_ukmper = $this->session->userdata('session_ukmper');
				$txt_comment = $this->input->post('txt_comment');
				$txt_noinvoice = $this->input->post('txt_noinvoice');
				$txt_email = $this->input->post('txt_email');

				$getinvoice = $this->urusetiasp_m->get_data_invoice($txt_noinvoice);

					$data = array(
						'ordersp_id' => $getinvoice[0]->order_id,
						'status_app' => 4,
						'ukmpersah_app' => $session_ukmper['id'],
						'tkh_ukmpersah_app' => date('Y-m-d H:i:s')
					);
					$this->urusetiasp_m->update_data_order_sp_by_orderID($data);


				if($this->input->post('txt_nomatrik') != null && $this->input->post('txt_nomatrik') != '') {

					$input_pelajar = array (
					'user_id' => $this->input->post('txt_user_id'),
					'nomatrik_sp' => $this->input->post('txt_nomatrik')
				);

					$this->urusetiasp_m->update_data_pelajar($input_pelajar);

				}

				if($this->input->post('txt_status_enrol') != null) {
					for($i = 0; $i < count($this->input->post('txt_orderspid')); $i++) {

							if($this->input->post('txt_status_enrol')[$i] != null || $this->input->post('txt_status_enrol')[$i] != '') {
								$data_kursus = $this->urusetiasp_m->get_data_order_mc($this->input->post('txt_orderspid')[$i]);
								$dataenrol = array(
									'order_id' => $this->input->post('txt_ordersp_id')[$i],
									'order_sp' => $this->input->post('txt_orderspid')[$i],
									'nomatrik' => $this->input->post('txt_nomatrik'),
									'fullname' => $this->input->post('txt_name'),
									'kursusid' => $data_kursus[0]->kursusid,
									'kodkursus' => $data_kursus[0]->kodkursus,
									'status_enrol' => $this->input->post('txt_status_enrol')[$i],
									'role' => 'Student',
									'comment_enrol' => $this->input->post('txt_comment_enrol')[$i],
									'ukmpersah' => $session_ukmper['id']
								);

								$data_check = $this->urusetiasp_m->get_data_enrol($dataenrol);
								if($data_check) {
									$this->urusetiasp_m->update_data_enrol($dataenrol);
									$dataenrol = array(
										'order_id' => $this->input->post('txt_ordersp_id')[$i],
										'order_sp' => $this->input->post('txt_orderspid')[$i],
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
									$this->urusetiasp_m->insert_data_enrol($dataenrol);

									if($this->input->post('txt_status_app') == 12) {
										if($this->CreateUser($dataenrol,'Enrol')) {
											$this->session->set_flashdata('mesej', '<b>Successfully Enrol User</b>');
											$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
										} else {
											$this->session->set_flashdata('mesej', '<b>Webservice to LMS having problem. Please try again by Re-Update Status</b>');
											$this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible fade show');
										}
									} else if($this->input->post('txt_status_enrol') == 'X') {
										$this->session->set_flashdata('mesej', '<b>Successfully Updated</b>');
										$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
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

							$detail_pelajar = $this->urusetiasp_m->get_detail_mohon($noinvoice);
							$data['detail_pelajar'] = $detail_pelajar; //dbug($beliantelefon); die();

							$detail_kursus = $this->urusetiasp_m->get_param_kursus_by_invoice($detail_pelajar[0]->user_id,$noinvoice);
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

		$detail_pelajar = $this->urusetiasp_m->get_detail_mohon($noinvoice);
		$this->template->set('detail_pelajar', $detail_pelajar); //dbug($beliantelefon); die();

		$detail_sponsor = $this->urusetiasp_m->get_detail_syarikat($detail_pelajar[0]->user_id);
		$this->template->set('detail_sponsor', $detail_sponsor); //dbug($detail_mohonspnf001); die();

    $customform = $this->urusetiasp_m->get_customform($detail_pelajar[0]->kursusid);
		$this->template->set('customform', $customform);

		$getForm = $this->urusetiasp_m->get_customformfixed($detail_pelajar[0]->kursusid);
		$this->template->set('getForm', $getForm);

		$detail_kursus = $this->urusetiasp_m->get_param_kursus_by_invoice($detail_pelajar[0]->user_id,$noinvoice);
		$this->template->set('detail_kursus', $detail_kursus);

		$listcomment = $this->urusetiasp_m->get_email_comment();
		$this->template->set('listcomment', $listcomment);

		//$detail_pelajar = $this->urusetiasp_m->get_detail_pelajar($nokp);
		//$this->template->set('detail_pelajar', $detail_pelajar);

		$liststatus = $this->urusetiasp_m->get_list_status();
		$this->template->set('liststatus', $liststatus);

		$this->template->set('script_content','urusetia_sp_f/script/script-detailsSP');
		$this->template->render('urusetia_sp_f/first_2');
	}

	public function detail_pemohon_verify($parameter) {

		if($this->input->post('btn_submit')){

				$session_ukmper = $this->session->userdata('session_ukmper');
				$txt_comment = '';
				$txt_comment = $this->input->post('txt_comment_urus1');
				if($txt_comment == '') {
					$txt_comment = $this->input->post('txt_comment_urus2');
				}
				$txt_status_admin = $this->input->post('txt_status_admin');
				$txt_noinvoice = $this->input->post('txt_noinvoice');
				$txt_email = $this->input->post('txt_email');

				if($this->input->post('jnspmbyrn') == 'Sponsorship') {
					$order_id = $this->input->post('order_id');

						$input_order = array (
							'ordersp_id' => $order_id,
							'comment_admin' => $txt_comment,
							'status_admin' => $txt_status_admin,
							'ukmperadmin' => $session_ukmper['id'],
							'tarikhsahadmin' => date('Y-m-d H:i:s')
						);

						$this->urusetiasp_m->update_data_order_sp($input_order);

							$data = array(
								'noinvoice' => $txt_noinvoice,
								'status_urus' => 6,
								'status_inv' => 4,
								'ukmpersah' => $session_ukmper['id'],
								'tarikhsah' => date('Y-m-d H:i:s')
							);

						$this->urusetiasp_m->update_data_invoice($data);

						$comment_urus = $this->urusetiasp_m->get_data_invoice($txt_noinvoice);

						if($txt_comment && $txt_comment != '') {
							$commentEst = $this->urusetiasp_m->get_email_comment_exist(trim($txt_comment));
							if(!$commentEst) {
								$this->urusetiasp_m->insert_email_comment(array(
									'comment' => trim($txt_comment)
								));
							}
						}

						$noinvoice = $txt_noinvoice; //dbug($nokp); die();

						$parameter2 = $this->encryption->encrypt($noinvoice);

						$this->session->set_flashdata('mesej', '<b>Successfully Update</b>');
						$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
						redirect('urusetia_sp/detail_pemohon_app/'.$parameter2, 'refresh');

				} else { // ansuran
					$txt_deposit = null;
					$txt_payment1 = null;
					$txt_payment2 = null;
					$txt_payment3 = null;

					if($this->input->post('txt_deposit') != null) {
						$txt_deposit = date("Y-m-d", strtotime($this->input->post('txt_deposit')));
					}
					if($this->input->post('txt_payment1') != null) {
						$txt_payment1 = date("Y-m-d", strtotime($this->input->post('txt_payment1')));
					}
					if($this->input->post('txt_payment2') != null) {
						$txt_payment2 = date("Y-m-d", strtotime($this->input->post('txt_payment2')));
					}
					if($this->input->post('txt_payment3') != null) {
						$txt_payment3 = date("Y-m-d", strtotime($this->input->post('txt_payment3')));
					}

					$order_id = $this->input->post('order_id');

						$input_order = array (
							'ordersp_id' => $order_id,
							'comment_admin' => $txt_comment,
							'status_admin' => $txt_status_admin,
							'ukmperadmin' => $session_ukmper['id'],
							'tarikhsahadmin' => date('Y-m-d H:i:s'),
							'status_app' => 3
						);

						$this->urusetiasp_m->update_data_order_sp($input_order);

						if($txt_deposit != null) {
							$input_order = array (
								'ordersp_id' => $order_id,
								'txt_deposit' => $txt_deposit
							);

							$this->urusetiasp_m->update_data_order_sp($input_order);
						} else {
							$input_order = array (
								'ordersp_id' => $order_id,
								'status_deposit' => '4'
							);

							$this->urusetiasp_m->update_data_order_sp($input_order);
						}
						if($txt_payment1 != null) {
							$input_order = array (
								'ordersp_id' => $order_id,
								'tkh_payment1' => $txt_payment1
							);

							$this->urusetiasp_m->update_data_order_sp($input_order);
						}
						if($txt_payment2 != null) {
							$input_order = array (
								'ordersp_id' => $order_id,
								'tkh_payment2' => $txt_payment2
							);

							$this->urusetiasp_m->update_data_order_sp($input_order);
						}
						if($txt_payment3 != null) {
							$input_order = array (
								'ordersp_id' => $order_id,
								'tkh_payment3' => $txt_payment3
							);

							$this->urusetiasp_m->update_data_order_sp($input_order);
						}

						$comment_urus = $this->urusetiasp_m->get_data_invoice($txt_noinvoice);

						if($txt_comment && $txt_comment != '') {
							$commentEst = $this->urusetiasp_m->get_email_comment_exist(trim($txt_comment));
							if(!$commentEst) {
								$this->urusetiasp_m->insert_email_comment(array(
									'comment' => trim($txt_comment)
								));
							}
						}

							$coursedetail = $this->urusetiasp_m->get_param_kursus_by_invoice($comment_urus[0]->user_id, $txt_noinvoice);
							if($coursedetail[0]->total <= 0) {
								$data = array(
									'noinvoice' => $txt_noinvoice,
									'status_urus' => 6,
									'status_inv' => 4,
									'ukmpersah' => $session_ukmper['id'],
									'tarikhsah' => date('Y-m-d H:i:s')
								);
	
								$this->urusetiasp_m->update_data_invoice($data);

								if($txt_payment1 == date("Y-m-d")) {
									$customkursus = $this->urusetiasp_m->get_customformfixed($coursedetail[0]->kursusid);

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
									'order_id' => $coursedetail[0]->order_id,
									'order_type' => 'SP',
									'status_inv' => 3,
									'user_id' => $coursedetail[0]->user_id,
									'total' => $customkursus[0]->ins_1,
									'notification' => 0,
									'tarikhinvoice' => date('Y-m-d H:i:s')
									);

									$insert_data_invoice = $this->cart_m->insert_data_invoice($input_inv);
									//////// INV /////////

								}

							}

							$subject = 'eCOURSE : Your Application '.$txt_noinvoice.', Successful';
							$message =

								'<br/>' .

								'Greetings Mr/Mrs,<br/><br/>' .

								'Kindly be informed that your application has been<br/><br/>' .

								'Invoice No.: <b>' .$txt_noinvoice. '</b><br/><br/>' .

								'Course: <b>'.$coursedetail[0]->namakursus.'</b><br/><br/>' .

								'Status: <b>APPLICATION APPROVED</b><br/><br/><br/>' .

								'You can now start pay under your <a href="https://ecourse.ukm.my/student/profile">Account Page Bills</a> before you can access the class.<br/><br/>' .

								//'You can now login <a href="https://ecourse.ukm.my/main/signin_moodle">eCOURSE: Learning Management System (LMS)</a> to access the class.<br/><br/>' .

								'Thank You.<br/><br/><br/>' .

								'<i>Micro-credential & Professional Courses Unit<br/>' .

								'Center for Shaping Advanced & Professional Education (UKMSHAPE)<br/>' .

								'studymc@ukm.edu.my</i><br/>' .

								'<a href="'.base_url().'/student/profile">'.base_url().'</a><br/><br/>';

								$noinvoice = $txt_noinvoice; //dbug($nokp); die();

								$detail_pelajar = $this->urusetiasp_m->get_detail_mohon($noinvoice);
								$data['detail_pelajar'] = $detail_pelajar; //dbug($beliantelefon); die();

								$detail_kursus = $this->urusetiasp_m->get_param_kursus_by_invoice($detail_pelajar[0]->user_id,$noinvoice);
								$data['detail_kursus'] = $detail_kursus;

								$this->email->from('no-reply-ecourse@ukm.edu.my', 'eCOURSE');
								$this->email->to($txt_email);
								//$this->email->cc('studymc@ukm.edu.my');
								$this->email->subject($subject);
								$this->email->message($message);
								$this->email->set_mailtype("html");
								$this->email->send();

								$parameter2 = $this->encryption->encrypt($noinvoice);

								$this->session->set_flashdata('mesej', '<b>Successfully Update</b>');
								$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
								redirect('urusetia_sp/detail_pemohon_verify/'.$parameter2, 'refresh');
				}

			}

		$parameter_list = $this->encryption->decrypt($parameter);

		$this->template->set('data_id', $parameter_list);

		$noinvoice = $parameter_list; //dbug($nokp); die();

		$detail_pelajar = $this->urusetiasp_m->get_detail_mohon($noinvoice);
		$this->template->set('detail_pelajar', $detail_pelajar); //dbug($beliantelefon); die();

		$detail_sponsor = $this->urusetiasp_m->get_detail_syarikat($detail_pelajar[0]->user_id);
		$this->template->set('detail_sponsor', $detail_sponsor); //dbug($detail_mohonspnf001); die();

		$customform = $this->urusetiasp_m->get_customform($detail_pelajar[0]->kursusid);
		$this->template->set('customform', $customform);

		$getForm = $this->urusetiasp_m->get_customformfixed($detail_pelajar[0]->kursusid);
		$this->template->set('getForm', $getForm);

		$detail_kursus = $this->urusetiasp_m->get_param_kursus_by_invoice($detail_pelajar[0]->user_id,$noinvoice);
		$this->template->set('detail_kursus', $detail_kursus);

		$listcomment = $this->urusetiasp_m->get_email_comment();
		$this->template->set('listcomment', $listcomment);

		//$detail_pelajar = $this->urusetiasp_m->get_detail_pelajar($nokp);
		//$this->template->set('detail_pelajar', $detail_pelajar);

		$liststatus = $this->urusetiasp_m->get_list_status();
		$this->template->set('liststatus', $liststatus);

		$this->template->set('script_content','urusetia_sp_f/script/script-detailsSP');
		$this->template->render('urusetia_sp_f/verify');
	}




	public function detail($parameter)
  {

    if($this->input->post('btn_submit') != null) {
			$session_ukmper = $this->session->userdata('session_ukmper');
      $txt_status = $this->input->post('txt_status');
      $txt_comment = $this->input->post('txt_comment');
      $txt_noinvoice = $this->input->post('txt_noinvoice');
      $txt_comment_app = $this->input->post('txt_comment_app');
      $txt_status_app = $this->input->post('txt_status_app');


			if($this->input->post('txt_nomatrik') != null && $this->input->post('txt_nomatrik') != '') {

				$input_pelajar = array (
		      'nokp' => $this->input->post('txt_nokp'),
		      'nomatrik_sp' => $this->input->post('txt_nomatrik')
		    );

				$this->urusetiasp_m->update_data_pelajar($input_pelajar);

			}


			if($this->input->post('txt_payment1') != null) {
				$txt_payment1 = $this->input->post('txt_payment1');
				$txt_payment2 = $this->input->post('txt_payment2');
				$txt_payment3 = $this->input->post('txt_payment3');
				$order_id = $this->input->post('order_id');

				$input_order = array (
		      'ordersp_id' => $order_id,
		      'tkh_payment1' => date("Y-m-d", strtotime($txt_payment1)),
		      'tkh_payment2' => date("Y-m-d", strtotime($txt_payment2)),
		      'tkh_payment3' => date("Y-m-d", strtotime($txt_payment3)),
					'comment_app' => $txt_comment_app,
	        'status_app' => $txt_status_app,
					'ukmpersah_app' => $session_ukmper['ukmper'],
					'tkh_ukmpersah_app' => date('Y-m-d H:i:s')
		    );

				$this->urusetiasp_m->update_data_order_sp($input_order);

			}

      $input_inv = array (
        'noinvoice' => $txt_noinvoice,
        'comment_urus' => $txt_comment,
        'status_urus' => $txt_status,
				'ukmpersah' => $session_ukmper['ukmper'],
        'tarikhsah' => date('Y-m-d H:i:s')
      );

      $update_data_invoice = $this->urusetiasp_m->update_data_invoice($input_inv);

      if($update_data_invoice) {
        $echo =  base_url('/urusetia_sp/semak_sp');
        echo "<script>alert('Completed');
                window.location.href = '".$echo."'
             </script>";
      } else {
        echo "<script>alert('Please try again.');
                location.reload();'
             </script>";
      }
    }

    $noinvoice = $this->encryption->decrypt($parameter);
    $this->template->set('data_id', $noinvoice);

    $detail_pelajar = $this->urusetiasp_m->get_detail_mohonsp_order_id($noinvoice);
		$this->template->set('detail_pelajar', $detail_pelajar); //dbug($detail_mohonspnf001); die();

		$detail_sponsor = $this->urusetiasp_m->get_detail_syarikat($detail_pelajar[0]->user_id);
		$this->template->set('detail_sponsor', $detail_sponsor); //dbug($detail_mohonspnf001); die();

		$customform = $this->urusetiasp_m->get_customform($detail_pelajar[0]->kursusid);
		$this->template->set('customform', $customform);

		$getForm = $this->urusetiasp_m->get_customformfixed($detail_pelajar[0]->kursusid);
		$this->template->set('getForm', $getForm);

    $this->template->set('script_content','urusetia_sp_f/script/script-detailsSP');
    $this->template->render('urusetia_sp_f/detail');
  }

	public function semak_inv()

	{
		$list_infosemaksp = $this->urusetiasp_m->get_infosemaksp();
		$this->template->set('list_infosemaksp', $list_infosemaksp);

		$list_infopelajarsp = $this->urusetiasp_m->get_infopelajarinv();
		$this->template->set('list_infopelajarsp', $list_infopelajarsp);

		$this->template->render('urusetia_sp_f/semakinv');

	}


	public function detail_inv($parameter)
  {

    if($this->input->post('btn_submit') != null) {
			$session_ukmper = $this->session->userdata('session_ukmper');
      $txt_status = $this->input->post('txt_status');
      $txt_comment = $this->input->post('txt_comment');
      $txt_noinvoice = $this->input->post('txt_noinvoice');
      $txt_comment_app = $this->input->post('txt_comment_app');
      $txt_status_app = $this->input->post('txt_status_app');


			if($this->input->post('txt_nomatrik') != null && $this->input->post('txt_nomatrik') != '') {

				$input_pelajar = array (
		      'nokp' => $this->input->post('txt_nokp'),
		      'nomatrik_sp' => $this->input->post('txt_nomatrik')
		    );

				$this->urusetiasp_m->update_data_pelajar($input_pelajar);
			}


			if($this->input->post('txt_payment1') != null) {
				$txt_payment1 = $this->input->post('txt_payment1');
				$txt_payment2 = $this->input->post('txt_payment2');
				$txt_payment3 = $this->input->post('txt_payment3');
				$order_id = $this->input->post('order_id');

				$input_order = array (
		      'ordersp_id' => $order_id,
		      'tkh_payment1' => date("Y-m-d", strtotime($txt_payment1)),
		      'tkh_payment2' => date("Y-m-d", strtotime($txt_payment2)),
		      'tkh_payment3' => date("Y-m-d", strtotime($txt_payment3)),
					'comment_app' => $txt_comment_app,
	        'status_app' => $txt_status_app,
					'ukmpersah_app' => $session_ukmper['ukmper'],
					'tkh_ukmpersah_app' => date('Y-m-d H:i:s')
		    );

				$this->urusetiasp_m->update_data_order_sp($input_order);

			}

      $input_inv = array (
        'noinvoice' => $txt_noinvoice,
        'comment_urus' => $txt_comment,
        'status_urus' => $txt_status,
				'ukmpersah' => $session_ukmper['ukmper'],
        'tarikhsah' => date('Y-m-d H:i:s')
      );

      $update_data_invoice = $this->urusetiasp_m->update_data_invoice($input_inv);

      if($update_data_invoice) {
        $echo =  base_url('/urusetia_sp/semak_inv');
        echo "<script>alert('Completed');
                window.location.href = '".$echo."'
             </script>";
      } else {
        echo "<script>alert('Please try again.');
                location.reload();'
             </script>";
      }
    }

    $noinvoice = $this->encryption->decrypt($parameter);
    $this->template->set('data_id', $noinvoice);

    $detail_pelajar = $this->urusetiasp_m->get_detail_mohonsp($noinvoice);
		$this->template->set('detail_pelajar', $detail_pelajar); //dbug($detail_mohonspnf001); die();

    $customform = $this->urusetiasp_m->get_customform($detail_pelajar[0]->kursusid);
		$this->template->set('customform', $customform);

		$getForm = $this->urusetiasp_m->get_customformfixed($detail_pelajar[0]->kursusid);
		$this->template->set('getForm', $getForm);

    $this->template->set('script_content','urusetia_sp_f/script/script-detailsSP');
    $this->template->render('urusetia_sp_f/detail-inv');
  }



	public function detail_SPNF001($parameter)

	{
		$parameter_list = $this->encryption->decrypt($parameter);
		$parameter = explode(',', $parameter_list); //dbug($parameter_list); die();

		$this->template->set('data_id', $parameter[0]);

		$data_id = $parameter[0];

		$detail_pelajarspnf001 = $this->urusetiasp_m->get_detail_mohonspnf001($data_id);
		$this->template->set('detail_pelajarspnf001', $detail_pelajarspnf001); //dbug($detail_mohonspnf001); die();

    $detail_infospnf001 = $this->urusetiasp_m->get_infodatapelajar($data_id);
		$this->template->set('detail_infospnf001', $detail_infospnf001);

		$this->template->render('urusetia_sp_f/detail_SPNF001');

	}

	public function detail_SPFF001($parameter)

	{
		$parameter_list = $this->encryption->decrypt($parameter);
		$parameter = explode(',', $parameter_list); //dbug($parameter_list); die();

		$this->template->set('data_id', $parameter[0]);

		$data_id = $parameter[0];

		$detail_pelajarspff001 = $this->urusetiasp_m->get_detail_mohonspff001($data_id);
		$this->template->set('detail_pelajarspff001', $detail_pelajarspff001);

    $detail_infospff001 = $this->urusetiasp_m->get_infodatapelajar($data_id);
		$this->template->set('detail_infospff001', $detail_infospff001);

		$this->template->render('urusetia_sp_f/detail_SPFF001');

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

				$kursusid = $this->urusetiasp_m->insert_reg_kursus($regkursus);

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
            redirect('urusetia_sp/reg_kursus_induk', 'refresh');
          } else {
            $upload_data = $this->upload->data();
            $attch_upload = str_replace('/var/www/html/ecourse/','',$upload_data['full_path']);

						$regkursus = array(
							'kodkursusinduk' => $kursusid,
							'imgfile' => $attch_upload
						);

						// simpan data cuti sakit
						$this->urusetiasp_m->update_reg_kursus($regkursus);

						$this->session->set_flashdata('mesej', '<b>Your information has been recorded</b>.');
						$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
						redirect('urusetia_sp/reg_kursus_induk', 'refresh');
          }
        } else {

					$this->session->set_flashdata('mesej', '<b>Information Incomplete</b>.');
					$this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible');
					redirect('urusetia_sp/reg_kursus_induk', 'refresh');

				}


			}

			$list_kursus = $this->urusetiasp_m->get_kursus_id();
			$this->template->set('list_kursus', $list_kursus);
			$this->template->render('urusetia_sp_f/daftarkursusmc');

  	}



  	public function reg_kursus_unit()

  	{

		$this->template->render('urusetia_sp_f/daftarkursusmc_unit');

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

			$this->urusetiasp_m->insert_reg_kursusunit($kursusunit);

			$this->session->set_flashdata('mesej', '<b>Your Information Has Been Recorded</b>.');

			$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');

			redirect('urusetia_sp/reg_kursus_unit', 'refresh');

		} else {

			$this->session->set_flashdata('mesej', '<b>Information Incomplete</b>.');

			$this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible');

			redirect('urusetia_sp/reg_kursus_unit', 'refresh');

		}

	}



  	public function param_kursus()

  	{
			$list_course = $this->urusetiasp_m->get_course_mc();
			$this->template->set('list_course', $list_course);//dbug($list_course);die();

        $this->template->render('urusetia_sp_f/paramkursusmc');

  	}



	public function registration_param()

	{

		$session_ukmper = $this->session->userdata('session_ukmper');



		if (!empty($session_ukmper)) {



			$list_course = $this->urusetiasp_m->get_course_mc();

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

				$this->urusetiasp_m->insert_reg_kursusunit($kursusunit);

				$this->session->set_flashdata('mesej', '<b>Your Information Has Been Recorded</b>.');

				$this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');

				redirect('urusetia_sp_f/paramkursusmc', 'refresh');

			} else {

				$this->session->set_flashdata('mesej', '<b>Information Incomplete</b>.');

				$this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible');

				redirect('urusetia_sp_f/paramkursusmc', 'refresh');

			}

		}



		$this->template->render('urusetia_sp_f/paramkursusmc');

	}



	public function daftarpensyarah()

	{

		$this->template->render('urusetia_sp_f/daftarpensyarah');

	}

	public function payment_pemohon($parameter)

	{
		if($this->input->post('btn_submit')){

			$session_ukmper = $this->session->userdata('session_ukmper');
      $txt_comment = $this->input->post('txt_comment');
      $txt_noinvoice = $this->input->post('txt_noinvoice');
      $txt_status = $this->input->post('txt_status');

			$data = array(
				'noinvoice' => $txt_noinvoice,
				'status_urus' => $txt_status,
				'comment_urus' => $txt_comment,
				'ukmpersah' => $session_ukmper['id'],
				'tarikhsah' => date('Y-m-d H:i:s')
			);

			$done = $this->urusetiasp_m->update_data_invoice($data);

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

		$detail_pelajar = $this->urusetiasp_m->get_detail_mohon($noinvoice);
		$this->template->set('detail_pelajar', $detail_pelajar); //dbug($beliantelefon); die();

		$detail_kursus = $this->urusetiasp_m->get_param_kursus_by_invoice($detail_pelajar[0]->user_id,$noinvoice);
		$this->template->set('detail_kursus', $detail_kursus);

		$customform = $this->urusetiasp_m->get_customform($detail_pelajar[0]->kursusid);
		$this->template->set('customform', $customform);

		$getForm = $this->urusetiasp_m->get_customformfixed($detail_pelajar[0]->kursusid);
		$this->template->set('getForm', $getForm);

		//$detail_pelajar = $this->urusetiasp_m->get_detail_pelajar($nokp);
		//$this->template->set('detail_pelajar', $detail_pelajar);

		$liststatus = $this->urusetiasp_m->get_list_status();
		$this->template->set('liststatus', $liststatus);

		//dbug($detail_mohon[0]->order_id);die();


		$this->template->set('script_content','urusetia_sp_f/script/script-detailsSP');
		$this->template->render('urusetia_sp_f/paymentsp');

	}

	public function CreateUser($maklumatUkmfolioLog,$type) {

		$data_pelajar = $this->urusetiasp_m->get_detail_pelajar_nomatrik($maklumatUkmfolioLog['nomatrik']);
		$user = $this->urusetiasp_m->get_data_users($data_pelajar[0]->user_id);
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
						$idnumber = $data_pelajar[0]->nomatrik_sp;
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


/* End of file urusetia_sp.php */

/* Location: ./application/controllers/urusetia_sp.php */

?>
