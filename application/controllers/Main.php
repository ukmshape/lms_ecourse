<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

  public function __construct() {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('form');
      $this->load->library('pagination');
      $this->load->library('encrypt');
      $this->load->helper('file');
      $this->load->model('main_m');
      $this->load->model('cart_m');
      //$this->output->enable_profiler(TRUE);
  }

  public function testpdata() {
    //dbug($this->main_m->pdata());
    dbug($this->input->ip_address());
  }

  /* public function test() {

    $this->session->unset_userdata('session_student');

    $arr = array(
      'pemohon_id' => 6,
      'nama' => "Olivia White",
      'nokp' => "E12345678",
      'carttotal' => count($this->cart_m->get_data_cart('E12345678'))
    );
		$this->session->set_userdata('session_student',$arr);
    dbug($this->session->userdata('session_student'));
  } */

  public function index() {
		$this->template->render('main_f/mainpage');
  }

/*
	public function index()
	{

    //$key = $this->encrypt->encode(7);
    //dbug($key);

    // start of uri_segment codes //
    $search = $prgm = $filter = '';

    if($this->uri->segment(4) !== NULL && !is_numeric($this->uri->segment(4))) {
      if($this->uri->segment(4) == 'MC') { // if($this->uri->segment(3) == 'mc' || $this->uri->segment(3) == 'sp' || $this->uri->segment(3) == 'kp') {
        $prgm = $this->uri->segment(4);
      } else {
        $search = $this->uri->segment(4);
      }
    }

    if($this->uri->segment(3) !== NULL && !is_numeric($this->uri->segment(3))) {
      $filter = $this->encryption->decrypt($this->uri->segment(3));
    } else {
    }

    if($this->uri->segment(5) !== NULL && !is_numeric($this->uri->segment(5))) {
      $search = $this->uri->segment(5);
      $this->template->set('search',$search);
    } else {
      $this->template->set('search','');
    }

    // https://pkp.ukm.my/ecourse/main?search=&prgm=mc&filter=7&nm=Fakulti%20Ekonomi%20dan%20Pengurusan

    // start of pagination codes //
    $urisegment = '';
    for($i = 3; $i < count($this->uri->segment_array()); $i++) {
      $urisegment .= $this->uri->slash_segment($i, 'leading');
    }
    $config = array();
    $config["base_url"] = base_url().'main/index'.$urisegment;

    if($search != '' || $prgm != '' || $filter != '') {
      if($prgm == 'MC') {
        $totalMC = $this->main_m->get_totalcourse_list_mcodlukm_search($search,$filter,$prgm);
      }
    } else {
      $totalMC = $this->main_m->get_totalcourse_list_mcodlukm();
    }
    // $totalSP
    // $totalKP
    $config["total_rows"] = count($totalMC); // count($totalMC) + count($totalSP) + count($totalKP);
    $config["per_page"] = 6;
    $last = $this->uri->total_segments()-2;
    $record_num = $this->uri->segment($last);
    if(is_numeric($record_num)) {
      $record_num = $record_num;
    } else {
      $record_num = 0;
    }
    $config["uri_segment"] = $record_num;
    $this->pagination->initialize($config);

    $last = $this->uri->total_segments();
    $record_num = $this->uri->segment($last);
    if(is_numeric($record_num)) {
      $record_num = $record_num;
    } else {
      $record_num = 0;
    }

    $page = ($record_num) ? $record_num : 0;

    $links = $this->pagination->create_links();
    $this->template->set('links',$links);
    // end of pagination codes //


    // uri_segment checking //
    if($search != '' || $prgm != '' || $filter != '') {
      $mdl_courselist = $this->main_m->get_course_list_mcodlukm_search($search,$filter,$config["per_page"], $page, $prgm);

    } else {
      $mdl_courselist = $this->main_m->get_course_list_mcodlukm($config["per_page"], $page, $prgm);
    }
    // end of uri_segment checking //


		$this->template->set('mdl_courselist', $mdl_courselist);

    $mdl_course_catergorieslst = $this->main_m->get_course_list_catergories();
    $this->template->set('mdl_course_catergorieslst', $mdl_course_catergorieslst);

    $this->template->set('script_content','main_f/script/script-homepage');
		$this->template->render('main_f/homepage');
	}
*/


  public function course_details()
	{
    $this->load->library("simple_html_dom");
    if($this->uri->segment(3) !== NULL) {
      $mdl_courselist = $this->main_m->get_course_detail_mcodlukm($this->uri->segment(3));
      if($mdl_courselist) {
        $type = strstr($mdl_courselist[0]->idnumber, '-', true);
        if($type) {
            $this->template->set('mdl_courselist', $mdl_courselist);
            $this->template->set('script_content','main_f/script/script-course-details');
            $this->template->render('main_f/course-detailsdev');
        }
      } else {
        $this->template->set('heading', '');
        $this->template->set('message', 'Please Contact the admin');
        $this->template->render('main_f/error_404');
      }
    }
	}


  public function carts()
	{
    if($this->session->userdata('session_student')) {
      $cart_list = $this->cart_m->get_data_cart($this->session->userdata('session_student')['nokp']);
      $this->template->set('cart_list', $cart_list);
    }

		$this->template->render('main_f/carts');
	}



  public function signin() {
    $this->template->render('main_f/signin');
    //$this->template->render('main_f/maintenance');
  }

  public function test_signin() {
    $this->template->render('main_f/signin');
  }

  public function signin_moodle() {
    if($this->session->userdata('session_student')) {
      $user_id = $this->session->userdata('session_student')['user_id'];
      $user = $this->main_m->get_data_users_id($user_id);
      $password = '';

      /* $cacheall = $this->main_m->get_cache();
      foreach ($cacheall as $value => $key) {
        if($this->encryption->decrypt($key->id) == $user_id) {
          $password = file_get_contents('./documents/cache/libraries/crypt/'.$key->id.'/'.$key->cache_file);
        }
      } */

      if($user) {
        $this->template->set('email', $user[0]->email);

        $unserialize = unserialize(base64_decode($user[0]->password));

        $password = $unserialize['password'];

        $this->template->set('password', $password);
      }

    } else if($this->session->userdata('session_ukmper')) {
      $user_id = $this->session->userdata('session_ukmper')['id'];
      $user = $this->main_m->get_data_users_id($user_id);

      $password = '';

      /* $cacheall = $this->main_m->get_cache();
      foreach ($cacheall as $value => $key) {
        if($this->encryption->decrypt($key->id) == $user_id) {
          $password = file_get_contents('./documents/cache/libraries/crypt/'.$key->id.'/'.$key->cache_file);
        }
      }*/

      if($user) {
        $this->template->set('email', $user[0]->email);

        $unserialize = unserialize(base64_decode($user[0]->password));

        $password = $unserialize['password'];

        $this->template->set('password', $password);
      }

    }
    $this->template->render('main_f/signin_moodle');
  }

  public function signout() {
    $this->session->sess_destroy();
    redirect('main');
  }

  public function signup() {
    $this->template->set('script_content', '/main_f/script/script-signup');
    $this->template->render('main_f/signup');
  }

  public function registration($value=''){

    if($this->input->post('btn_signup')) {
      $nama = $this->input->post('txt_nama');
      //$icno = $this->input->post('txt_kpkini');
      $email = trim($this->input->post('txt_email'));
      $telefon = $this->input->post('txt_telefon');
      $txt_password = trim($this->input->post('txt_password'));

      $params1 = array(
        'email' => $email,
        'password' => $txt_password
      );

      $params2 = serialize($params1);
      $serialize = base64_encode($params2);

      $password = $serialize;

      $id = uniqid('user_'.rand());

      if(!$this->main_m->get_data_users($email)) {
        $data_user = array(
          'id' => $id,
          'fullname' => $nama,
          'email' => $email,
          'password' => $password,
          'type' => 'Student',
          'active' => 'active'
        );

        $this->main_m->insert_data_users($data_user);

        $signup = array(
          'user_id' => $id,
          'nama' => $nama,
          //'ic' => $icno,
          'emel' => $email,
          'notel' => $telefon
        );
        $this->main_m->insert_signup($signup);

        // $cache_id = $this->encryption->encrypt($id);

        // if(!is_dir('documents/cache/libraries/crypt/'.$cache_id)) {
        //     if (!mkdir('documents/cache/libraries/crypt/'.$cache_id, 0777, TRUE)) {//0777
        //         echo '<b>Failed to upload files</b>.';
        //     } else {
        //       chmod('documents/cache/libraries/crypt/'.$cache_id, 0777);
        //     }
        // }

        // $password_encrypt = $this->encryption->encrypt($password);

        // $data = $this->input->post('txt_password');
        // if ( ! write_file('./documents/cache/libraries/crypt/'.$cache_id.'/'.$password_encrypt, $data))
        // {
        //   $this->session->set_flashdata('mesej', '<b>Account Already Exist!</b>');
        //   $this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible fade show');
        //   redirect('main/signup/', 'refresh');
        // }
        // else
        // {
        //         $signup = array(
        //           'id' => $cache_id,
        //           'cache_file' => $password_encrypt
        //         );
        //         $this->main_m->insert_cache($signup);
        // }

        $data['email'] = $email;
        $data['name'] = $nama;

        $message = $this->load->view('templates/email_welcome', $data, true);

        $this->email->from('no-reply-ecourse@ukm.edu.my', 'eCOURSE');
        $this->email->to($email);
        //$this->email->cc('studymc@ukm.edu.my');
        $this->email->subject('eCOURSE : Welcome to eCOURSE!');
        $this->email->message($message);
        $this->email->set_mailtype("html");
        $this->email->send();

        $this->session->set_flashdata('mesej', '<b>Successfully Register</b>');
        $this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
        redirect('main/signin/', 'refresh');

      } else {
        $this->session->set_flashdata('mesej', '<b>Account Already Exist!</b>');
        $this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible fade show');
        redirect('main/signup/', 'refresh');
      }
    }

  }

  public function forgetpassword() {
    $this->template->render('main_f/forget-password');
  }

  public function submit_forgetpassword() {
    $email = $this->input->post('txt_email');
    $datauser = $this->main_m->check_data_user($email);
    if($datauser) {

      $temporarypassword = bin2hex(random_bytes(10));

      $params1 = array(
        'email' => $datauser[0]->email,
        'password' => $temporarypassword
      );

      $params2 = serialize($params1);
      $serialize = base64_encode($params2);

      $password = $serialize;

      $input_data_user = array(
        'id' => $datauser[0]->id,
        'password' => $password
      );

      $update = $this->main_m->update_data_user($input_data_user);

      $message = "Dear ".$datauser[0]->fullname.",<br/><br/>

      It looks like you need help to login. Here is your temporary password: <b>".$temporarypassword."</b>. <br/><br/>

      Please make sure to change your password in <a href='".base_url('/student/profile#change-password')."'>My Account</a>. <br/><br/>

      If you did not perform this request, please ignore this email and be rest assured your account is safe with us.<br/><br/>

      Yours sincerely,<br/><br/>

      ecourse.ukm.my team";

      $this->email->from('no-reply-ecourse@ukm.edu.my', 'eCOURSE');
      $this->email->to($email);
      //$this->email->cc('studymc@ukm.edu.my');
      $this->email->subject('eCOURSE : Reset Password');
      $this->email->message($message);
      $this->email->set_mailtype("html");
      $this->email->send();

      $this->session->set_flashdata('mesej', '<b>Successfully. Please check your email.</b>');
      $this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');
      $this->template->render('main_f/forget-password', 'refresh');
    } else {
      $this->session->set_flashdata('mesej', '<b>Account Not Exist!</b>');
      $this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible fade show');
      $this->template->render('main_f/forget-password', 'refresh');
    }
  }

  public function contactUs() {
    $this->template->render('main_f/contactUs');
  }

  public function faqs() {
    $this->template->render('main_f/faq');
  }

  public function payment() {
    $this->template->render('main_f/payment');
  }

  /*public function test1() {

    $cache_id = $this->encryption->encrypt($this->session->userdata('session_student')['user_id']);

    if(!is_dir('documents/cache/libraries/crypt/'.$cache_id)) {
        if (!mkdir('documents/cache/libraries/crypt/'.$cache_id, 0777, TRUE)) {//0777
            echo '<b>Failed to upload files</b>.';
        } else {
          chmod('documents/cache/libraries/crypt/'.$cache_id, 0777);
        }
    }

    $password_encrypt = $this->encryption->encrypt(trim(strtoupper(md5(trim('Admin(123)')))));

    $data = 'Admin(123)';
    if ( ! write_file('./documents/cache/libraries/crypt/'.$cache_id.'/'.$password_encrypt, $data))
    {
      $this->session->set_flashdata('mesej', '<b>Account Already Exist!</b>');
      $this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible fade show');
      redirect('main/signup/', 'refresh');
    }
    else
    {
            $signup = array(
              'id' => $cache_id,
              'cache_file' => $password_encrypt
            );
            $this->main_m->insert_cache($signup);
    }
    /*
    if($this->session->get_userdata('session_ukmper')) {
      $cacheall = $this->main_m->get_cache();
      $user_id = $this->session->get_userdata('session_ukmper')['id'];
      foreach ($cacheall as $key) {
        if($this->encryption->decrypt($key->id) == $user_id) {
          echo file_get_contents('./documents/cache/libraries/crypt/'.$key->id.'/'.$key->cache_file);
        }
      }

    } else if($this->session->get_userdata('session_student')) {

      $user_id = $this->session->get_userdata('session_student')['user_id'];
      foreach ($cacheall as $key) {
        if($this->encryption->decrypt($key->id) == $user_id) {
          echo file_get_contents('./documents/cache/libraries/crypt/'.$key->id.'/'.$key->cache_file);
        }
      }
    }

  }*/
}
