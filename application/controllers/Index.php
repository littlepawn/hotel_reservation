<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("mhotel");
    }

    public function index(){
        $data['hotel']=$this->mhotel->get_hotel_info();
        $this->load->view("index/index",$data);
    }

    public function test(){
        var_export($_SESSION['user']);
    }

    public function userinfo(){
        $user=$this->session->userdata("user");
        if(empty($user))
            redirect("?c=auth&m=login");

        $userinfo=$this->muser->get_userinfo($user['id']);
        if(empty($userinfo)){

        }
        $data['user']=array(
            "username"=>$user['name'],
            "email"=>$userinfo[0]['email'],
            "gender"=>1,
        );
        $this->load->view("user/userinfo",$data);
    }
    
    
    //test
    public function reservation(){
        $user=$this->session->userdata("user");
        if(empty($user))
            redirect("?c=auth&m=login");

        $reservation=$this->muser->get_reservation($user['id']);
        if(empty($reservation)){

        }
        $this->load->model("mhotel");
        $hotel_array=array();
        foreach($reservation as $value){
            $hotel_array[]=$this->mhotel->get_hotel_by_id($value['hotel_id']);
        }
        $data['hotel']=$hotel_array;
        $this->load->view("hotel/reservation",$data);
    }

    public function reserve(){
        $id=$_REQUEST['id'];
        $user=$this->session->userdata("user");
        $data=array(
            "user_id"=>$user['id'],
            "hotel_id"=>$id,
            "type"=>1,
        );
        $this->muser->reserve($data);
        echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }

    public function del_reservation(){
        $uid=$_REQUEST['uid'];
        $hid=$_REQUEST['hid'];
        $this->muser->del_reservation($uid,$hid);
        echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }

}