<?php
class Mhotel extends CI_Model{
    private $_hotel_db;
    function __construct(){
        parent::__construct();
        $this->load->database("default");
        $this->_hotel_db="hotel";
    }

    public function get_hotel_info($cityID){
        $this->db->where("cityID",$cityID);
        $query=$this->db->get($this->_hotel_db);
        return $query->result_array();
    }

    public function get_hotel_by_id($id){
        $this->db->where("_id",$id);
        $query=$this->db->get($this->_hotel_db);
        return $query->row_array();
    }
}