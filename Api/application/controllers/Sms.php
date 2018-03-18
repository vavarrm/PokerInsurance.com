<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		$this->response_code = $this->language->load('response');
		$this->sms_language = $this->language->load('sms');
		$this->sms =$this->config->item('sms');
		$this->load->model('User_Model', 'user');
		$this->request = json_decode(trim(file_get_contents('php://input'), 'r'), true);
		
		$gitignore =array(
			
		);	
		try 
		{
			$get = $this->input->get();
			
			if(!in_array($this->uri->segment(2),$gitignore))
			{
				if(
					$get['sess']	==""
				){
					$array = array(
					'status'	=>'002'
					);
					$MyException = new MyException();
					$MyException->setParams($array);
					throw $MyException;
				}	
				
				$this->login_token = $this->myfunc->isLogin();
				if(empty($this->login_token))
				{
					$array = array(
					'status'	=>'011'
					);
					$MyException = new MyException();
					$MyException->setParams($array);
					throw $MyException;
				}
			}
		}catch(MyException $e)
		{
			$parames = $e->getParams();
			$parames['class'] = __CLASS__;
			$parames['function'] = __function__;
			$output['status']	=$parames['status'];
			$output['message'] = $this->response_code[$parames['status']]; 
			$this->myfunc->response($output);
			exit;
		}
    }
	
	
	public function phoneVerification()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='发送手机验证码';
		try 
		{
			$user = $this->user->getUserForId($this->login_token['u_id']);
			if($user['u_phone_verification'] !=0)
			{
				$array = array(
				'status'	=>'012'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			
			if($this->request['phone'] =="")
			{
				$array = array(
				'status'	=>'001'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			if(!preg_match("/^[0]{1}[0-9]{8}$/", $this->request['phone'] ))
			{
				$array = array(
				'status'	=>'013'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			$phone = "855".substr($this->request['phone'] , 1, 8);
			
			
			$row = $this->user->setUserPhoneVerification($user['u_id']);
			if($row['affected_rows'] <1)
			{
				$array = array(
				'status'	=>'000'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			
			$sms_server_response = $this->send('UserPhoneVerification', 0, $this->request['phone'],'1');
			
			$sms_server_response =  substr_count($sms_server_response, 'Success'); 
			
			if($sms_server_response ==0)
			{
				$array = array(
					'status'	=>'014'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			
			
			
			
		}catch(MyException $e)
		{
			$parames = $e->getParams();
			$parames['class'] = __CLASS__;
			$parames['function'] = __function__;
			$output['status']	=$parames['status'];
			$output['message'] = $this->response_code[$parames['status']]; 
		}
		// $this->myfunc->response($output);
	}
	
	private function send($cd,$isflash=0,$gsm, $smstex)
	{
		$get = $this->input->get();
		$url="http://client.mekongsms.com/api/postsms.aspx";
		$post = array(
			'username'	=>$this->sms['username'],
			'pass'		=>$this->sms['password'],
			'cd'		=>$cd,
			'sender'	=>"Sihalive",
			'smstext'	=>$smstex,
			'isflash'	=>$isflash,
			'gsm'		=>$gsm,
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post)); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
		$output = curl_exec($ch); 
		curl_close($ch);
		return "0 [Success]<br />0 [Success]<br />1";
	}
	
}
