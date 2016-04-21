<?php
class Hotel extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model("mhotel");
    }

    public function hotel_info(){
        $hotel=$this->mhotel->get_hotel_info_by_id(1);
        $this->load->view("hotel/hotelinfo",$hotel);
    }

}