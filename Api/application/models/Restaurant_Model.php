<?php

class Restaurant_Model extends CI_Model{

	public $CI;
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table="restaurant";
        $this->JoinTable="";
		$this->CI =&get_instance();
    }
	
	public function getFoodRowById($f_id)
	{
		$output = array();
		try
		{
			$sql="SELECT * FROM food WHERE f_id =?";
			$bind = array($f_id);
			$query =$this->db->query($sql, $bind); 
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
			$row=$query->row_array();
			$output['info'] = $row;
			
			$sql="	SELECT c.* 
					FROM 
						restaurant AS r
							INNER JOIN  category AS c ON c.ca_r_id = r.r_id 
					WHERE r.r_id =?
			";
			$bind = array($row['f_r_id']);
			$query =$this->db->query($sql, $bind); 
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
			$rows=$query->result_array();
			$output['info']['category'] = $rows;
			
			
			$query->free_result();
            return $output;
			
		}catch(MyException $e)
		{
			throw $e;
		}
	}
	
	public function getRowById($r_id)
	{
		$output = array();
		try
		{
			$sql="SELECT * FROM restaurant WHERE r_id =?";
			$bind = array($r_id);
			$query =$this->db->query($sql, $bind); 
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
			$row=$query->row_array();
			$output['info'] = $row;
			
			$sql ="SELECT * FROM restaurant_operation WHERE r_id =?";
			$bind = array($r_id);
			$query =$this->db->query($sql, $bind); 
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
			
			$rows=$query->result_array();
			$output['operation'] = $rows;
			
			$query->free_result();
            return $output;
			
		}catch(MyException $e)
		{
			throw $e;
		}
		
	}
	
	public function updateCategory($ary)
	{
		$output= array(
			'affected_rows'	=>0
		);
		try
		{
			$this->db->trans_begin();
			$sql =" UPDATE category SET 
						ca_name = ?,
						ca_name_en= ?
					WHERE ca_id = ?
					";
			$bind=array(
				$ary['ca_name'],
				$ary['ca_name_en'],
				$ary['ca_id'],
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
			$output['affected_rows'] += $this->db->affected_rows();
			$this->db->trans_commit();
			return $output;
		}catch(MyException $e)
		{
			$this->db->trans_rollback();
			throw $e;
		}
	}
	
	public function getCategoryRowById($id)
	{
		$output = array();
		try
		{
			$sql="SELECT * FROM category WHERE ca_id =?";
			$bind = array($id);
			$query =$this->db->query($sql, $bind); 
		
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
			$row=$query->row_array();
			$output['row'] = $row;
			$query->free_result();
            return $output;
			
		}catch(MyException $e)
		{
			throw $e;
		}
	}
	
	public function delCategory($id)
	{
		try
		{
			$bind = array(
				$id
			);
			$sql="DELETE FROM  category WHERE ca_id=?";
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
		}catch(MyException $e){
			throw $e;
		}
	}
	
	public function insertCategory($ary)
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
					'el_system_error' 	=>$error['message'] ,
					'status'	=>'000'
				);
				
				$MyException->setParams($array);
				throw $MyException;
			}
			
			$sql = "SELECT COUNT(*) AS total FROM category WHERE ca_r_id =? AND ca_name =? AND ca_name_en =?";
			$bind = array(
				$ary['r_id'],
				$ary['ca_name'],
				$ary['ca_name_en'],
			);
			
			$query =$this->db->query($sql, $bind); 
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
			
			if($row['total'] >0)
			{
				$MyException = new MyException();
				$array = array(
					'status'	=>'000'
				);
				
				$MyException->setParams($array);
				throw $MyException;
			}
			$query->free_result();
			
			$sql ="INSERT INTO category (ca_name, ca_name_en,  ca_r_id)
			      VALUES (?,?,?)";
			$bind = array(
				$ary['ca_name'],
				$ary['ca_name_en'],
				$ary['r_id'],
			);
			$this->db->query($sql, $bind); 
			$output['affected_rows'] += $this->db->affected_rows();
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
			$this->db->trans_commit();
			return $output;
			
		}catch(MyException $e)
		{
			$this->db->trans_rollback();
			throw $e;
		}
	}
	
	
	public function getCategoryList($ary)
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
			
			$sql ="	SELECT ca_id AS id," 
					.$fields.	
					" FROM
						 category AS ca";
			$ary['sql'] =$sql;
			$output = $this->getListFromat($ary);
			return 	$output  ;
		}catch(MyException $e)
		{
			throw $e;
		}
	}
	
	public function foodUpdate($ary)
	{
		$output= array(
			'affected_rows'	=>0
		);
		try
		{
			$this->db->trans_begin();
			$sql =" UPDATE food SET 
						f_name = ?,
						f_name_en= ?,
						f_status= ?,
						f_large_price= ?,
						f_medium_price= ?,
						f_small_price= ?,
						f_ca_id= ?
					WHERE f_r_id = ? AND  f_id =?
					";
			$bind=array(
				$ary['f_name'],
				$ary['f_name_en'],
				$ary['f_status'],
				$ary['f_large_price'],
				$ary['f_medium_price'],
				$ary['f_small_price'],
				$ary['f_ca_id'],
				$ary['f_r_id'],
				$ary['f_id']
			);
			$this->db->query($sql, $bind); 
			// echo $this->db->last_query();
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
			$output['affected_rows'] += $this->db->affected_rows();
			
			if (!file_exists(IMAGEPATH.'/food')) 
			{
				mkdir(IMAGEPATH.'/food', '0777', true);
			}
			
			if($_FILES['tmp_name'] !="")
			{
				$config['upload_path'] = IMAGEPATH.'/food/';
				$config['allowed_types'] = 'jpg|jpe|gpng';
				$config['max_size']	= '2048';
				$config['max_width']  = '300';
				$config['max_height']  = '250';
				$config['encrypt_name']  = true;
			
				$this->CI->load->library('upload',$config);
				if ( ! $this->upload->do_upload('f_photo_300X250'))
				{
					$error= $this->upload->display_errors();
					$MyException = new MyException();
					$array = array(
						'el_system_error' 	=>$error ,
						'status'	=>'009'
					);
					$MyException->setParams($array);
					throw $MyException;
				}
				
				if(file_exists(IMAGEPATH.'/food/'.$ary['f_photo']))
				{
					unlink(IMAGEPATH.'/food/'.$ary['f_photo']);
				}
				
				$image = array('upload_data' => $this->upload->data());
				
				$sql="UPDATE food SET f_photo_300X250 = ? WHERE f_id =?";
				$bind = array(
					$image['upload_data']['file_name'],
					$ary['f_id']
				);
				$this->db->query($sql, $bind); 
				$output['affected_rows'] += $this->db->affected_rows();
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
			}
			$this->db->trans_commit();
			return $output;
		}catch(MyException $e)
		{
			$this->db->trans_rollback();
			throw $e;
		}	
	}
	
	public function update($ary)
	{
		$output= array(
			'affected_rows'	=>0
		);
		try
		{
			$this->db->trans_begin();
			$sql =" UPDATE restaurant SET 
						r_name = ?,
						r_name_en= ?,
						r_description= ?,
						r_description_en= ?,
						r_lat= ?,
						r_lng= ?,
						r_address= ?
					WHERE r_id = ?
					";
			$bind=array(
				$ary['r_name'],
				$ary['r_name_en'],
				$ary['r_description'],
				$ary['r_description_en'],
				$ary['lat'],
				$ary['lng'],
				$ary['r_address'],
				$ary['r_id']
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
			$output['affected_rows'] += $this->db->affected_rows();
			
			$sql ="DELETE FROM restaurant_operation WHERE r_id =?";
			$bind = array(
				$ary['r_id']
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
			
			if(count($ary['operation_day']) >0)
			{
				foreach($ary['operation_day'] as $key =>$value)
				{
					$bind =array(
						$value,
						$ary['start'][$key],
						$ary['end'][$key],
						$ary['r_id']
					);
					$sql =" INSERT INTO restaurant_operation(ro_open_day,ro_open_time_start,ro_open_time_end,r_id)
							VALUES(?,?,?,?)";
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
					$output['affected_rows'] += $this->db->affected_rows();
				}
			}
			
			
			$this->db->trans_commit();
			return $output;
		}catch(MyException $e)
		{
			$this->db->trans_rollback();
			throw $e;
		}	
	}
	
    public  function getList($ary =array())
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
			
			$sql ="	SELECT r_id AS id," 
					.$fields.	
					" FROM
						 restaurant";
			$ary['sql'] =$sql;
			$output = $this->getListFromat($ary);
			return 	$output  ;
		}catch(MyException $e)
		{
			throw $e;
		}
    }
	
	public function delFood($ary)
	{
		try
		{
			$bind = array(
				$ary['id']
			);
			
			$sql ="SELECT	f_photo_300X250 FROM food WHERE f_id = ?";
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
			if(file_exists(IMAGEPATH.'/food/'.$row['f_photo']))
			{
				unlink(IMAGEPATH.'/food/'.$row['f_photo']);
			}
			
			$sql="DELETE FROM food WHERE f_id=?";
			$this->db->query($sql, $bind); 
			$error = $this->db->error();
			if($error['message'] !="")
			{
				
				$MyException = new MyException();
				
				if($error['code']== 1451)
				{
					$status ='010';
				}else
				{
					$status ='000';
				}
				
				$array = array(
					'el_system_error' 	=>$error['message'] ,
					'status'	=>$status
				);
				
				$MyException->setParams($array);
				throw $MyException;
			}
		}catch(MyException $e){
			throw $e;
		}
	}
	
	public function insertFood($ary =array())
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
			
			$sql ="INSERT INTO food (f_name, f_name_en, f_status, f_large_price, f_medium_price, f_small_price, f_r_id, f_ca_id)
			      VALUES (?,?,?,?,?,?,?,?)";
			$bind = array(
				$ary['f_name'],
				$ary['f_name_en'],
				$ary['f_status'],
				$ary['f_large_price'],
				$ary['f_medium_price'],
				$ary['f_small_price'],
				$ary['f_r_id'],
				$ary['f_ca_id'],
			);
			$this->db->query($sql, $bind); 
			$f_id  = $this->db->insert_id();
			$output['affected_rows'] += $this->db->affected_rows();
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
			
			if (!file_exists(IMAGEPATH.'/food')) 
			{
				mkdir(IMAGEPATH.'/food', '0777', true);
			}
			
			$config['upload_path'] = IMAGEPATH.'/food/';
			$config['allowed_types'] = 'jpg|jpe|gpng';
			$config['max_size']	= '2048';
			$config['max_width']  = '300';
			$config['max_height']  = '250';
			$config['encrypt_name']  = true;
			$this->CI->load->library('upload',$config);
			if ( ! $this->upload->do_upload('f_photo_300X250'))
			{
				$error= $this->upload->display_errors();
				var_dump($error);
				$MyException = new MyException();
				$array = array(
					'el_system_error' 	=>$error ,
					'status'	=>'009'
				);
				$MyException->setParams($array);
				throw $MyException;
			}
			
			$image = array('upload_data' => $this->upload->data());
			
			$sql="UPDATE food SET f_photo_300X250 = ? WHERE f_id =?";
			$bind = array(
				$image['upload_data']['file_name'],
				$f_id 
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
			
			$this->db->trans_commit();
			return $output;
			
		}catch(MyException $e)
		{
			$this->db->trans_rollback();
			throw $e;
		}
	}
	
	public function getRestaurantCategory($ary =array())
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
			$sql = "SELECT 
						ca_id,
						ca_name,
						ca_name_en
					FROM category
					WHERE ca_r_id=?";
			$bind=array(
				$ary['r_id']
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
			return 	$rows  ;
		}catch(MyException $e)
		{
			throw $e;
		}
	}
	
	
	public function getFoodList($ary =array())
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
			
			$sql ="	SELECT f.f_id AS id," 
					.$fields.	
					" FROM
						restaurant As r 
							INNER JOIN food AS f ON f.f_r_id = r.r_id
							LEFT JOIN category AS ca on ca.ca_r_id = r.r_id  AND f.f_ca_id = ca.ca_id
							";
			$ary['sql'] =$sql;
			$output = $this->getListFromat($ary);
			return 	$output  ;
		}catch(MyException $e)
		{
			throw $e;
		}
	}
	
	public function del($id)
	{
		try
		{
			$bind = array(
				$id
			);
			$sql="DELETE FROM restaurant WHERE r_id=?";
			$this->db->query($sql, $bind); 
			$error = $this->db->error();
			if($error['message'] !="")
			{
				$MyException = new MyException();
				
				if($error['code']== 1451)
				{
					$status ='010';
				}else
				{
					$status ='000';
				}
				
				$array = array(
					'el_system_error' 	=>$error['message'] ,
					'status'	=>$status
				);
				
				$MyException->setParams($array);
				throw $MyException;
			}
		}catch(MyException $e){
			throw $e;
		}
    }
	
    public function escapeString($val) {
        $db = get_instance()->db->conn_id;
        $val = mysqli_real_escape_string($db, $val);
        return $val;
    }
	
    public function Restaurant(){
        try
		{
			
			$sql="	SELECT 
						r.r_id,
						r_name,
						r_logo_310X260
					FROM  restaurant AS r 
					INNER JOIN food AS f ON f.f_r_id = r.r_id
					GROUP BY r.r_id
				 ";
			$query = $this->db->query($sql, $bind);
			$error = $this->db->error();
			if($error['message'] !="")
			{
				$MyException = new MyException();
				$MyException->setParams($array);
				throw $MyException;
			}
			$rows  =  $query->result_array();
			$query->free_result();
			return $rows;
		}catch(MyException $e){
			throw $e;
		}
    }

    public function  getRestaurant_byId($data){
        $q=$this->escapeString($data);
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('restaurant.r_id', $q);
        //$this->db->like('restaurant.r_name',str_replace('-', ' ', $q));
        $query = $this->db->get();

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

	public function insert($ary)
	{
		$output= array(
			'affected_rows'	=>0
		);
		try
		{
			$this->db->trans_begin();
			$sql =" INSERT INTO restaurant (
						r_name,
						r_name_en,
						r_description,
						r_description_en,
						r_lat,
						r_lng,
						r_address
					)
					VALUES(?,?,?,?,?,?,?)";
			$bind=array(
				$ary['r_name'],
				$ary['r_name_en'],
				$ary['r_description'],
				$ary['r_description_en'],
				$ary['lat'],
				$ary['lng'],
				$ary['r_address'],
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
			$output['affected_rows'] += $this->db->affected_rows();
			$insert_id = $this->db->insert_id();
			
			if(count($ary['operation_day']) >0)
			{
				foreach($ary['operation_day'] as $key =>$value)
				{
					$bind =array(
						$value,
						$ary['start'][$key],
						$ary['end'][$key],
						$insert_id
					);
					$sql =" INSERT INTO restaurant_operation(ro_open_day,ro_open_time_start,ro_open_time_end,r_id)
							VALUES(?,?,?,?)";
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
				}
			}
			
			$this->db->trans_commit();
			return $output;
		}catch(MyException $e)
		{
			$this->db->trans_rollback();
			throw $e;
		}	
	}
	
    public function  get_operation($data){
        // $q=$this->escapeString($data);
        // $this->db->select('*');
        // $this->db->from('restaurant_operation');

        // $this->db->where('r_id', $q);
        // $query = $this->db->get();

        // $rows=$query->result_array();
        // if(count($rows))
        // {
            // $query->free_result();
            // return $rows;
        // }
        // else
        // {
            // return FALSE;
        // }

    }

    public function search_Res($data)
	{
        $q=$this->escapeString($data);
        $sql="select DISTINCT(r.r_name),r.r_id,r_name from restaurant as r INNER join food as f
                  ON r.r_id=f.f_r_id WHERE f.f_name LIKE  '%".$q."%' OR f.f_name_en LIKE '%".$q."%' 
                  OR r.r_name LIKE '%".$q."%'";
        $query = $this->db->query($sql);
        $rows  =  $query->result_array();
        $query->free_result();
        return $rows;
    }
   function restaurant_group(){
       $sql="select * from grop_restaurant";
       $query = $this->db->query($sql);
       $rows  =  $query->result_array();
       $query->free_result();
       return $rows;
   }


}