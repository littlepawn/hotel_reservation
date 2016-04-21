<?php
class Muser extends CI_Model{
    private $_user_db;

    public function __construct(){
        parent::__construct();
        $this->load->database("default");
        $this->_user_db="user";
    }

    public function get_userinfo($id){
        $this->db->where("_id",$id);
        $query=$this->db->get($this->_user_db);
        return $query->result_array();
    }

    public function get_reservation($id){
        $this->db->where("user_id",$id);
        $query=$this->db->get("reservation");
        return $query->result_array();
    }

    public function reserve($data){
        $this->db->insert("reservation",$data);
    }

    public function del_reservation($uid,$hid){
        $this->db->where("user_id",$uid);
        $this->db->where("hotel_id",$hid);
        $this->db->delete("reservation");
    }
}