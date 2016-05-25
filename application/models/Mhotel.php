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

    public function get_hotels_by_param($id,$hotelname,$price,$level,$category){
        if($category==1)
            $this->db->where("areaID",$id);
        if($category==2)
            $this->db->where("cityID",$id);
        if(!empty($hotelname))
            $this->db->like("title",$hotelname,"both");
        if(!empty($level))
            $this->db->where("level",$level);
        if(!empty($price)) {
            if ($price == 1) {
                $this->db->where("low_price<", 100);
            } elseif ($price == 2) {
                $this->db->where("low_price>=", 100);
                $this->db->where("low_price<=", 300);
            } elseif ($price == 3) {
                $this->db->where("low_price>=", 300);
                $this->db->where("low_price<=", 600);
            } elseif ($price == 4) {
                $this->db->where("low_price>=", 600);
                $this->db->where("low_price<=", 1500);
            } else {
                $this->db->where("low_price>", 1500);
            }
        }
        $query=$this->db->get($this->_hotel_db);
        return $query->result_array();
    }

}