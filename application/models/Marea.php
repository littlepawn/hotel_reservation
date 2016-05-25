<?php
class Marea extends CI_Model{
    private $_area;
    private $_city;
    private $_province;
    function __construct(){
        parent::__construct();
        $this->load->database("default");
        $this->_area="area";
        $this->_city="city";
        $this->_province="province";
    }

    public function get_citys(){
        $query=$this->db->get($this->_city);
        return $query->result_array();
    }

    public function get_areas_by_cid($id){
        $this->db->where("fatherID",$id);
        $query=$this->db->get($this->_area);
        return $query->result_array();
    }
}