<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{
    public function __construct(){
        parent::__construct();
//        $this->load->library('session');
//        $this->load->helper('url');
    }

    public function login(){
        if(!empty($_POST)){
            $data=trim($_POST['username']);
            $password=md5(trim($_POST['password']));
            $user=$this->mauth->get_user_by_username_or_email($data);
            if(empty($user)){
                $this->session->set_flashdata('error', '用户不存在');
            }else {
                if($user['password']!=$password){
                    $this->session->set_flashdata('error', '密码错误');
                }else{
                    $this->session->set_userdata("user",array("id"=>$user['_id'],"name"=>$user['username'],"email"=>$user['email'],'mobile'=>$user['mobile'],"sex"=>$user['sex'],"avatar"=>$user['avatar']));
                    redirect(base_url('index.php?c=index&m=index'));
                }
            }
        }
        $this->load->view("auth/login");
    }

    public function login_out(){
        unset($_SESSION['user']);
        echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }

    public function register(){
        if(!empty($_POST)){
            $email=trim($_POST['email']);
            $name=trim($_POST['username']);
            $password=md5(trim($_POST['password']));
            
            $user=$this->mauth->get_user_by_username($name);
            if(!empty($user)){
                $this->session->set_flashdata('error', '用户名重复');
                $this->load->view("auth/register");
                return;
            }

            unset($user);
            $user=$this->mauth->get_user_by_email($email);
            if(!empty($user)){
                $this->session->set_flashdata('error', '邮箱重复');
                $this->load->view("auth/register");
                return;
            }

            $data=array(
                "email"=>$email,
                "username"=>$name,
                "password"=>$password,
            );
            $user_id=$this->mauth->insert_user($data);
            if(!$user_id){
                $this->session->set_flashdata('error', '注册失败，请稍后重试');
            }else{
                $this->load->view("auth/login");
                return;
            }

        }
        $this->load->view("auth/register");
    }
}