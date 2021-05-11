<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class RequestType extends CI_Controller{
    
    public function __construct()
    {
        // $this->load->model('VehicleType');
        parent::__construct();
        $this->load->model('requesttypemodel','model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function manage(){
        $data = new stdClass();
        $data->approvalStatus = get_status('approval');
        $data->requesttypes = $this->model->get('id')->result();
        $data->title = "Manage Vehicle Types";
        $data->count = 0;
        $this->load->view('templates/header', $data);
        $this->load->view('requesttype/manage');
        $this->load->view('templates/footer');
    }
    
    public function create(){
        $data = new stdClass();
        $data->approvalStatus = get_status('approval');
        $data->requesttypes = $this->model->get('id')->result();
        // pp($data->requesttypes);
        $data->count = 0;
        $data->title = "Create New Request Type";
        $this->load->view('templates/header', $data);
        $this->load->view('requesttype/create');
        $this->load->view('requesttype/manage');
        $this->load->view('templates/footer');
    }
    
    public function save(){
        $data = new stdClass();

        $this->form_validation->set_rules('request_name', 'Request Name', 'trim|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim');
        if($this->form_validation->run()){
            $form_data['request_name'] = $this->input->post('request_name', true);
            $form_data['remarks'] = $this->input->post('remarks', true);
            $form_data['entry_by'] = 'Admin';
            $form_data['entry_by_id'] = 1;
            $form_data['entry_date'] = date('Y-m-d H:i:s');
            
            $this->model->insert($form_data);
            set_flashdata('success', 'New Vehicle Type Successfully Created');
            
        }else{
            set_flashdata('error', validation_errors());
        }
        
        redirect('requesttype/create');
    }
    
    public function edit($id){
        $data = new stdClass();
        
        $data->record = $this->model->getWhere($id)->row();
        $data->approvalStatus = get_status('approval');
        $data->requesttypes = $this->model->get('id')->result();
        $data->title = "Edit Vehicle Type";
        $data->count = 0;
        $this->load->view('templates/header', $data);
        $this->load->view('requesttype/edit');
        $this->load->view('requesttype/manage');
        $this->load->view('templates/footer');
    }
    
    public function update($id){
        $data = new stdClass();
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('request_name', 'Request Name', 'trim|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');
        // die($this->form_validation->run());
        if($this->form_validation->run()){
            $form_data['request_name'] = $this->input->post('request_name', true);
            $form_data['remarks'] = $this->input->post('remarks', true);
            $form_data['entry_by'] = 'Admin';
            $form_data['entry_by_id'] = 1;
            $form_data['entry_date'] = date('Y-m-d H:i:s');

            if($this->model->update($id, $form_data)){
                set_flashdata('success', 'New Vehicle Type Successfully Created');
            }else{
                set_flashdata('error', 'New Vehicle Type could not be create. Please Try Again!!!');
            }
        }else{
            set_flashdata('error', validation_errors());
        }

        redirect('requesttype/edit/'.$id);
    }

    public function delete($id){
        if($this->model->delete($id)) set_flashdata('success', 'Vehicle Type Successfully Deleted');
        redirect($_SERVER['HTTP_REFERER']);
    }
}