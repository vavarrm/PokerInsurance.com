<?php
	class User_Model extends CI_Model 
	{
		public function __construct()
		{
			
			parent::__construct();
			$this->load->database();
		}
		
		public function getList($ary)
		{
			try
			{
				if(empty($ary))
				{
					$MyException = new MyException();
					$array = array(
						'message' 	=>$error['message'] ,
						'status'	=>'000'
					);
					
					$MyException->setParams($array);
					throw $MyException;
				}
				
				$fields = join(',' ,$ary['fields']);
				
				$sql ="	SELECT u_id AS id," 
						.$fields.	
						" FROM
							user AS u";
				$ary['sql'] =$sql;
				$output = $this->getListFromat($ary);
				return 	$output  ;
			}catch(MyException $e)
			{
				throw $e;
			}
		}
		
        public function escapeString($val) {
            $db = get_instance()->db->conn_id;
            $val = mysqli_real_escape_string($db, $val);
            return $val;
        }
		
		public function setsetProfile($ary,$u_id)
		{
			$this->db->where('u_id', $u_id);
			$this->db->update('user', $ary); 
			$output['affected_rows'] = $this->db->affected_rows();
			return $output;
		}
		
		public function isUserAccountExist($u_account)
		{
			try 
			{
				$sql="SELECT COUNT(*) AS total FROM user WHERE u_account=?";
				$bind = array(
					$u_account
				);
				$query = $this->db->query($sql, $bind);
				$error = $this->db->error();
				if($error['message'] !="")
				{
					$MyException = new MyException();
					$array = array(
						'db_error_message' 	=>$error['message'] ,
						'status'	=>'000'
					);
					
					$MyException->setParams($array);
					throw $MyException;
				}
				$row =  $query->row_array();
				$query->free_result();
				return $row;
			}catch(MyException $e)
			{
				throw $MyException;
			}
		}
		
		public function isEmailExist($u_email)
		{
			$sql="SELECT COUNT(*) AS total FROM user WHERE u_email=?";
			$bind = array(
				$u_email
			);
			$query = $this->db->query($sql, $bind);
			$row =  $query->row_array();
			$query->free_result();
			return $row;
		}
		
		public function getUserForFBId($fb_u_id)
		{
			$sql ="SELECT * FROM user WHERE fb_u_id = ?";
			$bind = array(
				$fb_u_id
			);
			$query = $this->db->query($sql, $bind);
			$row =  $query->row_array();
			$query->free_result();
			return $row;
		}	
		
		public function setUserPhoneVerification($u_id)
		{
			$output = array(
				'affected_rows'	=>0,
				'phone_verification_code'	=>''
			);
			try 
			{
				$u_phone_verification_code = rand(100000,999999);
				$output['phone_verification_code'] = $u_phone_verification_code ;
				$sql = "UPDATE 
							user
						SET
							u_phone_verification_code =? ,
							u_phone_verification_code_add_datetime =NOW()
						WHERE u_id =?";
				$bind = array(
					$u_phone_verification_code,
					$u_id
				);
				$query = $this->db->query($sql, $bind);
				$error = $this->db->error();
				if($error['message'] !="")
				{
					$MyException = new MyException();
					$array = array(
						'db_error_message' 	=>$error['message'] ,
						'status'	=>'000'
					);
					
					$MyException->setParams($array);
					throw $MyException;
				}
				$output['affected_rows']  +=$this->db->affected_rows();
				return $output;
			}catch(MyException $e)
			{
				throw $MyException;
			}
		}
		
		public function getUserForId($u_id)
		{
			$sql ="
			SELECT 
				u_account,
				u_first_name,
				u_last_name,
				u_email,
				u_phone,
				u_id,
				fb_u_id,
				u_phone_verification,
				u_phone_verification_code
			FROM user WHERE u_id = ?";
			$bind = array(
				$u_id
			);
			$this->db->join("user_position",'user.u_id=user_position.u_id');
			$query = $this->db->query($sql, $bind);
			$row =  $query->row_array();
			$query->free_result();
			return $row;
		}
		
		public function getUserForLogin($ary= array())
		{
			
			try 
			{
				$sql="	SELECT * 
						FROM user 
						WHERE (u_account =?)  OR (fb_u_id =? AND  fb_u_id <> 'NULL')";
				$bind = array(
					$ary['u_account'],
					$ary['fb_u_id'],
				);
				$query = $this->db->query($sql, $bind);
				$error = $this->db->error();
				if($error['message'] !="")
				{
					$MyException = new MyException();
					$array = array(
						'db_error_message' 	=>$error['message'] ,
						'status'	=>'000'
					);
					
					$MyException->setParams($array);
					throw $MyException;
				}
				$row =  $query->row_array();
				$query->free_result();
				return $row;
			}catch(MyException $e)
			{
				throw $MyException;
			}
		}
		
		public function isAccountExist($ary = array())
		{
			try 
			{
				$row = array();
				$sql = "SELECT COUNT(*) AS  total FROM user WHERE u_account = ?";
				$bind = array(
					$ary['u_account'],
				);
				$query = $this->db->query($sql, $bind);
				$row =  $query->row_array();
				$query->free_result();
				return $row['total'];
			}catch(Exception $e)
			{
				$output['status'] = '000';
				$output['message'] = $e->getMessage();
			}
		}
		
		public function setLock($ary)
		{
			$output= array(
				'affected_rows'	=>0
			);
			try
			{
				$this->db->trans_begin();
				if(empty($ary))
				{
					$MyException = new MyException();
					$array = array(
						'message' 	=>$error['message'] ,
						'status'	=>'000'
					);
					
					$MyException->setParams($array);
					throw $MyException;
				}
				
				$sql ="UPDATE user SET u_status = ? WHERE u_id =?";
				$bind = array(
					$ary['u_status'],
					$ary['u_id'],
				);
				$this->db->query($sql, $bind); 
				$output['affected_rows'] += $this->db->affected_rows();
				$error = $this->db->error();
				if($error['message'] !="")
				{	
					$MyException = new MyException();
					$array = array(
						'el_system_error' 	=>$error['message'] ,
						'status'	=>$status
					);
					
					$MyException->setParams($array);
					throw $MyException;
				}
				
				
				$this->db->trans_commit();
				return $output;
				
			}catch(MyException $e)
			{
				$this->db->trans_rollback();
				throw $e;
			}
		}
		
		public function getUserById($id)
		{
			$output =array();
			try
			{
				$sql ="SELECT u_account ,u_id,u_status FROM user WHERE u_id =?";
				$bind=array($id);
				$query = $this->db->query($sql,$bind);
				$error = $this->db->error();
				if($error['message'] !="")
				{
					$MyException = new MyException();
					$array = array(
						'el_system_error' 	=>$error['message'] ,
						'status'	=>'001'
					);
					
					$MyException->setParams($array);
					throw $MyException;
				}
				$row = $query->row_array();
				$query->free_result();
				$output['row'] =$row ;
				return 	$output  ;
			}catch(MyException $e)
			{
				throw $e;
			}
		}
		
		public function insert($ary = array())
		{
			$output = array(
				'affected_rows' =>0
			);
			try 
			{
				$data = array(
					'u_account' => $ary['u_account'],
					'u_passwd' => MD5($ary['u_passwd']),
					'fb_u_id' => $ary['fb_u_id'],
					'fb_name' => $ary['fb_name'],
				);
				$this->db->insert('user',$data);
				$error = $this->db->error();
				if($error['message'] !="")
				{
					$MyException = new MyException();
					$array = array(
						'db_error_message' 	=>$error['message'] ,
						'status'	=>'000'
					);
					
					$MyException->setParams($array);
					throw $MyException;
				}
				
				$affected_rows = $this->db->affected_rows();
				$output['affected_rows'] =$affected_rows;
				return $output;
			}catch(MyException $e)
			{
				throw $MyException;
			}
		}

        public function inv_view($inv)
        {
            $q=$this->escapeString($inv);
            $this->db->select('*');
            $this->db->from('order_detail');
            $this->db->join('food', 'food.f_id = order_detail.od_f_id');

            $this->db->where('order_detail.od_o_id', $q);
            $query = $this->db->get();
            $rows = $query->result_array();
            if (count($rows) >0) {
                $query->free_result();
                return $rows;
            } else {
                return FALSE;
            }
        }

        public function sum_price_order_by_rId($inv){
            $q=$this->escapeString($inv);
            $this->db->select('SUM(od_price) as total,add_datetime,od_o_id');
            $this->db->select('od_price');
            $this->db->from('order_detail');
            $this->db->where('order_detail.od_o_id', $q);
            $query = $this->db->get();
            $rows = $query->result_array();
            if (count($rows) >0) {
                $query->free_result();
                return $rows;
            } else {
                return FALSE;
            }
        }

        public function order_status($inv){
            $q=$this->escapeString($inv);
            $this->db->select('*');
            $this->db->from('order_list');
            $this->db->where('o_id',$q);
            $query = $this->db->get();
            $rows = $query->result_array();
            if (count($rows) >0) {
                $query->free_result();
                return $rows;
            } else {
                return FALSE;
            }

        }


	}
?>