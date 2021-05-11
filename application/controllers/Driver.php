<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Driver extends CI_Controller{
    private $name;

    public function __construct()
    {   
        parent::__construct();
        $this->load->model('drivermodel', 'model');
    }

    public function manage(){
        $data = new stdClass();
        $data->drivers = $this->model->get('firstname')->result();
        $data->title = "Manage Drivers";
        $data->count = 0;
        $this->load->view('templates/header');
		$this->load->view('driver/manage', $data);
		$this->load->view('templates/footer');
    }
    
    
    public function create(){
        $this->load->library('form_validation');
        $data = new stdClass();
        $data->title = "Add New Driver";
        $this->load->view('templates/header');
		$this->load->view('driver/create', $data);
		$this->load->view('templates/footer');
    }
    
    public function save(){
        $this->load->library('form_validation');
        $this->load->helper('db_helper');
        $data = new stdClass();

        $this->form_validation->set_rules('firstname','First Name',  'trim|required');
        $this->form_validation->set_rules('lastname','Last Name',  'trim|required');
        $this->form_validation->set_rules('phone','Phone Number', 'trim|numeric|required');
        
        if ($this->form_validation->run()) {

            $form_data['firstname'] = $this->input->post('firstname', true);
            $form_data['lastname'] = $this->input->post('lastname', true);
            $form_data['phone'] = $this->input->post('phone', true);
            $form_data['entry_by'] = 'Admin';
            $form_data['entry_by_id'] = '1';
            $form_data['entry_date'] = date('Y-m-d H:i:s');
            
            // pp($form_data);
            if($this->model->insert($form_data)){
                set_flashdata('success', "New Driver succesfully added");
            }else{
                set_flashdata('error', 'Sorry Driver addition failed, Please Try Again!!!');
            }

            redirect('driver/create');
        }
    }

    public function edit($id){
        $this->load->helper('db_helper');
        $data = new stdClass();
        if(!is_numeric($id)){
            $this->session->set_flashdata('invalid ID');
            redirect('driver/create','refresh');
        }
        $data->driver = $this->model->getWhere($id)->row();
        $data->title = "Edit Driver";
        $this->load->view('templates/header');
		$this->load->view('driver/edit', $data);
		$this->load->view('templates/footer');
    }

    public function update($id){

        $this->load->library('form_validation');

        $this->form_validation->set_rules('firstname','First Name',  'trim|required');
        $this->form_validation->set_rules('lastname','Last Name',  'trim|required');
        $this->form_validation->set_rules('phone','Phone Number', 'trim|numeric|required');
        
        if ($this->form_validation->run()) {

            $form_data['firstname'] = $this->input->post('firstname', true);
            $form_data['lastname'] = $this->input->post('lastname', true);
            $form_data['phone'] = $this->input->post('phone', true);
            $form_data['entry_by'] = 'Admin';
            $form_data['entry_by_id'] = '1';
            $form_data['entry_date'] = date('Y-m-d H:i:s');
            // pp($form_data);
            if($this->model->update($id, $form_data)){
                set_flashdata('success', "New Vehicle succesfully Updated");
            }else{
                set_flashdata('error', 'Sorry Vehicle update failed, Please Try Again!!!');
            }


            redirect('driver/manage');
        }else{
            echo validation_errors();
        }
    }

    public function delete($id){
        if($this->model->delete($id)) set_flashdata('success', 'Vehicle Successfully Deleted');
        redirect('vehicletype/manage');
    }

}