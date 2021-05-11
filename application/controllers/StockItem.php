<?php defined('BASEPATH') OR exit('No direct script access allowed');

class StockItem extends CI_Controller{
    
    public function __construct()
    {   
        parent::__construct();
        $this->load->model('stockitemmodel', 'model');
        $this->load->model('vendormodel', 'vendor');
        $this->load->model('requestlistmodel', 'request');
        $this->config->load('setting');
    }

    public function manage(){
        $data = new stdClass();
        
        $data->stockitems = $this->model->get('id')->result();
        $data->request = $this->request->get('id')->result();
        $data->title = "Manage Stock Items";
        $data->modalTitle = "Item Details";
        $data->count = 0;
        $data->approvalStatus = get_status('approval');
        $this->load->view('templates/header', $data);
		$this->load->view('items/manage');
		$this->load->view('templates/footer');
    }

    public function getstocksummary($id){
        $this->load->model('issueditemsmodel', 'issueditems');
        $stock = $this->issueditems->getByItemId($id)->result();
        header('Content-type: application/json');
        echo send_json(array(
                'data' => $stock,
                'message' => 'success'));
    }
    
    public function create(){
        $this->load->library('form_validation');
        $data = new stdClass();
        $data->approvalStatus = get_status('approval');
        $data->vendors = $this->vendor->get('name')->result();
        $data->title = "Create New Request";
        $this->load->view('templates/header', $data);
		$this->load->view('items/create');
		$this->load->view('templates/footer');
    }
    
    public function save(){
        $this->load->helper('db_helper');
        
        $this->validate_form();
        if ($this->form_validation->run()) {
            
            $form_data = $this->getInputFromPost();
            if($this->model->insert($form_data)){
                set_flashdata('success', "New Request succesfully added");
            }else{
                set_flashdata('error', 'Sorry Request addition failed, Please Try Again!!!');
            }
            
            redirect('stockitem/manage');
        }else{
            echo validation_errors();
        }
    }
    
    public function edit($id){
        $this->load->helper('db_helper');
        $data = new stdClass();
        if(!is_numeric($id)){
            $this->session->set_flashdata('invalid ID');
            redirect('stockitem/create','refresh');
        }
        
        $data->item = $this->model->getWhere($id)->row();
        $data->title = "Edit Driver";
        $data->approvalStatus = get_status('approval');
        $this->load->view('templates/header', $data);
		$this->load->view('items/edit');
		$this->load->view('templates/footer');
    }
    
    
    public function update($id){
        $form_data = $this->getinputFromPost();
        $this->validate_form();
        if ($this->form_validation->run()) {
            unset($form_data['entry_by']);
            unset($form_data['entry_by_id']);
            unset($form_data['entry_date']);
            if($this->model->update($id, $form_data)){
                set_flashdata('success', "New Request succesfully Updated");
            }else{
                set_flashdata('error', 'Sorry Request update failed, Please Try Again!!!');
            }
            
            redirect('stockitem/manage');
        }else{
            echo validation_errors();
        }
    }
    
    public function delete($id){
        if($this->model->delete($id)) set_flashdata('success', 'Request List Successfully Deleted');
        redirect('stockitem/manage');
    }
    
    public function validate_form(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('item_name','Item Name',  'trim|required');
        $this->form_validation->set_rules('description','Description',  'trim');
    }

    public function getVendorName($vendor_id){
        $vendor = $this->vendor->getWhere($vendor_id)->row();
        return $vendor->name;
    }

    public function getInputFromPost(){
        $form_data['item_name'] = $this->input->post('item_name', true);
        $form_data['description'] = $this->input->post('description', true);
        $form_data['entry_by'] = 'Admin';
        $form_data['entry_by_id'] = '1';
        $form_data['entry_date'] = date('Y-m-d H:i:s');

        return $form_data;
    }

    public function unit_price_check($price){
        if(!is_numeric($price)){
            $this->form_validation->set_message('unit_price_check', 'The {field} field has to be a number');
            return FALSE;
        }else{
            return TRUE;
        }
    }
    
    public function unit_price_zero_check($price){
        if($price <= 0){
            $this->form_validation->set_message('unit_price_zero_check', 'The {field} field must be greater than zero(0)');
            return FALSE;
        }else{
            return TRUE;
        }
            
    }
    
}