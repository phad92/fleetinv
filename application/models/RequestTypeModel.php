<?php defined('BASEPATH') OR exit('No direct script access allowed');


class RequestTypeModel extends CI_Model{

    public function __construct(){
        $this->tablename = 'tbl_request_types';
    }
    
    public function get($order_by){
        $this->db->order_by($order_by);
        return $this->db->get($this->tablename);
    }

    public function getWhere($id){
        $this->db->where('id', $id);
        return $this->db->get($this->tablename);
    }

    public function insert($data){
        return $this->db->insert($this->tablename, $data);    
    }

    public function update($id, $data){
        $this->db->where('id', $id);
        return $this->db->update($this->tablename, $data);
    }

    public function delete($id){
        $this->db->where('id', $id);
        return $this->db->delete($this->tablename);
    }
}