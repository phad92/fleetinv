<?php defined('BASEPATH') OR exit('No direct script access allowed');


class RequestListModel extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->tablename = 'tbl_request_list';
        
    }
    
    public function get($order_by = 'id'){
        $this->db->order_by($order_by, 'desc');
        return $this->db->get($this->tablename);
    }

    public function getWhere($id){
        $this->db->where('id', $id);
        $this->db->order_by('id', 'desc');
        return $this->db->get($this->tablename);
    }

    public function getRequestWithActivities($order_by){  
        $this->db->select('*,ra.id as activity_id, ra.request_id as id, ra.entry_by as by');
        $this->db->from($this->tablename.' as rl');
        $this->db->join('tbl_request_activities as ra', 'ra.request_id = rl.id', 'left');
        $this->db->order_by('ra.'.$order_by, 'desc');
        // $this->db->group_by('ra.request_status');
        $this->db->order_by('id', 'desc');
        return $this->db->get();
    }
    
    public function getRequestWithActivitiesByStatus($status=null){  
        $this->db->select('*,ra.id as activity_id, ra.request_id as id, ra.entry_by as by, rl.request_status as status');
        $this->db->from($this->tablename.' as rl');
        $this->db->where('rl.request_status', $status);
        $this->db->join('tbl_request_activities as ra', 'ra.request_id = rl.id', 'left');
        $this->db->order_by('rl.id', 'desc');
        return $this->db->get();
    }
    
    public function getRequestWithActivitiesByRequestId($request_id=null){  
        $this->db->select('*,ra.id as activity_id, ra.request_id as id, ra.entry_by as by');
        $this->db->from($this->tablename.' as rl');
        $this->db->where('rl.id', $request_id);
        $this->db->join('tbl_request_activities as ra', 'ra.request_id = rl.id');
        $this->db->order_by('rl.id', 'desc');
        return $this->db->get();
    }
    
    public function getRequestWithActivitiesByRequestIdAndStatus($request_id, $status){
        $this->db->from($this->tablename.' as rl');
        $this->db->where('ra.request_id', $request_id);
        $this->db->where('ra.request_status', $status);
        $this->db->join('tbl_request_activities as ra', 'ra.request_id = rl.id');
        $this->db->order_by('rl.id', 'desc');
        return $this->db->get();
    }

    public function getRequestByStatus($status){
        $this->db->where('request_status', $status);
        $this->db->order_by('id', 'desc');
        return $this->db->get($this->tablename);
    }

    public function getRequestWithStatus($status){
        $this->db->select('count(request_status) as status');
        // $this->db->where_in('request_status', $status);
        $this->db->order_by('id', 'desc');
        return $this->db->get($this->tablename);
    }

     public function batchUpdateByRequestId($batch){
        return $this->db->update_batch($this->tablename, $batch, 'id');
    }
    
    public function getByRequestId($requestId){
        $this->db->where('request_id', $requestId);
        $this->db->order_by('id', 'desc');
        return $this->db->get($this->tablename);
    }

    public function insert($data){
        return $this->db->insert($this->tablename, $data);    
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