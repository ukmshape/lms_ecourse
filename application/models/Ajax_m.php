<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//$this->dbpdata=$this->load->database('pdata',true);
		//$this->dbsmk_prodV=$this->load->database('smk_prodV',true);
		$this->dbecourse=$this->load->database('ecourse',true);
	}

	public function count_notification() {

		$sql = "SELECT *
			 FROM data_invoice
			 WHERE notification = 1";
		$query = $this->dbecourse->query($sql);
		return $query->num_rows();
	}

  public function select_notification() {

		$sql = "SELECT *
			 FROM data_invoice
			 WHERE notification = 1
       ORDER BY tarikhinvoice DESC LIMIT 5";
		$query = $this->dbecourse->query($sql);
		return $query->result();
	}
}
