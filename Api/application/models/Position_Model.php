<?php
	class Position_Model extends CI_Model 
	{
		function __construct()
		{
			
			parent::__construct();
			$this->load->database();
		}
		
		function getDeliveryPosition()
		{
			$sql ="SELECT * FROM position ORDER BY p_id DESC";
			$query = $this->db->query($sql, $bind);
			$rows =  $query->result_array();
			$query->free_result();


			return $rows;
		}
	
	}
?>