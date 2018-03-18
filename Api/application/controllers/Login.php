<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		$this->login_language_ary = $this->language->load('login');
    }
	
	public function index()
	{
		$get= $this->input->get();
		$this->smarty->assign(array(
			'back'				=>$get['back'],
			'language_ary'		=>$this->login_language_ary,
			'jsArray'	=>array(
				'fb.js',
				'login.js'
			)
		));
		$this->smarty->displayFrame(__CLASS__.'/index.tpl');
	}
	
}
