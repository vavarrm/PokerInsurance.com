<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainPage extends CI_Controller {
	
	public function __construct() 
	{
	   // phpinfo();
		parent::__construct();
		$this->mainpage_language_ary = $this->language->load('mainpage');
        $this->load->model('Restaurant_Model', 'restaurant');

    }
	
	
	public function privacy()
	{
		$this->smarty->displayFrame(__CLASS__.'/privacy.tpl');
	}
	
	public function index()
	{
        $shop = $this->restaurant->Restaurant();
        $group=$this->restaurant->restaurant_group();
		$this->smarty->assign(
			array(
				'mainpage_language_ary'	=>$this->mainpage_language_ary,
                'shop'	=>$shop,
                'group'=>$group
			)
		);
		$this->smarty->displayFrame(__CLASS__.'/index.tpl');
	}
	public function view(){
	    $this->smarty->displayFrame('Restaurant/index.tpl');
    }
}
