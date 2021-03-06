<?php
class Mauth extends CI_Model{
    private $_user_db;

    public function __construct(){
        parent::__construct();
        $this->load->database("default");
        $this->_user_db="user";
    }

    public function get_user_by_username_or_email($data){
        $this->db->where("username",$data);
        $this->db->or_where("email",$data);
        $query=$this->db->get($this->_user_db);
        return $query->row_array();
    }

    public function get_user_by_username($data){
        $this->db->where("username",$data);
        $query=$this->db->get($this->_user_db);
        return $query->row_array();
    }

    public function get_user_by_email($data){
        $this->db->where("email",$data);
        $query=$this->db->get($this->_user_db);
        return $query->row_array();
    }

    public function insert_user($data){
        $this->db->insert($this->_user_db,$data);
        if($this->db->affected_rows()>0)
            return $this->db->insert_id();
        return false;
    }
}