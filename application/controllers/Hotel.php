<?php
class Hotel extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model("mhotel");
        $this->load->model("muser");
    }

    public function hotel_info(){
        $hid=$_REQUEST['hid'];
        $data['hotel']=$this->mhotel->get_hotel_info_by_id($hid);
        $apartments=$this->mhotel->get_apartments_by_hid($hid);
        foreach($apartments as $key=>$apartment){
            $apartments[$key]['type']=$this->transform_type($apartment['type']);
        }
        $data['apartments']=$apartments;
        $comments=$this->mhotel->get_comments_by_hid($hid);
        foreach($comments as $key=>$comment){
            $user=$this->muser->get_user_by_id($comment['uid']);
            $comments[$key]['avatar']=$user['avatar'];
            $comments[$key]['username']=$user['username'];
        }
        $data['comments']=$comments;
        $this->load->view("hotel/hotelinfo",$data);
    }

    public function comment(){
        $uid=$_SESSION['user']['id'];
        $hid=$_REQUEST['hid'];
        $comment=$_REQUEST['comment'];
        $data=array(
            "uid"=>$uid,
            "hotel_id"=>$hid,
            "text"=>$comment,
        );
        $this->mhotel->add_comment($data);
        redirect("?c=hotel&m=hotel_info&hid=".$hid);
    }

    private function transform_type($type){
        $explanation="";
        switch($type) {
            case 1:
                $explanation="标间";
                break;
            case 2:
                $explanation="大床房";
                break;
            case 3:
                $explanation="商务房";
                break;
            case 4:
                $explanation="家庭房";
                break;
            default:
                break;
        }
        return $explanation;
    }

}