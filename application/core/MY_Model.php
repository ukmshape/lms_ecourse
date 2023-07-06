<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
	public function __construct()
    {
        parent::__construct();

		//$this->dbsmk = $this->load->database('smk',TRUE);
		//$this->dbsmp = $this->load->database('smp',TRUE);
	}

	/*
	| semak parameter yang wajib
	|
	| @param	array	$required	nama-nama parameter yang wajib
	| @param 	array 	$data 		data yang disemak
	| @jenis 	utiliti
	| @access 	private
	*/
	public function _required($requred, $data){
		foreach ($requred as $field)
			if (!isset($data[$field])) return false;

		return true;
	}

	/*
	| kira bil row
	|
	| @param 	array 	$data 		data sql
	| @jenis 	utiliti
	| @access 	private
	*/
	public function _bilrow($data){
		return sizeof($data);
	}


}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */
