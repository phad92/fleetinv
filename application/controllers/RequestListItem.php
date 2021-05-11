<?php defined('BASEPATH') OR exit('No direct script access allowed');

class RequestListItem extends CI_Controller{
    // private $status;

    public function __construct()
    {   
        parent::__construct();
        $this->load->helper('db_helper');
        $this->load->model('requestlistitemModel', 'model');
        // $this->load->model('requestitemvehiclemodel', 'model');
        $this->load->model('stockitemmodel', 'stockitem');
        $this->load->model('requestlistmodel', 'request');
        $this->load->model('vehiclemodel', 'vehicle');
        $this->load->model('vendormodel', 'vendor');
        $this->config->load('setting');
    }

    
    public function fetchRequestsById(){
        $request_id = $_GET['request_id'];

        if(!is_numeric($request_id)){
            echo send_json(array('message' => 'error', 'data' => 'invalid ID'));
            return;
        }

        $request = $this->model->getByRequestId($request_id)->result();

        echo send_json(array('message' => 'success', 'data' => $request));
    }
    //check sum of item qty dont exceed total quantity
    //move excess to inventory / stock
    public function manage(){
        $data = new stdClass();
        $requestId = $this->input->get('requestId');
        
        $this->load->model('vehiclemodel','vehicle');
        $vehicles = $this->vehicle->get('vehicle_id')->result();

        $requestList = $this->request->getWhere($requestId)->row();
        if(!is_numeric($requestId) || !isset($vehicles)){
            set_flashdata('info', 'Please create fill request form first, then add Items to the list');
            redirect('requestlist/create');
        }

        $data->approvalStatus = $this->config->item('approval');

        $data->request = $requestList;
        $data->vehicles = $vehicles;
        $data->vendors = $this->vendor->get('id')->result();
        $data->stockitems = $this->stockitem->get('id')->result();
        $data->hideActions = false;
        $data->issued_qty = get_assigned_qty($requestId, $data->approvalStatus['approved']);
        $data->assigned_qty = get_assigned_qty($requestId);
        $data->requestitems = $this->model->getByRequestId($requestId)->result();
        $data->title = "Manage Request Item List";
        $data->modalTitle = "Request Item";
        $data->count = 0;
        // pp($data);
        $this->load->view('templates/header', $data);
        $this->load->view('requestlist/edit');
		$this->load->view('requestlist/itemlist');
		$this->load->view('templates/footer');
    }

    public function addvehicle(){

        $form_data = $this->getInputFromPost();
        $vehicle = $this->vehicle->getWhere($this->input->post('vehicle_id'))->row();
        // pp($vehicle);
        $form_data['vehicle_no'] = $vehicle->vehicle_no;
        $form_data['qty'] = $this->input->post('qty');

        // pp($form_data);
        if($this->model->insert($form_data)){
            set_flashdata('success', "New Request Item succesfully added");
        }else{
            set_flashdata('error', 'Sorry Request Item addition failed, Please Try Again!!!');
        }
        
        redirect($_SERVER['HTTP_REFERER']); ///change to requestlistitem/manage
    }
    
    public function create(){
        $this->load->library('form_validation');
        $data = new stdClass();
        $data->title = "Create New Request";
        $this->load->view('templates/header');
		$this->load->view('requestlist/itemlist', $data);
		$this->load->view('templates/footer');
    }
    
    public function save(){
        $this->load->helper('db_helper');
        $data = new stdClass();

        $this->validate_form();
        
        if ($this->form_validation->run()) {

            $form_data = $this->getInputFromPost();
            $requestlist = $this->request->getWhere($form_data['request_id'])->row();
            $assigned_qty = get_total_assigned_qty($form_data['request_id'], $form_data['qty']);
            
            $vehicle = $this->vehicle->getWhere($form_data['vehicle_id'])->row();
            $form_data['vehicle_no'] = $vehicle->vehicle_no;
            // pp($form_data);

            if($assigned_qty > $requestlist->total_qty){
                set_flashdata('error', 'total quantity must be less that total requested qty');
                redirect("requestlistitem/manage?requestId=".$form_data['request_id']); ///change to requestlistitem/manage
            }

            
            if($this->model->insert($form_data)){
                set_flashdata('success', "New Request Item succesfully added");
            }else{
                set_flashdata('error', 'Sorry Request Item addition failed, Please Try Again!!!');
            }
            
            redirect($_SERVER['HTTP_REFERER']); ///change to requestlistitem/manage
        }else{
            echo validation_errors();
        }
    }
        
    public function edit($id){
        $this->load->helper('db_helper');
        $data = new stdClass();
        if(!is_numeric($id)){
            $this->session->set_flashdata('invalid ID');
            redirect('requestlist/create','refresh');
        }
        
        $data->driver = $this->model->getWhere($id)->row();
        $data->approvalStatus = $this->config->item('approval');
        $data->title = "Edit Driver";
        $this->load->view('templates/header', $data);
        $this->load->view('requestlist/edit');
        $this->load->view('templates/footer');
    }
        
    public function update($id){
        $this->validate_form();
        if ($this->form_validation->run()) {
            
            $form_data = $this->getInputFromPost();
            $requestlist = $this->request->getWhere($form_data['request_id'])->row();
            
            $issued_qty = get_total_assigned_qty($form_data['request_id'], $form_data['qty']);
            $total_issued = $issued_qty;
            
            if($total_issued > $requestlist->total_qty){
                set_flashdata('error', 'total quantity must be less that total requested qty');
                redirect("requestlistitem/manage?requestId=".$form_data['request_id']); ///change to requestlistitem/manage
            }
            unset($form_data['vehicle_id']);
            if($this->model->update($id, $form_data)){
                set_flashdata('success', "Request Item succesfully Updated");
            }else{
                set_flashdata('error', 'Sorry Request update failed, Please Try Again!!!');
            }
            redirect('requestlistitem/manage?requestId='.$form_data['request_id']);
        }else{
            echo validation_errors();
        }
    }

    public function delete($id){

        if($this->model->delete($id)){
            // $item = $this->model->getWhere()
        }
        
        set_flashdata('success', 'Request List Successfully Deleted');
    
        redirect($_SERVER['HTTP_REFERER']);
    }

   
    public function updateRequestTotalAmount($request_id){
        $requestItems = $this->model->getbyRequestId($request_id)->result();
        
        $totalAmount = 0;
        foreach($requestItems as $record){
            $totalAmount += $record->amount;
        }

        $data['total_amount'] = $totalAmount;
        $this->request->update($request_id, $data);
    }

    public function validate_form(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('qty','Quantity',  'trim|min_length[0]|required');
    }

    public function getInputFromPost(){
        $this->config->load('setting');
        $status = $this->config->item('approval');

        $form_data['vehicle_id'] = $this->input->post('vehicle_id', true);
        // $form_data['re_assigned_to'] = $this->input->post('re_assigned_to', true);
        $form_data['qty'] = $this->input->post('qty', true);
        $form_data['request_id'] = $this->input->post('request_id', true);
        $form_data['status'] = $status['pending_approval'];
        $form_data['entry_date'] = date('Y-m-d H:i:s');
        return $form_data;
    }

    
}