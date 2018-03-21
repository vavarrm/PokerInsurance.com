<?php
	class TexasholdemInsuranceOdds_Model extends CI_Model 
	{
		function __construct()
		{
			
			parent::__construct();
			$this->load->database();
		}
		 
		
		public function getOddsList($ary)
		{
			try
			{
				if(empty($ary))
				{
					$MyException = new MyException();
					$array = array(
						'el_system_error' 	=>'no setting ary' ,
						'status'	=>'000'
					);
					
					$MyException->setParams($array);
					throw $MyException;
				}
			
				$sql =" SELECT 
							odds_outs,
							odds_value
						FROM  texasholdem_insurance_odds
						WHERE  odds_group_id =?";
				$bind =array(
					$ary['group_id'],
				);
				$query = $this->db->query($sql, $bind);
				$error = $this->db->error();
				if($error['message'] !="")
				{
					$MyException = new MyException();
					$array = array(
						'el_system_error' 	=>$error['message'] ,
						'status'	=>'000'
					);
					
					$MyException->setParams($array);
					throw $MyException;
				}
				$rows = $query->result_array();
				$query->free_result();
				return $rows;
			}	
			catch(MyException $e)
			{
				throw $e;
			}
		}
		
		public function getOddsByOuts($outs, $group_id =1)
		{
			try
			{
			
				$sql =" SELECT 
							odds_value
						FROM texasholdem_insurance_odds 
						WHERE odds_outs =? AND odds_group_id =?";
				$bind =array(
					$outs,
					$group_id
				);
				$query = $this->db->query($sql, $bind);
				$error = $this->db->error();
				if($error['message'] !="")
				{
					$MyException = new MyException();
					$array = array(
						'el_system_error' 	=>$error['message'] ,
						'status'	=>'000'
					);
					
					$MyException->setParams($array);
					throw $MyException;
				}
				$row = $query->row_array();
				$query->free_result();
				return $row;
			}	
			catch(MyException $e)
			{
				throw $e;
			}
		}
		
	}
?>