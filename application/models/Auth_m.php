<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_m extends MY_Model {
	public function __construct()
	{
		parent::__construct();
		//$this->dbpdata = $this->load->database('pdata',TRUE);
		//$this->dbsmk_prodV = $this->load->database('smk_prodV', true);
		$this->dbecourse = $this->load->database('ecourse', true);
		//$this->dbumum = $this->load->database('umum', true);
		//$this->dbsmpl = $this->load->database('smpl', true);
		//$this->dbsmp = $this->load->database('smp', true);

		//load config jika belum.
		if (!($samlauth_config = $this->config->item('samlauth'))){
			$this->load->config('samlauth', true);
			$samlauth_config = $this->config->item('samlauth');
		}

		$this->kdmodul = $samlauth_config['sso.kodsistem'];
		//jika kodsistem empty ambil dari application
		if(empty($this->kdmodul)){

			$this->kdmodul = $this->config->item('kodsistem');
			if (empty($this->kdmodul)){
				//load config application
				$this->load->config('application',true);
				$this->kdmodul = $this->config->item('kodsistem');
			}
		}
	}

	//
	// // edit by Siti START //
	// public function get_ew10pengguna($ukmper, $pass)
	// {
	// 	$sql = "SELECT DISTINCT  ew10pengguna.ew10kodp ew10kodp,
	// 							ew10pengguna.ew10noper ew10noper,
	// 							ew10pengguna.ew10katalaluan ew10katalaluan
	// 			FROM 	ew10pengguna
	// 			WHERE 	ew10pengguna.ew10noper = '$ukmper' AND
	// 					ew10pengguna.ew10katalaluan = '$pass'";
	// 	$query = $this->dbpdata->query($sql);
	// 	return $query->result();
	// }

	//
	// public function get_data_peribadi($ukmper)
	//
	// {
	//
	//
	//
	// 	$sql = "SELECT 	smk.kk01fasas.kk01ukmper ukmper,
	//
	// 					smk.kk01fasas.kk01nama nama,
	//
	// 						smk.u20gelaran.u20ngelaran gelaran,
	//
	// 					smk.kk01fasas.kk01notelbim notelefon,
	//
	// 					-- smk.kk10fkhidmat.kk10kdjwtn jawatan,
	//
	// 					smk.ku13fjwtn.ku13jwtn jawatan,
	//
	// 					smk.kk01fasas.kk01nokpbaru nokp,
	//
	// 					smk.kk56email.kk56email emel
	//
	//
	//
	// 			FROM smk.kk01fasas,
	//
	// 					smk.kk56email,
	//
	// 					smk.kk10fkhidmat,
	//
	// 					smk.u20gelaran,
	//
	// 					smk.ku13fjwtn
	//
	//
	//
	// 			WHERE  	( smk.kk01fasas.kk01ukmper = smk.kk56email.kk56ukmper ) AND
	//
	// 					( smk.kk01fasas.kk01ukmper = smk.kk10fkhidmat.kk10ukmper ) AND
	//
	// 					( smk.kk56email.kk56guna = 'U' ) AND
	//
	// 					( smk.kk01fasas.kk01gelaran	= smk.u20gelaran.u20gelar )	AND
	//
	// 					( smk.kk10fkhidmat.kk10kdjwtn	= smk.ku13fjwtn.ku13kdjwtn )	AND
	//
	// 					smk.kk01fasas.kk01ukmper = '$ukmper'";
	//
	//
	//
	// 	$query = $this->dbsmk_prodV->query($sql);
	//
	//
	//
	// 	return $query->result();
	// }
	//
	// //SYAFIQ TAMBAH DEKAT SINI
	// public function get_ew10penggunaukmper($ukmper)
	// {
	// 	$sql = "SELECT DISTINCT  ew10pengguna.ew10kodp ew10kodp,
	// 							ew10pengguna.ew10noper ew10noper,
	// 							ew10pengguna.ew10katalaluan ew10katalaluan
	// 			FROM 	ew10pengguna
	// 			WHERE 	ew10pengguna.ew10noper = '$ukmper' ";
	// 	$query = $this->dbpdata->query($sql);
	// 	return $query->result();
	// }

	public function get_peribadi($ukmper)
	{

		$sql = "SELECT kodkelas FROM data_logmasukurus
			WHERE ukmper = '$ukmper' AND status ='A'";
		$query = $this->dbecourse->query($sql);
		return $query->row();
	}
	//
	// public function get_kelasperibadi($ukmper)
	// {
	//
	// 	$sql = "SELECT ukmper,kodkelas
	//     		FROM klspengguna
	//         	WHERE ukmper = '$ukmper' AND
	//         		kodsistem = 'ECOURSE' AND
	//         		status ='A'";
	// 	$query = $this->dbumum->query($sql);
	// 	return $query->row();
	// }
	//
	// public function get_kelasperibadi_auth($ukmper,$pass)
	// {
	//
	// 	$sql = "SELECT kodkelas
	//     		FROM klspengguna
	//         	WHERE ukmper = '$ukmper' AND
	//         			katalaluan = '$pass' AND
	//         		kodsistem = 'ECOURSE' AND
	//         		status ='A'";
	// 	$query = $this->dbumum->query($sql);
	// 	return $query->row();
	// }
	//
	// public function get_login($matrik, $passport)
	// {
	// 	/*$sql = "SELECT
	// 						px01fbiojnr.*
	// 					FROM px01fbiojnr
	// 					WHERE px01fbiojnr.px01semmula='1' AND px01fbiojnr.px01sesimula='20202021' AND px01fbiojnr.px01thppgn='V' AND px01fbiojnr.px01warga = 'M' AND px01fbiojnr.px01matrik != ''";
	// 					*/
	// 	$sql = "SELECT pu14thppeng.pu14kthppeng,
	// 						pu14thppeng.pu14nthppeng,
	// 						pu14thppeng.pu14peringkat,
	// 						pu14thppeng.pu14nperingkat,
	// 						px01fbiojnr.*
	// 					FROM px01fbiojnr,pu14thppeng
	// 					WHERE px01fbiojnr.px01matrik = '$matrik' AND
	// 								px01fbiojnr.px01kpkini = '$passport' AND
	// 								pu14thppeng.pu14kthppeng = px01fbiojnr.px01thppgn AND
	// 								(px01fbiojnr.px01stsdaftar = 'S' OR px01fbiojnr.px01stsdaftar = 'T' OR px01fbiojnr.px01stsdaftar = 'D')";
	// 	$query = $this->dbsmpl->query($sql);
	// 	return $query->row();
	// }
	//
	// public function get_login_smp($matrik, $passport)
	// {
	// 	/*$sql = "SELECT
	// 						px01fbiojnr.*
	// 					FROM px01fbiojnr
	// 					WHERE px01fbiojnr.px01semmula='1' AND px01fbiojnr.px01sesimula='20202021' AND px01fbiojnr.px01thppgn='V' AND px01fbiojnr.px01warga = 'M' AND px01fbiojnr.px01matrik != ''";
	// 					*/
	// 	$sql = "SELECT pu14thppeng.pu14kthppeng,
	// 						pu14thppeng.pu14nthppeng,
	// 						pu14thppeng.pu14peringkat,
	// 						pu14thppeng.pu14nperingkat,
	// 						px01fbiojnr.*
	// 					FROM px01fbiojnr,pu14thppeng
	// 					WHERE px01fbiojnr.px01matrik = '$matrik' AND
	// 								px01fbiojnr.px01kpkini = '$passport' AND
	// 								pu14thppeng.pu14kthppeng = px01fbiojnr.px01thppgn AND
	// 								(px01fbiojnr.px01stsdaftar = 'S' OR px01fbiojnr.px01stsdaftar = 'T' OR px01fbiojnr.px01stsdaftar = 'D')";
	// 	$query = $this->dbsmp->query($sql);
	// 	return $query->row();
	// }
	// // edit by Siti END //

	//
	// public function get_data_urusetia($ukmper)
	// {
	// 	$sql = "SELECT ukmper,kelas,url,status
	// 		 FROM urusetia
	// 		 WHERE ukmper = '$ukmper'";
	// 	$query = $this->dbumum->query($sql);
	// 	return $query->result();
	// }

	public function get_loginstud($user_id)
	{
		$sql = "SELECT *
			 FROM data_pelajar
			 WHERE user_id = '$user_id'";
		$query = $this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_data_users($txt_email, $txt_nopassword)
	{
		$sql = "SELECT *
			 FROM data_users
			 WHERE email = '$txt_email'
			 AND password = '$txt_nopassword'";
		$query = $this->dbecourse->query($sql);
		return $query->result();
	}

	// public function get_data_logmasukpel($nomatrik)
	// {
	// 	$sql = "SELECT nomatrik, katalaluan
	// 		 FROM data_logmasukpel
	// 		 WHERE nomatrik = '$nomatrik'";
	// 	$query = $this->dbecourse->query($sql);
	// 	return $query->result();
	// }
	//
	// function get_maklumatpelajar($nomatrik)
	// {
	// 	$sql = "SELECT px01fbiojnr.px01kpkini px01kpkini,
	// 					px01fbiojnr.px01nama px01nama,
	// 					px01fbiojnr.px01matrik px01matrik,
	// 					px01fbiojnr.px01k_jant px01k_jant,
	// 					px01fbiojnr.px01tlahir px01tlahir,
	// 					px01fbiojnr.px01tarafkhw px01tarafkhw,
	// 					px01fbiojnr.px01sesimula px01sesimula,
	// 					px01fbiojnr.px01semmula px01semmula,
	// 					px01fbiojnr.px01sesitmt px01sesitmt,
	// 					px01fbiojnr.px01semtmt px01semtmt,
	// 					px01fbiojnr.px01program px01program,
	// 					px01fbiojnr.px01email px01email,
	// 					px01fbiojnr.px01handphon px01handphon,
	// 					px01fbiojnr.px01negara px01negara,
	// 					px01fbiojnr.px01warga px01warga,
	// 					px01fbiojnr.px01altttp1 px01altttp1,
	// 					px01fbiojnr.px01altttp2 px01altttp2,
	// 					px01fbiojnr.px01altttp3 px01altttp3,
	// 					px01fbiojnr.px01ngrittp px01ngrittp,
	// 					px01fbiojnr.px01pskttp px01pskttp,
	// 					px01fbiojnr.px01kodfak px01kodfak,
	// 					px01fbiojnr.px01thppgn px01thppgn,
	// 					px01fbiojnr.px01jnspgn px01jnspgn
	// 		 FROM px01fbiojnr
	// 		 WHERE px01fbiojnr.px01matrik = '$nomatrik' AND
	// 		 px01fbiojnr.px01stsdaftar = 'S'";
	// 	$query = $this->dbsmpl->query($sql);
	// 	return $query->result();
	// }

	
	// public function insert_logmasuk($input_logmasukpel)
	// {
	// 	// Inserting in Table(students) of Database(college)
	// 	$this->dbecourse->insert('data_logmasukpel', $input_logmasukpel);
	// 	return $this->dbecourse->affected_rows();
	// }


	//******************************************************************************* */

	// public function semakuser($options = array()){

	// 	if(!$this->_required(array('attributes'),$options))
	// 		return false;

	// 	$kategori = $options['attributes']['kategori'][0];

	// 	//role
	// 	if($this->_required(array('ew11role'),$options['attributes']))
	// 		$ew11role = $options['attributes']['ew11role'];
	// 	else
	// 		$ew11role = array();

	// 	if($this->_required(array('kelasteknikal'),$options['attributes']))
	// 		$kelasteknikal = $options['attributes']['kelasteknikal'];
	// 	else
	// 		$kelasteknikal = array();

	// 	$valid_user = false;
	// 	if ($this->isUalidUser(array('roles'=>$ew11role, 'teknikal'=>$kelasteknikal, 'kategori'=>$kategori))){
	// 		$valid_user = true;
	// 		//$userProfil['notuser'] = true;
	// 	}

	// 	if (in_array($kategori,explode(",", 'KT,KA'))){

	// 		$userData = array(
	// 			'uid' => $options['attributes']['uid'][0],
	// 			'id' => $options['attributes']['uid'][0],
	// 			'nama' => $options['attributes']['displayName'][0],
	// 			'gelaran' => $options['attributes']['title'][0],
	// 			'kodjab' => $options['attributes']['kodjab'][0],
	// 			'kodjabtugas' => $options['attributes']['kodjabtugas'][0],
	// 			'kodjaw' => $options['attributes']['kodjaw'][0],
	// 			'njab' => $options['attributes']['ou'][0],
	// 			'kategori' => $options['attributes']['kategori'][0],
	// 			'flag_teknikal' => $this->isTeknikal($kelasteknikal),
	// 			'is_logged_in' => true
	// 		);

	// 		if (!empty($ew11role))
	// 			$userData['ew11role'] = $ew11role;
	// 		else
	// 			$userData['ew11role'] = array();


	// 		if (!empty($kelasteknikal))
	// 			$userData['kelasteknikal'] = $kelasteknikal;

	// 	}

	// 	if (in_array($kategori, explode(",", 'PEL'))){
	// 		$userData = array(
	// 			'uid' => $options['attributes']['uid'][0],
	// 			'id' => $options['attributes']['uid'][0],
	// 			'nama' => $options['attributes']['displayName'][0],
	// 			'gelaran' => '',
	// 			'kodjab' => $options['attributes']['kodfak'][0],
	// 			'kodjabtugas' => '',
	// 			'kodjaw' => '',
	// 			'njab' => $options['attributes']['ou'][0],
	// 			'kategori' => $options['attributes']['kategori'][0],
	// 			'flag_teknikal' => false,
	// 			'ew11role' => array('dummmmmy'),
	// 			'role' => array_merge($ew11role, $ew11role),
	// 			'is_logged_in' => true
	// 		);
	// 	}

	// 	// lain2 pengguna
	// 	if (!isset($userData)){
	// 		$userData = array(
	// 			'uid' => $options['attributes']['uid'][0],
	// 			'id' => $options['attributes']['uid'][0],
	// 			'nama' => $options['attributes']['displayName'][0],
	// 			'kategori' => $options['attributes']['kategori'][0],
	// 			'is_logged_in' => true
	// 		);
	// 	}


	// 	if (!$valid_user)
	// 		$userData['notuser'] = true;

	// 	if (isset($options['admin_sess']) && ($options['admin_sess'] === true)) {
	// 		// unset($userData['flag_teknikal']);
	// 		// unset($userData['uid']);
	// 	}else{
	// 		$this->session->set_userdata($userData);
	// 	}


	// 	return $userData;
	// }

	// private function isUalidUser($options = array()){

	// 	if ($is_pengguna = $this->isPengguna($options['kategori'])){
	// 		return true;
	// 	}

	// 	if ($is_kelasModul = $this->isKelasModul($options['roles'])){
	// 		return true;
	// 	}

	// 	if ($is_teknikal = $this->isTeknikal($options['teknikal'])){
	// 		return true;
	// 	}

	// 	return false;
	// }

	// public function isKelasModul($roles = false)
	// {
	// 	if(!$roles OR empty($roles))
	// 		return false;

	// 	$kelas = " AND ( ew19kelasmodul.ew19kdkelas IN ('".implode('\',\'',$roles)."') ) ";

	// 	$sql = sprintf("SELECT  ew19kelasmodul.ew19kdkelas,
	//             ew19kelasmodul.ew19kdmodul
	//     FROM    ew19kelasmodul
	// 	WHERE   ( ew19kelasmodul.ew19kdmodul = '%s' ) %s ",
	// 	$this->kdmodul, $kelas);

	// 	$result = $this->dbpdata->query($sql)
	// 					->result();

	// 	if (sizeof($result) > 0)
	// 		return true;
	// 	return false;
	// }

	// public function isTeknikal($teknikal = false)
	// {
	// 	if(!$teknikal OR empty($teknikal))
	// 		return false;

	// 	if (in_array($this->kdmodul, $teknikal))
	// 		return true;
	// }

	// public function isPengguna($kategori = false)
	// {
	// 	if (!$kategori)
	// 		return false;

	// 	$sql = "SELECT ew32katpgunasistem.ew32kdmodul
	// 			FROM ew32katpgunasistem
	// 			WHERE ( ew32katpgunasistem.ew32kdmodul = '$this->kdmodul' )
	// 				AND ( ew32katpgunasistem.ew32katpguna = '$kategori') " ;

	// 	$result = $this->dbpdata->query($sql)
	// 					->result();

	// 	if (sizeof($result) > 0)
	// 		return true;

	// 	return false;

	// }


}

/* End of file Auth_m.php */
/* Location: ./application/models/Auth_m.php */
