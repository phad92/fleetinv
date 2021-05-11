<?php defined('BASEPATH') OR exit('No direct script access allowed');


class RequestItemVehicleModel extends CI_Model{

    public function __construct(){
        $this->tablename = 'tbl_request_item_vehicle';
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

    public function batchUpdateByRequestId($request_id, $batch){
        return $this->db->update_batch($this->tablename, $batch, 'id');
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