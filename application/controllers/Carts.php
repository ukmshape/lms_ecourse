<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carts extends CI_Controller {

  public function __construct() {
      parent::__construct();
      $this->load->library('session');
      $this->load->model('cart_m');
      //$this->output->enable_profiler(TRUE);
  }

  public function addcart() {

      $wujud = false;
      $cart_list = $this->cart_m->get_data_cart_param_kursus($this->input->post('nokp'), $this->input->post('kursusid'));
      if($cart_list) {
        foreach ($cart_list as $row) {
          if($row->kursusid == $this->input->post('kursusid')) {
            $wujud = true; break 1;
          } else {
            continue;
          }
        }
      }

      if($wujud == false) {

        /*
        $insert_data = array(
          'nokp' => $this->input->post('nokp'),
          'kursusid' => $this->input->post('kursusid'),
          'kodkursus' => $this->input->post('kodkursus'),
          'nmkursus' => $this->input->post('nmkursus'),
          'tarikhmula' => date("Y-m-d", $this->input->post('tarikhmula')),
          'tarikhtamat' => date("Y-m-d", $this->input->post('tarikhtamat')),
          'kredit' => $this->input->post('kredit'),
          'price' => $this->input->post('price'),
          'kodkursus' => $this->input->post('kodkursus'),
          'qty' => 1
        );
        */


        $cart_list = $this->cart_m->get_data_cart_empty($this->input->post('nokp'));

        if(!$cart_list) {
          //insert data_cart
          $input_data_cart = array (
            'nokp' => $this->input->post('nokp')
          );
          $insert_data_cart = $this->cart_m->insert_data_cart($input_data_cart);
          //end insert data_cart
          $idcart = $insert_data_cart;
        } else {
          $idcart = $cart_list[0]->idcart;
        }

        //insert param_kursus
        $input_kursus = array (
          'kursusid' => $this->input->post('kursusid'),
          'kodkursus' => $this->input->post('kodkursus'),
          'namakursus' => $this->input->post('nmkursus'),
          'tarikhmula' => date("Y-m-d", $this->input->post('tarikhmula')),
          'tarikhtamat' => date("Y-m-d", $this->input->post('tarikhtamat')),
          'unitprice' => $this->input->post('price')
        );
        $insert_param_kursus = $this->cart_m->insert_param_kursus($input_kursus);
        //end insert param_kursus

        //insert data_mohon
        $input_kursus = array (
          'nokp' => $this->input->post('nokp'),
          'idcart' => $idcart,
          'kursusid' => $this->input->post('kursusid'),
          'kodkursus' => $this->input->post('kodkursus'),
          'idparam' => $insert_param_kursus,
          'statuskursus' => '1',
          'tarikhmhn' => date("Y-m-d H:i:s")
        );
        $insert_data_mohon = $this->cart_m->insert_data_mohon($input_kursus);
        //end insert data_mohon

        $session_student = $this->session->userdata('session_student');
        $session_student['carttotal'] = count($this->cart_m->get_data_cart($this->input->post('nokp')));

        $this->session->unset_userdata('session_student');
        $this->session->set_userdata('session_student', $session_student);

        redirect('main/course_details/'.$this->input->post('kursusid'));

      } else {
        $echo =  base_url('/main/course_details/'.$this->input->post('kursusid'));
        echo "<script>alert('Course already in cart!');
                window.location.href = '".$echo."'
             </script>";
      }

    //dbug($this->session->userdata());


  }

  public function remove_cart() {
    if($this->input->get('paramid') != null) {

      $cart_update = $this->cart_m->remove_param_kursus($this->input->get('paramid'));

      $session_student = $this->session->userdata('session_student');
      $session_student['carttotal'] = count($this->cart_m->get_data_cart($session_student['nokp']));

      $this->session->unset_userdata('session_student');
      $this->session->set_userdata('session_student', $session_student);

      if($cart_update) {
        $echo =  base_url('/main/carts/');
        echo "<script>alert('Course have been remove.');
                window.location.href = '".$echo."'
             </script>";
      } else {
        $echo =  base_url('/main/carts/');
        echo "<script>alert('Course cannot be remove.');
                window.location.href = '".$echo."'
             </script>";
      }
    }
  }




}
