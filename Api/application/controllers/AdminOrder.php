<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminOrder extends CI_Controller {
	
	private $request = array();
	
	public function __construct() 
	{
		parent::__construct();	
		$this->load->model('Order_Model', 'order');
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
	
	public function getInvoice()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='Invoice';
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
			$row = $this->order->getInvoice($id);
			$output['body']['row'] = $row;
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
	
	public function getDelivery()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='get Delivery';
		
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
			// $row = $this->order->getInvoice($id);
			$output['body']['row'] = $row;
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
			$form['inputSearchControl'] = array(
				'o_id'	=>array('type'	=>'text'),
			);
			if(!empty($form['inputSearchControl']))
			{
				foreach($form['inputSearchControl'] as $key => $value)
				{
					$$key= (isset($this->request[$key]))?$this->request[$key]:'';
				}
			}
			
			$form['selectSearchControl'] = array(
				'o_status'	=>array(
					array('text'=>'processing','value'=>'processing'),
					array('text'=>'restaurant','value'=>'restaurant'),
					array('text'=>'delivery','value'=>'delivery'),
					array('text'=>'complete','value'=>'complete'),
				)
			);
			if(!empty($form['selectSearchControl']))
			{
				foreach($form['selectSearchControl'] as $key => $value)
				{
					$$key= (isset($this->request[$key]))?$this->request[$key]:'';
				}
			}
			
			$ary['order'] = (empty($this->request['order']))?array("o_id"=>'DESC'):$this->request['order'];
		    

			$temp=array(
				'pe_id' =>$this->pe_id,
				'ad_id' =>$this->admin['ad_id'],
			);
			$action_list = $this->admin_user->getAdminListAction($temp);
			$ary['o_status'] = array(
				'value' =>$o_status,
				'logic' =>'AND',
				'operator' =>'=',
			);
			$ary['o_id'] = array(
				'value' =>$o_id,
				'logic' =>'AND',
				'operator' =>'=',
			);
			$ary['fields'] = array(
				'o_id'	=>'o.o_id',
				'total'	=>'(SELECT SUM(od2.od_price) FROM order_detail AS od2 WHERE od2.od_o_id = o.o_id) AS total',
				'itemNumber'	=>'(SELECT count(od2.od_f_id) FROM order_detail AS od2 WHERE od2.od_o_id = o.o_id) AS itemNumber',
				'status'	=>'o.o_status AS status',
				'user_phone'	=>'u.u_phone AS user_phone',
				'restaurant_name'	=>'CONCAT(r.r_name,"/",r.r_name_en) AS restaurant_name',
				'restaurant_phone'	=>'r.r_phone AS restaurant_phone',
			);
			$list = $this->order->getList($ary);
			
			
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
