<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Student_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//$this->dbpdata=$this->load->database('pdata',true);
		//$this->dbsmk_prodV=$this->load->database('smk_prodV',true);
		$this->dbecourse=$this->load->database('ecourse',true);
		$this->dbmcodlukm=$this->load->database('mcodlukm',true);
	}


	public function get_data_student($user_id)
	{
		$sql = "SELECT *
			 FROM data_pelajar
			 WHERE user_id = '$user_id'";
		$query = $this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_data_users($user_id)
	{
		$sql = "SELECT *
			 FROM data_users
			 WHERE id = '$user_id'";
		$query = $this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_data_pelajar($user_id) {
		$sql = "SELECT data_pelajar.*,
							data_pelajar_sponsor.emelsyrkt emelsyrkt,
							data_pelajar_sponsor.notelsyrkt notelsyrkt,
							data_pelajar_sponsor.nmsyrkt nmsyrkt
						FROM data_pelajar
						LEFT JOIN data_pelajar_sponsor ON
							data_pelajar_sponsor.user_id = data_pelajar.user_id
						WHERE data_pelajar.user_id = '$user_id'";

		$query=$this->dbecourse->query($sql);
		return $query->row();
	}


	public function update_data_student($update_student, $nokp)
    {
        $this->dbecourse->where('user_id', $nokp);
        $this->dbecourse->update('data_pelajar', $update_student);
    }

	public function update_data_users($update_student, $nokp)
    {
        $this->dbecourse->where('id', $nokp);
        $this->dbecourse->update('data_users', $update_student);
    }

	public function get_listcourse_stud($user_id)
	{
		$query = $this->dbecourse->query("SELECT DISTINCT *
																			FROM `data_enrol` JOIN param_kursus ON param_kursus.kursusid = data_enrol.kursusid
																			JOIN data_pelajar ON (data_enrol.nomatrik = data_pelajar.nomatrik_mc OR data_enrol.nomatrik = data_pelajar.nomatrik_sp)
																			JOIN data_cart ON data_cart.idcart = param_kursus.idcart AND data_cart.user_id = data_pelajar.user_id AND data_cart.order_id = data_enrol.order_id
																			WHERE data_pelajar.user_id = '$user_id'");
		/*$query = $this->dbecourse->query("SELECT param_kursus.*, data_order_mc.ordermc_id order_id, data_order_mc.status_app status_mc, data_order_sp.status_app status_sp
					FROM `data_cart`
                    LEFT JOIN `data_order_mc` ON data_cart.order_id = data_order_mc.ordermc_id AND (data_order_mc.status_app = 12 OR data_order_mc.status_app = 13)
                    LEFT JOIN `data_order_sp` ON data_cart.order_id = data_order_sp.ordersp_id AND (data_order_sp.status_app = 12 OR data_order_sp.status_app = 13)
                    JOIN `param_kursus` ON data_cart.idcart = param_kursus.idcart AND (data_order_mc.kursusid = param_kursus.kursusid or data_order_sp.kursusid = param_kursus.kursusid)
					WHERE data_cart.user_id = '$user_id'");
		*/
		return $query->result();
	}

	public function get_certificate($user_id)
	{


		$query = $this->dbecourse->query("SELECT DISTINCT *
		FROM `data_enrol` JOIN param_kursus ON param_kursus.kursusid = data_enrol.kursusid
		JOIN data_pelajar ON (data_enrol.nomatrik = data_pelajar.nomatrik_mc OR data_enrol.nomatrik = data_pelajar.nomatrik_sp)
		JOIN data_cart ON data_cart.idcart = param_kursus.idcart AND data_cart.user_id = data_pelajar.user_id AND data_cart.order_id = data_enrol.order_id
		WHERE data_pelajar.user_id = '$user_id' AND data_enrol.status_enrol = '13'");
		/*
		$query = $this->dbecourse->query("SELECT param_kursus.*, data_order_mc.ordermc_id order_id, data_order_mc.status_app status_mc, data_order_sp.status_app status_sp
					FROM `data_cart`
                    LEFT JOIN `data_order_mc` ON data_cart.order_id = data_order_mc.ordermc_id AND (data_order_mc.status_app = 13)
                    LEFT JOIN `data_order_sp` ON data_cart.order_id = data_order_sp.ordersp_id AND (data_order_sp.status_app = 13)
                    JOIN `param_kursus` ON data_cart.idcart = param_kursus.idcart AND (data_order_mc.kursusid = param_kursus.kursusid or data_order_sp.kursusid = param_kursus.kursusid)
					WHERE data_cart.user_id = '$user_id'");
		*/
		return $query->result();
	}

	public function get_history_purchase($user_id)
	{
		$query = $this->dbecourse->query("SELECT * FROM data_cart a, data_order_mc b, data_order_sp c, data_pelajar d, param_kursus e, data_invoice f
			WHERE a.order_id=b.ordermc_id OR a.order_id=c.ordersp_id AND d.user_id=a.user_id AND f.order_id = b.ordermc_id OR f.order_id=c.ordersp_id AND f.user_id = d.user_id AND b.kursusid = e.kursusid AND d.user_id = '$user_id'
			GROUP BY f.order_id
			ORDER by b.create_dated DESC");
		return $query->result();
	}

	public function get_historystudpaymc()
	{
		$query = $this->dbecourse->query("SELECT DISTINCT *
																			FROM `data_cart`
																			JOIN `data_invoice` ON data_cart.order_id = data_invoice.order_id
																			JOIN data_order_mc ON data_order_mc.ordermc_id = data_cart.order_id
																			JOIN data_pelajar ON data_pelajar.user_id = data_cart.user_id
																			JOIN param_kursus ON param_kursus.kursusid = data_order_mc.kursusid AND param_kursus.idcart = data_cart.idcart
																			GROUP BY data_order_mc.ordermc_id");

		return $query->result();
	}

	public function get_historystudpaysp()
	{
		$query = $this->dbecourse->query("SELECT DISTINCT *
																			FROM `data_cart`
																			JOIN `data_invoice` ON data_cart.order_id = data_invoice.order_id
																			JOIN data_order_sp ON data_order_sp.ordersp_id = data_cart.order_id
																			JOIN data_pelajar ON data_pelajar.user_id = data_cart.user_id
																			JOIN param_kursus ON param_kursus.kursusid = data_order_sp.kursusid AND param_kursus.idcart = data_cart.idcart
																			GROUP BY data_order_sp.ordersp_id");

		return $query->result();
	}

	public function get_historystudorder($user_id) {

		$query = $this->dbecourse->query("SELECT data_invoice.*, data_cart.*, data_order_mc.status_app status_mc, data_order_sp.status_app status_sp, data_order_mc.create_dated dated_mc, data_order_sp.create_dated dated_sp
							FROM data_invoice
							LEFT JOIN `data_cart` ON data_cart.order_id = data_invoice.order_id
		                    LEFT JOIN `data_order_mc` ON data_cart.order_id = data_order_mc.ordermc_id
		                    LEFT JOIN `data_order_sp` ON data_cart.order_id = data_order_sp.ordersp_id
		                    JOIN `param_kursus` ON data_cart.idcart = param_kursus.idcart AND (data_order_mc.kursusid = param_kursus.kursusid or data_order_sp.kursusid = param_kursus.kursusid)
							WHERE data_cart.user_id = '$user_id' AND
							data_cart.user_id = data_invoice.user_id AND 
							data_invoice.status_inv IS NOT NULL
							GROUP BY data_cart.order_id");

		return $query->result();
	}

	public function get_bill($user_id) {
		$query = $this->dbecourse->query("SELECT *, data_order_mc.status_app status_mc, data_order_sp.status_app status_sp, data_order_mc.create_dated dated_mc, data_order_sp.create_dated dated_sp
							FROM `data_cart`
		                    LEFT JOIN `data_order_mc` ON data_cart.order_id = data_order_mc.ordermc_id
		                    LEFT JOIN `data_order_sp` ON data_cart.order_id = data_order_sp.ordersp_id
		                    JOIN `param_kursus` ON data_cart.idcart = param_kursus.idcart AND (data_order_mc.kursusid = param_kursus.kursusid or data_order_sp.kursusid = param_kursus.kursusid)
							WHERE data_cart.user_id = '$user_id'
							AND (data_order_mc.status_app = 3 OR data_order_sp.status_app = 3 OR (data_order_sp.status_deposit = 3 OR data_order_sp.status_payment1 = 3 OR data_order_sp.status_payment2 = 3 OR data_order_sp.status_payment3 = 3))
							GROUP BY data_cart.order_id");

		return $query->result();
	}

	public function get_bill_invoice($user_id) {
		$query = $this->dbecourse->query("SELECT data_invoice.*, data_cart.*, data_order_mc.status_app status_mc, data_order_sp.status_app status_sp, data_order_mc.create_dated dated_mc, data_order_sp.create_dated dated_sp
		FROM `data_invoice`
			LEFT JOIN `data_cart` ON data_cart.order_id = data_invoice.order_id
		LEFT JOIN `data_order_mc` ON data_cart.order_id = data_order_mc.ordermc_id
		LEFT JOIN `data_order_sp` ON data_cart.order_id = data_order_sp.ordersp_id
		JOIN `param_kursus` ON data_cart.idcart = param_kursus.idcart AND (data_order_mc.kursusid = param_kursus.kursusid or data_order_sp.kursusid = param_kursus.kursusid)
		WHERE data_cart.user_id = '$user_id'
		 AND data_cart.user_id = data_invoice.user_id
		 AND data_invoice.status_inv = '3'
		GROUP BY data_cart.order_id");

		return $query->result();
	}

	public function get_donepay($user_id) {
		$query = $this->dbecourse->query("SELECT *, data_cart.order_id orderID, data_order_mc.status_app status_mc, data_order_sp.status_app status_sp, data_order_mc.create_dated dated_mc, data_order_sp.create_dated dated_sp
							FROM `data_cart`
												JOIN `data_invoice` ON data_cart.order_id = data_invoice.order_id
		                    LEFT JOIN `data_order_mc` ON data_cart.order_id = data_order_mc.ordermc_id
		                    LEFT JOIN `data_order_sp` ON data_cart.order_id = data_order_sp.ordersp_id
		                    JOIN `param_kursus` ON data_cart.idcart = param_kursus.idcart AND (data_order_mc.kursusid = param_kursus.kursusid or data_order_sp.kursusid = param_kursus.kursusid)
							WHERE data_cart.user_id = '$user_id'
							AND (data_invoice.status_urus != 3 AND data_invoice.status_urus != '')
							GROUP BY data_cart.order_id");

		return $query->result();
	}

	public function get_param_kursus_by_invoice($user_id, $order_id, $type) {
		$from = '';
		$where = '';
		$select = '';
		if($type == 'SP') {
			$from = "data_order_sp ";
			$select = 'data_order_sp.* ';
			$where = " param_kursus.kursusid = data_order_sp.kursusid AND data_cart.order_id = data_order_sp.ordersp_id";
		} else if($type == 'MC') {
			$from = "data_order_mc ";
			$select = 'data_order_mc.* ';
			$where = " param_kursus.kursusid = data_order_mc.kursusid AND data_cart.order_id = data_order_mc.ordermc_id";
		}

		$sql = "SELECT param_kursus.*,$select
						FROM param_kursus,data_cart,$from
						WHERE data_cart.idcart = param_kursus.idcart AND
							$where AND
							data_cart.user_id = '$user_id' AND
							data_cart.order_id = '$order_id'";
		$query=$this->dbecourse->query($sql);
		return $query->result();
	}


	public function get_param_kursus_by_invoicemc($user_id, $noinvoice) {

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

	public function get_param_kursus_by_invoicesp($user_id, $noinvoice) {

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

	public function get_data_invoice($order_id) {
		$sql = "SELECT *
					FROM data_invoice
					WHERE data_invoice.order_id = '$order_id'
                    GROUP BY data_invoice.order_id";
		$query=$this->dbecourse->query($sql);
		return $query->result();


	}

	public function get_liststatus($status_id) {

		$sql = "SELECT *
						FROM `liststatus`
						WHERE status_id = '$status_id'";
		$query=$this->dbecourse->query($sql);
		return $query->result();

	}

	// image file path //
	public function get_course_preview_img($courseid) {

		$sql = "SELECT f.id, f.contextid, f.component, f.filearea, f.itemid, f.filepath, f.filename
    			FROM mdl_context cx
          JOIN mdl_course c ON cx.instanceid=c.id
          JOIN mdl_files f ON cx.id=f.contextid
          WHERE f.filename <> '.'
          AND f.component = 'course'
          AND f.filearea = 'overviewfiles'
          AND c.id = '$courseid'";

		$query=$this->dbmcodlukm->query($sql);
		return $query->result();

	}

	public function get_coursestud_complete($user_id)
	{
		$query = $this->dbecourse->query("SELECT param_kursus.*, data_order_mc.ordermc_id order_id, data_order_mc.status_app status_mc, data_order_sp.status_app status_sp
					FROM `data_cart`
                    LEFT JOIN `data_order_mc` ON data_cart.order_id = data_order_mc.ordermc_id AND data_order_mc.status_app = 13
                    LEFT JOIN `data_order_sp` ON data_cart.order_id = data_order_sp.ordersp_id AND data_order_sp.status_app = 13
                    JOIN `param_kursus` ON data_cart.idcart = param_kursus.idcart AND (data_order_mc.kursusid = param_kursus.kursusid or data_order_sp.kursusid = param_kursus.kursusid)
					WHERE data_cart.user_id = '$user_id'");
		return $query->result();
	}

	public function get_coursestud_active($user_id)
	{
		$query = $this->dbecourse->query("SELECT param_kursus.*, data_order_mc.ordermc_id order_id, data_order_mc.status_app status_mc, data_order_sp.status_app status_sp
					FROM `data_cart`
                    LEFT JOIN `data_order_mc` ON data_cart.order_id = data_order_mc.ordermc_id AND data_order_mc.status_app = 12
                    LEFT JOIN `data_order_sp` ON data_cart.order_id = data_order_sp.ordersp_id AND data_order_sp.status_app = 12
                    JOIN `param_kursus` ON data_cart.idcart = param_kursus.idcart AND (data_order_mc.kursusid = param_kursus.kursusid or data_order_sp.kursusid = param_kursus.kursusid)
					WHERE data_cart.user_id = '$user_id'");
		return $query->result();
	}

	public function remove_order($order_id,$type) {
		$tables = '';
		if($type == 'SP') {
			$this->dbecourse->where('ordersp_id', $order_id);
			$this->dbecourse->delete('data_order_sp');
		} else if($type == 'MC') {
			$this->dbecourse->where('ordermc_id', $order_id);
			$this->dbecourse->delete('data_order_mc');
		}
		return $this->dbecourse->affected_rows();
	}

	public function remove_order_cart($order_id) {
		$this->dbecourse->where('order_id', $order_id);
		$this->dbecourse->delete('data_cart');
		return $this->dbecourse->affected_rows();
	}

	public function remove_order_invoice($order_id) {
		$this->dbecourse->where('order_id', $order_id);
		$this->dbecourse->delete('data_invoice');
		return $this->dbecourse->affected_rows();
	}

	public function remove_order_param($idcart) {
		$this->dbecourse->where('idcart', $idcart);
		$this->dbecourse->delete('param_kursus');
		return $this->dbecourse->affected_rows();
	}



}
/* End of file Dashboard_m.php */
/* Location: ./application/models/Dashboard_m.php */ ?>
