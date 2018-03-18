<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShopCart extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		$this->shopcart_language_ary = $this->language->load('shopcart');
        $this->load->model("User_Position_Model",'position');
        $this->load->model('Position_Model', 'adds');
        $this->mainpage_language_ary = $this->language->load('mainpage');
    }
	
	public function index()
	{
		$this->order();
	}
	
	public function order()
	{
        $location = $this->adds->getDeliveryPosition();
        $user_location=$this->position->listLocation('27');
		$this->smarty->assign(array(
		    'user_location'     =>$user_location,
            'location'		=>$location,
            'mainpage_language_ary'	=>$this->mainpage_language_ary,
			'shopLanguageAry'	=>$this->shopcart_language_ary
		));
		$this->smarty->displayFrame(__CLASS__.'/shop-cart.tpl');
	}

	public  function test()
    {
        $this->smarty->assign(array(
            'myname'	=>'tryion',
        ));
        $this->smarty->display(__CLASS__.'/test.tpl');
    }
	
}
