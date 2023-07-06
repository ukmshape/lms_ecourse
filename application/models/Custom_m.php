<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Custom_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		// $this->dbpdata=$this->load->database('pdata',true);
		// $this->dbsmk_prodV=$this->load->database('smk_prodV',true);
		$this->dbmcodlukm=$this->load->database('mcodlukm',true);
		$this->dbecourse=$this->load->database('ecourse',true);
	}

	function get_list_custom_field() {
		$sql = "SELECT custom_field.*
						FROM custom_field
						ORDER BY custom_field.custom_id ASC";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	function get_custom_field($id) {
		$sql = "SELECT custom_field.*
						FROM custom_field
						WHERE custom_id = '$id'";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function insert_custom_field($input_data_customfield) {
		$this->dbecourse->insert('custom_field', $input_data_customfield);
		return $this->dbecourse->insert_id();
	}

	public function update_custom_field($input_data_customfield) {
		$this->dbecourse->where('custom_id', $input_data_customfield['custom_id']);
		$this->dbecourse->update('custom_field', $input_data_customfield);
		return $this->dbecourse->affected_rows();
	}

	public function get_customfield_customform($custom_id) {
		$sql = "SELECT custom_field.*, custom_form.form_id form_id
						FROM custom_field
						JOIN custom_form
							ON custom_form.custom_id = custom_field.custom_id
						WHERE custom_field.custom_id = '$custom_id'";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_customfield_customform_1($kursusid) {
		$sql = "SELECT custom_field.*, custom_form.*, custom_form.custom_id idcustomform
						FROM custom_field
						JOIN custom_form
							ON custom_form.custom_id = custom_field.custom_id
						WHERE custom_form.kursusid = '$kursusid'
						ORDER BY custom_form.orderby ASC";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function delete_custom_field($custom_id) {
		$this->dbecourse->where('custom_id', $custom_id);
		$this->dbecourse->delete('custom_field');
		return $this->dbecourse->affected_rows();
	}

	public function update_customformfixed($input_data_customformfixed) {
		$this->dbecourse->where('form_id', $input_data_customformfixed['form_id']);
		$this->dbecourse->update('custom_form_fixed', $input_data_customformfixed);
		return $this->dbecourse->affected_rows();
	}

	public function insert_customformfixed($input_data_customformfixed) {
		$this->dbecourse->insert('custom_form_fixed', $input_data_customformfixed);
		return $this->dbecourse->insert_id();
	}

	public function update_customform($course_id) {
		$this->dbecourse->where('kursusid', $course_id);
		$this->dbecourse->delete('custom_form');
		return $this->dbecourse->affected_rows();
	}

	public function insert_customform($inputArray) {
		$this->dbecourse->insert('custom_form', $inputArray);
		return $this->dbecourse->insert_id();
	}

	function get_mcodlukm_course()
	{

			$sql = "SELECT mdl_course.id course_id, mdl_course.*, mdl_course_categories.name nmcategory
				 FROM mdl_course, mdl_course_categories
				 WHERE mdl_course_categories.id = mdl_course.category AND
				 mdl_course.newsitems = 5 AND
				 mdl_course.idnumber LIKE 'SP%'";

			$query = $this->dbmcodlukm->query($sql);
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

	public function get_customformfixed($kursusid) {
		$sql = "SELECT custom_form_fixed.*
						FROM custom_form_fixed
						WHERE custom_form_fixed.kursusid = '$kursusid'";

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

}



/* End of file Urusetia_mc.php */

/* Location: ./application/controllers/Urusetia_mc.php */

?>
