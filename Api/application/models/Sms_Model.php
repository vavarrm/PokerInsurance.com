<?php

class Sms_Model extends CI_Model {

    public function __construct()
    {
		parent::__construct();
		$this->load->database();
    }
	
	public function addSmsLog($ary)
	{
		
	}

}