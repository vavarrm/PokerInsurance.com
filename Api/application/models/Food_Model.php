<?php
	class Food_Model extends CI_Model 
	{
		function __construct()
		{
			
			parent::__construct();
			$this->load->database();
            $this->table="food";
            $this->JoinTable="restaurant";
            $this->innerJoin="restaurant.r_id=food.f_r_id";

		}


        function escapeString($val) {
            $db = get_instance()->db->conn_id;
            $val = mysqli_real_escape_string($db, $val);
            return $val;
        }

		public function getSetList($f_id)
		{
			$sql="	SELECT 
						f.f_id, 
						f.f_name setName,
						f.f_large_price,
						fs.fs_child_f_id , 
						f2.f_name , 
						ca.ca_name, 
						fs.fs_group_id 
					FROM `food` AS f 
						INNER JOIN food_set AS fs ON f.`f_id`  = fs.fs_parent_f_id
						INNER JOIN food AS f2 ON f2.f_id = fs.fs_child_f_id
						INNER JOIN category AS ca ON ca.ca_id = f2.ca_id
					WHERE f.f_id = ?
					ORDER BY fs.fs_group_id ASC , fs.fs_child_f_id  ASC";
			$bind = array($f_id);
			$query = $this->db->query($sql, $bind);
			$row =  $query->result_array();
			$query->free_result();
			return $row;
		}
		
		public function getLastOid()
		{
			$sql = 'SELECT 
						o_id 
					FROM 
						order_list 
					ORDER BY o_id DESC';
			$query = $this->db->query($sql, $bind);
			$row =  $query->row_array();
			$query->free_result();
			return $row;
		}


        public function inserdOrder($ary = array())
        {
            $output = array();
           // $this->db->trans_start();
            $row = $this->getLastOid();
            if(empty($row))
            {
                $row['o_id'] = date('Ymd').sprintf('%06d',1);
            }else
            {
                $row['o_id']+=1;
            }

            $sql="INSERT INTO order_list (o_id,o_u_id,o_messge,o_p_id) VALUES(?,?, ?, ?)";
            $bind = array(
                $row['o_id'],
                $ary['u_id'],
                $ary['o_message'],
                $ary['o_position_id']

            );

            $query = $this->db->query($sql,$bind);

            $in_f_id = array();

            if(!empty($ary['order_list']))
            {
                $index =0;
                $total_sql="";
                foreach($ary['order_list'] as  $key => $value )
                {
                    if($value['is_set']==1)
                    {
                        if(!empty($value['set_include']))
                        {

                            foreach($value['set_include'] as $include)
                            {
                                $index++;
                                $sql ="SELECT * FROM food WHERE f_id =?";
                                $bind = array( $include['f_id']);
                                $query = $this->db->query($sql, $bind);
                                $temp =  $query->row_array();
                                $query->free_result();
                                $sql ="INSERT INTO order_detail(od_o_id,od_item_index,f_id, od_num, od_price,od_is_set)
									   VALUES(?, ?, ?, ?, ?,'1')";
                                $insert = array(
                                    $row['o_id'] ,
                                    $index,
                                    $temp['f_id'],
                                    $value['order_num'],
                                    $temp['f_large_price']
                                );


                                $query = $this->db->query($sql, $insert);
                            }
                            $total_sql[] =sprintf("SELECT	f_large_price*f_discount AS price FROM food WHERE f_id = %s", $value['f_id']);
                        }
                    }else
                    {
                        $index++;
                        $sql ="SELECT * FROM food WHERE f_id =?";
                        $bind = array($value['f_id']);
                        $query = $this->db->query($sql, $bind);
                        $temp =  $query->row_array();
                        $query->free_result();
                        $total_sql = array();
                        $sql ="INSERT INTO order_detail(od_o_id, od_item_index,od_f_id, od_num, od_price)
							   VALUES(?,?,?,?,?)";
                        $insert = array(
                            $row['o_id'] ,
                            $index,
                            $temp['f_id'],
                            $value['order_num'],
                            $temp['f_large_price']
                        );
                        $query = $this->db->query($sql, $insert);
                        $total_sql[] =sprintf("SELECT	f_large_price AS price FROM food WHERE f_id = %s", $temp['f_id']);

                    }
                }
            }

            $total_sql =  "SELECT SUM(price) as total FROM (".join(' UNION ALL ' , $total_sql).") AS t1";
            $query = $this->db->query($total_sql);
            $temp =  $query->row_array();
            $query->free_result();

            $sql = "UPDATE order_list SET o_total =? WHERE o_id =?";
            $bind = array(
                $temp['total'],
                $row['o_id']
            );
            $query = $this->db->query($sql , $bind);

            $this->db->trans_complete();
            if ($this->db->trans_status()===  FALSE)
            {

            }
        }
        public function get_InvById($Id){
            $this->db->select('o_id');
            $this->db->from('order_list');
            $this->db->where('u_id',$Id);
            $this->db->order_by('o_id', 'DESC');
            $this->db->limit('1');
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


	
		public function getProductForFid($f_id)
		{
			$sql="	SELECT * 
					FROM food AS f LEFT JOIN category AS ca ON f.ca_id = ca.ca_id
					WHERE f_id =?";
			$bind = array(
				$f_id
			);
			$query = $this->db->query($sql, $bind);
			$rows  =  $query->row_array();
			$query->free_result();
			return $rows;
		}
	
		public function getCategory()
		{
			$sql="SELECT * FROM `category` ORDER BY ca_id";
			$query = $this->db->query($sql, $bind);
			$rows  =  $query->result_array();
			$query->free_result();
			return $rows;
		}
		
		public function getFoodClassList()
		{
		
		}
		
		public function getFoodForMenu($where = array())
		{
			$where_str =" 1 = 1  AND f_status='sale_on'";
			if(!empty($where) )
			{
				foreach($where as $key =>$vale)
				{
					$where_str.=sprintf(" AND %s = ?", $key);
					$bind[] = $value;
				}
			}

			return $rows;
		}

		function foodList_By_RestaurantId($userId){
		    $data=$this->escapeString($userId);
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->join($this->JoinTable,$this->innerJoin);
            //$this->db->join("food_category_link","food_category_link.f_id=food.f_id");
            $this->db->order_by("f_r_id", "asc");
            $this->db->where('restaurant.r_id',$data);
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
        public function get_food_by_r($userId)
        {
            $data=$this->escapeString($userId);
            $this->db->select('*');
            $this->db->from("food");
            $this->db->join("restaurant","restaurant.r_id=food.f_r_id");
            $this->db->join("category","category.ca_id=food.f_ca_id");
            $this->db->order_by("category.ca_id", "asc");
            $this->db->where('restaurant.r_id',$data);
            $query=$this->db->get();
            $rows=$query->result_array();
            $return = array();

            foreach ($query->result() as $category)
            {
                $return[$category->ca_id] = $category;
                $return[$category->ca_id]->subs = $this->get_category($category->ca_id); // Get the categories sub
                // categories
            }

            return $rows;
        }


        public function get_category($res_id)
        {
            // Select all entries from the menu table
            $query = $this->db->query("select * from category WHERE ca_r_id='.$res_id.' order by ca_id DESC ");

            // Create a multidimensional array to contain a list of items and parents
            $cat = array(
                'items' => array(),
                'parents' => array()
            );
            // Builds the array lists with data from the menu table
            foreach ($query->result() as $cats) {
                // Creates entry into items array with current menu item id ie. $menu['items'][1]
                $cat['items'][$cats->ca_id] = $cats;
                // Creates entry into parents array. Parents array contains a list of all items with children
                $cat['parents'][$cats->ca_r_id][] = $cats->category_id;
            }

            if ($cat) {
                $result = $this->get_food_by_r(0, $cat);
                return $result;
            } else {
                return FALSE;
            }
        }

	}
?>