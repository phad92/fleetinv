<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class RequestApproval extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('requestlistmodel','model');
    }

    public function manage(){
        $data = new stdClass();
        $this->config->load('setting');
        $data->requestlists = $this->model->get('request_name')->result();
        // pp($data->requestlists);
        $data->title = "Request List for Approval";
        $data->modalTitle = "Request Approval";
        $data->statusColors = $this->config->item('statusColor');
        $data->approvalStatus = $this->config->item('approval');
        $data->count = 0;
        $this->load->view('templates/header', $data);
        $this->load->view('requestapproval/manage', $data);
        $this->load->view('templates/footer');
    } 
    
    
    public function requestlist(){
        $data = new stdClass();
        $status = $this->input->get('status');
        
        $data->requestlists = $this->model->getRequestApprovalByStatus($status)->result();
        $data->title = "Request List Pending Issue";
        $data->statusColors = $this->config->item('statusColor');
        $data->approvalStatus = $this->config->item('approval');
        $this->load->view('templates/header', $data);
        $this->load->view('status/requestlist', $data);
        $this->load->view('templates/footer');
    }

    public function approvalAction($id){
        $data = new stdClass();
        // $form_data['request_name'] = $this->input->post('request_name', true);
        $form_data['request_status'] = $this->input->post('request_status', true);
        $form_data['approval_remarks'] = $this->input->post('approval_remarks', true);
        $form_data['approved_by'] = 'Head of department';
        $form_data['date_approved'] = date('Y-m-d H:i:s');
        // pp($form_data);
        if($this->model->update($id, $form_data)){
            set_flashdata('success', 'New Vehicle Type Successfully Created');
        }else{
            set_flashdata('error', 'New Vehicle Type could not be create. Please Try Again!!!');
        }
       
        redirect('requestApproval/manage/');
    }

    // public function delete($id){
    //     if($this->model->delete($id)) set_flashdata('success', 'Request  Successfully Deleted');
    //     redirect('vehicletype/manage');
    // }
}