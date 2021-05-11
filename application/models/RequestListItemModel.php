<?php defined('BASEPATH') OR exit('No direct script access allowed');


class RequestListItemModel extends CI_Model{

    public function __construct(){
        $this->tablename = 'tbl_request_list_items';
    }
    
    public function get($order_by){
        $this->db->order_by($order_by);
        return $this->db->get($this->tablename);
    }
    
    public function getWhere($id){
        $this->db->where('id', $id);
        return $this->db->get($this->tablename);
    }
    
    public function getByRequestId($request_id){
        $this->db->where('request_id', $request_id);
        return $this->db->get($this->tablename);
    }
    
    public function updateByRequestId($request_id, $data){
        $this->db->where('request_id', $request_id);
        return $this->db->update($this->tablename, $data);
    }

    public function update_batch($batch, $col = 'id'){
        return $this->db->update_batch($this->tablename, $batch,$col);
    }

    public function insert($data){
        return $this->db->insert($this->tablename, $data);    
    }

    public function insert_batch($data){
        return $this->db->insert_batch($this->tablename, $data);    
    }
    public function last_id(){
        return $this->db->insert_id();    
    }

    public function update($id, $data){
        $this->db->where('id', $id);
        return $this->db->update($this->tablename, $data);
    }

    public function delete($id){
        $this->db->where('id', $id);
        return $this->db->delete($this->tablename);
    }
    
    public function deleteByRequestId($request_id){
        
        $this->db->where('request_id', $request_id);
        return $this->db->delete($this->tablename);
    }
}