<?php
	class TexasholdemInsuranceOrder_Model extends CI_Model 
	{
		function __construct()
		{
			
			parent::__construct();
			$this->load->database();
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
		
		public function insert($ary)
		{
			
			try
			{
				$sql ="	INSERT texasholdem_insurance_order(
							round,
							outs,
							odds,
							pot,
							maximun,
							maximun_p50,
							buy_amount,
							u_id,
							insured_amount
						)VALUES(?,?,?,?,?,?,?,?,?)";
				$bind =array(
					$ary['round'],
					$ary['outs'],
					$ary['odds'],
					$ary['pot'],
					$ary['maximun'],
					$ary['maximun_p50'],
					$ary['amount'],
					$ary['u_id'],
					$ary['pay']
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
				return $order_id;
			}	
			catch(MyException $e)
			{
				throw $e;
			}
		}
	}
?>