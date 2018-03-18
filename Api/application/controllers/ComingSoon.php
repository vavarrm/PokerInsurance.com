<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ComingSoon extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();	
    }
	
	public function index()
	{
		header("Location: https://www.facebook.com/Happy-Cafe-1625286631132025/"); 
		exit;
		$this->smarty->display(__CLASS__.'/coming-soon.tpl');
	}
}
