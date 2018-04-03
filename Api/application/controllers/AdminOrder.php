<?php
// phpinfo();
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
			
			$ary['order'] = (empty($this->request['order']))?array("t.order_id"=>'DESC'):$this->request['order'];
		    
			$form['datetimeSearchControl'] = true;

			
			$temp=array(
				'pe_id' =>$this->pe_id,
				'ad_id' =>$this->admin['ad_id'],
			);
			$action_list = $this->admin_user->getAdminListAction($temp);
			
			$datetime_start = (isset($this->request['datetime_start']))?$this->request['datetime_start']:'';
			$datetime_end = (isset($this->request['datetime_end']))?$this->request['datetime_end']:'';
			if($datetime_start !="")
			{
				$datetime_start = date('Y-m-d H:i' ,strtotime($datetime_start));
			}
			
			if($datetime_end !="")
			{
				$datetime_end = date('Y-m-d H:i' ,strtotime($datetime_end));
			}
		
			$ary['datetime_start'] = array(
				'value'	=>$datetime_start,
				'operator'	=>'>=',
			);
			$ary['datetime_end'] = array(
				'value'	=>$datetime_end,
				'operator'	=>'<=',
			);
			
			$ary['fields'] = array(
				'order_number'		=>array('field'=>'t.order_number','AS' =>'order_id'),
				'buy_amount'		=>array('field'=>'t.buy_amount','AS' =>'buy_amount'),
				'pay_amount'		=>array('field'=>'t.pay_amount','AS' =>'pay_amount'),
				'income'			=>array('field'=>'(CASE result  WHEN "pay" THEN (0-t.pay_amount) ELSE t.buy_amount  END ) AS income ','AS' =>'income'),
				'players'			=>array('field'=>'t.players','AS' =>'players'),
				'round'				=>array('field'=>'t.round','AS' =>'round'),
				'outs'				=>array('field'=>'t.outs','AS' =>'outs'),
				'odds'				=>array('field'=>'t.odds','AS' =>'odds'),
				'pot'				=>array('field'=>'t.pot','AS' =>'pot'),
				'maximun'			=>array('field'=>'t.maximun','AS' =>'maximun'),
				'insured_amount'	=>array('field'=>'t.insured_amount','AS' =>'insured_amount'),
				'u_name'		=>array('field'=>'u.u_name','AS' =>'add user'),
				'add_datetime'		=>array('field'=>'t.add_datetime','AS' =>'add_datetime'),
			);
			
			$ary['subtotal'] = array(
				'buy_amount'		=>array('field'=>' IFNULL(ROUND(SUM(t.buy_amount),2),0)','AS' =>'$保金总额'),
				'pay_amount'		=>array('field'=>'IFNULL(ROUND(SUM(t.pay_amount),2),0)','AS' =>'$赔付总額'),
				'income'		=>array('field'=>'IFNULL(ROUND(SUM(t.income),2),0)','AS' =>'$收入总額'),
			);
			$list = $this->order->getList($ary);
			$ary['subtotal']['total'] = array('field'=>'','AS' =>'總筆數');
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
	
	public function checkOut()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='CheckOut';
		try 
		{
			$total  = $this->order->checkOut();
			if($total>0 && $_SERVER['CI_ENV']!="development")
			{
				$row= $this->order->getCheckOutByDay();
				$smstex =sprintf("Insurance %s buy %s pay %s Income  %s Total %s",$row['checkout_date'], $row['buy_amount'],$row['pay_amount'], $row['income'], $row['total'] );
				$gsm="85516995372;85512321402;85517684220;85511923080";
				$url="http://client.mekongsms.com/api/postsms.aspx";
				$post = array(
					'username'	=>'tsai_sms@smartmkn',
					'pass'		=>md5('3xxkdkj@c'),
					'cd'		=>'Cust001',
					'sender'	=>"Sihalive",
					'smstext'	=>$smstex,
					'isflash'	=>0,
					'gsm'		=>$gsm,
				);
				$ch = curl_init();
				@curl_setopt($ch, CURLOPT_URL, $url);
				@curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
				@curl_setopt($ch, CURLOPT_POST, true);
				@curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post)); 
				@curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
				$output = @curl_exec($ch); 
				@curl_close($ch);
			}
			$output['message']='checkOut total:'.$total;
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
	
	public function dayReport($ary=array())
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='dayReport';
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
			
			for($i =1 ;$i<=12;$i++)
			{
				$m = sprintf('%02d', $i);
				if(date('m') == $m && $this->request['mounth']=="")
				{
					$default = $m;
					$this->request['mounth'] = $default ;
				}elseif($this->request['mounth']!="")
				{
					$default = $this->request['mounth'];
				}
				$mounth_ary[] = array('text' =>$m, 'value'=>$m ,'default'=>$default);
			}
			
			$form['selectSearchControl'] = array(
				'mounth'	=>$mounth_ary
			);
		
			if(!empty($form['selectSearchControl']))
			{
				foreach($form['selectSearchControl'] as $key => $value)
				{
					$$key= (isset($this->request[$key]))?$this->request[$key]:'';
				}
			}
			
		
			
			
			
			$ary['order'] = (empty($this->request['order']))?array("t.checkout_date"=>'DESC'):$this->request['order'];
		    
			$form['dateSearchControl'] = true;

			
			$temp=array(
				'pe_id' =>$this->pe_id,
				'ad_id' =>$this->admin['ad_id'],
			);
			$button_list = $this->admin_user->getAdminListButton($temp);
			
			$datetime_start = (isset($this->request['datetime_start']))?$this->request['datetime_start']:'';
			$datetime_end = (isset($this->request['datetime_end']))?$this->request['datetime_end']:'';
			if($datetime_start !="")
			{
				$datetime_start = date('Y-m-d' ,strtotime($datetime_start));
			}
			
			if($datetime_end !="")
			{
				$datetime_end = date('Y-m-d' ,strtotime($datetime_end));
			}
		
			$ary['datetime_start'] = array(
				'value'	=>$datetime_start,
				'operator'	=>'>=',
				'field'		=>'checkout_date',
				'format'	=>'%Y-%m-%d'
			);
			$ary['datetime_end'] = array(
				'value'	=>$datetime_end,
				'operator'	=>'<=',
				'field'		=>'checkout_date',
				'format'	=>'%Y-%m-%d'
			);
			
		
			
			$ary['mounth'] = array(
				'value'	=>$mounth,
				'operator'	=>'=',
				'field'		=>'checkout_date',
			);
			
			$ary['checkout_date'] = array(
				'value'	=>'NULL',
				'operator'	=>'IS NOT',
				'logic'		=>'AND'
			);
			
			$ary['fields'] = array(
				'checkout_date'		=>array('field'=>'t.checkout_date','AS' =>'checkout_date'),
				'total'		=>array('field'=>'COUNT(t.order_id) AS total ','AS' =>'total'),
				'buy_amount'		=>array('field'=>'ROUND(SUM(t.buy_amount),2) AS buy_amount ','AS' =>'buy_amount'),
				'pay_amount'		=>array('field'=>'ROUND(SUM(t.pay_amount),2) AS pay_amount','AS' =>'pay_amount'),
				'income'			=>array('field'=>'ROUND(SUM((CASE result  WHEN "pay" THEN (0-t.pay_amount) ELSE t.buy_amount  END )),2) AS income ','AS' =>'income'),
			);
			
			$ary['group_by'] = "t.checkout_date";
			
			$ary['subtotal'] = array(
				'buy_amount'		=>array('field'=>' IFNULL(ROUND(SUM(t.buy_amount),2),0)','AS' =>'$保金总额'),
				'pay_amount'		=>array('field'=>'IFNULL(ROUND(SUM(t.pay_amount),2),0)','AS' =>'$赔付总額'),
				'income'		=>array('field'=>'IFNULL(ROUND(SUM(t.income),2),0)','AS' =>'$收入总額'),
				'order_total'		=>array('field'=>'IFNULL(SUM(t.total),0)','AS' =>'order total'),
			);
			$list = $this->order->getDayReport($ary);
			
			$output['body'] = $list;
			$output['body']['fields'] = $ary['fields'] ;
			$output['body']['subtotal_fields'] = $ary['subtotal'] ;
			$output['body']['form'] =$form;
			$output['body']['button_list'] =$button_list;
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
	
	public function getCheckOutList($ary=array())
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='CheckOut List';
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
			
			$ary['order'] = (empty($this->request['order']))?array("t.order_id"=>'ASC'):$this->request['order'];
		    
			$form['datetimeSearchControl'] = true;

			
			$temp=array(
				'pe_id' =>$this->pe_id,
				'ad_id' =>$this->admin['ad_id'],
			);
			$button_list = $this->admin_user->getAdminListButton($temp);
			
			$datetime_start = (isset($this->request['datetime_start']))?$this->request['datetime_start']:'';
			$datetime_end = (isset($this->request['datetime_end']))?$this->request['datetime_end']:'';
			if($datetime_start !="")
			{
				$datetime_start = date('Y-m-d H:i' ,strtotime($datetime_start));
			}
			
			if($datetime_end !="")
			{
				$datetime_end = date('Y-m-d H:i' ,strtotime($datetime_end));
			}
		
			$ary['datetime_start'] = array(
				'value'	=>$datetime_start,
				'operator'	=>'>=',
			);
			$ary['datetime_end'] = array(
				'value'	=>$datetime_end,
				'operator'	=>'<=',
			);
			
			$ary['checkout_date'] = array(
				'value'	=>'NULL',
				'operator'	=>'IS',
				'logic'		=>'AND'
			);
			
			$ary['fields'] = array(
				'order_number'		=>array('field'=>'t.order_number','AS' =>'order_id'),
				'buy_amount'		=>array('field'=>'t.buy_amount','AS' =>'buy_amount'),
				'pay_amount'		=>array('field'=>'t.pay_amount','AS' =>'pay_amount'),
				'income'			=>array('field'=>'(CASE result  WHEN "pay" THEN (0-t.pay_amount) ELSE t.buy_amount  END ) AS income ','AS' =>'income'),
				'players'			=>array('field'=>'t.players','AS' =>'players'),
				'round'				=>array('field'=>'t.round','AS' =>'round'),
				'outs'				=>array('field'=>'t.outs','AS' =>'outs'),
				'odds'				=>array('field'=>'t.odds','AS' =>'odds'),
				'pot'				=>array('field'=>'t.pot','AS' =>'pot'),
				'maximun'			=>array('field'=>'t.maximun','AS' =>'maximun'),
				'insured_amount'	=>array('field'=>'t.insured_amount','AS' =>'insured_amount'),
				'u_name'		=>array('field'=>'u.u_name','AS' =>'add user'),
				'add_datetime'		=>array('field'=>'t.add_datetime','AS' =>'add_datetime'),
			);
			
			$ary['subtotal'] = array(
				'buy_amount'		=>array('field'=>' IFNULL(ROUND(SUM(t.buy_amount),2),0)','AS' =>'$保金总额'),
				'pay_amount'		=>array('field'=>'IFNULL(ROUND(SUM(t.pay_amount),2),0)','AS' =>'$赔付总額'),
				'income'		=>array('field'=>'IFNULL(ROUND(SUM(t.income),2),0)','AS' =>'$收入总額'),
			);
			
			$list = $this->order->getList($ary);
			$ary['subtotal']['total'] = array('field'=>'','AS' =>'總筆數');
			$output['body'] = $list;
			$output['body']['fields'] = $ary['fields'] ;
			$output['body']['subtotal_fields'] = $ary['subtotal'] ;
			$output['body']['form'] =$form;
			$output['body']['button_list'] =$button_list;
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
