<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom extends CI_Controller {

  public function __construct() {
      parent::__construct();
      if(empty($this->session->userdata("session_ukmper")))
	   	{
	   		redirect(base_url()."main/signin",'refresh');
	   	}
      $this->load->model('auth_m');
      $this->load->model('custom_m');
      //$this->output->enable_profiler(TRUE);
  }

	public function dashboard()
	{
    $this->template->render('custom_f/dashboard');
	}

  public function custom_field()
  {
		$list_course = $this->custom_m->get_list_custom_field();
		$this->template->set('list_course', $list_course);

    $this->template->render('custom_f/listfield');
  }

  public function add_custom_field()
  {
    if($this->input->post('btn_submit') != null) {
      $txt_label = $this->input->post('txt_label');
      $txt_type = $this->input->post('txt_type');
      $txt_shortname = $this->input->post('txt_shortname');
      $txt_value = $this->input->post('txt_value');
      $txt_required = $this->input->post('txt_required');
      $txt_show = $this->input->post('txt_show');

      $data = array(
        'title' => $txt_label,
        'type' => $txt_type,
        'shortname' => $txt_shortname,
        'required' => $txt_required,
        'show_field' => $txt_show
      );

      if(strpos($txt_value, ',') !== false) {
        $txt_value = array_map('trim', explode(',', $txt_value));
        $data['value'] = json_encode($txt_value);
      }



      $insert_custom_field = $this->custom_m->insert_custom_field($data);

      if($insert_custom_field) {
        $echo =  base_url('/custom/custom_field');
        echo "<script>alert('Completed');
                window.location.href = '".$echo."'
             </script>";
      } else {
        echo "<script>alert('Please try again.');
                location.reload();'
             </script>";
      }

    }

    $list_field = $this->custom_m->get_list_custom_field();
    $titleVal = array();

    if(isset($list_field)) {
      foreach ($list_field as $field) {
        array_push($titleVal, $field->shortname);
      }
      $titleVal = json_encode($titleVal);
    }

		$this->template->set('titleVal', $titleVal);

    $this->template->set('script_content','custom_f/script/script-customfield');
    $this->template->render('custom_f/customfield');
  }

  public function edit_custom_field($parameter)
  {
    if($this->input->post('btn_submit') != null) {

      $custom_id = $this->input->post('custom_id');
      $txt_label = $this->input->post('txt_label');
      $txt_type = $this->input->post('txt_type');
      $txt_shortname = $this->input->post('txt_shortname');
      $txt_value = $this->input->post('txt_value');
      $txt_required = $this->input->post('txt_required');
      $txt_show = $this->input->post('txt_show');

      if(strpos($txt_value, ',') !== false) {
        $txt_value = array_map('trim', explode(',', $txt_value));
      }

      $data = array(
        'custom_id' => $custom_id,
        'title' => $txt_label,
        'type' => $txt_type,
        'shortname' => $txt_shortname,
        'value' => json_encode($txt_value),
        'required' => $txt_required,
        'show_field' => $txt_show
      );

      $insert_custom_field = $this->custom_m->update_custom_field($data);

      if($insert_custom_field) {
        $echo =  base_url('/custom/custom_field');
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
    $data_customfield = $this->custom_m->get_custom_field($id);
    $this->template->set('data_custom', $data_customfield);

    $this->template->set('script_content','custom_f/script/script-customfield');
    $this->template->render('custom_f/customfield');
  }

  public function delete($parameter) {
    $id = $this->encryption->decrypt($parameter);

    $data_customfieldform = $this->custom_m->get_customfield_customform($id);

    if($data_customfieldform) {
      $echo =  base_url('/custom/custom_field');
      echo "<script>alert('Cannot Delete This Field. The field is used in Course Application!');
              window.location.href = '".$echo."'
           </script>";
    } else {
      $insert_custom_field = $this->custom_m->delete_custom_field($id);

      if($insert_custom_field) {
        $echo =  base_url('/custom/custom_field');
        echo "<script>alert('Completed');
                window.location.href = '".$echo."'
             </script>";
      } else {
        echo "<script>alert('Please try again.');
                location.reload();'
             </script>";
      }
    }
  }

  public function custom_list()
  {

		$list_course = $this->custom_m->get_mcodlukm_course();
		$this->template->set('list_course', $list_course);

    $this->template->render('custom_f/listform');
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
      $txt_validatead = $this->input->post('txt_validateadmin');

      $getcustomfixed = $this->custom_m->get_customformfixed($course_id);

      if($getcustomfixed) {
        $datafixed = array(
          'form_id' => $getcustomfixed[0]->form_id,
          'kursusid' => $course_id,
          'semakfakulti' => $txt_validate,
          'semakadmin' => $txt_validatead,
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
          'semakadmin' => $txt_validatead,
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
