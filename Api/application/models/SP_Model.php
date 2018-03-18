<?php
	class SP_Model extends CI_Model 
	{
		function __construct()
		{
			
			parent::__construct();
			$this->load->database();
		}
	
		public function getSerialNumber($type)
		{
			try
			{
				$query = $this->db->query("CALL get_serial_number('order')");
				$row  = $query->row_array();
				$query->next_result(); 
				return $row ;
				
			}catch(MyException $e)
			{
				throw $MyException;
			}
		}
	}
?>