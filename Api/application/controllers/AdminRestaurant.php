<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminRestaurant extends CI_Controller {
	
	private $request = array();
	
	public function __construct() 
	{
		parent::__construct();	
		$this->load->model('Restaurant_Model', 'restaurant');
		$this->load->model('Food_Model', 'food');
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
		$output['title'] ='Restaurant List';
		$output['message'] ='insert ok';
		$back =-2;
		try 
		{
			if(
				$this->post['r_name'] =='' ||
				$this->post['r_name_en']  =='' ||
				count($this->post['operation_day'])==0 ||
				count($this->post['start'])==0 ||
				count($this->post['end'])==0
			)
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			$data = $this->restaurant->insert($this->post);
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
	
	
	public function del()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='Restaurant  Del';
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
			$data = $this->restaurant->del($id);
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
	
	public function doEdit()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='Edit Restaurant';
		$output['message'] ='upload ok';
		$back =-2;
		try 
		{
			if(
				$this->post['r_id'] =='' ||
				$this->post['r_name'] =='' ||
				$this->post['r_name_en']  =='' ||
				count($this->post['operation_day'])==0 ||
				count($this->post['start'])==0 ||
				count($this->post['end'])==0
			)
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			$data = $this->restaurant->update($this->post);
			
			if($data['affected_rows'] ==0)
			{
				$output['message'] ="nothing upload";
				$back = -1;
			}
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
	
	public function doFoodEdit()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='Edit Food';
		$output['message'] ='upload ok';
		$back =-2;
		try 
		{
			if(
				$this->post['f_id'] =='' ||
				$this->post['f_r_id'] ==''  ||
				$this->post['f_name'] ==''  ||
				$this->post['f_name_en'] ==''  ||
				$this->post['f_large_price'] ==0 
			)
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			$data = $this->restaurant->foodUpdate($this->post);
			
			if($data['affected_rows'] ==0)
			{
				$output['message'] ="nothing upload";
				$back = -1;
			}
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
	
	public function addCategory()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='Add Category Form Init';
		$output['message'] = "Add Ok";
		$back =-2;
		try 
		{
			$r_id = (!empty($this->post['r_id']))?$this->post['r_id']:'';
			if(	$r_id  =='')
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			$data = $this->restaurant->insertCategory($this->post);
			
			if($data['affected_rows'] ==0)
			{
				$output['message'] ="nothing upload";
				$back = -1;
			}
		}catch(MyException $e)
		{
			$parames = $e->getParams();
			$parames['class'] = __CLASS__;
			$parames['function'] = __function__;
			echo $parames['message'];
			$parames['message'] =  $this->response_code[$parames['status']]; 
			$output['message'] = $parames['message']; 
			$output['status'] = $parames['status']; 
			$this->myLog->error_log($parames);
		}
		
		$this->myfunc->back($back,$output['message']);
	}
	
	public function doCategoryEdit()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='Edit Category';
		$output['message'] ='upload ok';
		$back =-2;
		try 
		{
			if(
				$this->post['ca_id'] =='' ||
				$this->post['ca_name'] =='' ||
				$this->post['ca_name_en']  =='' 
			)
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			$data = $this->restaurant->updateCategory($this->post);
			
			if($data['affected_rows'] ==0)
			{
				$output['message'] ="nothing upload";
				$back = -1;
			}
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
	
	public function getCategoryRow()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='Category Row';
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
			$data = $this->restaurant->getCategoryRowById($id);
			$output['body']['row']['info'] = $data['row'];
			$output['body']['row']['form'] = array(
				'action'	=> '/'.__CLASS__.'/doCategoryEdit',
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
	
	public function delCategory()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='Category  Del';
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
			$data = $this->restaurant->delCategory($id);
			
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
	
	public function getCategoryList()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='Restaurant List';
		try 
		{
			$r_id = (!empty($this->request['id']))?$this->request['id']:'';
			if(	$r_id  =='')
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			$ary['limit'] = (isset($this->request['limit']))?$this->request['limit']:10;
			$ary['p'] = (isset($this->request['p']))?$this->request['p']:1;
			
			$form['inputSearchControl'] = array(
				'ca_name'	=>array('type'	=>'text'),
				'ca_name_en'	=>array('type'	=>'text')
			);
			$form['table_add'] = __CLASS__."/addCategory/".__CLASS__."CategoryAdd/";
			$form['table_del'] = "delCategory";
			$form['table_edit'] =  __CLASS__."/editCategory/".__CLASS__.'CategoryEdit/';
			if(!empty($form['inputSearchControl']))
			{
				foreach($form['inputSearchControl'] as $key => $value)
				{
					$$key= (isset($this->request[$key]))?$this->request[$key]:'';
				}
			}
			
			$ary['order'] = (empty($this->request['order']))?array("ca_id"=>'DESC'):$this->request['order'];
			
			$ary['ca.ca_r_id'] = array(
				'value' =>$r_id,
				'logic' =>'AND',
				'operator' =>'=',
			);
			$ary['fields'] = array(
				'ca_id'			=>'ca.ca_id',
				'ca_name'		=>'ca.ca_name',
				'ca_name_en'	=>'ca.ca_name_en',
			);
			
			$list = $this->restaurant->getCategoryList($ary);
			
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
	
	public function getRow()
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
			$row = $this->restaurant->getRowById($id);
			$output['body']['row'] = $row;
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
	
	public function addFood()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='Restaurant add food';
		$output['message'] ='add ok';
		$back =-2;
		try 
		{
			if(
				$this->post['f_r_id'] ==''  ||
				$this->post['f_name'] ==''  ||
				$this->post['f_name_en'] ==''  ||
				$this->post['f_large_price'] ==0 
			)
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			$data = $this->restaurant->insertFood($this->post);
			if($data['affected_rows'] ==0)
			{
				$output['message'] ="nothing upload";
				$back = -1;
			}
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
		// $this->myfunc->back($back,$output['message']);
	}
	
	public function addFoodInit()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='Add Food Form Init';
		try 
		{
			$r_id = (!empty($this->request['id']))?$this->request['id']:'';
			if(	$r_id  =='')
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			$ary['r_id'] =$r_id ;
			$output['body']['controller_list']['category_list'] = $this->restaurant->getRestaurantCategory($ary);
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
	
	public function delFood()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='Restaurant Food Del';
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
			$ary = array(
				'id'=>$id
			);
			$data = $this->restaurant->delFood($ary);
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
	
	public function getFoodRow()
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
			$ary['f_id'] = $id;
			$row = $this->restaurant->getFoodRowById($id);
			
			$output['body']['row'] = $row;
			$output['body']['row']['form'] = array(
				'action'	=> '/'.__CLASS__.'/doFoodEdit',
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
	
	public function getFoodList()
	{
		$output['body']=array();
		$output['status'] = '200';
		$output['title'] ='Restaurant List';
		try 
		{
			$r_id = (!empty($this->request['id']))?$this->request['id']:'';
			if(	$r_id  =='')
			{
				$array = array(
					'status'	=>'002'
				);
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			
			$ary['limit'] = (isset($this->request['limit']))?$this->request['limit']:10;
			$ary['p'] = (isset($this->request['p']))?$this->request['p']:1;
			
			$form['inputSearchControl'] = array(
				'f_name'	=>array('type'	=>'text'),
				'f_name_en'	=>array('type'	=>'text'),
			);
			$form['table_add'] = __CLASS__."/addFood/".__CLASS__."FoodAdd/";
			$form['table_del'] = "delFood";
			$form['table_edit'] =  __CLASS__."/add/".__CLASS__.'FoodEdit/';
			if(!empty($form['inputSearchControl']))
			{
				foreach($form['inputSearchControl'] as $key => $value)
				{
					$$key= (isset($this->request[$key]))?$this->request[$key]:'';
				}
			}
			
			$form['selectSearchControl'] = array(
				'f_status'	=>array(
					array('text'=>'sale_out','value'=>'sale_out'),
					array('text'=>'sale_on','value'=>'sale_on'),
					array('text'=>'sale_off','value'=>'sale_off'),
				)
			);
			if(!empty($form['selectSearchControl']))
			{
				foreach($form['selectSearchControl'] as $key => $value)
				{
					$$key= (isset($this->request[$key]))?$this->request[$key]:'';
				}
			}
			
			$ary['order'] = (empty($this->request['order']))?array("f_id"=>'DESC'):$this->request['order'];
			$ary['fields'] = array(
				'f_id'	=>'f.f_id',
				'food_name'	=>'CONCAT(f.f_name, "/", f.f_name_en) AS food_name',
				'category_name'  =>'CONCAT(ca.ca_name, "/", ca.ca_name_en) AS category_name',
				'large_price'	=>'f.f_large_price AS large_price',
				'medium_price'	=>'f.f_medium_price AS medium_price',
				'small_price'	=>'f.f_small_price AS small_price',
				'status'		=>'f.f_status AS status'
			);
			$ary['f.f_r_id'] = array(
				'value' =>$r_id,
				'logic' =>'AND',
				'operator' =>'=',
			);
			$ary['f.f_status'] = array(
				'value' =>$f_status,
				'logic' =>'AND',
				'operator' =>'=',
			);
			$list = $this->restaurant->getFoodList($ary);
			
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
				'r_name'	=>array('type'	=>'text'),
				'r_name_en'	=>array('type'	=>'text'),
			);
			$form['table_add'] = __CLASS__."/add/".__CLASS__.'Add/';
			$form['table_del'] = "del";
			$form['table_edit'] =  __CLASS__."/add/".__CLASS__.'edit/';
			if(!empty($form['inputSearchControl']))
			{
				foreach($form['inputSearchControl'] as $key => $value)
				{
					$$key= (isset($this->request[$key]))?$this->request[$key]:'';
				}
			}
			
			$ary['order'] = (empty($this->request['order']))?array("r_id"=>'DESC'):$this->request['order'];
		    
			// echo 
			$temp=array(
				'pe_id' =>$this->pe_id,
				'ad_id' =>$this->admin['ad_id'],
			);
			$action_list = $this->admin_user->getAdminListAction($temp);
			
			$ary['r_name'] = array(
				'value' =>$r_name,
				'logic' =>'AND',
				'operator' =>'like',
			);
			$ary['r_name_en'] = array(
				'value' =>$r_name_en,
				'logic' =>'AND',
				'operator' =>'like',
			);
			$ary['fields'] = array(
				'r_id'	=>'r_id',
				'r_name'	=>'r_name',
				'r_name_en'	=>'r_name_en',
			);
			$list = $this->restaurant->getList($ary);
			
			
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
