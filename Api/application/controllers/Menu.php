<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		$this->food_language_ary = $this->language->load('food');
		$this->load->model('Food_Model', 'food');	
    }
	
	public function index()
	{	
		$categorys = $this->food->getCategory();
		$foods = $this->food->getFoodForMenu();
		$this->smarty->assign(array(
			'categorys'	=>$categorys,
			'foods'		=>$foods ,
			'food_language_ary'	=>$this->food_language_ary
		));
		$this->smarty->displayFrame(__CLASS__.'/menu-modern.tpl');
	}
	
	public function food($f_id)
	{

		$food =$this->food->getProductForFid($f_id);
		$this->smarty->assign(array(
			'f_id'				=>$f_id,
			'food_language_ary'	=>$this->food_language_ary,
			'food'	=>$food

		));
		$this->smarty->displayFrame(__CLASS__.'/shop-single.tpl');
	}
}
