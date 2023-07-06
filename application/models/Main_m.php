<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->dbpdata=$this->load->database('pdata',true);
		//$this->dbsmk_prodV=$this->load->database('smk_prodV',true);
		//$this->dbsmpl=$this->load->database('smpl',true);
		$this->dbecourse=$this->load->database('ecourse',true);
		$this->dbmcodlukm=$this->load->database('mcodlukm',true);
	}

	public function pdata() {
		$sql = "SELECT DISTINCT *
				FROM 	ew10pengguna
				WHERE ew10kelas = 'PEL' AND ew10noper LIKE 'A%' LIMIT 20";

	  $query = $this->dbpdata->query($sql);
	  return $query->result();
	}



			// ------------------- db smpl ------------------- //

	public function get_warganegara() {
		$sql = "SELECT u27negara.u27knegara u27knegara,
							u27negara.u27nnegara u27nnegara
						FROM u27negara
						WHERE u27knegara <> '*'
						ORDER BY u27nnegara ASC";

	  $query = $this->dbsmpl->query($sql);
	  return $query->result();
	}





		// ------------------- db lms ------------------- //



		function get_mcodlukm_MC($limit, $start, $st = NULL)
	{
				if ($st == "NIL") $st = "";

		$sql = "SELECT mdl_course.*
					 FROM mdl_course
					 LEFT JOIN mdl_course_categories ON mdl_course_categories.id = mdl_course.category
			   WHERE mdl_course.newsitems = 5 AND
					 	mdl_course.fullname LIKE '%$st%' AND
					 	mdl_course.idnumber LIKE 'MC%'
					 LIMIT " . $start . ", " . $limit;

		$query = $this->dbmcodlukm->query($sql);
		return $query->result();
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

		function get_mcodlukm_SP($limit, $start, $st = NULL)
	{
				if ($st == "NIL") $st = "";

		$sql = "SELECT mdl_course.*
					 FROM mdl_course
					 LEFT JOIN mdl_course_categories ON mdl_course_categories.id = mdl_course.category
			   WHERE mdl_course.newsitems = 5 AND
					 	mdl_course.fullname LIKE '%$st%' AND
					 	mdl_course.idnumber LIKE 'SP%'
					 LIMIT " . $start . ", " . $limit;

		$query = $this->dbmcodlukm->query($sql);
		return $query->result();
	}

	function get_mcodlukm_SP_count($st = NULL)
	{
		if ($st == "NIL") $st = "";

				$sql = "SELECT mdl_course.*
					 FROM mdl_course, mdl_course_categories
			   WHERE mdl_course.category = mdl_course_categories.id AND
					 	mdl_course.newsitems = 5 AND
					 	mdl_course.fullname LIKE '%$st%' AND
					 	mdl_course.idnumber LIKE 'SP%'";

		$query = $this->dbmcodlukm->query($sql);
		return $query->num_rows();
	}

		function get_mcodlukm_KP($limit, $start, $st = NULL)
	{
				if ($st == "NIL") $st = "";

		$sql = "SELECT mdl_course.*
					 FROM mdl_course
					 LEFT JOIN mdl_course_categories ON mdl_course_categories.id = mdl_course.category
			   WHERE mdl_course.newsitems = 5 AND
					 	mdl_course.fullname LIKE '%$st%' AND
					 	mdl_course.idnumber LIKE 'KP%'
					 LIMIT " . $start . ", " . $limit;

		$query = $this->dbmcodlukm->query($sql);
		return $query->result();
	}

	function get_mcodlukm_KP_count($st = NULL)
	{
		if ($st == "NIL") $st = "";

				$sql = "SELECT mdl_course.*
					 FROM mdl_course, mdl_course_categories
			   WHERE mdl_course.category = mdl_course_categories.id AND
					 	mdl_course.newsitems = 5 AND
					 	mdl_course.fullname LIKE '%$st%' AND
					 	mdl_course.idnumber LIKE 'KP%'";

		$query = $this->dbmcodlukm->query($sql);
		return $query->num_rows();
	}



	public function get_course_list_mcodlukm($limit, $start, $type) {

		$sql="SELECT mdl_course.*
			 FROM mdl_course, mdl_course_categories, mdl_course_sections
	   WHERE mdl_course.category = mdl_course_categories.id AND
			 mdl_course.newsitems = 5 AND
			 mdl_course.id = mdl_course_sections.course AND
			 mdl_course.idnumber LIKE '$type%'
			 GROUP BY mdl_course.id
			 LIMIT $start, $limit";

		$query=$this->dbmcodlukm->query($sql);
		return $query->result();

	}

	public function get_totalcourse_list_mcodlukm() {

		$sql="SELECT mdl_course.*
			 FROM mdl_course, mdl_course_categories, mdl_course_sections
	   WHERE mdl_course.category = mdl_course_categories.id AND
			 mdl_course.newsitems = 5 AND
			 mdl_course.id = mdl_course_sections.course
			 GROUP BY mdl_course.id";

		$query=$this->dbmcodlukm->query($sql);
		return $query->result();

	}

	public function get_totalcourse_list_mcodlukm_search($search,$filter,$prgm) {

		$where = '';
		if($search != '') {
			$where .=" AND mdl_course.fullname LIKE '%$search%'";
		}

		if($prgm != '') {
			$where .=" AND (mdl_course.summary LIKE '%$prgm%' or mdl_course.summary like '%$prgm' or mdl_course.summary like '$prgm%')";
		}

		if($filter != '') {
			$where .=" AND mdl_course_categories.id = '$filter'";
		}

		$sql="SELECT mdl_course.*
			 FROM mdl_course, mdl_course_categories, mdl_course_sections
	   WHERE mdl_course.category = mdl_course_categories.id AND
			 mdl_course.newsitems = 5 AND
			 mdl_course.id = mdl_course_sections.course
			 $where
			 GROUP BY mdl_course.id";

		$query=$this->dbmcodlukm->query($sql);
		return $query->result();

	}

	public function get_course_list_catergories() {

		$sql="SELECT mdl_course_categories.*
			 FROM mdl_course_categories
			 GROUP BY mdl_course_categories.sortorder";

		$query=$this->dbmcodlukm->query($sql);
		return $query->result();

	}

	public function get_course_list_mcodlukm_search($search,$filter,$limit,$start) {

		$where = '';
		if($search != '') {
			$where .=" AND mdl_course.fullname LIKE '%$search%'";
		}

		if($filter != '') {
			$where .=" AND mdl_course_categories.id = '$filter'";
		}

		$sql="SELECT mdl_course.*
			 FROM mdl_course, mdl_course_categories, mdl_course_sections
	   WHERE mdl_course.category = mdl_course_categories.id AND
			 mdl_course.newsitems = 5 AND
			 mdl_course.id = mdl_course_sections.course
			 $where
			 GROUP BY mdl_course.id
			 LIMIT $start, $limit";

		$query=$this->dbmcodlukm->query($sql);
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

	public function get_course_sections_mcodlukm($courseid) {

		$sql = "SELECT mdl_course_sections.*
						 FROM mdl_course_sections
				   WHERE mdl_course_sections.course = '$courseid'
						 ORDER BY mdl_course_sections.section ASC";
		$query=$this->dbmcodlukm->query($sql);
		return $query->result();

	}

	public function get_mdl_page_mcodlukm($courseid, $section) {

		$sql = "SELECT mdl_page.*
						 FROM mdl_page
				   WHERE mdl_page.course = '$courseid' AND
						 mdl_page.name LIKE '$section%'
						 ORDER BY mdl_page.id ASC";
		$query=$this->dbmcodlukm->query($sql);
		return $query->result();

	}

	public function get_mdl_label_mcodlukm($courseid, $section) {

		$sql = "SELECT mdl_label.*
						 FROM mdl_label
				   WHERE mdl_label.course = '$courseid' AND
						 mdl_label.name LIKE '$section%'
						 ORDER BY mdl_label.id ASC";

		$query=$this->dbmcodlukm->query($sql);
		return $query->result();

	}


	public function get_mdl_block_instances_coursefeature($id) {
		$sql = "SELECT mdl_block_instances.id, mdl_block_instances.configdata
	FROM mdl_block_instances
	JOIN mdl_context ON
			mdl_context.id = mdl_block_instances.parentcontextid
	JOIN mdl_course ON
			mdl_course.id = mdl_context.instanceid
	WHERE mdl_course.id = '$id' AND
			(mdl_block_instances.blockname = 'cocoon_course_feat_a' OR
			mdl_block_instances.blockname = 'cocoon_course_features')";

		$query=$this->dbmcodlukm->query($sql);
		return $query->result();
	}

	public function get_mdl_block_instances_course_intro($id) {
		$sql = "SELECT mdl_block_instances.id, mdl_block_instances.configdata
	FROM mdl_block_instances
	JOIN mdl_context ON
			mdl_context.id = mdl_block_instances.parentcontextid
	JOIN mdl_course ON
			mdl_course.id = mdl_context.instanceid
	WHERE mdl_course.id = '$id' AND
			mdl_block_instances.blockname = 'cocoon_course_intro'";

		$query=$this->dbmcodlukm->query($sql);
		return $query->result();
	}

	public function get_mdl_role_assignments($id) {
		$sql = "SELECT mdl_role_assignments.id, mdl_role.id, mdl_role.shortname, mdl_user.*
		FROM mdl_role_assignments
			LEFT JOIN mdl_user_enrolments ON
				mdl_role_assignments.userid = mdl_user_enrolments.userid
			LEFT JOIN mdl_role ON
				mdl_role_assignments.roleid = mdl_role.id
			LEFT JOIN mdl_context ON
				mdl_context.id = mdl_role_assignments.contextid
			LEFT JOIN mdl_enrol ON
				mdl_enrol.courseid = mdl_context.instanceid AND
				mdl_user_enrolments.enrolid = mdl_enrol.id
			LEFT JOIN mdl_user ON
				mdl_user.id = mdl_role_assignments.userid
		WHERE mdl_role.id = '3' AND
			mdl_enrol.courseid = '$id'";



		$query=$this->dbmcodlukm->query($sql);
		return $query->result();
	}





	// ------------------- db ecourse ------------------- //

	public function insert_signup($signup)
	{
		$this->dbecourse->insert('data_pelajar', $signup);
		return $this->dbecourse->affected_rows();
	}

	public function insert_cache($signup)
	{
		$this->dbecourse->insert('cache', $signup);
		return $this->dbecourse->affected_rows();
	}

	public function get_cache() {
		$sql = "SELECT cache.*
						FROM cache";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_data_users($email) {
		$sql = "SELECT data_users.*
						FROM data_users
						WHERE data_users.email = '$email'";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function insert_data_users($signup)
	{
		$this->dbecourse->insert('data_users', $signup);
		return $this->dbecourse->affected_rows();
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

	public function update_data_pelajar($input_data_pelajar) {
		$this->dbecourse->where('user_id', $input_data_pelajar['user_id']);
		return $this->dbecourse->update('data_pelajar', $input_data_pelajar);
	}

	public function insert_data_pelajar_sponsor($input_data_pelajar) {
		$this->dbecourse->insert('data_pelajar_sponsor', $input_data_pelajar);
		return $this->dbecourse->affected_rows();
	}

	public function update_data_pelajar_sponsor($input_data_pelajar) {
		$this->dbecourse->where('user_id', $input_data_pelajar['user_id']);
		return $this->dbecourse->update('data_pelajar_sponsor', $input_data_pelajar);
	}

	public function get_param_kursus_by_invoice($user_id, $noinvoice, $type) {
		$from = '';
		$where = '';
		$select = '';
		if($type == 'SP') {
			$from = "data_order_sp ";
			$select = 'data_order_sp.* ';
			$where = " param_kursus.kursusid = data_order_sp.kursusid AND data_cart.order_id = data_order_sp.ordersp_id AND data_invoice.order_id = data_order_sp.ordersp_id";
		} else if($type == 'MC') {
			$from = "data_order_mc ";
			$select = 'data_order_mc.* ';
			$where = " param_kursus.kursusid = data_order_mc.kursusid AND data_cart.order_id = data_order_mc.ordermc_id AND data_invoice.order_id = data_order_mc.ordermc_id";
		}

		$sql = "SELECT param_kursus.*, data_invoice.*,$select
						FROM param_kursus,data_cart,data_invoice,$from
						WHERE data_cart.idcart = param_kursus.idcart AND
							$where AND
							data_cart.user_id = '$user_id' AND
							data_invoice.noinvoice = '$noinvoice'";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_data_order_sp($order_id) {
		$sql="SELECT data_order_sp.*
					FROM data_order_sp
					WHERE data_order_sp.ordersp_id = '$order_id'
					ORDER BY data_order_sp.ordersp_id DESC";

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

	public function get_customformPemohon($form_id, $user_id) {
		$sql = "SELECT *
						FROM `custom_pemohon`
						WHERE `user_id` = '$user_id' AND
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

	public function get_data_invoice_sp($no_inv) {
		$sql = "SELECT *
						FROM data_invoice, data_order_sp
						WHERE data_order_sp.ordersp_id = data_invoice.order_id AND
							data_invoice.noinvoice = '$no_inv'";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_data_invoice_mc($no_inv) {
		$sql = "SELECT *
						FROM data_invoice, data_order_mc
						WHERE data_order_mc.ordermc_id = data_invoice.order_id AND
							data_invoice.noinvoice = '$no_inv'";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_data_order_mc($order_id) {
		$sql="SELECT data_order_mc.*
					FROM data_order_mc
					WHERE data_order_mc.ordermc_id = '$order_id'
					ORDER BY data_order_mc.ordermc_id DESC";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_data_users_id($user_id)
	{
		$sql = "SELECT *
				FROM data_users
				WHERE id = '$user_id'";
		$query = $this->dbecourse->query($sql);
		return $query->result();
	}

	public function check_data_user($email)
	{
		$sql = "SELECT *
				FROM data_users
				WHERE email = '$email'";
		$query = $this->dbecourse->query($sql);
		return $query->result();
	}

	public function update_data_user($input_data_user) {
		$this->dbecourse->where('id', $input_data_user['id']);
		return $this->dbecourse->update('data_users', $input_data_user);
	}

	

	public function get_kursusactive($kursusid, $user_id) {
		$sql = "SELECT *
						FROM `data_order_mc`
						JOIN data_cart ON data_cart.order_id = data_order_mc.ordermc_id
						WHERE data_order_mc.kursusid = '$kursusid' AND
							data_cart.user_id = '$user_id'";

		$query = $this->dbecourse->query($sql);
		return $query->result();
	}


	//mdl_page -> klik 1.1 pengenalan ada summary
  //mdl_label -> section dlm topik
	//-> mdl_lesson -> 1.2.1 sub summary
	// -> mdl_lesson_pages -> isi summary mdl_lesson

	//mdl_course_sections -> curriculum section

}
/* End of file Dashboard_m.php */
/* Location: ./application/models/Dashboard_m.php */ ?>
