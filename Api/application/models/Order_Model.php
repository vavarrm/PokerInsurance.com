<?php
	class Order_Model extends CI_Model 
	{
		function __construct()
		{
			
			parent::__construct();
			$this->load->database();
		}
	
		public function getInvoice($id)
		{
			try
			{
				if(empty($id))
				{
					$MyException = new MyException();
					$array = array(
						'message' 	=>$error['message'] ,
						'status'	=>'000'
					);
					
					$MyException->setParams($array);
					throw $MyException;
				}
				
				$sql="
						SELECT 
							od.* ,
							CONCAT(f_name,'/',	f_name_en) AS food_name
						FROM  
							order_detail AS od LEFT JOIN  food AS f ON f.f_id = od.od_f_id
						WHERE 
							od.od_o_id =?";
				$bind =array(
					'id'=>$id
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
				$data['list'] =  $query->result_array();
				
				$sql ="SELECT SUM(t.od_price) AS total FROM(".$sql.") AS t";
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
				$row =  $query->row_array();
				$data['total'] = $row['total'];
				
				$sql="	SELECT 
							o_messge , 
							o_addrees , 
							o_receiver ,
							u.u_phone 
						FROM 
							order_list AS o LEFT JOIN  user AS u ON o.o_u_id = u.u_id  
						WHERE o_id =?";
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
				$row =  $query->row_array();
				$data['order_list'] = $row;
				
				$query->free_result();
				return $data;
				
			}catch(MyException $e)
			{
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
						'el_system_error' 	=>$error['message'] ,
						'status'	=>'000'
					);
					
					$MyException->setParams($array);
					throw $MyException;
				}
				
				$fields = join(',' ,$ary['fields']);
				
				$sql ="	SELECT o_id AS id," 
						.$fields.	
						" FROM
							order_list AS o 
								LEFT JOIN restaurant AS r ON o.o_r_id = r.r_id
								LEFT JOIN user AS u ON u.u_id =o.o_u_id";
				$ary['sql'] =$sql;
				$output = $this->getListFromat($ary);
				return 	$output  ;
			}catch(MyException $e)
			{
				throw $e;
			}
		}
	
		public function getOrderList($where = array())
		{
			$ignore = array(
				'sess',
				'u_id'
			);
			$where_str =" 1 = 1";
			if(!empty($where))
			{
				foreach($where as $key =>$value)
				{
					if(in_array($key, $ignore))
					{
						continue;
					}
					$where_str .=sprintf(" AND %s = ?", $key);
					$bind[] =$value;
				}
			}
			$sql = 'SELECT * FROM `order_list`
					WHERE '.$where.' 
					ORDER BY o_id DESC';
			$query = $this->db->query($sql, $bind);
			$rows =  $query->result_array();
			$query->free_result();
			return $rows;
		}

		function User_OrderList($Id){
		    $this->db->select("*");
		    $this->db->from("order_list");
            $this->db->where('u_id',$Id);
            $query=$this->db->get();
            $rows=$query->result_array();
            if(count($rows))
            {
                $query->free_result();
                return $rows;
            }
            else
            {
                return FALSE;
            }

        }


		public function getOrderStatus()
		{
			$sql = "SELECT * FROM order_status ORDER BY os_id ASC";
			$query = $this->db->query($sql);
			$rows =  $query->result_array();
			$query->free_result();
			return $rows;
		}
	}
?>