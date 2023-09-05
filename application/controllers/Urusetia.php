<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Urusetia extends CI_Controller {

  public function __construct() {
      parent::__construct();
      $this->load->library('session');
      $this->load->model('auth_m');
      //$this->output->enable_profiler(TRUE);
  }

	public function dash_admin()
	{
      //dbug($this->session->userdata("session_ukmper")); 
      dbug($this->session->userdata());
      die;
        $this->template->set('script_content', 'admin_f/script/script-dashboardlayout');
        $this->template->render('admin_f/dashboard_main');
	}

  public function reg_kursus_induk()
  {
        $this->template->render('admin_f/kursus_induk');
  }

  public function reg_kursus_unit()
  {
        $this->template->render('admin_f/kursus_unit');
  }

  public function param_kursus()
  {
        //$this->template->render('admin_f/dashboard');
  }


  public function semak_mc()
  {
    $this->template->set('script_content', 'admin_f/script/script-dashboardlayout');
    $this->template->render('urusetia_mc_f/semakmc');
  }

  public function detail_mc()
  {
    $this->template->set('script_content', 'admin_f/script/script-dashboardlayout');
    $this->template->render('urusetia_mc_f/detailmc');
  }
}
