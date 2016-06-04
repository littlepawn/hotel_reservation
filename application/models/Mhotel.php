<?php
class Mhotel extends CI_Model{
    private $_hotel_db;
    function __construct(){
        parent::__construct();
        $this->load->database("default");
        $this->_hotel_db="hotel";
        $this->_apartment_db="apartment";
        $this->_comment_db="comment";
    }

    public function get_hotel_info($cityID){
        $this->db->where("cityID",$cityID);
        $query=$this->db->get($this->_hotel_db);
        return $query->result_array();
    }

    public function get_hotel_info_by_id($id){
        $this->db->where("_id",$id);
        $query=$this->db->get($this->_hotel_db);
        return $query->row_array();
    }

    public function get_apartments_by_hid($hid){
        $this->db->where("hotel_id",$hid);
        $this->db->order_by("type","asc");
        $query=$this->db->get($this->_apartment_db);
        return $query->result_array();
    }

    public function get_comments_by_hid($hid){
        $this->db->where("hotel_id",$hid);
        $this->db->order_by("create_time","desc");
        $query=$this->db->get($this->_comment_db);
        return $query->result_array();
    }

    public function add_comment($data){
        $this->db->insert($this->_comment_db,$data);
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
                $this->db->where("low_price<=", 1000);
            } else {
                $this->db->where("low_price>", 1000);
            }
        }
        $query=$this->db->get($this->_hotel_db);
        return $query->result_array();
    }

    public function get_reservation_by_params($data){
        $this->db->where("user_id",$data['user_id']);
        $this->db->where("hotel_id",$data['hotel_id']);
        $this->db->where("apartment_id",$data['apartment_id']);
        $query=$this->db->get("reservation");
        return $query->row_array();
    }

    public function count_hotel($cityID){
        $this->db->where('cityID', $cityID);
        $this->db->from($this->_hotel_db);
        $total = $this->db->count_all_results();
        return $total;
    }

    public function get_apartment_info_by_id($id){
        $this->db->where("_id",$id);
        $query=$this->db->get($this->_apartment_db);
        return $query->row_array();
    }

}