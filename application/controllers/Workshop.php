<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Workshop extends CI_Controller{
    
    public function __construct()
    {
        // $this->load->model('VehicleType');
        parent::__construct();
        $this->load->model('requesttypemodel','model');
        $this->load->library('form_validation');
        $this->load->model('vehiclemodel', 'vehicle');
        $this->load->model('vehicletypemodel', 'vehicletype');
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
    
    public function newService(){
        $data = new stdClass();
        $data->approvalStatus = get_status('approval');
        $data->requesttypes = $this->model->get('id')->result();
        // pp($data->requesttypes);
        $data->vehicles = $this->vehicle->get('vehicle_id')->result();
        $data->vehicle_types = $this->vehicletype->get()->result();
        $data->count = 0;
        $data->title = "New Service";
        $this->load->view('templates/header', $data);
        $this->load->view('workshop/create');
        // $this->load->view('requesttype/manage');
        $this->load->view('templates/footer');
    }
    
    public function steptwo(){
        $data = new stdClass();
        $vehicle_id = $this->input->get('vehicle_id');
        
        $data->vehicle = $this->vehicle->getWhere($vehicle_id)->row();
        $data->title = 'WorkShop Step 2';
        
        $this->load->view('templates/header', $data);
        $this->load->view('workshop/steptwo');
        // $this->load->view('requesttype/manage');
        $this->load->view('templates/footer');
    }
    
    public function stepthree(){
        $data = new stdClass();
        $data->vehicle = $this->vehicle->getWhere($this->input->post('vehicle_id'))->row();
        $this->form_validation->set_rules('mileage', 'Mileage', 'trim|numeric|required');
        // $this->form_validation->set_rules('package', 'Package', 'required');
        $form_data['mileage'] = $this->input->post('mileage', true);
        $form_data['package'] = serialize($this->input->post('package', true));

        if($this->form_validation->run()){


            $this->session->set_userdata('packages', $form_data);
        }else{
            set_flashdata('error',validation_errors());
        }
        // $packages = [];
        
        foreach (unserialize($form_data['package']) as $value) {
            $x = explode('_', $value);
            $packages[] = $x[0];
        }

        // pp(implode(', ',$packages));
        $data->mileage = $form_data['mileage'];
        $data->packages = implode(', ', $packages);
        $this->session->set_userdata('package_str', $data->packages);
        $data->title = 'WorkShop Step 3';
        $this->load->view('templates/header', $data);
        $this->load->view('workshop/stepthree');
        // $this->load->view('requesttype/manage');
        $this->load->view('templates/footer');
    }

    public function stepfour(){
        $data = new stdClass();

        $this->form_validation->set_rules('tyres', 'Tyres', 'trim|required');
        $this->form_validation->set_rules('steering', 'Steering', 'trim|required');
        $this->form_validation->set_rules('engine', 'Engine', 'trim|required');
        $this->form_validation->set_rules('suspension', 'Suspension', 'trim|required');
        $this->form_validation->set_rules('battery', 'Battery', 'trim|required');
        $this->form_validation->set_rules('others', 'Others', 'trim|required');
        $vehicle_id = $this->input->post('vehicle_id');
        $data->vehicle = $this->vehicle->getWhere($vehicle_id)->row();
        if($this->form_validation->run()){
            $form_data['tyres'] = $this->input->post('tyres', true);
            $form_data['steering'] = $this->input->post('steering', true);
            $form_data['engine'] = $this->input->post('engine', true);
            $form_data['battery'] = $this->input->post('battery', true);
            $form_data['suspension'] = $this->input->post('suspension', true);
            $form_data['others'] = $this->input->post('others', true);

            $this->session->set_userdata('defects', $form_data);

            
        }else{
            pp(validation_errors());
            set_flashdata('error', validation_errors());

            redirect($_SERVER['HTTP_REFERER']);
        }

        $package = unserialize($this->session->userdata('packages')['package']);
        $p = [];
        foreach($package as $key => $value){
            $x = explode('_', $value);
            $p[$key]['name'] = $x[0];
            $p[$key]['price'] = $x[1];
        }
        $defects = $this->session->userdata('defects');
        // pp($defects);
        $data->defects = $defects;
        $data->title = "WorkShop Step 4";
        $data->mileage = $this->session->userdata('packages')['mileage'];
        $data->packages = $p;

        // $data->packages = $this->session->userdata('package_str');
        $this->load->view('templates/header', $data);
        $this->load->view('workshop/stepfour');
        // $this->load->view('requesttype/manage');
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