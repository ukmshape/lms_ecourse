<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sso extends CI_Controller {

	public function index()
	{
		$saml = $this->samlauth;

		if (!$saml->isAuthenticated()){
			$url = $saml->getLoginURL(base_url('sso'));
			echo "sila login <a href='" .$url."'> SSO</a>";
		}else{
			$attr = $saml->getAttributes();
			echo "selamat datang ". $attr['displayName'][0] ;


			echo " <a href='".base_url('sso/keluar')."'>log keluar</a>";
			// dbug($attr);
		}
		;

	//	var_dump($this->samlauth);
	}

	public function keluar()
	{
		$saml = $this->samlauth;
		$saml->logout(base_url('sso'));
	}

}

/* End of file Sso.php */
/* Location: ./application/controllers/Sso.php */