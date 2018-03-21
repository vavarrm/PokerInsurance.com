<?php
	class TexasholdemInsuranceOrder_Model extends CI_Model 
	{
		function __construct()
		{
			
			parent::__construct();
			$this->load->database();
			$query = $this->db->query("set time_zone = '+7:00'");
			$error = $this->db->error();
			if($error['message'] !="")
			{
				$MyException = new MyException();
				$array = array(
					'el_system_error' 	=>"set time_zone error" ,
					'status'	=>'000'
				);
				
				$MyException->setParams($array);
				throw $MyException;
			}
		}
		
		public function updataResult($ary)
		{
			try
			{
				$sql ="	UPDATE texasholdem_insurance_order
						SET result =? , pay_amount =?
						WHERE u_id =? AND order_id=?
						";
				$bind =array(
					$ary['result'],
					$ary['payamount'],
					$ary['u_id'],
					$ary['order_id'],
				);
				$this->db->query($sql, $bind);
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
				
				$affected_rows = $this->db->affected_rows();
				if($affected_rows==0)
				{
					$MyException = new MyException();
					$array = array(
						'el_system_error' 	=>$error['message'] ,
						'status'	=>'004'
					);
					
					$MyException->setParams($array);
					throw $MyException;
				}
			}	
			catch(MyException $e)
			{
				throw $e;
			}
		}
		
		public function getOrderNumber()
		{
			try
			{
				$sql ="SELECT 
							CONCAT(DATE_FORMAT(NOW(),'%Y%m%d'),
							LPAD((SELECT COUNT(*) AS total FROM `texasholdem_insurance_order` 
									WHERE DATE_FORMAT(add_datetime,'%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d') ) + 1,8,0),
							LPAD(FLOOR(1 + (RAND() * 9999)),4,0)) AS order_number";
				$query = $this->db->query($sql);
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
				$row =$query->row_array();
				$query->free_result();
				return $row['order_number'];
			}catch(MyException $e)
			{
				
				throw $e;
			}
		}
		
		public function insert($ary)
		{
			$output = array();
			try
			{
				$order_number = $this->getOrderNumber();
				$this->db->trans_begin();
				$sql ="	INSERT texasholdem_insurance_order(
							round,
							outs,
							odds,
							pot,
							maximun,
							maximun_p50,
							buy_amount,
							u_id,
							insured_amount,
							order_number
						)VALUES(?,?,?,?,?,?,?,?,?,?)";
				$bind =array(
					$ary['round'],
					$ary['outs'],
					$ary['odds'],
					$ary['pot'],
					$ary['maximun'],
					$ary['maximun_p50'],
					$ary['amount'],
					$ary['u_id'],
					$ary['pay'],
					$order_number 
				);
				
				$this->db->query($sql, $bind);
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
				
				$affected_rows = $this->db->affected_rows();
				if($affected_rows==0)
				{
					$MyException = new MyException();
					$array = array(
						'el_system_error' 	=>$error['message'] ,
						'status'	=>'000'
					);
					
					$MyException->setParams($array);
					throw $MyException;
				}
				$order_id =  $this->db->insert_id();
				
				$this->db->trans_commit();
				$output['order_id'] =$order_id;
				$output['order_number'] =$order_number;
				return $output ;
			}	
			catch(MyException $e)
			{
				$this->db->trans_rollback();
				throw $e;
			}
		}
		
		public function getList($ary)
		{
			try
			{
				if(empty($ary))
				{
					$MyException = new MyException();
					$array = array(
						'el_system_error' 	=>'no setParams' ,
						'status'	=>'000'
					);
					
					$MyException->setParams($array);
					throw $MyException;
				}
				if(!empty($ary['fields']))
				{
					foreach($ary['fields'] as $value)
					{
						$temp[] = $value['field'];
					}
				}
				
				$fields = join(',' ,$temp);
				$sql ="	SELECT order_id AS id," 
						.$fields.	
						" FROM
							texasholdem_insurance_order AS o";
				$ary['sql'] =$sql;
				$output = $this->getListFromat($ary);
				return 	$output  ;
			}catch(MyException $e)
			{
				throw $e;
			}
		}
	}
?>