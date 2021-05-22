<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends CI_Controller{
    private $name;

    public function __construct()
    {   
        parent::__construct();
        $this->load->model('vehiclemodel', 'model');
        $this->load->model('vehicletypemodel', 'vehicletype');
    }

    public function manage(){
        $data = new stdClass();
        $data->vehicles = $this->model->get('vehicle_no')->result();
        $data->title = "Manage Vehicles";
        $data->count = 0;
        $this->load->view('templates/header', $data);
		$this->load->view('vehicle/manage');
		$this->load->view('templates/footer');
    }
    
    
    public function create(){
        $this->load->helper('db_helper');
        $data = new stdClass();
        $this->load->model('vehicletypemodel', 'v_type');
        $data->vehicle_types = $this->v_type->get('vehicle_type')->result();
        $data->title = "Add New Vehicle";
        $this->load->view('templates/header', $data);
		$this->load->view('vehicle/create');
		$this->load->view('templates/footer');
    }

    public function getVehicleJson(){
        $vehicle_id = $_GET['vehicle_id'];
        // pp($vehicle_id);
        $vehicle = $this->model->getWhere($vehicle_id)->row();
        // pp($vehicle);
        echo send_json(array(
            'message' => 'success',
            'data' => $vehicle
        ));
    }

    public function newvehicleajax(){
        $data = $_POST;
        // $form_data['vehicle_id'] = 400;
        $form_data['vehicle_no'] = $this->input->post('vehicle_no');
        $form_data['model_year'] = $this->input->post('model_year');
        $form_data['driver_id'] = 2;
        $form_data['vehicle_type_id'] = $this->input->post('vehicle_type_id');
        $form_data['description'] = $this->input->post('description');
        
        
        $this->form_validation->set_rules('vehicle_no', 'Vehicle Number', 'trim|required');
        $this->form_validation->set_rules('model_year', 'Model Year', 'trim|required');
        $this->form_validation->set_rules('vehicle_type_id', 'Vehicle Category', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        
        if($this->form_validation->run()){
            $vehicleType = $this->vehicletype->getWhere($form_data['vehicle_type_id'])->row();
            $form_data['vehicle_type'] = $vehicleType->vehicle_type;
            if($this->model->insert($form_data)){
                $last_id = $this->model->last_id();
                $vehicle = $this->model->getWhere($last_id)->row();
                echo send_json(array('message' => 'success', 'data' => $vehicle));
            }else{
                echo send_json(array('message' => 'error', 'data' => 'Could Not Add Data Please Try again'));
            }
        }else{
            echo send_json(array('message' => 'error', 'data' => validation_errors()));
        }

    }

    public function getVehicleajax(){
        $vehicle_id = $_GET['selected'];

        $vehicle = $this->model->getWhere($vehicle_id)->row();
        echo send_json(array('message' => 'success', 'data' => $vehicle));
    }
    
    public function save(){
        $this->load->library('form_validation');
        $this->load->helper('db_helper');
        $data = new stdClass();

        $this->form_validation->set_rules('vehicle_no','Vehicle Number',  'trim|required');
        $this->form_validation->set_rules('model_year','Model Year', 'trim|numeric|required');
        $this->form_validation->set_rules('description','Description',  'trim');
        
        if ($this->form_validation->run()) {

            $form_data['vehicle_no'] = $this->input->post('vehicle_no', true);
            $form_data['model_year'] = $this->input->post('model_year', true);
            $form_data['vehicle_type_id'] = $this->input->post('vehicle_type_id', true);
            $form_data['description'] = $this->input->post('description', true);
            $form_data['entry_by'] = 'Admin';
            $form_data['entry_by_id'] = '1';
            $form_data['entry_date'] = date('Y-m-d H:i:s');
            $form_data['driver_id'] = 1;
            
            $form_data['vehicle_type'] = $this->input->post('vehicle_type', true);
            $form_data['driver_name'] = $this->input->post('driver_name', true);
            
            $v_type = foreign_row('vehicletypemodel', $form_data['vehicle_type_id']);
            // if(isset($driver->id)){
                $form_data['driver_id'] = 2;
                $form_data['driver_name'] = null;
            // }
            if(isset($v_type->vehicle_type_id)){
                $form_data['vehicle_type'] = $v_type->vehicle_type;
            }

            // pp($form_data);
            if($this->model->insert($form_data)){
                set_flashdata('success', "New Vehicle succesfully added");
            }else{
                set_flashdata('error', 'Sorry Vehicle addition failed, Please Try Again!!!');
            }

            $data->title = "Create Vehicle";

            redirect('vehicle/create');
        }else{
            echo validation_errors();
        }
    }

    public function edit($id){
        $this->load->helper('db_helper');
        $data = new stdClass();
        if(!is_numeric($id)){
            $this->session->set_flashdata('invalid ID');
            redirect('vehicleController/create','refresh');
        }
        $data->vehicle = $this->model->getWhere($id)->row();
        $data->vehicle_types = foreign_result('vehicletypemodel', 'vehicle_type', 'v_type');
        $data->title = "Edit Vehicle";
        $this->load->view('templates/header', $data);
		$this->load->view('vehicle/edit');
		$this->load->view('templates/footer');
    }

    public function update($id){
        $this->load->helper('db_helper');

        $this->load->library('form_validation');
        $this->load->helper('db_helper');
        $data = new stdClass();

        $this->form_validation->set_rules('vehicle_no','Vehicle Number',  'trim|required');
        $this->form_validation->set_rules('model_year','Model Year', 'trim|numeric|required');
        $this->form_validation->set_rules('description','Description',  'trim');
        
        if ($this->form_validation->run()) {

            $form_data['vehicle_no'] = $this->input->post('vehicle_no', true);
            $form_data['model_year'] = $this->input->post('model_year', true);
            $form_data['vehicle_type_id'] = $this->input->post('vehicle_type_id', true);
            $form_data['description'] = $this->input->post('description', true);
            $form_data['entry_by'] = 'Admin';
            $form_data['entry_by_id'] = '1';
            $form_data['entry_date'] = date('Y-m-d H:i:s');
            $form_data['driver_id'] = 1;
            
            $form_data['vehicle_type'] = $this->input->post('vehicle_type', true);
            $form_data['driver_name'] = $this->input->post('driver_name', true);
            
            $v_type = foreign_row('vehicletypemodel', $form_data['vehicle_type_id']);
            // if(isset($driver->id)){
                $form_data['driver_id'] = 2;
                $form_data['driver_name'] = null;
            // }
            if(isset($v_type->vehicle_type_id)){
                $form_data['vehicle_type'] = $v_type->vehicle_type;
            }

            // pp($form_data);
            if($this->model->update($id, $form_data)){
                set_flashdata('success', "New Vehicle succesfully Updated");
            }else{
                set_flashdata('error', 'Sorry Vehicle update failed, Please Try Again!!!');
            }


            redirect('vehicle/create');
        }else{
            echo validation_errors();
        }
    }

    public function delete($id){
        if($this->model->delete($id)) set_flashdata('success', 'Vehicle Successfully Deleted');
        redirect('vehicletype/manage');
    }

}