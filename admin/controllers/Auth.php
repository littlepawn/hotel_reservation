<?php

class Auth extends CI_Controller
{
    private $admin_email = "admin";
    private $admin_pwd = "admin";

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->driver('cache', array('adapter' => 'redis'));
    }

    private function get_redis()
    {
        if (!$admin = $this->cache->get("admin")) {
            $this->cache->save("admin", array("email" => $this->admin_email, "password" => $this->admin_pwd), 60 * 60 * 24);
            $admin = $this->cache->get("admin");
        }
        return $admin;
    }

    public function clean_redis(){
        $this->cache->save('admin',array(),10);
        unset($_SESSION['admin']);
    }

    public function login()
    {
        if ($this->session->userdata('admin')) {
            redirect('');
        }

        $this->load->view('login', array('email' => '', 'password' => ''));
    }

    public function login_verify()
    {
        if ($this->session->userdata('admin')) {
            redirect('');
        }

        $email = trim($_REQUEST['email']);
        $password = trim($_REQUEST['password']);

        $admin = $this->get_redis();
        if ($admin['email'] == $email && $admin['password'] == $password) {
            $res = true;
        } else {
            $res = false;
        }

        if ($res) {
            $this->session->set_userdata("admin", array('email' => $email));
            $reponse = array('state' => '0');
            redirect("?c=admin&m=index");
        } else {
            $reponse = array('state' => '1');
            redirect("?c=auth&m=login");
        }
    }

    public function loginout(){
        $this->clean_redis();
        $this->login();
    }
}