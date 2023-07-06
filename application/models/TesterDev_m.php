<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class TesterDev_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//$this->dbesmpl=$this->load->database('smpl',true);
		$this->dbecourse=$this->load->database('ecourse',true);
		$this->dbmcodlukm=$this->load->database('mcodlukm',true);
	}

	public function get_pu14thppeng() {

		$sql = "SELECT * FROM pu14thppeng WHERE pu14urustia = '11JN' ORDER BY pu14nthppeng ASC";

    $query=$this->dbesmpl->query($sql);
		return $query->result();
	}

  public function get_block() {
    $sql = "SELECT cat.id AS catid, cat.name AS catname, b.blockname, COUNT(*)
    FROM mdl_context x
    JOIN mdl_block_instances b ON b.parentcontextid = x.id
    JOIN mdl_course c ON c.id = x.instanceid
    JOIN mdl_course_categories cat ON cat.id = c.category
    WHERE x.contextlevel = 50
    GROUP BY cat.id, cat.name, b.blockname
    ORDER BY cat.name, 4 DESC, b.blockname";

    $query=$this->dbmcodlukm->query($sql);
		return $query->result();

  }

  public function get_block_content() {
    $sql = "SELECT mdl_block_instances.id, mdl_block_instances.blockname, mdl_block_instances.configdata
    FROM mdl_block_instances
    JOIN mdl_context ON mdl_context.id = mdl_block_instances.parentcontextid
    JOIN mdl_course ON mdl_course.id = mdl_context.instanceid
    WHERE mdl_course.id = 9";

		//	WHERE mdl_block_instances.blockname = 'cocoon_course_intro' AND

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
			mdl_block_instances.blockname = 'cocoon_course_feat_a'";

		$query=$this->dbmcodlukm->query($sql);
		return $query->result();
	}

}
/* End of file Dashboard_m.php */
/* Location: ./application/models/Dashboard_m.php */ ?>
