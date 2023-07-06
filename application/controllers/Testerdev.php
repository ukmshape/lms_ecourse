<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testerdev extends CI_Controller {

  public function __construct() {
      parent::__construct();
      $this->load->library('session');
      $this->load->model('testerDev_m');
      $this->load->model('student_m');
      $this->load->model('urusetiamc_m');
      //$this->output->enable_profiler(TRUE);
  }

  public function index() {
    $this->load->view('templates/email_welcome');
    //$this->load->view('main_f/test');
  }

  public function email_invoice($parameter) {
    $parameter_list = $this->encryption->decrypt($parameter);

		$data['data_id'] = $parameter_list;

		$noinvoice = $parameter_list; //dbug($nokp); die();

		$detail_pelajar = $this->urusetiamc_m->get_detail_mohon($noinvoice);
		$data['detail_pelajar'] = $detail_pelajar; //dbug($beliantelefon); die();

		$detail_kursus = $this->urusetiamc_m->get_param_kursus_by_invoice($detail_pelajar[0]->user_id,$noinvoice);
		$data['detail_kursus'] = $detail_kursus;

    $this->load->view('templates/email_invoice', $data);
  }

  public function block() {
    dbug($this->testerDev_m->get_block());
    dbug($this->testerDev_m->get_block_page());
  }

  public function block_unserialize() {
    dbug($this->testerDev_m->get_block_content());

    $get_block_content = $this->testerDev_m->get_block_content();

    if($get_block_content) {
      foreach ($get_block_content as $value) {
        dbug(unserialize(base64_decode($value->configdata)));
      }
    }
  }

  public function unserializeblock() {
    dbug(unserialize(base64_decode("Tzo4OiJzdGRDbGFzcyI6OTp7czo0OiJ1c2VyIjtzOjE6IjQiO3M6MTI6InNob3dfdGVhY2hlciI7czoxOiIxIjtzOjk6InZpZGVvX3VybCI7czoyODoiaHR0cHM6Ly95b3V0dS5iZS9VZER3S0k0RGNHdyI7czo2OiJhY2NlbnQiO3M6MTE6IkJlc3QgU2VsbGVyIjtzOjc6InRlYWNoZXIiO3M6MjA6Ik11aGFtbWFkIE5hem1pIE5hYmlsIjtzOjU6ImltYWdlIjtpOjg4MTgyMDA0NjtzOjE0OiJjY25fbWFyZ2luX3RvcCI7czoxOiIwIjtzOjE3OiJjY25fbWFyZ2luX2JvdHRvbSI7czoxOiIwIjtzOjEzOiJjY25fY3NzX2NsYXNzIjtzOjA6IiI7fQ==")));
  }


  public function profile() {

    //$session_student = $this->session->userdata('session_student');

    $session_nokp = trim($this->session->userdata('session_student')['user_id']); //dbug($session_nokp);

    $semakdata_student = $this->student_m->get_data_pelajar($session_nokp); //dbug($semakdata_student);
    $this->template->set('semakdata_student', $semakdata_student);


      $this->template->set('tab1', ''); //profile
      $this->template->set('tab2', ''); //change_pswd
      $this->template->set('tab3', ''); //course_list
      $this->template->set('tab4', ''); //orders
      $this->template->set('tab5', ''); //history

      $this->template->set('tab_pane1', 'tab-pane fade');
      $this->template->set('tab_pane2', 'tab-pane fade');
      $this->template->set('tab_pane3', 'tab-pane fade');
      $this->template->set('tab_pane4', 'tab-pane fade');
      $this->template->set('tab_pane5', 'tab-pane fade');


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

      }else{
        $this->template->set('tab3', 'active');
        $this->template->set('tab_pane3', 'tab-pane fade show active');
      }


      $this->template->set('action_save_tab_profile', base_url('student/save_tab_profile/'));

      $this->template->set('action_save_tab_changepswd', base_url('student/save_tab_changepswd/'));

      $this->template->set('action_save_tab_courselist', base_url('student/save_tab_courselist/'));

      $this->template->set('action_save_tab_orders', base_url('student/save_tab_orders/'));

      $this->template->set('action_save_tab_historypurchase', base_url('student/save_tab_historypurchase/'));

      //$this->template->set('action_save_tab_certificate', base_url('student/save_tab_certificate/'));


    /*
		//checking session_id
		if (empty($session_student)) {
      redirect('main/signin/','location');
    } else {
      $this->template->render('student_f/profile');
    }
    */
    $this->template->render('student_f/profile_tab');
  }



    public function test() {

      $get_pu14thppeng = $this->testerDev_m->get_pu14thppeng();
      echo '<style>table, td, th {
  border: 1px solid;white-space: nowrap;
} </style>';
      echo '<table cellspacing="0" cellpadding="0" border="1" width="1386">';
      echo '<tr>';
      echo '<th>pu14kthppeng</th>';
      echo '<th>pu14nthppeng</th>';
      echo '<th>pu14nthpbi</th>';
      echo '<th>pu14peringkat</th>';
      echo '<th>pu14nperingkat</th>';
      //echo '<th>pu14namapprbm</th>';
      //echo '<th>pu14namapprbi</th>';
      echo '</tr>';
      foreach ($get_pu14thppeng as $value) {

        echo '<tr nowrap>';
        echo '<td>'.$value->pu14kthppeng.'</td>';
        echo '<td>'.$value->pu14nthppeng.'</td>';
        echo '<td>'.$value->pu14nthpbi.'</td>';
        echo '<td>'.$value->pu14peringkat.'</td>';
        echo '<td>'.$value->pu14nperingkat.'</td>';
        //echo '<td>'.$value->pu14namapprbm.'</td>';
        //echo '<td>'.$value->pu14namapprbi.'</td>';
        echo '</tr>';

      }

    }

}
