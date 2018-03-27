<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminOrder extends CI_Controller {
	
	private $request = array();
	
	public function __construct() 
	{
		parent::__construct();	
		$this->load->model('TexasholdemInsuranceOrder_Model', 'order');
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
				
			);
			if(!empty($form['inputSearchControl']))
			{
				foreach($form['inputSearchControl'] as $key => $value)
				{
					$$key= (isset($this->request[$key]))?$this->request[$key]:'';
				}
			}
			
			$form['selectSearchControl'] = array(

			);
			if(!empty($form['selectSearchControl']))
			{
				foreach($form['selectSearchControl'] as $key => $value)
				{
					$$key= (isset($this->request[$key]))?$this->request[$key]:'';
				}
			}
			
			$ary['order'] = (empty($this->request['order']))?array("o.order_id"=>'DESC'):$this->request['order'];
		    
			$form['datetimeSearchControl'] = true;
			// $form['print'] =""
			
			$temp=array(
				'pe_id' =>$this->pe_id,
				'ad_id' =>$this->admin['ad_id'],
			);
			$action_list = $this->admin_user->getAdminListAction($temp);
			
			$datetime_start = (isset($this->request['datetime_start']))?$this->request['datetime_start']:'';
			$datetime_end = (isset($this->request['datetime_end']))?$this->request['datetime_end']:'';
		
			$ary['datetime_start'] = array(
				'value'	=>$datetime_start,
				'operator'	=>'>=',
			);
			$ary['datetime_end'] = array(
				'value'	=>$datetime_end,
				'operator'	=>'<=',
			);
			
			$ary['fields'] = array(
				'order_number'		=>array('field'=>'o.order_number','AS' =>'订单編號'),
				'round'				=>array('field'=>'o.round','AS' =>'下注圈'),
				'players'			=>array('field'=>'o.players','AS' =>'玩家人数'),
				'outs'				=>array('field'=>'o.outs','AS' =>'补牌数'),
				'odds'				=>array('field'=>'o.odds','AS' =>'赔率'),
				'pot'				=>array('field'=>'o.pot','AS' =>'底池'),
				'maximun'			=>array('field'=>'o.maximun','AS' =>'保金上限'),
				'buy_amount'		=>array('field'=>'o.buy_amount','AS' =>'保金'),
				'insured_amount'	=>array('field'=>'o.insured_amount','AS' =>'保额'),
				'result'			=>array('field'=>'o.result','AS' =>'结果'),
				'pay_amount'		=>array('field'=>'o.pay_amount','AS' =>'赔付额'),
				'income'			=>array('field'=>'(CASE result  WHEN "pay" THEN (0-o.pay_amount) ELSE o.buy_amount  END ) AS income ','AS' =>'收入'),
				'complete'			=>array('field'=>'o.complete','AS' =>'是否完成'),
			);
			
			$ary['subtotal'] = array(
				'buy_amount'		=>array('field'=>'ROUND(SUM(t.buy_amount),2)','AS' =>'保金总额'),
				'pay_amount'		=>array('field'=>'ROUND(SUM(t.pay_amount),2)','AS' =>'赔付总額'),
				'income'		=>array('field'=>'ROUND(SUM(t.income),2)','AS' =>'收入总額'),
			);
			$list = $this->order->getList($ary);
			
			$output['body'] = $list;
			$output['body']['fields'] = $ary['fields'] ;
			$output['body']['subtotal_fields'] = $ary['subtotal'] ;
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
