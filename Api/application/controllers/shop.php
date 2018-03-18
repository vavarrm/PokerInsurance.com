<?php

class Shop extends  CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Restaurant_Model', 'restaurant');
        $this->load->model('Restaurant_cat_Model', 'cat');
    }

    function Id($x){
        $shopId = $this->cat->list_restaurant_cat($x);
        $operation=$this->restaurant->get_operation($x);
        $this->smarty->assign(array(
            'shopId'	=>$shopId,
            'operation'      =>$operation
        ));
        //var_dump($shopId);
        $this->smarty->displayFrame('Restaurant/shop_category.tpl');
    }

}