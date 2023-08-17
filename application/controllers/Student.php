<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

  public function __construct() {
      parent::__construct();
      $this->load->model('student_m');

      $this->load->config('token');//load token odl dev
			$this->url_odl = $this->config->item('url_odl');
			$this->get_user_token =  $this->config->item('get_user_token');
			$this->update_user_token =  $this->config->item('update_user_token');

      $this->ssltoken = array(
          "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
      );


      if(empty($this->session->userdata("session_student")))
      {
        redirect(base_url()."main/signin",'refresh');
      }
      
      //$this->output->enable_profiler(TRUE);
  }


  // public function getUserMoodle($maklumatUkmfolioLog,$type) {

	// 	$data_pelajar = $this->urusetiamc_m->get_detail_pelajar_nomatrik($maklumatUkmfolioLog['nomatrik']);
	// 	$user = $this->urusetiamc_m->get_data_users($data_pelajar[0]->user_id);
	// 	$data = array(
	// 		'wstoken' => $this->get_user_token,
	// 		'moodlewsrestformat' => 'json',
	// 		'wsfunction' => 'core_user_get_users',
	// 		'criteria[0][key]' => 'idnumber',
	// 		'criteria[0][value]' => $data_pelajar[0]->user_id
	// 	);
	// 	$moodle_get_user_json = file_get_contents($this->url_odl.http_build_query($data), FALSE, stream_context_create($this->ssltoken));
	// 	$moodle_get_user_data = json_decode($moodle_get_user_json, TRUE);
	// 	if(!empty($moodle_get_user_data)) {
	// 		if(empty($moodle_get_user_data['users'])) {
	// 				//IF USERID NOT EXIST

	// 					$username = $data_pelajar[0]->emel;
	// 					$firstname = $data_pelajar[0]->nama;
	// 					$email = $data_pelajar[0]->emel;
	// 					$idnumber = $data_pelajar[0]->nomatrik_mc;
	// 					$rtn_sts = true;
	// 					$password = '';

	// 					$user_id = $idnumber;
	// 					$unserialize = unserialize(base64_decode($user[0]->password));

	// 					$password = $unserialize['password'];

	// 					//dbug($password);die;

	// 				// IF rtn_sts TRUE, CREATE USER
	// 				if($rtn_sts) {
	// 					$data = array(
	// 						'wstoken' => $this->create_user_token,
	// 						'moodlewsrestformat' => 'json',
	// 						'wsfunction' => 'core_user_create_users',
	// 						'users[0][username]' => $username,
	// 						'users[0][firstname]' => $firstname,
	// 						'users[0][lastname]' => '&nbsp;',
	// 						'users[0][email]' => $email,
	// 						'users[0][idnumber]' => $idnumber,
	// 						'users[0][auth]' => 'manual',
	// 						'users[0][password]' => $password, //'saml2',
	// 					);

	// 					$moodle_create_user_json = file_get_contents($this->url_odl.http_build_query($data), FALSE, stream_context_create($this->ssltoken));
	// 					$create_odl_moodle_data = json_decode($moodle_create_user_json, TRUE);

	// 					if(!empty($create_odl_moodle_data)) {
	// 						if(count($create_odl_moodle_data) == 4 || !empty($create_odl_moodle_data['exception'])) {
	// 							//dbug($create_odl_moodle_data['message']);
	// 							$this->session->set_flashdata('webservice', '<b>'.$create_odl_moodle_data['message'].'</b>.');
	// 							return false;

	// 						} else {
	// 							$userid = $create_odl_moodle_data[0]['id'];
	// 							$username = $create_odl_moodle_data[0]['username'];//nomatrik/ukmper
	// 						}
	// 					}
	// 					if(empty($create_odl_moodle_data)) {
	// 						//dbug($create_odl_moodle_data['message']);
	// 						$this->session->set_flashdata('webservice', '<b>'.$create_odl_moodle_data['message'].'</b>.');
	// 					return false;
	// 					}
	// 				}


	// 		} else {
	// 			// IF USER EXIST IN MOODLE
	// 			$userid = $moodle_get_user_data['users'][0]['id'];
	// 			$username = $moodle_get_user_data['users'][0]['username'];//nomatrik/ukmper
	// 		}

	// 		if(isset($userid)) {
	// 			$user_details = array(
	// 				'value' => $maklumatUkmfolioLog,
	// 				'userid' => $userid,
	// 				'username' => $username
	// 			);

	// 			return $this->CheckCourseUser($user_details,$type);
	// 		}


	// 	}

	// }

  public function profile() {
    //$session_student = $this->session->userdata('session_student');

    $session_nokp = trim($this->session->userdata('session_student')['user_id']); //dbug($session_nokp);

    $semakdata_student = $this->student_m->get_data_pelajar($session_nokp); //dbug($semakdata_student);
    $this->template->set('semakdata_student', $semakdata_student);

    $userdata = $this->student_m->get_data_users($session_nokp); //dbug($userdata);
    $this->template->set('userdata', $userdata);

    $semakcourse_student = $this->student_m->get_listcourse_stud($session_nokp); //dbug($semakdata_student);
    $this->template->set('semakcourse_student', $semakcourse_student);

    $semakhistorystudorder = $this->student_m->get_historystudorder($session_nokp); //dbug($semakdata_student);
    $this->template->set('semakhistorystudorder', $semakhistorystudorder);

    $semakbill = $this->student_m->get_bill_invoice($session_nokp); //dbug($semakdata_student);
    $this->template->set('semakbill', $semakbill);

    $semakdonepay = $this->student_m->get_donepay($session_nokp); //dbug($semakdata_student);
    $this->template->set('semakdonepay', $semakdonepay);

    $semakhistory_paymentmc = $this->student_m->get_historystudpaymc(); //dbug($semakdata_student);
    $this->template->set('semakhistory_paymentmc', $semakhistory_paymentmc);

    $semakhistory_paymentsp = $this->student_m->get_historystudpaysp(); //dbug($semakdata_student);
    $this->template->set('semakhistory_paymentsp', $semakhistory_paymentsp);

    $semakcertificate_student = $this->student_m->get_certificate($session_nokp); //dbug($semakdata_student);
    $this->template->set('semakcertificate_student', $semakcertificate_student);



      $this->template->set('tab1', ''); //profile
      $this->template->set('tab2', ''); //change_pswd
      $this->template->set('tab3', ''); //course_list
      $this->template->set('tab4', ''); //orders
      $this->template->set('tab5', ''); //history
      $this->template->set('tab6', ''); //bill
      $this->template->set('tab7', ''); //photo

      $this->template->set('tab_pane1', 'tab-pane fade');
      $this->template->set('tab_pane2', 'tab-pane fade');
      $this->template->set('tab_pane3', 'tab-pane fade');
      $this->template->set('tab_pane4', 'tab-pane fade');
      $this->template->set('tab_pane5', 'tab-pane fade');
      $this->template->set('tab_pane6', 'tab-pane fade');
      $this->template->set('tab_pane7', 'tab-pane fade');


      /*set tab mana yang aktif*/
      if($this->session->flashdata('tab')=='1'){ //home
        $this->template->set('tab1', 'active');
        $this->template->set('tab_pane1', 'tab-pane fade show active');

      }elseif($this->session->flashdata('tab')=='2'){ //level
        $this->template->set('tab2', 'active');
        $this->template->set('tab_pane2', 'tab-pane fade show active');

      }elseif($this->session->flashdata('tab')=='3'){ //level
        $this->template->set('tab3', 'active');
        $this->template->set('tab_pane3', 'tab-pane fade show active');

      }elseif($this->session->flashdata('tab')=='4'){ //agent
        $this->template->set('tab4', 'active');
        $this->template->set('tab_pane4', 'tab-pane fade show active');

      }elseif($this->session->flashdata('tab')=='5'){ //declaration
        $this->template->set('tab5', 'active');
        $this->template->set('tab_pane5', 'tab-pane fade show active');

      }elseif($this->session->flashdata('tab')=='6'){ //declaration
        $this->template->set('tab6', 'active');
        $this->template->set('tab_pane6', 'tab-pane fade show active');

      }elseif($this->session->flashdata('tab')=='7'){ //declaration
        $this->template->set('tab7', 'active');
        $this->template->set('tab_pane7', 'tab-pane fade show active');

      }else{
        $this->template->set('tab3', 'active');
        $this->template->set('tab_pane3', 'tab-pane fade show active');
      }


      $this->template->set('action_save_tab_profile', base_url('student/save_tab_profile/'));

      $this->template->set('action_save_tab_changepswd', base_url('student/save_tab_changepswd/'));

      $this->template->set('action_save_tab_courselist', base_url('student/save_tab_courselist/'));

      $this->template->set('action_save_tab_certificate', base_url('student/save_tab_certificate/'));

      $this->template->set('action_save_tab_historypurchase', base_url('student/save_tab_historypurchase/'));

      $this->template->set('action_save_tab_changephoto', base_url('student/save_save_tab_changephoto/'));

      //$this->template->set('action_save_tab_certificate', base_url('student/save_tab_certificate/'));






    /*
		//checking session_id
		if (empty($session_student)) {
      redirect('main/signin/','location');
    } else {
      $this->template->render('student_f/profile');
    }
    */
    //$this->template->set('script_content','student_f/script/script-changepassword');
    $this->template->set('script_content','student_f/script/script-profile');
    $this->template->render('student_f/profile');
  }


  public function save_tab_profile($value='')
  {
    $session_nokp = trim($this->session->userdata('session_student')['nokp']);

    if ($this->input->post('btn_update')) {

      $txt_name = trim(strtoupper(trim($this->input->post('txt_name'))));
      $txt_emel = trim($this->input->post('txt_emel'));
      $txt_alamat1 = trim(strtoupper(trim($this->input->post('txt_alamat1'))));
      $txt_alamat2 = trim(strtoupper(trim($this->input->post('txt_alamat2'))));
      $txt_alamat3 = trim(strtoupper(trim($this->input->post('txt_alamat3'))));
      $txt_city = trim(strtoupper(trim($this->input->post('txt_city'))));
      $txt_state = trim(strtoupper(trim($this->input->post('txt_state'))));
      $txt_country = trim(strtoupper(trim($this->input->post('txt_country'))));
      $txt_poscode = trim(strtoupper(trim($this->input->post('txt_poscode'))));
      $txt_tel = trim(strtoupper(trim($this->input->post('txt_tel'))));
      $txt_academic = trim(strtoupper(trim($this->input->post('txt_academic'))));
      $txt_nmacademic = trim(strtoupper(trim($this->input->post('txt_nmacademic'))));

      $update_student = array(
        'nama' => $txt_name,
        'emel' => $txt_emel,
        'alamat1' => $txt_alamat1,
        'alamat2' => $txt_alamat2,
        'alamat3' => $txt_alamat3,
        'bandar' => $txt_city,
        'negeri' => $txt_state,
        'negara' => $txt_country,
        'poskod' => $txt_poscode,
        'akadtertinggi' => $txt_academic,
        'nmsijil' => $txt_nmacademic,

      );
      if(!empty($_FILES["txt_academicfile"]['name'])) {
        if(!is_dir(STORAGEPATH.$this->session->userdata('session_student')['user_id'])){
            if (!mkdir(STORAGEPATH.$this->session->userdata('session_student')['user_id'], 0777, TRUE)) {//0777
                echo '<b>Failed to upload files</b>.';
            } else {
              chmod(STORAGEPATH.$this->session->userdata('session_student')['user_id'], 0777);
            }
        }

        $config['upload_path'] = STORAGEPATH.$this->session->userdata('session_student')['user_id'];
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

      $this->student_m->update_data_student($update_student, $session_nokp);
      $this->session->set_flashdata('mesej', 'Success! Information saved.');
      $this->session->set_flashdata('mesej_css','alert alert-success alert-dismissible');
      $this->session->set_flashdata('tab','1');


    }

    redirect('student/profile/','location');
  }


  public function save_tab_changepswd($value='')
  {
    $session_nokp = trim($this->session->userdata('session_student')['user_id']);
    $email = $this->session->userdata('session_student')['email'];

    if ($this->input->post('btn_chngepswd')) {

      // $txt_newpass = trim($this->input->post('txt_newpass'));
      // $txt_repass = trim($this->input->post('txt_repass'));

      $txt_repass = trim($this->input->post('txt_newpass'));

      if($this->input->ip_address() == '34.126.171.240') {
        // dbug($session_nokp);
        // dbug($this->session->userdata('session_student'));
        // die;
      }


      $params1 = array(
        'email' => $email,
        'password' => $txt_repass
      );

      $params2 = serialize($params1);
      $serialize = base64_encode($params2);

      $password = $serialize;

       $update_pswd = array(
        'password' => $password,
      );

      $this->student_m->update_data_users($update_pswd, $session_nokp);


      //password ke lms


      $this->session->set_flashdata('mesej', 'Success! Information saved.');
      $this->session->set_flashdata('mesej_css','alert alert-success alert-dismissible');
      $this->session->set_flashdata('tab','2');
    }

    redirect('student/profile/','location');
  }


  public function save_save_tab_changephoto($value='')
  { 
    $session_nokp = trim($this->session->userdata('session_student')['user_id']); //dbug($session_nokp );

    //dbug($this->input->post('btn_chngephoto')); die();

    if ($this->input->post('btn_chngephoto')) { //echo "hello"; die();

        //dbug($_FILES["txt_photo"]['name']); die();

        if(!empty($_FILES["txt_photo"]['name'])) {

            if(!is_dir(STORAGEPATH.$session_nokp)){
                if (!mkdir(STORAGEPATH.$session_nokp, 0777, TRUE)) {//0777
                    echo '<b>Failed to upload files</b>.';
                } else {
                  chmod(STORAGEPATH.$session_nokp, 0777);
                }
            }

            $config['upload_path'] = STORAGEPATH.$session_nokp; //dbug($config['upload_path'] ); die();

            $config['allowed_types'] = 'jpg|jpeg|png';

            $new_name = 'gambar_'.$session_nokp;

            $path = $_FILES["txt_photo"]['name'];

            $ext = pathinfo($path, PATHINFO_EXTENSION);

            $config['file_name'] = $new_name.'.'.$ext; //dbug($config['file_name']); die();

            echo $config['upload_path'].$config['file_name'];  //dbug(file_exists($config['upload_path'].$config['file_name'])); die();

            if (file_exists($config['upload_path'].$config['file_name'])) {

               unlink($config['upload_path'].'/'.$config['file_name']);

            }

            $this->load->library('upload',$config);

            $this->upload->initialize($config);

            $update_student = array(

                'gambar'=>$config['file_name']

            );

            //update data_users
            $this->student_m->update_data_users($update_student, $session_nokp);
            $this->session->set_flashdata('mesej', 'Success! Information saved.');
            $this->session->set_flashdata('mesej_css','alert alert-success alert-dismissible');
            $this->session->set_flashdata('tab','7');

            if(!$this->upload->do_upload("txt_photo")) {

                echo '<b>'.$this->upload->display_errors().'</b>.';
            } else {
              $file_data = $this->upload->data();
              $resize['image_library'] = 'gd2';
              $resize['create_thumb'] = TRUE;
              $resize['maintain_ratio'] = TRUE;
              $resize['quality'] = '100%';
              $resize['width'] = 400;
              $resize['height'] = 400;
              $resize['source_image'] = $file_data['full_path'];
              $this->load->library('image_lib', $resize);
              if (!$this->image_lib->resize()) {
                  echo $this->image_lib->display_errors();
              }
            }
        }
    }

    redirect('student/profile/','location');
  }



  public function course_details()
	{
    if($this->uri->segment(3) !== NULL) {
      $this->template->set('course_id', $this->uri->segment(3));
    }

    //$this->template->set('script_content','student_f/script/script-course-details');
		$this->template->render('student_f/course-details');
	}

  public function payment() {
    if($this->input->get('type')) {
      $type = $this->input->get('type');
      $noinvoice = $this->input->get('noinvoice');
      $this->session->set_userdata('inv_no', $noinvoice);
      if($type == 'MC') {
        redirect('MC/carts/payment');
      } else if($type == 'SP') {
        redirect('SP/carts/payment');
      }
    } else {
      redirect('student/profile');
    }

  }

  public function personaldetail() {
    if($this->input->get('noinvoice')) {
      $noinvoice = $this->input->get('noinvoice');
      $this->session->set_userdata('inv_no', $noinvoice);
      //$this->session->set_userdata('order_no', $order_id);
      redirect('SP/carts/payment');
    } else {
      redirect('student/profile');
    }
  }

  public function cancel() {
    if($this->input->get('order_id')) {
      $order_id = $this->input->get('order_id');
      $user_id = $this->session->userdata('session_student')['user_id'];
      $type = '';
      if(stripos($order_id, 'POS') !== false) {
        $type = 'SP';
      } else if(stripos($order_id, 'POM') !== false) {
        $type = 'MC';
      }

      $getdata = $this->student_m->get_param_kursus_by_invoice($user_id, $order_id, $type);

      dbug($getdata);die;

      $remove = $this->student_m->remove_order($order_id,$type);
      $this->student_m->remove_order_cart($order_id);
      $this->student_m->remove_order_invoice($order_id);
      $this->student_m->remove_order_param($getdata[0]->idcart);

      if($remove) {
        $this->session->set_flashdata('mesej', 'Success! Purchase has removed.');
        $this->session->set_flashdata('mesej_css','alert alert-success alert-dismissible');
        $this->session->set_flashdata('tab','5');
      } else {
        $this->session->set_flashdata('mesej', 'Error! Please try again.');
        $this->session->set_flashdata('mesej_css','alert alert-danger alert-dismissible');
        $this->session->set_flashdata('tab','5');
      }
    }
      redirect('student/profile');
  }

}
