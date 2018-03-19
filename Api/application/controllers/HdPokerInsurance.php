<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class HdPokerInsurance extends CI_Controller {
	
	private $request = array();
	
	public function __construct() 
	{
		parent::__construct();	
		$this->load->model('TexasholdemInsuranceOrder_Model', 'order');
		$this->request = json_decode(trim(file_get_contents('php://input'), 'r'), true);
		$this->get = $this->input->get();
		$this->post = $this->input->post();
		
		$gitignore =array(
			'login',
			'logout'
		);
			
		try 
		{
			// $checkAdmin = $this->myfunc->checkAdmin($gitignore);
			// if($checkAdmin !="200")
			// {
				// $array = array(
					// 'status'	=>$checkAdmin
				// );
				// $MyException = new MyException();
				// $MyException->setParams($array);
				// throw $MyException;
			// }
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
		

    }
	
	public function insert()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='insert order';
		try 
		{
			$players = (isset($this->request['players']))?intval($this->request['players']):0;
			$pot = (isset($this->request['pot']))?intval($this->request['pot']):0;
			$amount = (isset($this->request['amount']))?intval($this->request['amount']):0;
			$i_maximum = (isset($this->request['i_maximum']))?intval($this->request['i_maximum']):0;
			$percentage50 = (isset($this->request['percentage50']))?intval($this->request['percentage50']):0;
			
			// if($players )
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
