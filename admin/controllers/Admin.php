<?php
class Admin extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("muser");
	}

	public function index(){
		$this->load->view("main");
	}

	public function get_user_list(){
		$user_array=$this->muser->get_user_list();
		$this->dump($user_array);
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

}