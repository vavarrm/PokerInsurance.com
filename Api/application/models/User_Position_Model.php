<?php

class User_Position_Model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
       // $this->load->database();
        $this->table="user_position_book";
        $this->JoinTable="user";
        $this->joinTable_postion="position";
        $this->InnerJoin="user.u_id=user_position_book.u_id";
        $this->InnerJoin_pos="position.p_id=user_position_book.p_id";
    }

    public function index(){



    }

    public function listLocation($id){

        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->join($this->JoinTable,$this->InnerJoin);
        $this->db->join($this->joinTable_postion,$this->InnerJoin_pos);
        $this->db->where('user.u_id',$id);
        $query=$this->db->get();
        if($query->num_rows() >0){
            return $query->result();

        }else{
            return false;
        }
    }

    public function My_loac($id){

        $this->db->select("*");
        $this->db->from('user_position_book');
       // $this->db->join('position','position.p_id=user_position_book.p_id');
        $this->db->where('user_position_book.u_id',$id);
        $query=$this->db->get();
        if($query->num_rows() >0){
            return $query->result();
        }else{
            return false;
        }

    }

    public function insert($post)
    {
        $this->db->insert($this->table, $post);
        return true;

    }

    public  function Insert_Select(){

    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('u_position_id', $id);
        $this->db->delete($this->table);
    }



}