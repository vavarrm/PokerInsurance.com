<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller {
	
	private $request = array();
	
	public function __construct() 
	{
		parent::__construct();	
		
		$this->request = json_decode(trim(file_get_contents('php://input'), 'r'), true);
		$this->load->model('Food_Model', 'food');
		$this->load->model('User_Model', 'user');
		$this->load->model('Order_Model', 'order');
		$this->load->model('Position_Model', 'position');
		$this->js = $this->language->load('js');
		$this->response_code = $this->language->load('response');
		$this->sms =$this->config->item('sms');

		$this->load->model('Restaurant_Model','Restaurant');
        $this->load->model('User_Position_Model', 'u_position');
    }

	
	public function sendCheckPhoneSMS()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='传送手機驗證訊息';
		try 
		{
			
		}catch(Exception $e)
		{
			$output['status'] = '000';
			$output['message'] = $e->getMessage();
		}
		
		$this->response($output);
	}
	
	public function getSetList()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='getSetList';
		try 
		{
			$get = $this->input->get();
			$f_id = $get['f_id'];
			$temp = $this->food->getSetList($f_id);
			if(!empty($temp))
			{
				foreach($temp as $value)
				{
					$rows['set']['ca_name']  =  $value['ca_name'];
					$rows['set']['f_id']  =  $value['f_id'];
					$rows['set']['setName']  =  $value['setName'];
					$rows['set']['f_large_price']  =  $value['f_large_price'];
					$rows['set']['f_id']  =  $value['f_id'];
					$rows['select'][$value['fs_group_id']]['data'][] =  $value;
					$rows['select'][$value['fs_group_id']]['ca_name'] =  $value['ca_name'];
				}
			}
			$output['body']['rows'] = $rows;
		}catch(Exception $e)
		{
			$output['status'] = '000';
			$output['message'] = $e->getMessage();
		}
		
		$this->response($output);
	}
	
	public function getSMDBalance ()
	{
		$url="http://client.mekongsms.com/api/postcheckbalance.aspx";
		$post = array(
			'username'	=>$this->sms['username'],
			'pass'		=>$this->sms['password'],
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post)); 
		$output = curl_exec($ch); 
		curl_close($ch);
		echo $output;
	}
	
	public function sendSMS()
	{
		$get = $this->input->get();
		$url="http://client.mekongsms.com/api/postsms.aspx";
		$post = array(
			'username'	=>$this->sms['username'],
			'pass'		=>$this->sms['password'],
			'cd'		=>"Cust001",
			'sender'	=>"Sihalive",
			'smstext'	=>$get['smstext'],
			'isflash'	=>0,
			'gsm'		=>$get['gsm'],
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post)); 
		$output = curl_exec($ch); 
		curl_close($ch);
		echo $output;
	}
	
	public function getOrderList()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='set Profile';
		try 
		{
			$get = $this->input->get();
			$sess= $get ['sess'];
			$urlRsaRandomKey = 	$get["sess"];
			$encrypt_user_data =$_SESSION['encrypt_user_data'];
			$user_data = $this->decryptUser($urlRsaRandomKey, $encrypt_user_data);
			if(!$user_data)
			{
				throw new Exception("get user error");
			}
			$get = $user_data['u_id'];
			$output['body']['data']['orders'] = $this->order->getOrderList($get);
		}catch(Exception $e)
		{
			$output['status'] = '000';
			$output['message'] = $e->getMessage();
		}
		
		$this->response($output);
	}

    public function getUserAddress()
    {
        $output['body']=array();
        $output['status'] = '200';
        $output['title'] ='set Profile';
        try
        {
            $get = $this->input->get();
            $sess= $get ['sess'];
            $urlRsaRandomKey = 	$get["sess"];
            $encrypt_user_data =$_SESSION['encrypt_user_data'];
            $user_data = $this->decryptUser($urlRsaRandomKey, $encrypt_user_data);
            if(!$user_data)
            {
                throw new Exception("get user error");
            }
            $get = $user_data['u_id'];

            $output['body']['data']['book_address'] = $this->u_position->My_loac($get);

        }catch(Exception $e)
        {
            $output['status'] = '000';
            $output['message'] = $e->getMessage();
        }

        $this->response($output);
    }

	
	public function setProfile()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='set Profile';
		try 
		{
			$get = $this->input->get();
			$sess= $get ['sess'];
			$urlRsaRandomKey = 	$get["sess"];
			$encrypt_user_data =$_SESSION['encrypt_user_data'];
			$user_data = $this->decryptUser($urlRsaRandomKey, $encrypt_user_data);
			if(!$user_data)
			{
				throw new Exception("get user error");
			}
			$output['body']['affected_rows'] = $this->user->setsetProfile($this->request, $user_data['u_id']);
			
			
		}catch(Exception $e)
		{
			$output['status'] = '000';
			$output['message'] = $e->getMessage();
		}
		
		$this->response($output);
	}



	
	public function isUserAccountExist()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='is User Exist';
		try 
		{
			$get = $this->input->get();
			$u_account = $get ['u_account'];
			$isUserExist  = $this->user->isUserAccountExist($u_account );
			$output['body']['data']['is_user_exist'] =$isUserExist['total'] ;
			
		}catch(MyException $e)
		{
			$parames = $e->getParams();
			$parames['class'] = __CLASS__;
			$parames['function'] = __function__;
			$output['status']	=$parames['status'];
			$output['message'] = $this->response_code[$parames['status']]; 
		}
		
		$this->response($output);
	}
	
	public function isEmailExist()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='is Email Exist';
		try 
		{
			$get = $this->input->get();
			$u_email = $get ['u_email'];
			$isUserExist  = $this->user->isEmailExist($u_email);
			$output['body']['data']['is_user_exist'] =$isUserExist['total'] ;
			
		}catch(Exception $e)
		{
			$output['status'] = '000';
			$output['message'] = $e->getMessage();
		}
		
		$this->response($output);
	}
	
	public function test()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='test';
		$get= $this->input->get();
		try 
		{
			
		}catch(Exception $e)
		{
			$output['status'] = '000';
			$output['message'] = $e->getMessage();
		}
		
		$this->response($output);
	}
	
	public function getDeliveryPosition()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='get Delivery Position';
		try 
		{
			$positions = $this->position->getDeliveryPosition();

			var_dump($positions);
			exit();
			$output['body']['data']['positions'] =$positions ;
			
		}catch(Exception $e)
		{
			$output['status'] = '000';
			$output['message'] = $e->getMessage();
		}
		
		$this->response($output);
	}
	
	public function fbLogin()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='FB登入';
		try 
		{
			if(empty($this->request))
			{
				$output['status'] ='000';
				throw new Exception("request is empty");
			}
			
			$response =  $this->fb->get('/me?fields=id,name,email', $this->request['accessToken']);
			if(empty($response))
			{
				throw new Exception("fb response empty");
			}
			$fbuser = $response->getGraphUser();
			$user = $this->user->getUserForFBId($fbuser['id']);
			
			if(empty($user))
			{
				throw new Exception("user is no exist");
			}
			
			$sess = $this->doLogin($user);
			$output['body']['sess'] = $sess;
			
		}catch(Exception $e)
		{
			$output['status'] = '000';
			$output['message'] = $e->getMessage();
		}
		
		$this->response($output);
	}
	
	public function fbReg()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='FB注册';
		try 
		{
			if(empty($this->request))
			{
				$array = array(
					'status'	=>'001'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			$response =  $this->fb->get('/me?fields=id,name,email', $this->request['accessToken']);
			if(empty($response))
			{
				$array = array(
					'status'	=>'008'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			$fbuser = $response->getGraphUser();
			$user = $this->user->getUserForFBId($fbuser['id']);
			if(!empty($user))
			{
				$array = array(
					'status'	=>'005'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			
			$insert = array(
				'u_account'		=>NULL,
				'u_passwd'		=>NULL,
				'u_email'		=>NULL,
				'fb_u_id'		=>$fbuser['id'],
				'fb_name'		=>$fbuser['name']
			);
			$row = $this->user->insert($insert);
			if($row['affected_rows'] <0)
			{
				$array = array(
					'status'	=>'009'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			$user = $this->user->getUserForFBId($fbuser['id']);
			$sess = $this->doLogin($user);
			$output['body']['sess'] = $sess;
			
		}catch(MyException $e)
		{
			$parames = $e->getParams();
			$parames['class'] = __CLASS__;
			$parames['function'] = __function__;
			$output['status']	=$parames['status'];
			$output['message'] = $this->response_code[$parames['status']]; 
		}
		
		$this->response($output);
	}
	
	public function logout()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='登出';
		try 
		{
			session_destroy();
		}catch(Exception $e)
		{
			$output['message'] = $e->getMessage();
		}
		
		$this->response($output);
	}
	
	private function doLogin($ary)
	{
		$row = $this->user->getUserForLogin($ary);
		if(empty($row))
		{
			$array = array(
				'status'	=>'006'
			);
			$MyException = new MyException();
			$MyException->setParams($array);
			throw $MyException;
		}elseif(md5($ary['u_passwd']) != $row['u_passwd'] && $ary['logintype'] =='account'){
			$output['status'] ='002';
			$array = array(
				'status'	=>'007'
			);
			$MyException = new MyException();
			$MyException->setParams($array);
			throw $MyException;
		}else{
				
			$user = array(
				'u_name'  =>$row['u_name'],
				'u_email' =>$row['u_email'],
				'u_id' =>$row['u_id'],
				'fb_u_id' =>$row['fb_u_id'],
			);
			$randomKey = $this->token->getRandomKey();
			$rsaRandomKey = $this->token->publicEncrypt($randomKey);
			$data = array(
				'u_name'  =>$row['u_name'],
				'u_email' =>$row['u_email'],
				'u_id' =>$row['u_id'],
				'fb_u_id' =>$row['fb_u_id'],
			);
			$encrypt_user_data = $this->token->AesEncrypt(serialize($data), $randomKey);
			$_SESSION['encrypt_user_data'] = $encrypt_user_data;
			$urlRsaRandomKey = urlencode($rsaRandomKey) ;
			return $urlRsaRandomKey ;
		}
	
	}
	
	private function decryptUser($rsa_randomKey, $encrypt_user_data)
	{
		$randomKey =  $this->token->privateDecrypt($rsa_randomKey);
		$encrypt_user_data = $_SESSION['encrypt_user_data'] ;
		$decrypt_user_data = $this->token->AesDecrypt($encrypt_user_data , $randomKey );
		$user_data = unserialize($decrypt_user_data);
		return $user_data;
	}
	
	public function getUser($urlRsaRandomKey='')
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='取得登入訊息';
		try 
		{	$get = $this->input->get();
			if(isset($get['sess']))
			{
				$urlRsaRandomKey =$get['sess'];
			}
			$encrypt_user_data = $_SESSION['encrypt_user_data'] ;
			$decrypt_user_data= $this->decryptUser($urlRsaRandomKey, $encrypt_user_data);
			if(!$decrypt_user_data)
			{
				$output['status'] ='000';
				throw new Exception("get user error");
			}
			$user_data = $this->user->getUserForId($decrypt_user_data['u_id']);
			$output['body']['user_data'] =$user_data  ;
		}catch(Exception $e)
		{
			$output['status'] = '000';
			$output['message'] = $e->getMessage();
		}
		
		$this->response($output);
	}
	
	public function login()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='登入';
		try 
		{
			if(empty($this->request))
			{
				$array = array(
					'status'	=>'001'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			if(
				empty($this->request['account']) ||
				empty($this->request['passwd']) 
			)
			{
				$array = array(
					'status'	=>'001'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			

			$ary['u_account'] = $this->request['account'];
			$ary['u_passwd'] = $this->request['passwd'];
			$ary['logintype'] = $this->request['logintype'];
			$sess = $this->doLogin($ary);
			$output['body']['sess'] = $sess;
		}catch(MyException $e)
		{
			$parames = $e->getParams();
			$parames['class'] = __CLASS__;
			$parames['function'] = __function__;
			$output['status']	=$parames['status'];
			$output['message'] = $this->response_code[$parames['status']]; 
		}
		
		$this->response($output);
	}
	
	public function registration()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='註冊';
		try 
		{
			if(empty($this->request))
			{
				$array = array(
					'status'	=>'001'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
		
			if(empty($this->request['u_account']))
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
		
			if(!preg_match('/^[a-z0-9]{6,12}$/', $this->request['u_account'])){
				$array = array(
					'status'	=>'003'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			if(empty($this->request['u_passwd']))
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			if(!preg_match('/^[a-z0-9]{6,12}$/', $this->request['u_passwd'])){
				$array = array(
					'status'	=>'010'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			
			
			if(empty($this->request['u_passwd_confirm']))
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			if($this->request['u_passwd'] != $this->request['u_passwd_confirm'] )
			{
				$array = array(
					'status'	=>'004'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
		
			
			$isUserExist = $this->user->isAccountExist($this->request);
			if($isUserExist >0)
			{
				$array = array(
					'status'	=>'005'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}

			$row = $this->user->insert($this->request);
			if($row['affected_rows'] <0)
			{
				$array = array(
					'status'	=>'009'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;;
			}
			$output['message'] =$this->response_code['201'];
			$sess = $this->doLogin($this->request);
			$output['body']['sess'] = $sess;
			
		}catch(MyException $e)
		{
			$parames = $e->getParams();
			$parames['class'] = __CLASS__;
			$parames['function'] = __function__;
			$output['status']	=$parames['status'];
			$output['message'] = $this->response_code[$parames['status']]; 
		}
		
		$this->response($output);
	}



	public function checkout()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='结帐';
		try
		{

			if(empty($this->request))
			{
				throw new Exception("request is empty");
			}

			$user  =$_SESSION['encrypt_user_data'];

			if(empty($user))
			{
				throw new Exception("user no login");
			}
            $get = $this->input->get();


            if(isset($get['sess']))
            {
                $urlRsaRandomKey =$get['sess'];
            }
            $encrypt_user_data = $user ;
            $decrypt_user_data= $this->decryptUser($urlRsaRandomKey, $encrypt_user_data);
			if(!$decrypt_user_data)
			{
				throw new Exception("get user error");
			}
			$this->request['u_id'] = $decrypt_user_data['u_id'];


			$this->food->inserdOrder($this->request);
			//$Inv=$this->food->get_InvById($this->request['u_id']);

			$ary =array(
				'action'	=>'order_alert'
			);
			$output['body']['order_alert'] = $this->socketIO->push($ary);

		}catch(Exception $e)
		{
			$output['status'] ='000';
			$output['message'] = $e->getMessage();
		}
		$this->response($output);
	}


	public function getProduct()
	{
		$get= $this->input->get();
		
		$status = 100;
		$body =array();
		$output['title'] ='取得产品';
		try 
		{
			$output['body']['data'] = $this->food->getProductForFid($get['f_id']);
			$output['status'] = $status ;
		}catch(Exception $e)
		{
			$output['status'] ='000';
			$output['message'] = $e->getMessage();
		}
		
		$this->response($output);
		
	}
	
	/*
	取得菜單分類
	*/
	public function getCategory()
	{
		$status = 100;
		$body =array();
		$title ='取得菜單分類';
		try 
		{
			$output['body']['data'] = $this->food->getCategory();
			$output['status'] = $status ;;
		}catch(Exception $e)
		{
			$output['status'] ='000';
			$output['message'] = $e->getMessage();
		}
		
		$this->response($output);
	}
	
	private function response($output)
	{
		
		$output = array(
			'body'		=>$output['body'],
			'title'		=>$output['title'],
			'status'	=>$output['status'],
			'message'	=>$output['message']
		);
		
		header('Content-Type: application/json');
		echo json_encode($output , true);
	}
}
