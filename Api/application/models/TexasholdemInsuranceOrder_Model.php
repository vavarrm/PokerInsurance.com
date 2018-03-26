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
						SET result =? , pay_amount =? , complete =1
						WHERE u_id =? AND order_id=? AND order_number =? AND complete = 0
						";
				$bind =array(
					$ary['result'],
					$ary['payamount'],
					$ary['u_id'],
					$ary['order_id'],
					$ary['order_number'],
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
		
		public function getOrderNumber($round)
		{
			try
			{
				$round = strtoupper(substr($round,0,1));
				$sql ="SELECT 
							CONCAT
							(
								DATE_FORMAT(NOW(),'%y%m%d%H%i'),
								(SELECT LPAD((SELECT IFNULL((SELECT 
										substring(order_number,11,3)
									FROM 
										`texasholdem_insurance_order` 
									WHERE 
										DATE_FORMAT(add_datetime,'%Y%m%d%H') = DATE_FORMAT(NOW(),'%Y%m%d%H') ORDER BY  `order_number` DESC LIMIT 1 
								),0)+1 AS oo),3,0)),
								IF((SELECT COUNT(order_number) FROM  texasholdem_insurance_order WHERE order_number = ?) +1 >1 , 2,1)
							) AS order_number";
				$bind = array($round);
				$query = $this->db->query($sql,$bind);
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
				$order_number = $this->getOrderNumber($ary['order_number']);
				if($ary['order_number'] !='')
				{
					$order_number =  substr($ary['order_number'],0,13).'2';
				}
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
							order_number,
							players,
							result,
							pay_amount,
							complete
						)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,1)";
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
					$order_number ,
					$ary['players'],
					$ary['result'],
					$ary['payamount'],
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