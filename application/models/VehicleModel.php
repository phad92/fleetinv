<?php defined('BASEPATH') OR exit('No direct script access allowed');


class VehicleModel extends CI_Model{

    public function __construct(){
        $this->tablename = 'tbl_vehicle';
    }
    
    public function get($order_by){
        $this->db->order_by($order_by);
        return $this->db->get($this->tablename);
    }

    public function getWhere($id){
        $this->db->where('vehicle_id', $id);
        return $this->db->get($this->tablename);
    }

    public function insert($data){
        return $this->db->insert($this->tablename, $data);    
    }

    public function last_id(){
        return $this->db->insert_id();
    }

    public function update($id, $data){
        $this->db->where('vehicle_id', $id);
        return $this->db->update($this->tablename, $data);
    }

    public function delete($id){
        $this->db->where('vehicle_id', $id);
        return $this->db->delete($this->tablename);
    }
}