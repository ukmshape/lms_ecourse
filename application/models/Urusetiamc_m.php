<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Urusetiamc_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		// $this->dbpdata=$this->load->database('pdata',true);
		// $this->dbsmk_prodV=$this->load->database('smk_prodV',true);
		$this->dbecourse=$this->load->database('ecourse',true);
		$this->dbmcodlukm=$this->load->database('mcodlukm',true);
	}

	public function get_kursus_id()
	{
        $query = $this->dbecourse->query("SELECT kodkursusinduk

									 FROM data_kursus_induk");

        return $query->result();
	}

	public function get_course_mc()
	{
		$sql = "SELECT kodkursusinduk, nmkursusbi
 							FROM data_kursus_induk";
		$query = $this->dbecourse->query($sql);

		return $query->result();
	}

    public function insert_reg_kursus($regkursus)
    {
        $this->dbecourse->insert('data_kursus_induk', $regkursus);
        return $this->dbecourse->insert_id();
    }

	public function insert_reg_kursusunit($kursusunit)
	{
		$this->dbecourse->insert('data_kursus_unit', $kursusunit);
		return $this->dbecourse->affected_rows();
	}

	public function update_reg_kursus($regkursus)
	{
		$this->dbecourse->where('kodkursusinduk',$regkursus['kodkursusinduk']);
		$this->dbecourse->update('data_kursus_induk', $regkursus);
		return $this->dbecourse->affected_rows();

	}

	public function get_listpermohonan()
	{
		$query = $this->dbecourse->query("SELECT data_mohon.nokp, data_mohon.tarikhmhn, data_mohon.kodkursus, data_mohon.noinvoice, data_mohon.statuskursus, data_pelajar.nama, data_pelajar.emel
									 FROM data_mohon
									 JOIN data_pelajar ON data_mohon.nokp=data_pelajar.nokp
									 ORDER BY  data_mohon.tarikhmhn DESC");
		return $query->result();
	}

	public function get_detail_mohon($data_id)
	{
		$query = $this->dbecourse->query("SELECT DISTINCT *
			FROM `data_cart`
			JOIN `data_invoice` ON data_cart.order_id = data_invoice.order_id
			JOIN data_order_mc ON data_order_mc.ordermc_id = data_cart.order_id
			JOIN data_pelajar ON data_pelajar.user_id = data_cart.user_id
			JOIN param_kursus ON param_kursus.kursusid = data_order_mc.kursusid AND param_kursus.idcart = data_cart.idcart
			WHERE data_invoice.noinvoice = '$data_id'");
		return $query->result();
		// $query = $this->dbecourse->query("SELECT *
		// 							 FROM data_mohon
		// 							 WHERE data_mohon.nokp = '$data_id'
		// 							");
		// return $query->result();
	}

	public function get_detail_pelajar($data_id)
	{
		$query = $this->dbecourse->query("SELECT *
									 FROM data_pelajar
									 WHERE data_pelajar.nokp = '$data_id'
									");
		return $query->result();
	}

	public function get_detail_pelajar_nomatrik($nomatrik)
	{
		$query = $this->dbecourse->query("SELECT *
									 FROM data_pelajar
									 WHERE data_pelajar.nomatrik_mc = '$nomatrik'
									");
		return $query->result();
	}

	public function update_data_pelajar($input_data_pelajar) {
		$this->dbecourse->where('user_id', $input_data_pelajar['user_id']);
		$this->dbecourse->update('data_pelajar', $input_data_pelajar);
		return $this->dbecourse->affected_rows();
	}

	public function get_infosemakmc()
  {
    $query = $this->dbecourse->query("SELECT *
																			FROM custom_field a, custom_form b, custom_form_fixed c, custom_pemohon d
																			WHERE a.custom_id=b.custom_id AND c.form_id=b.form_id AND d.form_id=b.form_id");

		return $query->result();
  }

	public function get_infopelajarmc()
	{
		/*$query = $this->dbecourse->query("SELECT *
                                      FROM data_cart a, data_order_mc b, data_pelajar c, data_pelajar_sponsor d, param_kursus e, data_invoice f
                                      WHERE a.order_id=b.ordermc_id AND c.user_id=a.user_id AND d.nokp=c.nokp AND f.order_id = b.ordermc_id AND f.user_id = c.user_id AND b.kursusid = e.kursusid AND a.idcart = e.idcart
																			GROUP BY f.order_id
                                      ORDER by b.create_dated DESC");

																			*/
		$query = $this->dbecourse->query("SELECT DISTINCT *
																			FROM `data_cart`
																			JOIN `data_invoice` ON data_cart.order_id = data_invoice.order_id
																			JOIN data_order_mc ON data_order_mc.ordermc_id = data_cart.order_id
																			JOIN data_pelajar ON data_pelajar.user_id = data_cart.user_id
																			JOIN param_kursus ON param_kursus.kursusid = data_order_mc.kursusid AND param_kursus.idcart = data_cart.idcart
																			GROUP BY data_order_mc.ordermc_id
																			ORDER BY data_invoice.tarikhinvoice DESC");

		return $query->result();
	}

	public function get_infopelajarmc_filter($where)
	{
		$query = $this->dbecourse->query("SELECT DISTINCT *
																			FROM `data_cart`
																			JOIN `data_invoice` ON data_cart.order_id = data_invoice.order_id
																			JOIN data_order_mc ON data_order_mc.ordermc_id = data_cart.order_id
																			JOIN data_pelajar ON data_pelajar.user_id = data_cart.user_id
																			JOIN param_kursus ON param_kursus.kursusid = data_order_mc.kursusid AND param_kursus.idcart = data_cart.idcart
																			WHERE $where
																			GROUP BY data_order_mc.ordermc_id
																			ORDER BY data_invoice.tarikhinvoice DESC");

		return $query->result();
	}

	public function get_param_kursus_by_invoice($user_id, $noinvoice) {

		$from = "data_order_mc ";
		$select = 'data_order_mc.* ';
		$where = " param_kursus.kursusid = data_order_mc.kursusid AND data_cart.order_id = data_order_mc.ordermc_id AND data_invoice.order_id = data_order_mc.ordermc_id";

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
		/*$query = $this->dbecourse->query("SELECT *
																	FROM `data_cart`
																	LEFT JOIN `data_order_mc` ON data_cart.order_id = data_order_mc.ordermc_id
																	JOIN `param_kursus` ON data_cart.idcart = param_kursus.idcart AND (data_order_mc.kursusid = param_kursus.kursusid)
																	LEFT JOIN `data_invoice` ON data_cart.order_id = data_invoice.order_id AND data_invoice.user_id = data_cart.user_id
																	WHERE data_invoice.noinvoice IS NOT NULL");
		*/
		$query = $this->dbecourse->query("SELECT DISTINCT *
																			FROM `data_cart`
																			JOIN `data_invoice` ON data_cart.order_id = data_invoice.order_id
																			JOIN data_order_mc ON data_order_mc.ordermc_id = data_cart.order_id
																			JOIN data_pelajar ON data_pelajar.user_id = data_cart.user_id
																			GROUP BY data_order_mc.ordermc_id");

		return $query->result();
	}

	public function get_list_status()
	{
		$query = $this->dbecourse->query("SELECT *
                                      FROM liststatus");
		return $query->result();
	}

	public function update_data_application($update_data_application,$ordermc_id)
	{
		$this->dbecourse->where('ordermc_id', $ordermc_id);
		$this->dbecourse->update('data_order_mc', $update_data_application);
	}

	public function count_totalapp()
	{
		$query = $this->dbecourse->query("SELECT ordermc_id FROM data_order_mc GROUP BY ordermc_id");
		return $query->num_rows();
	}

	public function count_completed()
	{
		$query = $this->dbecourse->query("SELECT ordermc_id FROM data_order_mc WHERE status_app = '13'");
		return $query->num_rows();
	}

	public function count_incompleted()
	{
		$query = $this->dbecourse->query("SELECT ordermc_id FROM data_order_mc WHERE status_app = '19'");
		return $query->num_rows();
	}

	public function count_totalcourse()
	{
		$query = $this->dbecourse->query("SELECT kodkursus FROM param_kursus");
		return $query->num_rows();
	}

	function get_mcodlukm_MC_count($st = NULL)
	{
			if ($st == "NIL") $st = "";

			$sql = "SELECT mdl_course.*
				 FROM mdl_course, mdl_course_categories
				 WHERE mdl_course.category = mdl_course_categories.id AND
					mdl_course.newsitems = 5 AND
					mdl_course.fullname LIKE '%$st%' AND
					mdl_course.idnumber LIKE 'MC%'";

			$query = $this->dbmcodlukm->query($sql);
			return $query->num_rows();
	}


	public function update_data_order_mc($input_data_order_mc) {
		$this->dbecourse->where('id', $input_data_order_mc['id']);
		$this->dbecourse->update('data_order_mc', $input_data_order_mc);
		return $this->dbecourse->affected_rows();
	}

	public function get_data_order_mc($order_id) {

		$sql = "SELECT param_kursus.*
			 FROM data_order_mc, param_kursus
			 WHERE data_order_mc.kursusid = param_kursus.kursusid AND
			 id = '$order_id'";

		$query = $this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_data_enrol($dataenrol) {

		$order_id = $dataenrol['order_mc'];
		$nomatrik = $dataenrol['nomatrik'];
		$kursus_id = $dataenrol['kursusid'];

		$sql = "SELECT data_enrol.*
			 FROM data_enrol
			 WHERE order_mc = '$order_id' AND
			 nomatrik = '$nomatrik' AND
			 kursusid = '$kursus_id'";

		$query = $this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_cache() {
		$sql = "SELECT cache.*
						FROM cache
						ORDER BY id ASC";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function update_data_enrol($dataenrol) {
		$this->dbecourse->where('order_mc', $dataenrol['order_mc']);
		$this->dbecourse->where('nomatrik', $dataenrol['nomatrik']);
		$this->dbecourse->where('kursusid', $dataenrol['kursusid']);
		$this->dbecourse->update('data_enrol', $dataenrol);
		return $this->dbecourse->affected_rows();
	}

	public function insert_data_enrol($dataenrol) {
		$this->dbecourse->insert('data_enrol', $dataenrol);
		return $this->dbecourse->insert_id();
	}

	public function get_nomatrik() {
		$sql = "SELECT data_pelajar.nomatrik_mc nomatrik_mc
					FROM `data_pelajar`
					WHERE nomatrik_mc != ''
					ORDER BY data_pelajar.nomatrik_mc DESC";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function update_data_invoice($data) {
		$this->dbecourse->where('noinvoice', $data['noinvoice']);
		$this->dbecourse->update('data_invoice', $data);
		return $this->dbecourse->affected_rows();
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

	public function update_data_order_mc_by_orderID($input_data_order_mc) {
		$this->dbecourse->where('ordermc_id', $input_data_order_mc['ordermc_id']);
		$this->dbecourse->update('data_order_mc', $input_data_order_mc);
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

	public function get_email_comment_exist($comment) {
		$sql = "SELECT *
					FROM `email_comment`
					WHERE comment = '$comment'";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

}
/* End of file Dashboard_m.php */
/* Location: ./application/models/Dashboard_m.php */
