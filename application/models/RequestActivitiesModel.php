<?php defined('BASEPATH') OR exit('No direct script access allowed');


class RequestActivitiesmodel extends CI_Model{

    public function __construct(){
        $this->tablename = 'tbl_request_activities';
    }

    public function getByRequestId($request_id){
        $this->db->where('request_id', $request_id);
        $this->db->order_by('id', 'desc');
        return $this->db->get($this->tablename);
    }
    
    public function getByRequestStatus($request_id, $status){
        $this->db->where('request_id', $request_id);
        $this->db->where('request_status', $status);
        return $this->db->get($this->tablename);
    }
    
    
    public function getStatusByRequestId($request_id){
        $this->db->select('request_status');
        $this->db->where('request_id', $request_id);
        $this->db->order_by('id', 'desc');
        return $this->db->get($this->tablename);
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