<?php
class Admin extends CI_Controller{
	public function __construct(){
		parent::__construct();
		
		$this->load->model("muser");
		// $this->load->helper('url');
		$this->load->library('session');
		if (!$this->session->userdata('admin')){
            //跳转到用户登陆页面
            redirect("?c=auth&m=login");
        }
	}

	public function index(){
		$data['users']=$this->get_user_list();
		$this->load->view("main",$data);
	}

	public function user(){
		$data['users']=$this->get_user_list();
		$this->load->view("user",$data);
	}

	public function hotel(){
		$data['hotels']=$this->muser->get_hotel_list();
		$this->load->view("hotel",$data);
	}

	public function comment(){
		$comments=$this->muser->get_comment_list();
		foreach($comments as $key=>$comment){
			$user=$this->muser->get_user_by_id($comment['uid']);
			$comments[$key]['username']=$user['username'];
			$hotel=$this->muser->get_hotel_by_id($comment['hotel_id']);
			$comments[$key]['title']=$hotel['title'];
		}
		$data['comments']=$comments;
		$this->load->view("comment",$data);
	}

	public function del_comment(){
		$cid=$_REQUEST['cid'];
		$this->muser->del_comment($cid);
		$this->comment();
	}







	public function get_user_list(){
		$user_array=$this->muser->get_user_list();
		return $user_array;
	}

	public function get_hotel_list(){
		$data['hotels']=$this->muser->get_hotel_list();
		$this->load->view("admin_index1",$data);
	}

	public function get_reservation_list(){
		$data['reservations']=$this->muser->get_reservation_list();
		$this->load->view("admin_index2",$data);
	}


	/**
	*  	辅助函数	
	*/
	public function dump($vars, $label = '', $return = false) {
        if (ini_get('html_errors')) {
                $content = "<pre>\n";
                if ($label != '') {
                        $content .= "<strong>{$label} :</strong>\n";
                }
                $content .= htmlspecialchars(print_r($vars, true));
                $content .= "\n</pre>\n";
        } else {
                $content = $label . " :\n" . print_r($vars, true);
        }
        if ($return) { return $content; }
        echo $content;
        return null;
	}

	public function test(){
		echo base_url()."<br>";
		echo site_url();
	}

}