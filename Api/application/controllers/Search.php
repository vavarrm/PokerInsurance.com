<?php

class search extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Restaurant_Model', 'restaurant');
    }
    function escapeString($val) {
        $db = get_instance()->db->conn_id;
        $val = mysqli_real_escape_string($db, $val);
        return $val;
    }
    function index(){
       if(isset($_GET['q'])){
           $q=$this->escapeString($_GET['q']);
           $search = $this->restaurant->search_Res($q);
           if($search >0){
               $this->smarty->assign(array(
                   'search'	=>$search
               ));
               $this->smarty->displayFrame('Restaurant/search.tpl');
           }else{
               echo $q;
           }

        }else{
            echo'error';
        }


    }

}