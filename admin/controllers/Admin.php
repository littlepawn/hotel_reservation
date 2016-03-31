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
		$this->load->view("admin_index",$data);
	}

	public function get_user_list(){
		$user_array=$this->muser->get_user_list();
		// $this->dump($user_array);
		return $user_array;
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