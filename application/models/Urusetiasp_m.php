<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Urusetiasp_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->dbpdata=$this->load->database('pdata',true);
		$this->dbecourse=$this->load->database('ecourse',true);
		$this->dbmcodlukm=$this->load->database('mcodlukm',true);
	}

	public function get_infosemaksp()
  {
    $query = $this->dbecourse->query("SELECT *
																			FROM custom_field a, custom_form b, custom_form_fixed c, custom_pemohon d
																			WHERE a.custom_id=b.custom_id AND c.form_id=b.form_id AND d.form_id=b.form_id");

		return $query->result();
  }

	public function get_infopelajarsp()
	{
		/*$query = $this->dbecourse->query("SELECT *
                                      FROM data_cart a, data_order_sp b, data_pelajar c, data_pelajar_sponsor d, param_kursus e, data_invoice f
                                      WHERE a.order_id=b.ordersp_id AND c.user_id=a.user_id AND d.nokp=c.nokp AND f.order_id = b.ordersp_id AND f.user_id = c.user_id AND b.kursusid = e.kursusid AND a.idcart = e.idcart
																			GROUP BY f.order_id
                                      ORDER by b.create_dated DESC");

																			*/
		$query = $this->dbecourse->query("SELECT DISTINCT *
																			FROM `data_cart`
																			JOIN `data_invoice` ON data_cart.order_id = data_invoice.order_id
																			JOIN data_order_sp ON data_order_sp.ordersp_id = data_cart.order_id
																			JOIN data_pelajar ON data_pelajar.user_id = data_cart.user_id
																			JOIN param_kursus ON param_kursus.kursusid = data_order_sp.kursusid AND param_kursus.idcart = data_cart.idcart
																			GROUP BY data_order_sp.ordersp_id");

		return $query->result();
	}

	public function get_infopelajarspstatusfakulti()
	{
		/*$query = $this->dbecourse->query("SELECT *
                                      FROM data_cart a, data_order_sp b, data_pelajar c, data_pelajar_sponsor d, param_kursus e, data_invoice f
                                      WHERE a.order_id=b.ordersp_id AND c.user_id=a.user_id AND d.nokp=c.nokp AND f.order_id = b.ordersp_id AND f.user_id = c.user_id AND b.kursusid = e.kursusid AND a.idcart = e.idcart
																			GROUP BY f.order_id
                                      ORDER by b.create_dated DESC");

																			*/
		$query = $this->dbecourse->query("SELECT DISTINCT * FROM `data_cart` JOIN data_order_sp ON data_order_sp.ordersp_id = data_cart.order_id JOIN data_pelajar ON data_pelajar.user_id = data_cart.user_id JOIN param_kursus ON param_kursus.kursusid = data_order_sp.kursusid AND param_kursus.idcart = data_cart.idcart WHERE data_order_sp.status_fakulti != '' GROUP BY data_order_sp.ordersp_id");

		return $query->result();
	}

	public function get_param_kursus_by_invoice($user_id, $noinvoice) {

		$from = "data_order_sp ";
		$select = 'data_order_sp.* ';
		$where = " param_kursus.kursusid = data_order_sp.kursusid AND data_cart.order_id = data_order_sp.ordersp_id AND data_invoice.order_id = data_order_sp.ordersp_id";

		$sql = "SELECT param_kursus.*, data_invoice.*,$select
						FROM param_kursus,data_cart,data_invoice,$from
						WHERE data_cart.idcart = param_kursus.idcart AND
							$where AND
							data_cart.user_id = '$user_id' AND
							data_invoice.noinvoice = '$noinvoice'";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_course_detail_mcodlukm($courseid) {

		$sql = "SELECT mdl_course.id cid,
							mdl_course.fullname cname,
							mdl_course.shortname ccode,
							mdl_course.summary csummary,
							mdl_course.startdate startdate,
							mdl_course.enddate enddate,
							mdl_course.idnumber idnumber,
							mdl_course_categories.id cateid,
							mdl_course_categories.name category

						 FROM mdl_course, mdl_course_categories
			       WHERE mdl_course.category = mdl_course_categories.id AND
						 	mdl_course.newsitems = 5 AND
						 	mdl_course.id = '$courseid'";
		$query=$this->dbmcodlukm->query($sql);
		return $query->result();

	}

	public function get_liststatus($status_id) {

		$sql = "SELECT *
						FROM `liststatus`
						WHERE status_id = '$status_id'";
		$query=$this->dbecourse->query($sql);
		return $query->result();

	}

	public function get_infopelajarinv()
	{
		$query = $this->dbecourse->query("SELECT DISTINCT *
																			FROM `data_cart`
																			JOIN `data_invoice` ON data_cart.order_id = data_invoice.order_id
																			JOIN data_order_sp ON data_order_sp.ordersp_id = data_cart.order_id
																			JOIN data_pelajar ON data_pelajar.user_id = data_cart.user_id
																			JOIN data_pelajar_sponsor ON data_pelajar_sponsor.user_id = data_pelajar.user_id
																			JOIN param_kursus ON param_kursus.kursusid = data_order_sp.kursusid AND param_kursus.idcart = data_cart.idcart
																			GROUP BY data_order_sp.ordersp_id");
		return $query->result();
	}

	public function get_detail_mohonspnf001($data_id)
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
                                      WHERE user_id='$data_id' ");
		return $query->result();
  }



	public function get_detail_mohonsp($inv_no) {
		$sql="SELECT data_order_sp.*, data_invoice.noinvoice,data_invoice.order_id,data_invoice.status_urus,data_invoice.comment_urus, data_invoice.tarikhinvoice create_dated, data_pelajar.*, data_pelajar_sponsor.*
						FROM data_invoice, data_order_sp, data_pelajar, data_pelajar_sponsor
						WHERE data_order_sp.ordersp_id = data_invoice.order_id AND
							data_pelajar.user_id = data_pelajar_sponsor.user_id AND
							data_invoice.noinvoice = '$inv_no'";

							//	data_pelajar.user_id = data_invoice.user_id AND
		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_detail_mohonsp_order_id($order_id) {
		$sql="SELECT *
					FROM data_cart, data_order_sp, data_pelajar,param_kursus
					WHERE data_cart.order_id = data_order_sp.ordersp_id AND
					data_cart.idcart = param_kursus.idcart AND
					data_order_sp.kursusid = param_kursus.kursusid AND
					data_cart.user_id = data_pelajar.user_id AND
					data_cart.order_id = '$order_id'";
							//	data_pelajar.user_id = data_invoice.user_id AND
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
						WHERE `user_id` = '$nokp' AND
							`form_id` = '$form_id'";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_customformfixed($kursusid) {
		$sql = "SELECT custom_form_fixed.*
						FROM custom_form_fixed
						WHERE custom_form_fixed.kursusid = '$kursusid'";

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

	public function update_data_pelajar($input_data_pelajar) {
		$this->dbecourse->where('user_id', $input_data_pelajar['user_id']);
		$this->dbecourse->update('data_pelajar', $input_data_pelajar);
		return $this->dbecourse->affected_rows();
	}

	public function get_nomatrik() {
		$sql = "SELECT data_pelajar.nomatrik_sp nomatrik_sp
					FROM `data_pelajar`
					WHERE nomatrik_sp != ''
					ORDER BY data_pelajar.nomatrik_sp DESC";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_data_enrol($dataenrol) {

		$order_id = $dataenrol['order_sp'];
		$nomatrik = $dataenrol['nomatrik'];
		$kursus_id = $dataenrol['kursusid'];

		$sql = "SELECT data_enrol.*
			 FROM data_enrol
			 WHERE order_sp = '$order_id' AND
			 nomatrik = '$nomatrik' AND
			 kursusid = '$kursus_id'";

		$query = $this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_detail_mohon($data_id)
	{
		$query = $this->dbecourse->query("SELECT DISTINCT *
			FROM `data_cart`
			JOIN `data_invoice` ON data_cart.order_id = data_invoice.order_id
			JOIN data_order_sp ON data_order_sp.ordersp_id = data_cart.order_id
			JOIN data_pelajar ON data_pelajar.user_id = data_cart.user_id
			JOIN param_kursus ON param_kursus.kursusid = data_order_sp.kursusid AND param_kursus.idcart = data_cart.idcart
			WHERE data_invoice.noinvoice = '$data_id'");
		return $query->result();
		// $query = $this->dbecourse->query("SELECT *
		// 							 FROM data_mohon
		// 							 WHERE data_mohon.nokp = '$data_id'
		// 							");
		// return $query->result();
	}

	public function get_data_order_sp($idcart,$order_id) {

		$sql = "SELECT param_kursus.*
			 FROM data_order_sp, data_cart, param_kursus
			 WHERE data_cart.idcart = param_kursus.idcart AND
			 data_cart.order_id = data_order_sp.ordersp_id AND
			 data_order_sp.kursusid = param_kursus.kursusid AND
			 data_cart.idcart = '$idcart' AND
			 data_cart.order_id = '$order_id'";

		$query = $this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_list_status()
	{
		$query = $this->dbecourse->query("SELECT *
                                      FROM liststatus");
		return $query->result();
	}



		public function insert_email_comment($data)
		{
			$this->dbecourse->insert('email_comment', $data);
			return $this->dbecourse->affected_rows();
		}

		public function get_email_comment()
		{
			$sql = "SELECT *
						FROM `email_comment`";

			$query=$this->dbecourse->query($sql);
			return $query->result();
		}

		public function get_data_invoice($noinvoice)
		{
			$sql = "SELECT *
						FROM `data_invoice`
						WHERE noinvoice = '$noinvoice'";

			$query=$this->dbecourse->query($sql);
			return $query->result();
		}

		public function update_data_order_sp_by_orderID($input_data_order_sp) {
			$this->dbecourse->where('ordersp_id', $input_data_order_sp['ordersp_id']);
			$this->dbecourse->update('data_order_sp', $input_data_order_sp);
			return $this->dbecourse->affected_rows();
		}

		public function get_data_users($user_id)
		{
			$sql = "SELECT *
						FROM `data_users`
						WHERE id = '$user_id'";

			$query=$this->dbecourse->query($sql);
			return $query->result();
		}

		public function get_data_order_mc($order_id) {

			$sql = "SELECT param_kursus.*
				 FROM data_order_sp, param_kursus
				 WHERE data_order_sp.kursusid = param_kursus.kursusid AND
				 id = '$order_id'";

			$query = $this->dbecourse->query($sql);
			return $query->result();
		}

		public function get_email_comment_exist($comment) {
			$sql = "SELECT *
						FROM `email_comment`
						WHERE comment = '$comment'";

			$query=$this->dbecourse->query($sql);
			return $query->result();
		}

		public function insert_data_enrol($dataenrol) {
			$this->dbecourse->insert('data_enrol', $dataenrol);
			return $this->dbecourse->insert_id();
		}

		public function update_data_enrol($dataenrol) {
			$this->dbecourse->where('order_sp', $dataenrol['order_sp']);
			$this->dbecourse->where('nomatrik', $dataenrol['nomatrik']);
			$this->dbecourse->where('kursusid', $dataenrol['kursusid']);
			$this->dbecourse->update('data_enrol', $dataenrol);
			return $this->dbecourse->affected_rows();
		}

		public function get_detail_pelajar_nomatrik($nomatrik)
		{
			$query = $this->dbecourse->query("SELECT *
										 FROM data_pelajar
										 WHERE data_pelajar.nomatrik_sp = '$nomatrik'
										");
			return $query->result();
		}

}



/* End of file Urusetia_mc.php */

/* Location: ./application/controllers/Urusetia_mc.php */

?>
