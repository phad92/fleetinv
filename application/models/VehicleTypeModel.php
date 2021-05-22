<?php defined('BASEPATH') OR exit('No direct script access allowed');


class VehicleTypeModel extends CI_Model{

    public function __construct(){
        $this->tablename = 'tbl_vehicle_type';
    }
    
    public function get($order_by = 'vehicle_type_id'){
        $this->db->order_by($order_by);
        return $this->db->get($this->tablename);
    }

    public function getWhere($id){
        $this->db->where('vehicle_type_id', $id);
        return $this->db->get($this->tablename);
    }

    public function insert($data){
        return $this->db->insert($this->tablename, $data);    
    }

    public function update($id, $data){
        $this->db->where('vehicle_type_id', $id);
        return $this->db->update($this->tablename, $data);
    }

    public function delete($id){
        $this->db->where('vehicle_type_id', $id);
        return $this->db->delete($this->tablename);
    }
}