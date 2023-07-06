<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Fakulti_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		// $this->dbpdata=$this->load->database('pdata',true);
		// $this->dbsmk_prodV=$this->load->database('smk_prodV',true);
		$this->dbecourse=$this->load->database('ecourse',true);
	}

  public function get_infomohonsp()
  {
    $query = $this->dbecourse->query("SELECT *
																			FROM custom_field a, custom_form b, custom_form_fixed c, custom_pemohon d
																			WHERE a.custom_id=b.custom_id AND c.form_id=b.form_id AND d.form_id=b.form_id");
		return $query->result();
  }

  public function get_infosemakSPNF001()
  {
    $query = $this->dbecourse->query("SELECT *
                                      FROM data_cart a, data_order_sp b, data_pelajar c, data_pelajar_sponsor d, param_kursus e, data_invoice f
                                      WHERE a.order_id=b.ordersp_id AND c.nokp=a.nokp AND d.nokp=a.nokp AND f.order_id = b.ordersp_id AND f.nokp = c.nokp AND b.kursusid = e.kursusid AND a.idcart = e.idcart AND e.kodkursus LIKE 'SP-NF%' AND b.status_fakulti != ''
																			GROUP BY f.order_id
                                      ORDER by b.create_dated, b.status_fakulti DESC");
		return $query->result();
  }

  public function get_infosemakSPFF001()
  {
    $query = $this->dbecourse->query("SELECT *
                                      FROM data_cart a, data_order_sp b, data_pelajar c, data_pelajar_sponsor d, param_kursus e, data_invoice f
                                      WHERE a.order_id=b.ordersp_id AND c.nokp=a.nokp AND d.nokp=a.nokp AND f.order_id = b.ordersp_id AND f.nokp = c.nokp AND b.kursusid = e.kursusid AND a.idcart = e.idcart AND e.kodkursus LIKE 'SP-FF%' AND b.status_fakulti != ''
																			GROUP BY f.order_id
                                      ORDER by b.create_dated, b.status_fakulti DESC");
		return $query->result();
  }

  public function get_detail_mohonspnf001($inv_no)
  {
    $query = $this->dbecourse->query("SELECT *
																			FROM data_cart a, data_order_sp b, data_pelajar c, data_pelajar_sponsor d, param_kursus e
																			WHERE a.order_id=b.ordersp_id AND c.nokp=a.nokp AND d.nokp=a.nokp AND e.kursusid= '23' AND a.nokp='$data_id'
																			ORDER by b.create_dated DESC");
		return $query->result();
  }

  public function get_detail_mohonspff001($data_id)
  {
    $query = $this->dbecourse->query("SELECT *
																			FROM data_cart a, data_order_sp b, data_pelajar c, data_pelajar_sponsor d, param_kursus e
																			WHERE a.order_id=b.ordersp_id AND c.nokp=a.nokp AND d.nokp=a.nokp AND e.kursusid= '24' AND a.nokp='$data_id'
																			ORDER by b.create_dated DESC");
		return $query->result();
  }

	public function get_infodatapelajar($data_id)
  {
    $query = $this->dbecourse->query("SELECT *
																			FROM custom_field a, custom_form b, custom_form_fixed c, custom_pemohon d
																			WHERE a.custom_id=b.custom_id AND c.form_id=b.form_id AND d.form_id=b.form_id AND d.nokp='$data_id'");
		return $query->result();
  }

  public function get_detail_syarikat($data_id)
  {
    $query = $this->dbecourse->query("SELECT *
                                      FROM data_pelajar_sponsor
                                      WHERE nokp='$data_id' ");
		return $query->result();
  }



	public function get_detail_mohonsp($inv_no) {
		$sql="SELECT data_order_sp.kursusid, data_order_sp.status_fakulti, data_invoice.order_id, data_invoice.tarikhinvoice,data_order_sp.comment_fakulti, data_order_sp.create_dated, data_pelajar.*
						FROM data_invoice, data_order_sp, data_pelajar
						WHERE data_order_sp.ordersp_id = data_invoice.order_id AND
							data_pelajar.nokp = data_invoice.nokp AND
							data_invoice.noinvoice = '$inv_no'";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_customform($kursusid) {
		$sql = "SELECT custom_field.*, custom_form.form_id form_id
						FROM custom_field
						JOIN custom_form
							ON custom_form.custom_id = custom_field.custom_id
						WHERE custom_form.kursusid = '$kursusid' AND
							custom_field.show_field = 'yes'
						ORDER BY custom_form.orderby ASC";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_customformPemohon($form_id, $nokp) {
		$sql = "SELECT *
						FROM `custom_pemohon`
						WHERE `nokp` = '$nokp' AND
							`form_id` = '$form_id'";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function update_data_invoice($input_data_invoice) {
		$this->dbecourse->where('noinvoice', $input_data_invoice['noinvoice']);
		$this->dbecourse->update('data_invoice', $input_data_invoice);
		return $this->dbecourse->affected_rows();
	}

	public function update_data_order_sp($input_data_order_sp) {
		$this->dbecourse->where('ordersp_id', $input_data_order_sp['ordersp_id']);
		$this->dbecourse->update('data_order_sp', $input_data_order_sp);
		return $this->dbecourse->affected_rows();
	}

}
