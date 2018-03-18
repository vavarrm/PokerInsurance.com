<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminHome extends CI_Controller {
	
	private $request = array();
	
	public function __construct() 
	{
		parent::__construct();	
		$this->response_code = $this->language->load('admin_response');
		$this->request = json_decode(trim(file_get_contents('php://input'), 'r'), true);
		$this->get = $this->input->get();
		$this->post = $this->input->post();
    }
	
	public function index()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='後台首頁';
		$output['message'] ='成功';
		try 
		{
			
			
		}catch(MyException $e)
		{
			$parames = $e->getParams();
			$parames['class'] = __CLASS__;
			$parames['function'] = __function__;
			$output['status']	=$parames['status'];
			$output['message'] = $this->response_code[$parames['status']]; 
		}
		$this->myfunc->response($output);
	}
	
}
