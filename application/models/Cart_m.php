<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cart_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//$this->dbpdata=$this->load->database('pdata',true);
		//$this->dbsmk_prodV=$this->load->database('smk_prodV',true);
		$this->dbecourse=$this->load->database('ecourse',true);
	}

	public function get_data_cart($user_id) {
		$sql="SELECT `data_cart`.*,
						`param_kursus`.*
					FROM `data_cart`, `param_kursus`
					WHERE data_cart.idcart = param_kursus.idcart AND
						data_cart.user_id = '$user_id' AND
						data_cart.order_id = ''";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function insert_param_kursus($input_param_kursus) {
		$this->dbecourse->insert('param_kursus', $input_param_kursus);
		return $this->dbecourse->insert_id();
	}

	public function insert_data_mohon($input_data_mohon) {
		$this->dbecourse->insert('data_mohon', $input_data_mohon);
		return $this->dbecourse->insert_id();
	}

	public function insert_data_cart($input_data_cart) {
		$this->dbecourse->insert('data_cart', $input_data_cart);
		return $this->dbecourse->insert_id();
	}


	public function get_data_cart_param_kursus($user_id, $kursusid) {
		$sql="SELECT `data_cart`.*,
						`param_kursus`.*
					FROM `data_cart`, `param_kursus`
					WHERE data_cart.idcart = param_kursus.idcart AND
						data_cart.user_id = '$user_id' AND
						param_kursus.kursusid = '$kursusid' AND
						data_cart.noinvoice = ''";
		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_data_cart_empty($user_id) {
		$sql="SELECT `data_cart`.*
					FROM `data_cart`
					WHERE data_cart.user_id = '$user_id' AND
						data_cart.order_id = ''";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function insert_data_order($input_data_order) {
		return $this->dbecourse->insert('data_order', $input_data_order);
	}

// old





	public function insert_data_order_sp($input_data_order_sp) {
		$this->dbecourse->insert('data_order_sp', $input_data_order_sp);
		return $this->dbecourse->affected_rows();
	}

	public function update_data_order_sp($input_data_order_sp) {
		$this->dbecourse->where('ordersp_id', $input_data_order_sp['ordersp_id']);
		$this->dbecourse->update('data_order_sp', $input_data_order_sp);
		return $this->dbecourse->affected_rows();
	}

	public function get_data_invoice($inv) {
		$sql="SELECT *
					FROM `data_invoice`
					WHERE data_invoice.noinvoice LIKE '$inv%'
					ORDER BY data_invoice.noinvoice DESC";
		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function insert_data_invoice($input_data_invoice) {
		$this->dbecourse->insert('data_invoice', $input_data_invoice);
		return $this->dbecourse->affected_rows();
	}

	public function update_data_invoice($input_data_invoice) {
		$this->dbecourse->where('noinvoice', $input_data_invoice['noinvoice']);
		$this->dbecourse->update('data_invoice', $input_data_invoice);
		return $this->dbecourse->affected_rows();
	}

	public function update_data_cart($input_data_cart) {
		$this->dbecourse->where('idcart', $input_data_cart['idcart']);
		return $this->dbecourse->update('data_cart', $input_data_cart);
	}

	public function get_data_order() {
		$sql="SELECT data_order.order_id order_id
					FROM `data_order`
					ORDER BY data_order.order_id DESC";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_data_order_sp() {
		$sql="SELECT data_order_sp.ordersp_id order_id
					FROM `data_order_sp`
					ORDER BY data_order_sp.ordersp_id DESC";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function insert_customformPemohon($input_customformpemohon)
	{
		$this->dbecourse->insert('custom_pemohon', $input_customformpemohon);
		return $this->dbecourse->affected_rows();
	}

	public function update_customformPemohon($input_customformpemohon)
	{
		$this->dbecourse->where('user_id', $input_customformpemohon['user_id']);
		$this->dbecourse->where('form_id', $input_customformpemohon['form_id']);
		$this->dbecourse->update('custom_pemohon', $input_customformpemohon);
		return $this->dbecourse->affected_rows();
	}

	public function get_data_order_mc() {
		$sql="SELECT data_order_mc.ordermc_id order_id
					FROM `data_order_mc`
					ORDER BY data_order_mc.ordermc_id DESC";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_data_order_mc_wujud($user_id,$kursusid) {
		$sql="SELECT *
					FROM `data_order_mc`, `data_cart`
					WHERE data_cart.order_id = data_order_mc.ordermc_id AND
								data_order_mc.kursusid = '$kursusid' AND
								data_cart.user_id = '$user_id' AND
								data_order_mc.status_app = 1";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function get_data_order_mc_cart($user_id) {
		$sql="SELECT *
					FROM `data_order_mc`, `data_cart`
					WHERE data_cart.order_id = data_order_mc.ordermc_id AND
								data_cart.user_id = '$user_id' AND
								data_order_mc.status_app = 1";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function insert_data_order_mc($input_data_order_mc) {
		$this->dbecourse->insert('data_order_mc', $input_data_order_mc);
		return $this->dbecourse->affected_rows();
	}

	public function update_data_order_mc($input_data_order_mc) {
		$this->dbecourse->where('ordermc_id', $input_data_order_mc['ordermc_id']);
		$this->dbecourse->update('data_order_mc', $input_data_order_mc);
		return $this->dbecourse->affected_rows();
	}

	public function get_data_order_mc_param_kursus($user_id) {
		$sql="SELECT *
					FROM `data_cart`
                    LEFT JOIN `data_order_mc` ON data_cart.order_id = data_order_mc.ordermc_id AND data_order_mc.status_app = 1
                    JOIN `param_kursus` ON data_cart.idcart = param_kursus.idcart AND data_order_mc.kursusid = param_kursus.kursusid
					WHERE data_cart.user_id = '$user_id'";

		$query=$this->dbecourse->query($sql);
		return $query->result();
	}

	public function remove_param_kursus($paramid,$cartid) {
		$this->dbecourse->where('idparam', $paramid);
		$this->dbecourse->where('idcart', $cartid);
		return $this->dbecourse->delete('param_kursus');

		return $this->dbecourse->query($sql);
	}

	public function remove_data_order_mc($id) {
		$this->dbecourse->where('id', $id);
		return $this->dbecourse->delete('data_order_mc');
	}

	public function remove_data_cart_mc($idcart) {
		$this->dbecourse->where('idcart', $idcart);
		return $this->dbecourse->delete('data_cart');
	}

}
/* End of file Dashboard_m.php */
/* Location: ./application/models/Dashboard_m.php */ ?>
