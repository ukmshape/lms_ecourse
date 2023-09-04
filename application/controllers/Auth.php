<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends CI_Controller
{
  
    public function __construct() {
        parent::__construct();
        $this->load->model('auth_m');
        $this->load->model('cart_m');
        $this->output->enable_profiler(TRUE);
    }
    
    public function main_login()
    {
        if ($this->input->post('btn_login')) {

            $txt_email = trim($this->input->post('txt_kpkini')); //dbug($txt_ukmpernomatrik); die();

            $txt_password = trim($this->input->post('txt_password'));

            $params1 = array(
              'email' => $txt_email,
              'password' => $txt_password
            );

            $params2 = serialize($params1);
            $serialize = base64_encode($params2);

            //dbug($serialize);die;

            $password = $serialize;

            $txt_nopassword = $password;

            $getlogin = $this->auth_m->get_data_users($txt_email, $txt_nopassword);

            if($this->input->ip_address() == '10.142.128.143') {
              dbug($txt_nopassword);die;
            }

            if($getlogin) {

              $this->auth_m->update_last_login($getlogin[0]->id);

              if($getlogin[0]->active == 'active') {
                if($getlogin[0]->type == 'Student') {
                  $studentdata = $this->auth_m->get_loginstud($getlogin[0]->id);

                  $arr = array(
                    'user_id' => $getlogin[0]->id,
                    'nama' => $studentdata[0]->nama,
                    'nokp' => $studentdata[0]->nokp,
                    'email' => $getlogin[0]->email,
                    'carttotal' => count($this->cart_m->get_data_order_mc_cart($getlogin[0]->id))
                  );

                  $this->session->set_userdata('session_student',$arr);
                  redirect('student/profile', 'location');

                } else if($getlogin[0]->type == 'Admin') {
                  $arr = array(
                      'id' => $getlogin[0]->id,
                      'fullname' => $getlogin[0]->fullname,
                      'kodkelas' => $getlogin[0]->type
                  );

                  $this->session->set_userdata('session_ukmper', $arr);
                  $session_ukmper = $this->session->userdata('session_ukmper'); //dbug(); die();

                  // skrin teknikal
                  redirect('urusetia/dash_admin', 'location');
                } else if($getlogin[0]->type == 'Faculty') {
                  //skrin urs fakulti-SP
                  redirect('fakulti/dash_fakulti', 'location');
                }
              } else {
                $this->session->set_flashdata('mesej', '<b>Email and Password not match</b>');
              $this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible fade show');
              redirect('main/signin/', 'refresh');
              }
            } else {
              $this->session->set_flashdata('mesej', '<b>Email and Password not match</b>');
              $this->session->set_flashdata('mesej_css', 'alert alert-danger alert-dismissible fade show');
              redirect('main/signin/', 'refresh');
            }

        }
    }

    public function keluar()
    {
        $this->session->unset_userdata('session_ukmper');
        $this->session->unset_userdata('session_student');
        redirect('/', 'location');
    }

    //************************************************************************************************** */

    // public function signin() {
    //     if (isset($_SERVER['PATH_INFO'])) {
    //         $url_to = str_replace("/signin", "", $_SERVER['PATH_INFO']);
    //     }
    //     else $url_to = site_url();
    //     if (!$this->samlauth->isAuthenticated()) {
    //         redirect('auth/loginfail', 'refresh');
    //     }
    //     $loginrequest = $this->auth_m->semakuser(array("attributes" => $this->samlauth->getAttributes()));
    //     //dbug($loginrequest);
    //     if (!$loginrequest) $this->loginfail();
    //     if (array_key_exists('notuser', $loginrequest)) {
    //         if ($loginrequest['notuser']) redirect(site_url('auth/notuser'), 'refresh');
    //     }

    //     /*redirect to*/
    //     redirect($url_to, 'refresh');
    // }

    // public function login() {
    //         $uri = uri_string();
    //         $url_login = site_url(str_replace("/login", "", $uri));
    //         $this->samlauth->requireAuth(array(
    //             'ReturnTo' => $url_login,
    //             'KeepPost' => FALSE
    //         ));
    // }

    // public function logout() {
    //     unset($this->session->userdata);
    //     $this->session->sess_destroy();
    //     $this->samlauth->logout(site_url('auth/loggedout'));
    //     //kalau tak berjaya logout
    //     redirect(site_url('auth/logoutfail'));
    // }

    // public function relogin($relay) {
    //     if (($relay === 'http:') OR ($relay === 'https:')) {
    //         $uri = uri_string();
    //         $uri = str_replace(":/", "://", $uri);
    //         $pos = strpos($uri, '/', strpos($uri, '/') + 1);
    //         $relay = substr($uri, $pos + 1);
    //     }
    //     else $relay = site_url($relay);
    //     unset($this->session->userdata);
    //     $this->session->sess_destroy();
    //     $this->samlauth->logout($relay);
    // }

    // public function loginfail() {
    //     $mesej = '<div class="alert alert-danger alert-dismissible" role="alert">
    //               <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    //               <strong>Mesej : </strong> Proses login tidak berjaya.
    //               <p>klik <a class="btn btn-primary btn-xs" href="' . site_url('auth/relogin') . '" role="button"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;sini</a> untuk login semula</p>
    //             </div>';
    //     if ($mesej) {
    //         $this->template->set_layout('templates/layout_public');
    //         $this->template->set('mesej', array($mesej));
    //         $this->template->render('main/mesej');
    //     }
    // }

    // public function logoutfail() {
    //     $mesej = '<div class="alert alert-danger alert-dismissible" role="alert">
    //               <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    //               <strong>Mesej : </strong> Proses logout tidak berjaya. untuk keluar sepenuhnya sila tutup pelayar internet.
    //             </div>';
    //     if ($mesej) {
    //         $this->template->set_layout('templates/layout_public');
    //         $this->template->set('mesej', array($mesej));
    //         $this->template->render('main/mesej');
    //     }
    // }

    // public function loggedout() {
    //     $mesej = '<div class="alert alert-danger alert-dismissible" role="alert">
    //               <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    //               <strong>Mesej : </strong> Anda telah logout dari sistem
    //               <p>klik <a class="btn btn-primary btn-xs" href="' . site_url() . '" role="button"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;sini</a> untuk login semula</p>
    //             </div>';
    //     if ($mesej) {
    //         $this->template->set_layout('templates/layout_public');
    //         $this->template->set('mesej', array($mesej));
    //         $this->template->render('main/mesej');
    //     }
    // }

    // public function notuser() {
    //     $mesej = '<div class="alert alert-danger alert-dismissible" role="alert">
    //               <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    //               <strong>Mesej : </strong> Anda tiada akses untuk sistem ini
    //               <p>klik <a class="btn btn-primary btn-xs" href="' . site_url('auth/relogin') . '" role="button"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;sini</a> untuk login semula</p>
    //             </div>';
    //     if ($mesej) {
    //         $this->template->set_layout('templates/layout_public');
    //         $this->template->set('mesej', array($mesej));
    //         $this->template->render('main/mesej');
    //     }
    // }
}
/* End of file sessions.php */
/* Location: ./application/controllers/sessions.php */
