<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Food extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		$this->food_language_ary = $this->language->load('food');
		$this->load->model('Food_Model', 'food');	
		$this->load->model('Order_Model', 'order');	
		
    }
	
	public function orderList()
	{
		$order_status = $this->order->getOrderStatus();
		$this->smarty->assign(array(
			'shopList'			=>$shopList,
			'foodTypeClass'		=>$foodTypeClass,
			'f_id'				=>$f_id,
			'order_status'		=>$order_status,
			'foodLanguageAry'	=>$this->food_language_ary,

		));
		$this->smarty->displayFrame(__CLASS__.'/orderlist.tpl');
	}
	
	public function index($f_id)
	{
		$this->smarty->displayFrame(__CLASS__.'/shop-single.tpl');
	}
	
	public function menu()
	{
		$foodList = $this->food->getFoodList();
		$foodClassList =$this->food->getFoodClassList();
		$this->smarty->assign(array(
			'foodList'			=>$foodList,
			'foodClassList'		=>$foodClassList,
			'foodLanguageAry'	=>$this->food_language_ary,
		));
		$this->smarty->display(__CLASS__.'/menu.tpl');
	}
	
	public function shopCar()
	{
		$this->smarty->assign(array(
			'foodLanguageAry'	=>$this->food_language_ary,
		));
		$this->smarty->display(__CLASS__.'/shopCar.tpl');
	}
	
	public function shopInfo()
	{
		
		$shopImageList = array(
			array(
			),
			array(
			),
			array(
			),
			array(
			),
		);
		
		$this->smarty->assign(array(
			'shopImageList'			=>$shopImageList
		));
		$this->smarty->display(__CLASS__.'/shopInfo.tpl');
	}


	function foodList_by_Id($userId){

    }
	
	
}
