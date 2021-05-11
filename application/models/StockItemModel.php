<?php defined('BASEPATH') OR exit('No direct script access allowed');


class StockItemModel extends CI_Model{

    public function __construct(){
        $this->tablename = 'tbl_stock_items';
    }
    
    public function get($order_by){
        $this->db->order_by($order_by, 'desc');
        return $this->db->get($this->tablename);
    }

    public function getWhere($id){
        $this->db->where('id', $id);
        return $this->db->get($this->tablename);
    }

    public function getByRequestId($requestId){
        $this->db->where('request_id', $requestId);
        return $this->db->get($this->tablename);
    }
    public function getByItemId($item_id){
        $this->db->where('item_id', $item_id);
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