<?php 
class Muser extends CI_Model{
	private $_db_user="user";
	private $_db_hotel;

	public function __construct(){
		parent::__construct();
		$this->_db_hotel=$this->load->database("default",true);
	}

	public function get_user_list(){
		$query=$this->_db_hotel->get($this->_db_user);
		return $query->result_array();
	}
}