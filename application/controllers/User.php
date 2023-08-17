<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

  public function __construct() {
      parent::__construct();
      if(empty($this->session->userdata("session_ukmper")))
	   	{
	   		redirect(base_url()."main/signin",'refresh');
	   	}
      $this->load->model('auth_m');
      $this->load->model('user_m');
      //$this->output->enable_profiler(TRUE);
  }

	public function dashboard()
	{
    $this->template->render('user_f/dashboard');
	}

  public function list_user()
  {
		$list_user = $this->user_m->get_list_data_user();
		$this->template->set('list_user', $list_user);

    $this->template->render('user_f/listuser');
  }

  public function add_user()
  {
    if($this->input->post('btn_submit') != null) {
      $txt_fullname = $this->input->post('txt_fullname');
      $txt_email = $this->input->post('txt_email');
      $txt_password = $this->input->post('txt_password');
      $txt_type = $this->input->post('txt_type');
      $txt_faculty = $this->input->post('txt_faculty');
      $txt_active = $this->input->post('txt_active');

      $password = trim(strtoupper(md5($txt_password)));
      $id = uniqid('user_'.rand());

      $data = array(
        'id' => $id,
        'fullname' => $txt_fullname,
        'email' => $txt_email,
        'type' => $txt_type,
        'password' => $password,
        'faculty' => $txt_faculty,
        'active' => $txt_active
      );
      if(!$this->user_m->get_data_usersbyemail($txt_email)) {
        $insert_data_users = $this->user_m->insert_data_users($data);

        $cache_id = $this->encryption->encrypt($id);

        if(!is_dir('documents/cache/libraries/crypt/'.$cache_id)) {
            if (!mkdir('documents/cache/libraries/crypt/'.$cache_id, 0777, TRUE)) {//0777
                echo '<b>Failed to upload files</b>.';
            } else {
              chmod('documents/cache/libraries/crypt/'.$cache_id, 0777);
            }
        }

        $password_encrypt = $this->encryption->encrypt($password);

        $data = $this->input->post('txt_password');
        if ( ! write_file('./documents/cache/libraries/crypt/'.$cache_id.'/'.$password_encrypt, $data)) {
          $echo =  base_url('/user/add_user');
          echo "<script>alert('Completed');
                  window.location.href = '".$echo."'
               </script>";
        } else {
          echo "<script>alert('Please try again.');
                  location.reload();'
               </script>";
        }
      } else {
        echo "<script>alert('User already exist');
                location.reload();'
             </script>";
      }


    }

    $usertype = $this->user_m->get_data_user_type();
    $this->template->set('usertype', $usertype);

    $this->template->set('script_content','user_f/script/script-user');
    $this->template->render('user_f/createuser');
  }

  public function edit_user($parameter)
  {
    if($this->input->post('btn_submit') != null) {

      $user_id = $this->input->post('user_id');
      $txt_fullname = $this->input->post('txt_fullname');
      $txt_email = $this->input->post('txt_email');
      $txt_type = $this->input->post('txt_type');
      $txt_faculty = $this->input->post('txt_faculty');
      $txt_active = $this->input->post('txt_active');

      $data = array(
        'id' => $user_id,
        'fullname' => $txt_fullname,
        'email' => $txt_email,
        'type' => $txt_type,
        'faculty' => $txt_faculty,
        'active' => $txt_active
      );

      $update_data_user = $this->user_m->update_data_user($data);

      if($update_data_user) {
        $echo =  base_url('/user/list_user');
        echo "<script>alert('Completed');
                window.location.href = '".$echo."'
             </script>";
      } else {
        echo "<script>alert('Please try again.');
                location.reload();'
             </script>";
      }
      //die;
    }

    $usertype = $this->user_m->get_data_user_type();
    $this->template->set('usertype', $usertype);

    $id = $this->encryption->decrypt($parameter);
    $data_user = $this->user_m->get_data_users($id);
    $this->template->set('data_user', $data_user);

    $this->template->set('script_content','user_f/script/script-user');
    $this->template->render('user_f/edituser');
  }

  public function password_user($parameter)
  {
    if($this->input->post('btn_submit') != null) {

      $user_id = $this->input->post('user_id');
      $email = $this->input->post('email');
      // $txt_password = $this->input->post('txt_password');

      // $txt_nopassword = trim(strtoupper(md5(trim($txt_password))));

      // $data = array(
      //   'id' => $user_id,
      //   'password' => $txt_nopassword
      // );

      $txt_repass = trim($this->input->post('txt_password'));

      $params1 = array(
        'email' => $email,
        'password' => $txt_repass
      );

      $params2 = serialize($params1);
      $serialize = base64_encode($params2);

      $password = $serialize;

       $update_pswd = array(
        'id' => $user_id,
        'password' => $password,
      );

      $update_data_user = $this->user_m->update_data_user($update_pswd);

      if($update_data_user) {
        $echo =  base_url('/user/list_user');
        echo "<script>alert('Completed');
                window.location.href = '".$echo."'
             </script>";
      } else {
        echo "<script>alert('Please try again.');
                location.reload();'
             </script>";
      }
      //die;
    }

    $id = $this->encryption->decrypt($parameter);
    $data_user = $this->user_m->get_data_users($id);
    $this->template->set('data_user', $data_user);

    $this->template->set('script_content','user_f/script/script-user');
    $this->template->render('user_f/passworduser');
  }

  public function delete($parameter) {
    $id = $this->encryption->decrypt($parameter);

    //$data_user = $this->user_m->get_data_users($id);

    /*if($data_customfieldform) {
      $echo =  base_url('/custom/custom_field');
      echo "<script>alert('Cannot Delete This Field. The field is used in Course Application!');
              window.location.href = '".$echo."'
           </script>";
    } else {*/
      $insert_custom_field = $this->user_m->delete_user($id);

      if($insert_custom_field) {
        $echo =  base_url('/user/list_user');
        echo "<script>alert('Completed');
                window.location.href = '".$echo."'
             </script>";
      } else {
        echo "<script>alert('Please try again.');
                location.reload();'
             </script>";
      }
    //}
  }

  public function role_list()
  {

		$list_course = $this->user_m->get_mcodlukm_course();
		$this->template->set('list_course', $list_course);

    $this->template->render('user_f/listcourseuser');
  }

  public function user_roles($parameter) {
    $course_id = $this->encryption->decrypt($parameter);
    $this->template->set('course_id', $course_id);

    $enrol = $this->user_m->get_totalenrolment($course_id);
    $this->template->set('enrol', $enrol);

    $this->template->render('user_f/listrole');
  }

  public function add_role($parameter) {
    $course_id = $this->encryption->decrypt($parameter);
    $this->template->set('course_id', $course_id);

    $usertype = $this->user_m->get_data_user_type();
    $this->template->set('usertype', $usertype);

    $this->template->set('script_content','user_f/script/script-addroles');
    $this->template->render('user_f/addroles');
  }

  public function categories_list() {

  }




  // AJAX //
  public function ajax_getuserbyfaculty() {
    $faculty = $this->input->post('faculty');

    $getuser = $this->user_m->get_userbyfaculty($faculty);

    echo json_encode($getuser);
  }
















  public function detail_custom($parameter)
  {
    if($this->input->post('btn_submit') != null) {
      $course_id = $this->input->post('course_id');

      $txt_sponsor = $this->input->post('txt_sponsor');
      $txt_installment = $this->input->post('txt_installment');
      $txt_deposit = $this->input->post('txt_deposit');
      $txt_ins1 = $this->input->post('txt_ins1');
      $txt_ins2 = $this->input->post('txt_ins2');
      $txt_ins3 = $this->input->post('txt_ins3');
      $txt_validate = $this->input->post('txt_validate');

      $getcustomfixed = $this->custom_m->get_customformfixed($course_id);

      if($getcustomfixed) {
        $datafixed = array(
          'form_id' => $getcustomfixed[0]->form_id,
          'kursusid' => $course_id,
          'semakfakulti' => $txt_validate,
          'sponsorship' => $txt_sponsor,
          'installment' => $txt_installment,
          'deposit' => $txt_deposit,
          'ins_1' => $txt_ins1,
          'ins_2' => $txt_ins2,
          'ins_3' => $txt_ins3
        );

        $this->custom_m->update_customformfixed($datafixed);

      } else {
        $datafixed = array(
          'kursusid' => $course_id,
          'semakfakulti' => $txt_validate,
          'sponsorship' => $txt_sponsor,
          'installment' => $txt_installment,
          'deposit' => $txt_deposit,
          'ins_1' => $txt_ins1,
          'ins_2' => $txt_ins2,
          'ins_3' => $txt_ins3
        );

        $this->custom_m->insert_customformfixed($datafixed);

      }

      $txt_label = $this->input->post('txt_label');

      if($txt_label != '') {
        $no = 0;
        $this->custom_m->update_customform($course_id);
        for($i = 0; $i < count($txt_label); $i++) {
          if($txt_label[$i] != '') {
            $inputArray = array(
              'custom_id' => $txt_label[$i],
              'kursusid' => $course_id,
              'orderby' => ++$no
            );
            $this->custom_m->insert_customform($inputArray);
          }
        }
      }

      $this->session->set_flashdata('mesej', '<b>Successfully Update Custom Form</b>');
      $this->session->set_flashdata('mesej_css', 'alert alert-success alert-dismissible fade show');

    }

    $this->load->library("simple_html_dom");

    $course_id = $this->encryption->decrypt($parameter);
    $this->template->set('course_id', $course_id);

    $course = $this->custom_m->get_course_detail_mcodlukm($course_id);
		$this->template->set('course', $course);

    $customform = $this->custom_m->get_customform($course_id);
		$this->template->set('customform', $customform);

    $customformloop = $this->custom_m->get_customfield_customform_1($course_id);
		$this->template->set('customformloop', $customformloop);

    $custom_field = $this->custom_m->get_list_custom_field();
		$this->template->set('custom_field', $custom_field);
    $this->template->set('jqcustom_field', json_encode($custom_field));

		$getForm = $this->custom_m->get_customformfixed($course_id);
		$this->template->set('getForm', $getForm);

    $this->template->set('script_content','custom_f/script/script-customform');
    $this->template->render('custom_f/customform');
  }


}
