<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller{
    private static $limit=5;
    public function __construct(){
        parent::__construct();
        $this->load->model("mhotel");
        $this->load->model("marea");
    }

    public function index(){
        $page=1;
        if(isset($_REQUEST['page']))
            $page=$_REQUEST['page'];
        $cityID=$this->get_current_cityID();
        $hotels=$this->mhotel->get_hotel_info($cityID);
        $hotels=$this->add_comment_count($hotels);
        $data['count']=count($hotels);
        $data['page_count']=intval((count($hotels)-1)/SELF::$limit)+1;
        $data['page']=$page;
        $data['hotels']=$this->paging_hotels($page,$hotels);
        $areas=$this->get_citys();
        $data['areas']=$areas;
        $data['cityName']=$this->getPlace();
        $this->load->view("index/index",$data);
    }

    public function paging_hotels($page,$hotels){
//        $_SESSION['hotels']=$hotels;
        $count=count($hotels);
        if($count>SELF::$limit)
            $count=SELF::$limit;
        $hotel_array=array();
        if(empty($hotels))
            return array();
        for ($i=($page-1)*$count,$j=0;$j<$count;$j++,$i++){
            if(!isset($hotels[$i]))
                break;
            $hotel_array[]=$hotels[$i];
        }
        return $hotel_array;
    }

    public function add_comment_count($hotels){
        foreach ($hotels as $key=>$hotel){
            $comments=$this->mhotel->get_comments_by_hid($hotel['_id']);
            $hotels[$key]['comments']=count($comments);
        }
        return $hotels;
    }

    public function filter(){
        $city=htmlentities(trim($_REQUEST['area']));
        $hotelname=htmlentities(trim($_REQUEST['hotelname']));
        $areaID=intval($_REQUEST['areaID']);
        $price=intval($_REQUEST['price']);
        $level=intval($_REQUEST['level']);

        $start=htmlentities(trim($_REQUEST['start']));
        $end=htmlentities(trim($_REQUEST['end']));
        unset($_SESSION['start']);
        unset($_SESSION['end']);
        if(!empty($start))
            $_SESSION['start']=$start;
        if(!empty($end))
            $_SESSION['end']=$end;

        $page=1;
        if(isset($_REQUEST['page']))
            $page=$_REQUEST['page'];
        $param=array(
            "area"=>$city,
            "hotelname"=>$hotelname,
            "areaID"=>$areaID,
            "price"=>$price,
            "level"=>$level,
            "page"=>$page,
        );
        if(!empty($city)) {
            $cityID = $this->get_cityID_by_name($city);
            if (empty($cityID)) {
                $param['type']=1;
                $this->index_filter($param);
            }else{
                if($areaID==0) {
                    /*$param['type'] = 2;
                    $param['cityID'] = $cityID;
                    $this->index_filter($param);*/
                    $param['type']=4;
                    $hotels=$this->get_hotels_by_cityID($cityID,$hotelname,$price,$level);
                    $hotels=$this->add_comment_count($hotels);
                    $param['hotels']=$hotels;
                    $areas=$this->get_areas_by_cityID($cityID);
                    $param['areas']=$areas;
                    $this->index_filter($param);
                }else{
                    $param['type']=3;
                    $hotels=$this->get_hotels_by_areaID($areaID,$hotelname,$price,$level);
                    $hotels=$this->add_comment_count($hotels);
                    $param['hotels']=$hotels;
                    $areas=$this->get_areas_by_cityID($cityID);
                    $param['areas']=$areas;
                    $this->index_filter($param);
                }
            }
        }else{
            $areas=$this->get_citys();
            if(!empty($areaID)){
                $param['type']=3;
                $hotels=$this->get_hotels_by_areaID($areaID,$hotelname,$price,$level);
                $hotels=$this->add_comment_count($hotels);
                $param['hotels']=$hotels;
                $param['areas']=$areas;
                $this->index_filter($param);
            }else{
                $param['type']=4;
                $cityID=$this->get_current_cityID();
                $hotels=$this->get_hotels_by_cityID($cityID,$hotelname,$price,$level);
                $hotels=$this->add_comment_count($hotels);
                $param['hotels']=$hotels;
                $param['areas']=$areas;
                $this->index_filter($param);
            }
        }
    }

    public function index_filter($param){
        if($param['type']==1) {
            $data['areas'] = array();
            $data['hotels']=array();
            $data['count']=0;
            $data['page_count']=1;
            $data['page']=1;
            $data['flag']=true;
        }elseif($param['type']==2){
            $hotels=$this->mhotel->get_hotel_info($param['cityID']);
            $hotels=$this->add_comment_count($hotels);
            $data['count']=count($hotels);
            $data['page_count']=intval((count($hotels)-1)/SELF::$limit)+1;
            $data['hotels']=$this->paging_hotels($param['page'],$hotels);
            $areas=$this->get_areas_by_cityID($param['cityID']);
            $data['flag']=true;
            foreach($areas as $area){
                if($area['areaID']==$param['areaID']){
                    $hotels=$this->get_hotels_by_areaID($param['areaID'],$param['hotelname'],$param['price'],
                        $param['level']);
                    $data['hotels']=$hotels;
                    unset($data['flag']);
                    break;
                }
            }
            $data['page']=$param['page'];
            $data['areas']=$areas;
        }elseif($param['type']==3||$param['type']==4){
            $hotels=$param['hotels'];

            $data['count']=count($hotels);
            $data['page_count']=intval((count($hotels)-1)/SELF::$limit)+1;
            $data['hotels']=$this->paging_hotels($param['page'],$hotels);
            $data['areas']=$param['areas'];
            $data['page']=$param['page'];
            $data['cityName']=$this->getPlace();
        }else{
            echo "error";
            exit;
        }
        $this->load->view("index/index",$data);
    }

    public function get_hotels_by_areaID($areaID,$hotelname,$price,$level){
        $hotels=$this->mhotel->get_hotels_by_param($areaID,$hotelname,$price,$level,1);
        return $hotels;
    }

    public function get_hotels_by_cityID($cityID,$hotelname,$price,$level){
        $hotels=$this->mhotel->get_hotels_by_param($cityID,$hotelname,$price,$level,2);
        return $hotels;
    }

    public function test(){
        var_export($_SESSION['user']);
    }

    public function userinfo(){
        $user=$this->session->userdata("user");
        if(empty($user))
            redirect("?c=auth&m=login");

        $userinfo=$this->muser->get_userinfo($user['id']);
        if(empty($userinfo)){

        }
        $data['user']=array(
            "username"=>$user['name'],
            "email"=>$userinfo[0]['email'],
            "gender"=>1,
        );
        $this->load->view("user/userinfo",$data);
    }

    public function reservation(){
        $user=$this->session->userdata("user");
        if(empty($user))
            redirect("?c=auth&m=login");

        $reservation=$this->muser->get_reservation($user['id']);
        if(empty($reservation)){

        }
        $this->load->model("mhotel");
        $hotel_array=array();
        foreach($reservation as $value){
            $hotel=$this->mhotel->get_hotel_info_by_id($value['hotel_id']);
            $apartment=$this->mhotel->get_apartment_info_by_id($value['apartment_id']);
            $hotel['type']=$this->transform_type($apartment['type']);
            $hotel['aid']=$apartment['_id'];
            $hotel['price']=$apartment['price'];
            $hotel_array[]=$hotel;
        }
        $data['hotel']=$hotel_array;
        $this->load->view("hotel/reservation",$data);
    }

    public function reserve(){
        $hid=$_REQUEST['hid'];
        $aid=$_REQUEST['aid'];
        $user=$this->session->userdata("user");
        if(empty($_SESSION['start'])){
            $start=date("Y-m-d",time());
        }else{
            $start=$_SESSION['start'];
        }

        if(empty($_SESSION['end'])){
            $end=date("Y-m-d",time()+24*60*60);
        }else{
            $end=$_SESSION['end'];
        }
        $data=array(
            "user_id"=>$user['id'],
            "hotel_id"=>$hid,
            "apartment_id"=>$aid,
            "start_time"=>$start,
            "end_time"=>$end,
        );
        $res=$this->mhotel->get_reservation_by_params($data);
        if(!empty($res)){
            echo "<script>alert('已经预订过该房间');</script>";
            echo "<script>location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
            return;
        }

        $rid=$this->muser->reserve($data);
        if($rid>0) {
            echo "<script>alert('预订成功');</script>";
        }else{
            echo "<script>alert('预订无效');</script>";
        }
         echo "<script>location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
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

    public function del_reservation(){
        $uid=$_REQUEST['uid'];
        $hid=$_REQUEST['aid'];
        $this->muser->del_reservation($uid,$hid);
        echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }


    function getIPLoc($queryIP){
        $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip='.$queryIP;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_ENCODING ,'utf8');
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
        $location = curl_exec($ch);
        $location = json_decode($location);
        curl_close($ch);

        $loc = "";
        if($location===FALSE) return "";
        if (empty($location->desc)) {
//            $loc = $location->province.$location->city.$location->district.$location->isp;
            if(isset($location->city)){
				$loc=array($location->province,$location->city);
			}else{
				$loc=array("江苏省","徐州");
			}
        }else{
            $loc = $location->desc;
        }
        return $loc;
    }

    function getRealIp(){
        $ip=false;
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
            for ($i = 0; $i < count($ips); $i++) {
                if (!eregi ("^(10│172.16│192.168).", $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }

    public function getPlace(){
        $ip=$this->getRealIp();
//        echo $ip;
//        exit;
        $place=$this->getIPLoc($ip);
//        var_dump($place);
//        exit;
        return $place[1];
    }

    public function get_current_cityID(){
        $citys=$this->marea->get_citys();
        $city=$this->getPlace();

        $cityID=320300;
        if(!empty($city)) {
            foreach ($citys as $key => $value) {
                if (mb_strpos($value['city'], $city) !== false) {
                    $cityID = $value['cityID'];
                }
            }
        }
        return $cityID;
    }

    public function get_cityID_by_name($name){
        $citys=$this->marea->get_citys();
        $cityID=0;
        foreach ($citys as $key=>$value){
            if(mb_strpos($value['city'],$name)!==false){
                $cityID=$value['cityID'];
            }
        }
        return $cityID;
    }

    public function get_areas_by_cityID($cityID){
        $areas=$this->marea->get_areas_by_cid($cityID);
        return $areas;
    }

    public function get_citys(){
        $citys=$this->marea->get_citys();
//        var_dump($citys);
        $city=$this->getPlace();
        $areas=array();
        if(!empty($city)) {
            foreach ($citys as $key => $value) {
                if (mb_strpos($value['city'], $city) !== false) {
                    $areas = $this->marea->get_areas_by_cid($value['cityID']);
                }
            }
        }
        if(empty($areas)){
            $areas=$this->marea->get_areas_by_cid(320300);
        }
        return $areas;
    }

    public function test1(){
        $city=$this->getPlace();
        var_dump($city);
    }

}