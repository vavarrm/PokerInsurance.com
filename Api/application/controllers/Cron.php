<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cron extends CI_Controller {
	
	
	public function __construct() 
	{
		parent::__construct();
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		   $myip = $_SERVER['HTTP_CLIENT_IP'];
		}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		   $myip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
		   $myip= $_SERVER['REMOTE_ADDR'];
		}
		echo $myip;
    }
	
	public function subtotal(){
       
	   echo "D";
    }
}
