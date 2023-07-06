<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fakulti extends CI_Controller {

  public function __construct() {
      parent::__construct();
      $this->load->model('auth_m');
      $this->load->model('fakulti_m');
      //$this->output->enable_profiler(TRUE);
  }

	public function dash_fakulti()
	{
        $this->template->render('fakulti_f/dashboard_f');
	}

  public function semak_SPNF001()
  {
    $list_SPNF001 = $this->fakulti_m->get_infosemakSPNF001();
		$this->template->set('list_SPNF001', $list_SPNF001);

    $list_infomohonSPNF001 = $this->fakulti_m->get_infomohonsp();
		$this->template->set('list_infomohonSPNF001', $list_infomohonSPNF001);

    $this->template->render('fakulti_f/semak_SPNF001');
  }

  public function semak_SPFF001()
  {
    $list_SPFF001 = $this->fakulti_m->get_infosemakSPFF001();
		$this->template->set('list_SPFF001', $list_SPFF001);

    $list_infomohonSPFF001 = $this->fakulti_m->get_infomohonsp();
		$this->template->set('list_infomohonSPFF001', $list_infomohonSPFF001);

    $this->template->render('fakulti_f/semak_SPFF001');
  }

  public function detail_SPNF001($parameter)
  {
    /*$parameter_list = $this->encryption->decrypt($parameter);
		$parameter = explode(',', $parameter_list); //dbug($parameter_list); die();

		$this->template->set('data_id', $parameter[0]);

		$data_id = $parameter[0];

		$detail_pelajarspnf001 = $this->fakulti_m->get_detail_mohonspnf001($data_id);
		$this->template->set('detail_pelajarspnf001', $detail_pelajarspnf001); //dbug($detail_mohonspnf001); die();

    $detail_infospnf001 = $this->fakulti_m->get_infodatapelajar($data_id);
		$this->template->set('detail_infospnf001', $detail_infospnf001);
    */

    if($this->input->post('btn_submit') != null) {
      $txt_status = $this->input->post('txt_status');
      $txt_comment = $this->input->post('txt_comment');
      $txt_noinvoice = $this->input->post('txt_noinvoice');
      $order_id = $this->input->post('order_id');

      $input_order = array (
        'ordersp_id' => $order_id,
        'comment_fakulti' => $txt_comment,
        'status_fakulti' => $txt_status,
        'tarikhsahfakulti' => date('Y-m-d H:i:s')
      );

      $update_data_invoice = $this->fakulti_m->update_data_order_sp($input_order);

      if($update_data_invoice) {
        $echo =  base_url('/fakulti/semak_SPNF001');
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

    $detail_pelajar = $this->fakulti_m->get_detail_mohonsp($noinvoice);
		$this->template->set('detail_pelajar', $detail_pelajar); //dbug($detail_mohonspnf001); die();

    $customform = $this->fakulti_m->get_customform($detail_pelajar[0]->kursusid);
		$this->template->set('customform', $customform);

    $this->template->set('script_content','fakulti_f/script/script-detailsSP');
    $this->template->render('fakulti_f/detail_SPNF001');
  }

  public function detail_SPFF001($parameter)
  {
    /* $parameter_list = $this->encryption->decrypt($parameter);
		$parameter = explode(',', $parameter_list); //dbug($parameter_list); die();

		$this->template->set('data_id', $parameter[0]);

		$data_id = $parameter[0];

		$detail_pelajarspff001 = $this->fakulti_m->get_detail_mohonspff001($data_id);
		$this->template->set('detail_pelajarspff001', $detail_pelajarspff001);

    $detail_infospff001 = $this->fakulti_m->get_infodatapelajar($data_id);
		$this->template->set('detail_infospff001', $detail_infospff001);

    $this->template->render('fakulti_f/detail_SPFF001');
    */


    if($this->input->post('btn_submit') != null) {
      $txt_status = $this->input->post('txt_status');
      $txt_comment = $this->input->post('txt_comment');
      $txt_noinvoice = $this->input->post('txt_noinvoice');
      $order_id = $this->input->post('order_id');

      $input_order = array (
        'ordersp_id' => $order_id,
        'comment_fakulti' => $txt_comment,
        'status_fakulti' => $txt_status,
        'tarikhsahfakulti' => date('Y-m-d H:i:s')
      );

      $update_data_invoice = $this->fakulti_m->update_data_order_sp($input_order);

      if($update_data_invoice) {
        $echo =  base_url('/fakulti/semak_SPFF001');
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

    $detail_pelajar = $this->fakulti_m->get_detail_mohonsp($noinvoice);
		$this->template->set('detail_pelajar', $detail_pelajar); //dbug($detail_mohonspnf001); die();

    $customform = $this->fakulti_m->get_customform($detail_pelajar[0]->kursusid);
		$this->template->set('customform', $customform);

    $this->template->set('script_content','fakulti_f/script/script-detailsSP');
    $this->template->render('fakulti_f/detail_SPFF001');
  }
}
