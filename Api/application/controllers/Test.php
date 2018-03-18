<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		// $this->load->model('SP_Model', 'sp');
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
    }
	
	public function index()
	{
		// $this->sp->getSerialNumber('order');
		if ( ! $foo = $this->cache->get('foo1'))
		{
				echo 'Saving to the cache!<br />';
				$foo = 'foobarbaz!';

				// Save into the cache for 5 minutes
				$this->cache->save('foo1', $foo, 5);
		}
		$this->cache->delete('foo1');
		echo $this->cache->get('foo1');
	}
	
}
