<?php 
Class MY_Email extends CI_Email { 
	
	protected $_ci;

	public function __construct($params)
	{
		parent::__construct($params);

		if (isset($params['db'])){
			$this->_db_sql = $params['db'];
		}
		$this->_ci =& get_instance();
	}	
			
	
	public function f_hantar_emel($options=array())
	{	
		
		//$emelsubject = 'espeed PKP'. ': Admission Application ';
		$emelsubject = 'SBO PKP'. ': Sistem Borang Online ';
		$from_emel = 'no-reply-sbo@ukm.edu.my';//$this->_ci->config->item('emel.fromemel','application');
		$from_nama = 'SBO';//$this->_ci->config->item('emel.fromnama','application');
		//$mesej = 'Berjaya daftar';
		
		$dataemel = $options; 

		$emel_recipient = $dataemel['alamat_emel'];	

		//$mesej = 'Your account has been successfully created.'.'<br><br>Please login on Executive Programme Admission Application System (MSKPKP) page.'.'<br><br>Regards, Thank You'.'<br><br>Pusat Kembangan Pendidikan,UKM';
		
		// Remove all illegal characters from email
		$emailf = filter_var($from_emel, FILTER_SANITIZE_EMAIL);
		// Validate e-mail
		if (!filter_var($emailf, FILTER_VALIDATE_EMAIL) === false){
			$this->from($from_emel, $from_nama);
			//$this->to($emel_recipient); //$emel_recipient
			$this->to('nurfarahaain@ukm.edu.my');
			//$this-cc('spklnpc@ukm.edu.my');
			//$this->bcc($teknikal_emel);
			$this->subject($emelsubject);
			$this->message($dataemel['mesej_emel']);
			//$this->message($mesej);
			//$this->message($mesej);
			$this->send();
		} else {
			//dbug('emel recipient tidak valid');
		}						
	}


	public function f_hantar_emel_forgot($options=array())
	{	
		
		$emelsubject = 'eSPEED PKP'. ': Admission Application';//$this->_ci->config->item('emel.subject','application') . ': Permohonan Pelajar';
		$from_emel = 'no-reply-espeed@ukm.edu.my';//$this->_ci->config->item('emel.fromemel','application');
		$from_nama = 'eSPEED';//$this->_ci->config->item('emel.fromnama','application');
		//$mesej = 'Berjaya daftar';
		
		$dataemel = $options; 

		$nokp = $dataemel['nokp']; 
		$nokpx = $dataemel['nokpx']; 
		$emel_recipient = $dataemel['alamat_emel'];	
		$emel_recipientx = $dataemel['alamat_emelx']; 
		$newpass = trim($dataemel['newpass']);

		//-- lama
		// $mesej = 'Thanks for contacting regarding to forgot password,<br><br> Your <b>Password</b> is <b>'.$newpass.'</b>'."\r\n".'<br><br>Please Update your password here '.'<a href=http://smp.ukm.my/mskpkp/main/change_password/'.$emel_recipientx.'>Link</a>'.'<br>Thanks & Regards'; 

		$mesej = 'Hi, 
				<br><br>Thanks for contacting regarding to eSPEED Forgot Password,
				<br><br> Your <b>Password</b> is <b>'.$newpass.'</b>'."\r\n".'
				<br><br>Please use the password above to update your new password at this link'.'<h4><a href=http://smp.ukm.my/espeed/main/change_password/'.$emel_recipientx.'/'.$nokpx.'>Change Password</a></h4>'.'

				<br><br>Thanks & Regards
				<br>eSPEED Technical Team'; 
		
		// Remove all illegal characters from email
		$emailf = filter_var($from_emel, FILTER_SANITIZE_EMAIL);
		// Validate e-mail
		if (!filter_var($emailf, FILTER_VALIDATE_EMAIL) === false){
			$this->from($from_emel, $from_nama);
			$this->to($emel_recipient); //$emel_recipient
			//$this->to('spklnjppel@ukm.edu.my');
			//$this-cc('spklnpc@ukm.edu.my');
			//$this->bcc($teknikal_emel);
			$this->subject($emelsubject);
			//$this->message($dataemel['mesej_emel']);
			$this->message($mesej);
			//$this->message($mesej);
			$this->send();
		} else {
			//dbug('emel recipient tidak valid');
		}						
	}

	
	public function f_hantar_emel_daftar_agen($options=array())
	{	
		
		//$emelsubject = 'espeed PKP'. ': Admission Application ';
		$emelsubject = 'MAKLUMAN ESPEED: DAFTAR ID LOG MASUK AGEN';
		$from_emel = 'no-reply-espeed@ukm.edu.my';//$this->_ci->config->item('emel.fromemel','application');
		$from_nama = 'eSPEED';//$this->_ci->config->item('emel.fromnama','application');
		//$mesej = 'Berjaya daftar';
		
		$dataemel = $options; 

		$emel_recipient = $dataemel['alamat_emel'];	

		$mesej = $dataemel['catatanemel'];

		//$mesej = 'Your account has been successfully created.'.'<br><br>Please login on Executive Programme Admission Application System (MSKPKP) page.'.'<br><br>Regards, Thank You'.'<br><br>Pusat Kembangan Pendidikan,UKM';
		
		// Remove all illegal characters from email
		$emailf = filter_var($from_emel, FILTER_SANITIZE_EMAIL);
		// Validate e-mail
		if (!filter_var($emailf, FILTER_VALIDATE_EMAIL) === false){
			$this->from($from_emel, $from_nama);
			$this->to($emel_recipient); //$emel_recipient
			//$this->to('spklnjppel@ukm.edu.my');
			//$this-cc('spklnpc@ukm.edu.my');
			//$this->bcc($teknikal_emel);
			$this->subject($emelsubject);
			$this->message($mesej);
			//$this->message($mesej);
			//$this->message($mesej);
			$this->send();
		} else {
			//dbug('emel recipient tidak valid');
		}						
	}
	

	public function f_hantar_emel_forgot_agen($options=array())
	{	
		
		$emelsubject = 'eSPEED PKP'. ': Agent Reset Password';//$this->_ci->config->item('emel.subject','application') . ': Permohonan Pelajar';
		$from_emel = 'no-reply-espeed@ukm.edu.my';//$this->_ci->config->item('emel.fromemel','application');
		$from_nama = 'eSPEED';//$this->_ci->config->item('emel.fromnama','application');
		//$mesej = 'Berjaya daftar';
		
		$dataemel = $options; 

		$idagen = $dataemel['id_agen']; 
		$idagenx = $dataemel['id_agenx']; 
		$emel_recipient = $dataemel['alamat_emel'];	
		$emel_recipientx = $dataemel['alamat_emelx']; 
		$newpass = trim($dataemel['newpass']);

		//-- lama
		// $mesej = 'Thanks for contacting regarding to forgot password,<br><br> Your <b>Password</b> is <b>'.$newpass.'</b>'."\r\n".'<br><br>Please Update your password here '.'<a href=http://smp.ukm.my/mskpkp/main/change_password/'.$emel_recipientx.'>Link</a>'.'<br>Thanks & Regards'; 

		$mesej = 'Hi, 
				<br><br>Thanks for contacting regarding to eSPEED Forgot Password,
				<br><br> Your <b>Password</b> is <b>'.$newpass.'</b>'."\r\n".'
				<br><br>Please use the password above to Update your new password at this link'.'<h4><a href=http://smp.ukm.my/espeed/admin_marketing/change_password/'.$emel_recipientx.'/'.$idagenx.'>Change Password</a></h4>'.'
				<br><br>Thanks & Regards
				<br>eSPEED Technical Team'; 
		
		// Remove all illegal characters from email
		$emailf = filter_var($from_emel, FILTER_SANITIZE_EMAIL);
		// Validate e-mail
		if (!filter_var($emailf, FILTER_VALIDATE_EMAIL) === false){
			$this->from($from_emel, $from_nama);
			$this->to($emel_recipient); //$emel_recipient
			//$this->to('spklnjppel@ukm.edu.my');
			//$this-cc('spklnpc@ukm.edu.my');
			//$this->bcc($teknikal_emel);
			$this->subject($emelsubject);
			//$this->message($dataemel['mesej_emel']);
			$this->message($mesej);
			//$this->message($mesej);
			$this->send();
		} else {
			//dbug('emel recipient tidak valid');
		}						
	}




	public function f_hantar_emel_terima($options=array())
	{	
		
		$from_emel = 'no-reply-espeed@ukm.edu.my';//$this->_ci->config->item('emel.fromemel','application');
		$from_nama = 'eSPEED';//$this->_ci->config->item('emel.fromnama','application');
		//$mesej = 'Berjaya daftar';
		$dataemel = $options; 

		$emelpemohon = $dataemel['alamat_emel'];
		$emelagen = $dataemel['alamat_emel_cc'];		

		$emelsubject = $dataemel['tajuk_emel'];
		$mesej = $dataemel['catatanemel'];
		
		// Remove all illegal characters from email
		$emailf = filter_var($from_emel, FILTER_SANITIZE_EMAIL);
		// Validate e-mail
		if (!filter_var($emailf, FILTER_VALIDATE_EMAIL) === false){
			$this->from($from_emel, $from_nama);
			$this->to($emelpemohon); //$emel_recipient
			//$this->to('nurfarahaain@ukm.edu.my');
			$this->cc($emelagen);

			//$this->to('spklnjppel@ukm.edu.my');
			//$this-cc('spklnpc@ukm.edu.my');
			//$this->bcc($teknikal_emel);
			$this->subject($emelsubject);
			//$this->message($dataemel['mesej_emel']);
			$this->message($mesej);
			//$this->message($mesej);
			$this->send();
		} else {
			//dbug('emel recipient tidak valid');
		}						
	}

	public function f_hantar_emel2($options=array())
	{	
		
		
		$from_emel = 'no-reply-espeed@ukm.edu.my';//$this->_ci->config->item('emel.fromemel','application');
		$from_nama = 'eSPEED';//$this->_ci->config->item('emel.fromnama','application');
		//$mesej = 'Berjaya daftar';
		
		$dataemel = $options; 

		$emelpemohon = $dataemel['alamat_emel'];		

		$emelsubject = $dataemel['tajuk_emel'];
		$mesej = $dataemel['catatanemel'];
		
		// Remove all illegal characters from email
		$emailf = filter_var($from_emel, FILTER_SANITIZE_EMAIL);
		// Validate e-mail
		if (!filter_var($emailf, FILTER_VALIDATE_EMAIL) === false){
			$this->from($from_emel, $from_nama);
			$this->to($emelpemohon); //$emel_recipient
			//$this->to('nurfarahaain@ukm.edu.my');
			//$this->cc($emelagen);

			//$this->to('spklnjppel@ukm.edu.my');
			//$this-cc('spklnpc@ukm.edu.my');
			//$this->bcc($teknikal_emel);
			$this->subject($emelsubject);
			//$this->message($dataemel['mesej_emel']);
			$this->message($mesej);
			//$this->message($mesej);
			$this->send();
		} else {
			//dbug('emel recipient tidak valid');
		}						
	}
}
