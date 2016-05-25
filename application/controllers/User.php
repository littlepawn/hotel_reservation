<?php

class User extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }


    public function show_edit_info(){
        $this->load->view("user/edit_userinfo");
    }

}