<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gmap extends CI_Controller {
	
	private $request = array();
	
	public function __construct() 
	{
		parent::__construct();	
		
		$this->request = json_decode(trim(file_get_contents('php://input'), 'r'), true);
		$this->load->model('GMAP_Model', 'gmap');
    }

	
}
