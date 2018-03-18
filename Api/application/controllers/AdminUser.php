<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminUser extends CI_Controller {
	
	private $request = array();
	
	public function __construct() 
	{
		parent::__construct();	
		$this->load->model('AdminUser_Model', 'admin_user');
		$this->response_code = $this->language->load('admin_response');
		$this->request = json_decode(trim(file_get_contents('php://input'), 'r'), true);
		$this->get = $this->input->get();
		$this->post = $this->input->post();
		$this->pe_id = (!empty($this->get['pe_id']))?$this->get['pe_id']:'';
		
		$gitignore =array(

		);
			
		try 
		{
			$checkAdmin = $this->myfunc->checkAdmin($gitignore);
			if($checkAdmin !="200")
			{
				$array = array(
					'status'	=>$checkAdmin
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
			$parames['message'] =  $this->response_code[$parames['status']]; 
			$output['message'] = $parames['message']; 
			$output['status'] = $parames['status']; 
			$this->myLog->error_log($parames);
			$this->myfunc->response($output);
			exit;
		}
		
		$this->admin = $this->myfunc->getAdminUser($this->get['sess']);
    }
	
	public function add()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='add admin user';
		$output['message'] ='insert ok';
		$back =-2;
		try 
		{
			if(
				$this->post['ad_account'] =='' ||
				$this->post['ad_passwd']  =='' ||
				$this->post['ad_ar_id'] ==""
			)
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			if(!preg_match('/^[a-z0-9]{6,12}$/', $this->post['ad_account'])){
				$array = array(
					'status'	=>'011'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			if(strlen($this->post['ad_passwd']) <6 ||  strlen($this->post['ad_passwd']) >12 ){
				$array = array(
					'status'	=>'012'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			if( $this->post['ad_passwd'] != $this->post['ad_passwd_confirm']){
				$array = array(
					'status'	=>'014'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			if(intval($this->post['ad_ar_id']) ==1)
			{
				$array = array(
					'status'	=>'013'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			$data = $this->admin_user->insert($this->post);
			// if($data
		}catch(MyException $e)
		{
			$back++;
			$parames = $e->getParams();
			$parames['class'] = __CLASS__;
			$parames['function'] = __function__;
			$parames['message'] =  $this->response_code[$parames['status']]; 
			$output['message'] = $parames['message']; 
			$output['status'] = $parames['status']; 
			$this->myLog->error_log($parames);
		}
		
		$this->myfunc->back($back,$output['message']);
	}
	
	public function adminAddForm()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='admin Add Form';
		try 
		{
			$output['body']['controller_list']['role_list'] = $this->admin_user->getRoleList();
		}catch(MyException $e)
		{
			$parames = $e->getParams();
			$parames['class'] = __CLASS__;
			$parames['function'] = __function__;
			$parames['message'] =  $this->response_code[$parames['status']]; 
			$output['message'] = $parames['message']; 
			$output['status'] = $parames['status']; 
			$this->myLog->error_log($parames);
		}
		
		$this->myfunc->response($output);
	}
	
	public function del()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='admin user  Del';
		try 
		{
	
			$id= (isset($this->request['id']))?$this->request['id']:'';
			if($id=="")
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			$data = $this->admin_user->del(array('ad_id' =>$id));
			// if($data
		}catch(MyException $e)
		{
			$parames = $e->getParams();
			$parames['class'] = __CLASS__;
			$parames['function'] = __function__;
			$parames['message'] =  $this->response_code[$parames['status']]; 
			$output['message'] = $parames['message']; 
			$output['status'] = $parames['status']; 
			$this->myLog->error_log($parames);
		}
		$this->myfunc->response($output);
	}
	
	public  function getRow()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='Restaurant Row';
		try 
		{
			$id= (isset($this->request['id']))?$this->request['id']:'';
			if($id=="")
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			$data = $this->admin_user->getUserById($id);
			$output['body']['row']['info'] = $data['row'];
			$output['body']['row']['form'] = array(
				'action'	=> '/'.__CLASS__.'/doEdit',
				'pe_id'		=>$this->get['pe_id']
			);
		}catch(MyException $e)
		{
			$parames = $e->getParams();
			$parames['class'] = __CLASS__;
			$parames['function'] = __function__;
			$parames['message'] =  $this->response_code[$parames['status']]; 
			$output['message'] = $parames['message']; 
			$output['status'] = $parames['status']; 
			$this->myLog->error_log($parames);
		}
		
		$this->myfunc->response($output);
	}
	
	
	public function doLock()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='do Lock ';
		$output['message'] ='set ok';
		$back =-2;
		try 
		{
			if(
				$this->post['ad_id'] ==""
			)
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			
			$data = $this->admin_user->setLock($this->post);
			
		}catch(MyException $e)
		{
			$back++;
			$parames = $e->getParams();
			$parames['class'] = __CLASS__;
			$parames['function'] = __function__;
			$parames['message'] =  $this->response_code[$parames['status']]; 
			$output['message'] = $parames['message']; 
			$output['status'] = $parames['status']; 
			$this->myLog->error_log($parames);
		}
		
		$this->myfunc->back($back,$output['message']);
	}
	
	public function lockForm()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='lock Form';
		
		try 
		{
			$id= (isset($this->request['id']))?$this->request['id']:'';
			if($id=="")
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			// echo $id;
			$data = $this->admin_user->getUserById($id);
			$output['body']['row']['info'] = $data['row'];
			$output['body']['row']['form'] = array(
				'action'	=> '/'.__CLASS__.'/doLock',
				'pe_id'		=>$this->get['pe_id']
			);
		}catch(MyException $e)
		{
			$parames = $e->getParams();
			$parames['class'] = __CLASS__;
			$parames['function'] = __function__;
			$parames['message'] =  $this->response_code[$parames['status']]; 
			$output['message'] = $parames['message']; 
			$output['status'] = $parames['status']; 
			$this->myLog->error_log($parames);
		}
		
		$this->myfunc->response($output);
	}
	
	public function doResetPassword()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='do reset password ';
		$output['message'] ='set ok';
		$back =-2;
		try 
		{
			if(
				$this->post['ad_passwd']  =='' ||
				$this->post['ad_id'] ==""
			)
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			
			if(strlen($this->post['ad_passwd']) <6 ||  strlen($this->post['ad_passwd']) >12 ){
				$array = array(
					'status'	=>'012'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			if( $this->post['ad_passwd'] != $this->post['ad_passwd_confirm']){
				$array = array(
					'status'	=>'014'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			

			
			$data = $this->admin_user->resetPassword($this->post);
			
		}catch(MyException $e)
		{
			$back++;
			$parames = $e->getParams();
			$parames['class'] = __CLASS__;
			$parames['function'] = __function__;
			$parames['message'] =  $this->response_code[$parames['status']]; 
			$output['message'] = $parames['message']; 
			$output['status'] = $parames['status']; 
			$this->myLog->error_log($parames);
		}
		
		$this->myfunc->back($back,$output['message']);
	}
	
	public function resetPasswordForm()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='reset Password Form';
		
		try 
		{
			$id= (isset($this->request['id']))?$this->request['id']:'';
			if($id=="")
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			// echo $id;
			$data = $this->admin_user->getUserById($id);
			$output['body']['row']['info'] = $data['row'];
			$output['body']['row']['form'] = array(
				'action'	=> '/'.__CLASS__.'/doResetPassword',
				'pe_id'		=>$this->get['pe_id']
			);
		}catch(MyException $e)
		{
			$parames = $e->getParams();
			$parames['class'] = __CLASS__;
			$parames['function'] = __function__;
			$parames['message'] =  $this->response_code[$parames['status']]; 
			$output['message'] = $parames['message']; 
			$output['status'] = $parames['status']; 
			$this->myLog->error_log($parames);
		}
		
		$this->myfunc->response($output);
	}
	
	public function getList($ary=array())
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='Restaurant List';
		try 
		{
			$ary['limit'] = (isset($this->request['limit']))?$this->request['limit']:10;
			$ary['p'] = (isset($this->request['p']))?$this->request['p']:1;
			$form['table_add'] = __CLASS__."/add/".__CLASS__.'Add/';
			$form['table_del'] = "del";
			$form['inputSearchControl'] = array(
				'account'	=>array('type'	=>'text'),
			);
			if(!empty($form['inputSearchControl']))
			{
				foreach($form['inputSearchControl'] as $key => $value)
				{
					$$key= (isset($this->request[$key]))?$this->request[$key]:'';
				}
			}
			
			$roleList = $this->admin_user->getRoleList();
			$form['selectSearchControl'] = array(
				'role'	=>$roleList ,
				'status'	=>array(
					array('value' =>'unlock' ,'text'=>'unlock'),
					array('value' =>'onlock' ,'text'=>'onlock'),
				)
			);
			if(!empty($form['selectSearchControl']))
			{
				foreach($form['selectSearchControl'] as $key => $value)
				{
					$$key= (isset($this->request[$key]))?$this->request[$key]:'';
				}
			}
			
			$ary['order'] = (empty($this->request['order']))?array("ad_id"=>'DESC'):$this->request['order'];
		    

			$temp=array(
				'pe_id' =>$this->pe_id,
				'ad_id' =>$this->admin['ad_id'],
			);
			$action_list = $this->admin_user->getAdminListAction($temp);
			$ary['au.ad_ar_id'] = array(
				'value' =>'1',
				'logic' =>'AND',
				'operator' =>'<>',
			);
			$ary['au.ad_account'] = array(
				'value' =>$account,
				'logic' =>'AND',
				'operator' =>'=',
			);
			$ary['au.ad_ar_id'] = array(
				'value' =>$role,
				'logic' =>'AND',
				'operator' =>'=',
			);
			$ary['au.ad_status'] = array(
				'value' =>$status,
				'logic' =>'AND',
				'operator' =>'=',
			);
			$ary['fields'] = array(
				'account'		=>'au.ad_account AS account',
				'role'			=>'ar.ar_name AS role',
				'ad_status'		=>'au.ad_status AS 	ad_status',
			);
			$list = $this->admin_user->getList($ary);
			
			
			$output['body'] = $list;
			$output['body']['fields'] = $ary['fields'] ;
			$output['body']['form'] =$form;
			$output['body']['action_list'] =$action_list;
		}catch(MyException $e)
		{
			$parames = $e->getParams();
			$parames['class'] = __CLASS__;
			$parames['function'] = __function__;
			$parames['message'] =  $this->response_code[$parames['status']]; 
			$output['message'] = $parames['message']; 
			$output['status'] = $parames['status']; 
			$this->myLog->error_log($parames);
		}
		
		$this->myfunc->response($output);
	}
}
