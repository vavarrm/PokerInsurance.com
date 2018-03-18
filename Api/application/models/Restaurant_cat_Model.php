<?php

class Restaurant_cat_Model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->tb_restaurant="restaurant";
        $this->tb_restaurant_category_link="restaurant_category_link";
        $this->tb_category="category";
        $this->tb_food_category_link="food_category_link";

        $this->JoinTable="category";
        $this->innerJoin="restaurant.ca_id=category.ca_id";


        $this->join_link_restautant=" restaurant_category_link.rcl_r_id= restaurant.r_id";
        $this->join_link_category=" category.ca_id= restaurant_category_link.rcl_ca_id ";
        $this->join_link_food="food_category_link.ca_id=category.ca_id";

    }
    function escapeString($val) {
        $db = get_instance()->db->conn_id;
        $val = mysqli_real_escape_string($db, $val);
        return $val;
    }

    public  function list_restaurant_cat($data)
	{

        $q=$this->escapeString($data);
       // $qu=str_replace('-',' ',$q);

        $this->db->select('*');
        $this->db->from("restaurant");
        $this->db->join("grop_restaurant","grop_restaurant.g_r_id=restaurant.g_r_id");
       // $this->db->where('grop_restaurant.g_r_name', $qu);
        $this->db->like('grop_restaurant.g_r_name',str_replace('-', ' ',$q));
        $this->db->or_like('grop_restaurant.g_r_id',str_replace('-', ' ',$q));
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

    public function list_category_by_restaurant($r_id)
	{
		try
		{
			$sql ="	SELECT 
						ca_name ,
						ca_id
					FROM 
						category  AS  ca
						INNER JOIN food AS f ON f.f_ca_id = ca.ca_id
					WHERE 
						ca.ca_r_id =?
						GROUP BY ca.ca_id";
			$bind =array($r_id);
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
		}catch(MyException $e)
		{
			throw $e;
		}	
		
    }
    public function list_food_by_ca($ca_id){
        $q=$this->escapeString($ca_id);
        $this->db->select("*");
        $this->db->from($this->tb_restaurant);
        $this->db->join($this->tb_restaurant_category_link, $this->join_link_restautant);
        $this->db->join($this->tb_category,$this->join_link_category);
        $this->db->join($this->tb_food_category_link,$this->join_link_food);
        $this->db->where('restaurant.r_id', $q);
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
}