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

	public function del_user(){
		$uid=$_REQUEST['uid'];
		$this->muser->del_user($uid);
		$this->user();
		return;
	}

	public function hotel(){
		$data['hotels']=$this->muser->get_hotel_list();
		$this->load->view("hotel",$data);
	}

	public function add_hotel(){
		$this->load->view("add_hotel");
	}

	public function publish_hotel(){
		$hotel_array=$_POST;
        if(empty($_FILES['image']['error'])){
            $data=$this->do_upload();
			$this->resize($data['upload_data']['full_path']);
            $filename=$data['upload_data']['file_name'];
            $fileurl=base_url()."uploads/".$filename;
            $hotel_array['image']=$fileurl;
        }
		unset($hotel_array['city']);
        $this->muser->insert_hotel($hotel_array);
        $this->hotel();
		return;
	}

	public function del_hotel(){
		$hid=$_REQUEST['hid'];
		$this->muser->del_hotel($hid);
		$this->hotel();
		return;
	}

	public function get_area(){
		$city=trim($_REQUEST['city']);
		$areas=$this->get_areas_by_cid($city);
		if(empty($areas)){
			echo json_encode(array("result"=>0));
		}else {
			echo json_encode(array("result"=>1,"areas"=>$areas));
		}
	}

	public function get_areas_by_cid($city){
        $citys=$this->muser->get_citys();
        $areas=array();
        foreach ($citys as $key=>$value){
            if(mb_strpos($value['city'],$city)!==false){
                $areas=$this->muser->get_areas_by_cid($value['cityID']);
            }
        }
        return $areas;
    }

	public function add_apartment(){
		$data['hid']=$_REQUEST['hid'];
		$this->load->view("add_apartment",$data);
	}

	public function publish_apartment(){
		$apartment_array=$_POST;
        if(empty($_FILES['image']['error'])){
            $data=$this->do_upload();
			$this->resize($data['upload_data']['full_path']);
            $filename=$data['upload_data']['file_name'];
            $fileurl=base_url()."uploads/".$filename;
            $apartment_array['image']=$fileurl;
        }
        $this->muser->insert_apartment($apartment_array);
        $this->apartment();
		return;
	}

	public function resize(){
		$config['image_library'] = 'gd2';
		$config['source_image'] = '/path/to/image/mypic.jpg';
		$config['create_thumb'] = false;
		$config['maintain_ratio'] = false;
		$config['width']     = 200;
		$config['height']   = 180;

		$this->load->library('image_lib', $config);

		$this->image_lib->resize();
	}

	public function do_upload()
    {
        $config['upload_path']      = './uploads/';
        $config['allowed_types']    = 'gif|jpg|png';
//        $config['max_size']     = 100;
//        $config['max_width']        = 1024;
//        $config['max_height']       = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('image'))
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

	public function apartment(){
		$apartments=$this->muser->get_apartment_list();
		foreach($apartments as $key=>$apartment){
			$apartments[$key]['type']=$this->transform_type($apartment['type']);
			$hotel=$this->muser->get_hotel_by_id($apartment['hotel_id']);
			$apartments[$key]['hotel']=$hotel['title'];
		}
		$data['apartments']=$apartments;
		$this->load->view("apartment",$data);
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

	public function del_apartment(){
		$aid=$_REQUEST['aid'];
		$this->muser->del_apartment($aid);
		$this->apartment();
		return;
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