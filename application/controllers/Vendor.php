<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller{

    public function __construct()
    {   
        parent::__construct();
        $this->load->model('vendormodel', 'model');
    }

    public function manage(){
        $data = new stdClass();

        $data->approvalStatus = get_status('approval');
        $data->vendors = $this->model->get('name')->result();
        $data->title = "Manage Vendor List";
        $data->count = 0;
        $this->load->view('templates/header', $data);
		$this->load->view('vendors/manage');
		$this->load->view('templates/footer');
    }
    
    
    public function create(){
        $this->load->library('form_validation');
        $data = new stdClass();
        $data->title = "Add New Vendor";
        $this->load->view('templates/header');
		$this->load->view('vendors/create', $data);
		$this->load->view('templates/footer');
    }
    
    public function save(){
        $this->load->library('form_validation');
        $this->load->helper('db_helper');
    
        $this->validate_form();
        
        if ($this->form_validation->run()) {

            $form_data = $this->getInputFromPost();
            
            if($this->model->insert($form_data)){
                set_flashdata('success', "New Vendor succesfully added");
            }else{
                set_flashdata('error', 'Sorry Vendor addition failed, Please Try Again!!!');
            }
            redirect("vendor/manage"); 
            
        }else{
            redirect("vendor/create");
        }
        
    }

        
    public function edit($id){
        $this->load->helper('db_helper');
        $data = new stdClass();
        if(!is_numeric($id)){
            $this->session->set_flashdata('invalid ID');
            redirect('vendors/create','refresh');
        }
        $data->vendor = $this->model->getWhere($id)->row();
        $data->title = "Edit Vendor";
        $this->load->view('templates/header');
        $this->load->view('vendors/edit', $data);
        $this->load->view('templates/footer');
    }
        
    public function update($id){
        $this->validate_form();
        if ($this->form_validation->run()) {
            
        $form_data = $this->getInputFromPost();
        if($this->model->update($id, $form_data)){
            
            unset($form_data['entry_date']);
            set_flashdata('success', "Vendor succesfully Updated");
        }else{
            set_flashdata('error', 'Sorry Request update failed, Please Try Again!!!');
        }
            redirect('vendor/manage');
        }else{
            echo validation_errors();
        }
    }

    public function delete($id){
        
        if($this->model->delete($id)) set_flashdata('success', 'Request List Successfully Deleted');
        redirect('vendor/manage');
    }


    public function validate_form(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','Vendor Name',  'trim|required');
        $this->form_validation->set_rules('phone','Phone Number',  'trim|numeric|max_length[10]|required');
        $this->form_validation->set_rules('email','Email Address',  'trim|valid_email|required');
    }

    public function getInputFromPost(){
        $form_data['name'] = $this->input->post('name', true);
        $form_data['email'] = $this->input->post('email', true);
        $form_data['phone'] = $this->input->post('phone', true);
        $form_data['entry_by'] = 'admin';
        $form_data['entry_date'] = date('Y-m-d H:i:s');
        return $form_data;
    }

    
}