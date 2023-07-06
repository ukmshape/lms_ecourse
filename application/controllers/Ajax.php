<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

  public function __construct() {
      parent::__construct();
      $this->load->library('session');
      $this->load->model('ajax_m');
      //$this->output->enable_profiler(TRUE);
  }

  public function fetch() {
    if($this->input->post('view') == null){

      // if($this->input->post('view') != '') {
      //    $update_query = "UPDATE comments SET comment_status = 0 WHERE comment_status = 1";
      //    mysqli_query($con, $update_query);
      // }

      $notification = $this->ajax_m->select_notification();
      $output = '';

      if($notification) {
        foreach($notification as $value) {

          if($value->order_type == 'MC') {
            $url = base_url('/urusetia_mc/detail_pemohon/'.$this->encryption->encrypt($value->noinvoice));
          } else if($value->order_type == 'SP') {
            $url = base_url('/urusetia_sp/detail_pemohon/'.$this->encryption->encrypt($value->noinvoice));
          } else {
            $url = "";
          }

          $output .= '
          <li>
            <a href="'.$url.'">
              <span class="notification-icon dashbg-red">
                <i class="fa fa-bullhorn"></i>
              </span>
              <span class="notification-text">
                <span>New Order:</span><br/> '.$value->order_id.'
              </span>
              <span class="notification-time">
                <!--<a href="#" class="fa fa-close"></a>-->
                <span> '.date("d M y", strtotime($value->tarikhinvoice)).'</span>
              </span>
            </a>
          </li>
          ';
        }
      } else {
          $output .= '<li><a href="#" class="text-bold text-italic">No New Order Found</a></li>';
      }

      $count = $this->ajax_m->count_notification();

      $data = array(
         'notification' => $output,
         'unseen_notification'  => $count
      );

      echo json_encode($data);
    }
  }
}
