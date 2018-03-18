<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
    }
	
	public function index()
	{
		$this->smarty->assign(array(
			'f_id'				=>$f_id

		));
		$this->smarty->displayFrame(__CLASS__.'/index.tpl');
	}
	
}
