<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//$this->dbpdata=$this->load->database('pdata',true);
		//$this->dbsmk_prodV=$this->load->database('smk_prodV',true);
		//$this->dbsmpl=$this->load->database('smpl',true);
		$this->dbecourse=$this->load->database('ecourse',true);
		$this->dbmcodlukm=$this->load->database('mcodlukm',true);
	}


  public function get_list_data_user() {
    $sql = "SELECT data_users.*
            FROM data_users";

    $query=$this->dbecourse->query($sql);
    return $query->result();
  }

  public function get_data_users($user_id) {
    $sql = "SELECT data_users.*
            FROM data_users
            WHERE id = '$user_id'";

    $query=$this->dbecourse->query($sql);
    return $query->result();
  }

  public function get_data_usersbyemail($email) {
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

  public function update_data_user($input_data_user) {
		$this->dbecourse->where('id', $input_data_user['id']);
		return $this->dbecourse->update('data_users', $input_data_user);
	}

  public function delete_user($id) {
		$this->dbecourse->where('id', $id);
		return $this->dbecourse->delete('data_users');
	}

	public function get_mcodlukm_course()
	{

			$sql = "SELECT mdl_course.id course_id, mdl_course.*, mdl_course_categories.name nmcategory
				 FROM mdl_course, mdl_course_categories
				 WHERE mdl_course_categories.id = mdl_course.category AND
				 mdl_course.newsitems = 5 AND
				 (mdl_course.idnumber LIKE 'SP%' OR mdl_course.idnumber LIKE 'MC%')";

			$query = $this->dbmcodlukm->query($sql);
			return $query->result();
	}

	public function get_totalenrolment($idnumber) {
		$sql = "SELECT * FROM `data_enrol` WHERE kursusid = '$idnumber'";

		$query = $this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_data_user_type() {
		$sql = "SELECT * FROM data_user_type
						ORDER BY data_user_type.type ASC";

		$query = $this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_userbyfaculty($faculty) {
		$sql = "SELECT data_users.*
						FROM data_users
						WHERE data_users.faculty = '$faculty' AND
						data_users.active = 'active'
						ORDER BY data_users.fullname ASC";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

}
