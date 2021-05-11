<?php defined('BASEPATH') OR exit('No direct script access allowed');


class IssuedItemsModel extends CI_Model{

    public function __construct(){
        $this->tablename = 'tbl_issued_items';
    }
    
    public function get($order_by){
        $this->db->order_by($order_by, 'desc');
        return $this->db->get($this->tablename);
    }
    
    public function getWhere($id){
        $this->db->where('id', $id);
        $this->db->order_by('id', 'desc');
        return $this->db->get($this->tablename);
    }
    
    public function getByItemId($item_id){
        $this->db->where('item_id', $item_id);
        $this->db->order_by('id', 'desc');
        return $this->db->get($this->tablename);
    }
    public function getByRequestId($request_id){
        $this->db->where('request_id', $request_id);
        $this->db->order_by('id', 'desc');
        return $this->db->get($this->tablename);
    }
    
    public function updateByRequestId($request_id, $data){
        $this->db->where('request_id', $request_id);
        return $this->db->update($this->tablename, $data);
    }

    public function updateByItemId($item_id, $data){
        $this->db->where('item_id', $item_id);
        return $this->db->update($this->tablename, $data);
    }

    public function batchUpdateByRequestId($request_id, $batch){
        return $this->db->update_batch($this->tablename, $batch, 'id');
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
}