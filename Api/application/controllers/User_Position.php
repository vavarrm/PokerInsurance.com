<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2/9/18
 * Time: 11:20 AM
 */
class User_Position extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->Model('User_Position_Model','position');
        $this->load->helper('url');
    }
    public function doInsert(){

        $map=$this->input->post('o_position_id');
        $query = $this->db->query("select p_lat ,p_lng,p_title from position where p_id='$map'");
        foreach ($query->result() as $row)
        {
        $data = array(
            'p_id' => $this->input->post('o_position_id'),
            'description' => $this->input->post('desc'),
            'u_id' => $this->input->post('u_id'),
            'u_p_b_late'=>$row->p_lat,
            'u_p_b_lag'=>$row->p_lng,
            'u_p_b_titel'=>$row->p_title,
        );
        }

        $result=$this->position->insert($data);
        if($result){
            redirect('/profile');
        }
    }
    public function ajax_edit($id)
    {
        $data = $this->person->get_by_id($id);
        echo json_encode($data);
    }
    public function ajax_delete($id)
    {
        $this->person->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }




}