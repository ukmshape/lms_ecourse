<?php 
/**
* 
*/
class MY_Controller extends CI_Controller
{
	
	public $attributes;
	
	public function __construct()
	{
		parent::__construct();
		$this->id_login = null;
		$this->gelaran = null;
		$this->nama = null;
		$this->mail = null;
		$this->tel = null;
		$this->kelas = null;
		$this->kategori = null;
		$this->role = array();
		$signin = false;
		$url_login = site_url();
		if (isset($_SERVER['PATH_INFO']))
			$url_login .= '/signin'.$_SERVER['PATH_INFO'];
		else
			$url_login .= '/signin';
		
		if (!$this->samlauth->isAuthenticated()){
			$this->samlauth->requireAuth(array(
			    'ReturnTo' => $url_login,
			    'KeepPost' => FALSE
			));			
		}
		if (!$this->session->userdata('is_logged_in')){
			redirect($url_login,'refresh');
		}
		if (array_key_exists('notuser', $loginsession = $this->session->all_userdata())){  
            if ($loginsession['notuser'])       
                redirect(site_url('auth/notuser'),'refresh');
        }
       
        if ($this->samlauth->isAuthenticated()){
		//var_dump($this->session->all_userdata());
		$this->SAMLattr = $this->samlauth->getAttributes();
		//var_dump($this->SAMLattr);
		$this->_session = $this->session->all_userdata();
		if (array_key_exists('id', $this->_session))
			$this->id_login = $this->_session['id'];
		if (array_key_exists('nama', $this->_session))
			$this->nama = $this->_session['nama'];
		if (array_key_exists('gelaran', $this->_session))
			$this->gelaran = $this->_session['gelaran'];
		if (array_key_exists('kodjab', $this->_session))
			$this->kodjab = $this->_session['kodjab'];
		if (array_key_exists('kodjabtugas', $this->_session))
			$this->kodjabtugas = $this->_session['kodjabtugas'];
		if (array_key_exists('njab', $this->_session))
			$this->njab = $this->_session['njab'];
		
		$role = array();
        if (array_key_exists('ew11role', $this->_session))
        	$role = array_merge($role, $this->_session['ew11role']);
        
        if (array_key_exists('kelasteknikal', $this->_session)){
        	$role_teknikal = array_merge($role, $this->_session['kelasteknikal']);
	
        }
		
		if (!empty($role))
        	$this->role = $role;
       	if (isset($role_teknikal))
        	$this->role = $role_teknikal;
        }
		
		$ip_addr = $this->input->ip_address();
		$profiler_ips = $this->config->item('profiler_ips','application');
       	if ($profiler_ips = $this->config->item('profiler_ips')){
			foreach ($profiler_ips as $key => $value) {
				if ($this->input->ip_address() === $value)
					$this->output->enable_profiler(TRUE);
			}
		}
	}
	public function __keepflashdata()
	{
        $this->session->keep_flashdata();
	}
	public function not_eligible()
	{
		$this->load->library('user_agent');
		$mesej ='<div class="alert alert-danger alert-dismissible" role="alert">
	                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	                  <strong>Mesej : </strong> Anda tiada akses untuk modul ini.';
	                  		
		if ($this->agent->is_referral())
	    {
	        $this->agent->referrer();
	    	$mesej .= '<p>klik <a class="btn btn-primary btn-xs" href="'.$this->agent->referrer().'" role="button"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;sini</a> untuk login semula</p>';
	    }
	    
	    $mesej .= '</div>';
	    if ($mesej){ 
	        $this->template->set_layout('templates\layout_public');
	        $this->template->set('mesej',array($mesej));
	        $this->template->render('main/mesej');
	    }
	}
	function urlfriendly($url) {  	
   		$url = str_replace("&","DAN",$url);
		$url = preg_replace('~[^\\pL0-9_]+~u', ' ', $url);
		return $url;
	}
	
}
?>