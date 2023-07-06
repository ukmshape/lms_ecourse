<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kewangan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_m');
        //$this->output->enable_profiler(TRUE);
    }

    public function dash_kew()
    {
        $this->template->render('kewangan_f/kew_mc');
    }

    public function semakkew_mc()
    {
        $this->template->render('kewangan_f/semakanmckew');
    }

    public function detailmc_kew()
    {
        $this->template->render('kewangan_f/detailmc_kew');
    }

    public function semak_sp()
    {
        $this->template->render('kewangan_f/kew_sp');
    }

    public function semak_kp()
    {
        $this->template->render('kewangan_f/kew_kp');
    }
}
