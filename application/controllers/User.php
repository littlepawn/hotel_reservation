<?php

class User extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("muser");
    }


    public function show_edit_info(){
        $this->load->view("user/edit_userinfo");
    }

    public function edit_user(){
        $user_array=$_POST;
        if(empty($_FILES['avatar']['error'])){
            $data=$this->do_upload();
            $filename=$data['upload_data']['file_name'];
            $fileurl=base_url()."uploads/".$filename;
            $user_array['avatar']=$fileurl;
        }
        $uid=$_SESSION['user']['id'];
        $this->muser->update_user($user_array,$uid);

        $user=$this->muser->get_user_by_id($uid);
        unset($_SESSION['user']);
        $this->session->set_userdata("user",array("id"=>$user['_id'],"name"=>$user['username'],"email"=>$user['email'],'mobile'=>$user['mobile'],"sex"=>$user['sex'],"avatar"=>$user['avatar']));
        redirect("?c=index&m=userinfo");

    }

    public function do_upload()
    {
        $config['upload_path']      = './uploads/';
        $config['allowed_types']    = 'gif|jpg|png';
//        $config['max_size']     = 100;
//        $config['max_width']        = 1024;
//        $config['max_height']       = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('avatar'))
        {
            $error = array('error' => $this->upload->display_errors());

            echo "upload image failed".implode($error);
            exit;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
        }
        return $data;
    }

}