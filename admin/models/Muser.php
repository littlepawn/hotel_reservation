<?php 
class Muser extends CI_Model{
	private $_db_user="user";
	private $_db_hotel;

	public function __construct(){
		parent::__construct();
		$this->_db_hotel=$this->load->database("default",true);
	}

	public function get_user_by_id($id){
		$this->_db_hotel->where("_id",$id);
		$query=$this->_db_hotel->get($this->_db_user);
		return $query->row_array();
	}

	public function get_user_list(){
		$query=$this->_db_hotel->get($this->_db_user);
		return $query->result_array();
	}

	public function get_hotel_by_id($id){
		$this->_db_hotel->where("_id",$id);
		$query=$this->_db_hotel->get("hotel");
		return $query->row_array();
	}

	public function get_hotel_list(){
		$query=$this->_db_hotel->get("hotel");
		return $query->result_array();
	}

	public function get_comment_list(){
		$query=$this->_db_hotel->get("comment");
		return $query->result_array();
	}

	public function del_comment($cid){
		$this->_db_hotel->where("_id",$cid);
		$this->_db_hotel->delete("comment");
	}

	public function get_reservation_list(){
		$sql="select * from (select r.*,u.email,u.username from reservation r left join user u on r.user_id=u._id) a left join hotel h on h._id=a.hotel_id";
		$query=$this->_db_hotel->query($sql);
		return $query->result_array();
	}
}