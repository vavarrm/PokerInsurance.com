<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cron extends CI_Controller {
	
	// private $request = array();
	
	// public function __construct() 
	// {
		// parent::__construct();
    // }
	
	public function backupdb(){
       
	    // $this->load->dbutil();
        // $prefs = array(
            // 'format'      => 'text',
            // 'filename'    => 'my_db_backup.sql'
        // );
        // $backup =& $this->dbutil->backup($prefs);
        // $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
        // $save = './upload/_tmp/'.$db_name;
        // $this->load->helper('file');
        // write_file($save, $backup);
        // $this->load->helper('download');
        // force_download($db_name, $backup);
    }
}
