<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function login(){
        if(!empty($_POST)){
            $data=trim($_POST['username']);
            $password=md5(trim($_POST['password']));
            $user=$this->mauth->get_user_by_username_or_email($data);
            if(empty($user)){
                echo "null";
            }else {
                var_export($user);
            }
            exit;
        }
        $this->load->view("auth/login");
    }

    public function register(){
        if(!empty($_POST)){
            $email=trim($_POST['email']);
            $name=trim($_POST['username']);
            $password=md5(trim($_POST['password']));
            $data=array(
                "email"=>$email,
                "name"=>$name,
                "password"=>$password,
            );
            var_export($data);
            exit;
        }
         $this->load->view("auth/register");
    }
}