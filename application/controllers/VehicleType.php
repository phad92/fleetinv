<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class VehicleType extends CI_Controller{

    public function __construct()
    {
        // $this->load->model('VehicleType');
        parent::__construct();
        $this->load->model('vehicletypemodel','model');
    }

    public function manage(){
        $data = new stdClass();
        $data->approvalStatus = get_status('approval');
        $data->vehicle_types = $this->model->get('vehicle_type')->result();
        $data->title = "Manage Vehicle Types";
        $data->count = 0;
        $this->load->view('templates/header', $data);
        $this->load->view('vehicle_type/manage');
        $this->load->view('templates/footer');
    }

    public function create(){
        $data = new stdClass();
        $data->approvalStatus = get_status('approval');
        $data->title = "Create New Vehicle Type";
        $this->load->view('templates/header', $data);
        $this->load->view('vehicle_type/create');
        $this->load->view('templates/footer');
    }

    public function save(){
        $data = new stdClass();
        $this->load->library('form_validation');

        $this->form_validation->set_rules('vehicle_type', 'Vehicle Type', 'trim|required');
        if($this->form_validation->run()){
            $form_data['vehicle_type'] = $this->input->post('vehicle_type', true);
            $form_data['entry_by'] = 'Admin';
            $form_data['entry_by_id'] = '1';
            $form_data['entry_date'] = date('Y-m-d H:i:s');

            if($this->model->insert($form_data)){
                set_flashdata('success', 'New Vehicle Type Successfully Created');
            }else{
                set_flashdata('error', 'New Vehicle Type could not be create. Please Try Again!!!');
            }
        }else{
            $data->errors = validation_errors('<span class="error">', '</span>');
        }

        redirect('vehicletype/create');
    }

    public function edit($id){
        $data = new stdClass();

        $data->record = $this->model->getWhere($id)->row();
        $data->approvalStatus = get_status('approval');
        $data->title = "Edit Vehicle Type";
        $this->load->view('templates/header', $data);
        $this->load->view('vehicle_type/edit');
        $this->load->view('templates/footer');
    }

    public function update($id){
        $data = new stdClass();
        $this->load->library('form_validation');

        $this->form_validation->set_rules('vehicle_type', 'Vehicle Type', 'trim|required');
        // die($this->form_validation->run());
        if($this->form_validation->run()){
            $form_data['vehicle_type'] = $this->input->post('vehicle_type', true);
            $form_data['entry_by'] = 'Admin';
            $form_data['entry_by_id'] = '1';
            $form_data['entry_date'] = date('Y-m-d H:i:s');

            if($this->model->update($id, $form_data)){
                set_flashdata('success', 'New Vehicle Type Successfully Created');
            }else{
                set_flashdata('error', 'New Vehicle Type could not be create. Please Try Again!!!');
            }
        }else{
            $data->errors = validation_errors('<span class="error">', '</span>');
        }

        redirect('vehicletype/edit/'.$id);
    }

    public function delete($id){
        if($this->model->delete($id)) set_flashdata('success', 'Vehicle Type Successfully Deleted');
        redirect('vehicletype/manage');
    }
}