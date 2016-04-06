<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require_once './vendor/autoload.php';
class Xmpp extends CI_Controller{

	 public function __construct(){
	 	parent::__construct();
	 }

	 public function index(){
	 	try{
	 		$XMPP = new \BirknerAlex\XMPPHP\XMPP('139.129.133.105', 5222, 'test', '123456', 'PHP');		
			$XMPP->connect();
			$XMPP->processUntil('session_start', 10);
			$XMPP->presence();
			$XMPP->message('pawnr@139.129.133.105', 'Hello, how are you?', 'chat');
			$XMPP->disconnect();
	 	}catch(XMPPHP_Exception $e){
	 		echo $e->getMessage();
	 	}
	 	var_export($XMPP);
	 }
}