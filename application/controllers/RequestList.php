<?php defined('BASEPATH') OR exit('No direct script access allowed');

class RequestList extends CI_Controller{
    
    public function __construct()
    {   
        parent::__construct();
        $this->load->model('requestlistmodel', 'model');
        $this->load->model('vendormodel', 'vendor');
        $this->load->model('stockitemmodel', 'stockitem');
        $this->load->model('requestactivitiesmodel', 'requestactivity');
        $this->load->model('requestlistItemModel', 'requestitems');
        $this->load->model('requesttypemodel', 'requesttype');
        $this->load->model('vehiclemodel', 'vehicle');
        $this->load->helper('db_helper');

    }

    public function index(){
        $this->manage();
    }


    public function saveRequestList(){
        $status = get_status('approval');

        $this->validateRequestForm();
        if($this->form_validation->run()){
            $form_data = $this->getRequestInputData();
            if($this->model->insert($form_data)){
                $last_id = $this->model->last_id();
                $listData = $this->requestListItemData($form_data, $last_id);
                $this->requestitems->insert_batch($listData);
                $data['request_status'] = $status['pending_approval'];
                $data['request_id'] = $last_id;
                $data['qty'] = $form_data['total_qty'];
                $data['entry_by'] = $form_data['entry_by'];
                $data['entry_by_id'] = $form_data['entry_by_id'];
                $data['entry_date'] = $form_data['entry_date'];
                
                $this->requestactivity->insert($data);
                set_flashdata('success', 'New Request Successfully Created');
            }else{
                
                set_flashdata('error', 'New Request Create Unsuccessful');
            }

        }else{
            set_flashdata('error', validation_errors());
        }
        
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function insertAddedRequestItems($listitems, $listData){
        // $lists = $this->requestitems->getByRequestId($request_id)->result_array();
        pp($listitems);
        $newList = [];
        foreach ($listData as $value) {
           

        }

        pp($newList);

    }
    public function updateRequestList($request_id){
        $this->validateRequestForm();
        if($this->form_validation->run()){
            $form_data = $this->getRequestInputData();
            $listData = $this->requestListItemData($form_data, $request_id);
            $listitems = $this->requestitems->getByRequestId($request_id)->result_array();
            if($this->model->update($request_id, $form_data)){
                $this->requestitems->deleteByRequestId($request_id);
                $this->requestitems->insert_batch($listData);
                set_flashdata('success', 'New Request Successfully Updated');
            }else{
                
                set_flashdata('error', 'New Request Create Unsuccessful');
            }

        }else{
            set_flashdata('error', validation_errors());
        }
        
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function requestListItemData($input_data, $request_id){
        $vehicle_no = $this->input->post('vehicle_no');
        $vehicle_id = $this->input->post('vehicle_id');
        $qty = $this->input->post('qty');
        foreach($qty as $key => $value){
            $data[$key]['vehicle_id'] = $vehicle_id[$key];
            $data[$key]['vehicle_no'] = $vehicle_no[$key];
            $data[$key]['item_name'] = $input_data['item_name'];
            $data[$key]['item_id'] = $input_data['item_id'];
            $data[$key]['status'] = $input_data['request_status'];
            $data[$key]['entry_date'] = $input_data['entry_date'];
            $data[$key]['request_name'] = $input_data['request_name'];
            $data[$key]['qty'] = $qty[$key];
            $data[$key]['request_id'] = $request_id;
            
        }

        return $data;
    }

    public function manage(){
        $data = new stdClass();
        
        $requestlists = $this->model->get('id')->result();
    
        $data->requestlists = $requestlists;
        $data->title = "Manage Request Lists";
        $data->statusColors = $this->config->item('statusColor');
        $data->approvalStatus = $this->config->item('approval');
        
        // pp($data->vehicles);
        $data->count = 0;
        $this->load->view('templates/header', $data);
		$this->load->view('requestlist/manage');
		$this->load->view('templates/footer');
    }
    
    public function detail($request_id){
        $data = new stdClass();

        $data->request = $this->model->getWhere($request_id)->row();
        // $data->activities = $this->model->getRequestWithActivitiesByRequestId($request_id)->result();
        $data->activities = $this->requestactivity->getByRequestId($request_id)->result();
        // pp($data->activities);
        $data->approvalStatus = get_status('approval');
        $data->count = 0;
        $data->title = "Request Summary";
        $this->load->view('templates/header', $data);
        $this->load->view('requestlist/show');
        $this->load->view('templates/footer');
    }

    public function jqForm(){
        $vehicle_no = $_POST['vehicle_no'];
        $vehicle_id = $_POST['vehicle_id'];
        // $request_type_id = $_POST['request_type_id'];
        // $vendor_id = $_POST['vendor_id'];
        // $item_id = $_POST['item_id'];
        // $date_needed = $_POST['date_needed'];
        // $unit_price = $_POST['unit_price'];
        // $justification = $_POST['justification'];

        $vehicles = array_merge($vehicle_id, $vehicle_no);
        pp($vehicles);
    }

    public function approveRequest($request_id){
        $data = new stdClass();
        $this->load->model('vehiclemodel', 'vehicle');
        $data->vehicles = $this->vehicle->get('vehicle_no')->result();
        $status = get_status('approval');
        $data->approvalStatus = get_status('approval');
        $request = $this->model->getRequestWithActivitiesByRequestId($request_id)->result();
        $arr = [];

        foreach ($request as  $value) {
            if($value->request_status == $status['approved']
            || $value->request_status == $status['denied']){
                array_push($arr, $value);
            }
        }
        
        $data->request = $request[0];
        // pp($data->request);

        $data->stockitems = $this->stockitem->get('id')->result();
        $data->requestitems = $this->requestitems->getByRequestId($request_id)->result();
        $data->title = "Approve Request";
        $data->modalTitle = "Request Details";
        $data->count = 0;
        $this->load->view('templates/header', $data);
        $this->load->view('requestapproval/approverequest');
        $this->load->view('requestapproval/itemlist');
        $this->load->view('templates/footer');
    }

    public function approveRequestList($request_id){
        $form_data['request_status'] = $this->input->post('request_status');
        $form_data['approval_remarks'] = $this->input->post('approval_remarks');
        
        $this->requestactivity->insert($request_id, $form_data);
    }

    public function updateRequestApproval($request_id){
        $form_data = $this->getActivityData($request_id);

        if(!$this->requestStatusExists($request_id, $form_data['request_status'])){
            
            $status = get_status('approval');
            $d['status'] = $form_data['request_status'];
            $d['qty'] = $this->input->post('qty');
            $request = $this->model->getWhere($request_id)->row();
            $data['request_name'] = $request->request_name;
            $data['item_id'] = $request->item_id;
            $data['item_name'] = $request->item_name;
            // pp($data);
            $this->requestactivity->insert($form_data);
            $data['status'] = $status[$form_data['request_status']];
            $this->requestitems->updateByRequestId($request_id,$data);
            $this->setCurrentStatus($request_id, 'awaiting_receive');
            
            set_flashdata('success', 'Request succesfully approved');
        }else{
            set_flashdata('error', "Request Already Approved");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function receiveRequest($request_id){
        $data = new stdClass();
        $this->load->model('vehiclemodel', 'vehicle');
        $data->vehicles = $this->vehicle->get('vehicle_no')->result();
        $status = get_status('approval');
        $data->approvalStatus = get_status('approval');
        // $request = $this->model->getRequestWithActivitiesByRequestId($request_id)->result();
        $request = $this->model->getWhere($request_id)->row();
        // $arr = [];
        // foreach ($request as  $value) {
        //     if($value->request_status == $status['awaiting_receive']){
        //         array_push($arr, $value);
        //     }
        // }
        
        // pp($request);
        $data->request = $request;
        $data->vendors = $this->vendor->get('id')->result();
        $data->stockitems = $this->stockitem->get('id')->result();
        $data->requestitems = $this->requestitems->getByRequestId($request_id)->result();
        $data->title = "Approve Request";
        $data->modalTitle = "Request Details";
        $data->count = 0;
        $this->load->view('templates/header', $data);
        $this->load->view('requestlist/receive');
        $this->load->view('templates/footer');
    }
    
    public function saveReceiveRequest($request_id){
        $form_data['supplier_id'] = $this->input->post('supplier_id');
        $supplier = $this->vendor->getWhere($form_data['supplier_id'])->row();
        $form_data['supplier_name'] = $supplier->name;

        if(!$this->requestStatusExists($request_id, $this->input->post('request_status'))){
            
            unset($form_data['total_qty']);
            if($this->model->update($request_id, $form_data)){
             $status = get_status('approval');
               $d['qty'] = $this->input->post('qty');
               $d['request_id'] = $request_id;
               $d['request_status'] = $status[$this->input->post('request_status')];
               $this->requestactivity->insert($d);
               $d['request_status'] = $this->input->post('request_status');
               
            //    $request = $this->model->getWhere($request_id)->row();
            //     $data['request_name'] = $request->request_name;
            //     $data['item_id'] = $request->item_id;
            //     $data['item_name'] = $request->item_name;

               $this->updateStockData($d);
               $this->setCurrentStatus($request_id, 'pending_issue');
            //    $this->requestlist->updateByRequestId($request_id, $data);
               set_flashdata('success', 'Request Status Successfully Updated');
            }else{
                set_flashdata('error', 'Request Status Update Failed');
            }
        }else{
            set_flashdata('error', "This Request is already Recieved");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function updateStockData($data){
        $status = get_status('approval');
        $request = $this->model->getWhere($data['request_id'])->row();
        $stock = $this->stockitem->getWhere($request->item_id)->row();
        $stockData = $this->getStockData($data);
        
        $currActivity = $this->model->getRequestWithActivitiesByRequestIdAndStatus($request->id,$status[$data['request_status']])->row();
        if($currActivity->request_status === $status['received']){
            $stockData['stock'] = $stock->stock + $stockData['stock'];
        }

        $this->load->model('stockItemmodel', 'stockmodel');
        $stockData['unit_price'] = $request->unit_price;
        $stockData['inventory'] = $stockData['stock'];
        $stockData['entry_by'] = 'Admin';
        $stockData['entry_by_id'] = 1;
        $stockData['entry_date'] = date('Y-m-d H:i:s');
        // pp($stockData);
        unset($stockData['request_status']);
        unset($stockData['qty']);
        // pp($stockData);
        $this->stockitem->update($request->item_id, $stockData);
    }


    
    public function issueRequest($request_id){
        $data = new stdClass();
        $this->load->model('vehiclemodel', 'vehicle');
        $data->vehicles = $this->vehicle->get('vehicle_no')->result();
        $status = get_status('approval');
        $data->approvalStatus = get_status('approval');
        $request = $this->model->getRequestWithActivitiesByRequestId($request_id)->result();
        $arr = [];
        foreach ($request as  $value) {
            if($value->request_status == $status['awaiting_receive']){
                array_push($arr, $value);
            }
        }
        
        $data->request = $arr[0];
        $data->vendors = $this->vendor->get('id')->result();
        $data->stockitems = $this->stockitem->get('id')->result();
        $data->requestitems = $this->requestitems->getByRequestId($request_id)->result();
        $data->title = "Approve Request";
        $data->modalTitle = "Request Details";
        $data->count = 0;
        $this->load->view('templates/header', $data);
        $this->load->view('requestlist/issueRequest');
        $this->load->view('templates/footer');
    }

     public function issueRequestItem(){
        $this->load->helper('db_helper');
        // $this->validate_form();
        
        // if ($this->form_validation->run()) {
            $form_data = $this->getInputFromIssueModal();
        if(!$this->requestStatusExists($form_data['request_id'], $this->input->post('request_status'))){
        $form_data['serial_no'] = serialize($this->input->post('serial_no'));
        $requestlist = $this->model->getWhere($form_data['request_id'])->row();
        
        $vehicle = $this->vehicle->getWhere($form_data['vehicle_id'])->row();
        $form_data['vehicle_no'] = $vehicle->vehicle_no;
        $issued_qty = get_total_assigned_qty($form_data['request_id'], $form_data['qty']);
        // pp($form_data);
        if($issued_qty > $requestlist->total_qty){
            set_flashdata('error', 'total quantity must be less that total requested qty');
            redirect($_SERVER['HTTP_REFERER']);
        }

        // pp($requestlist);
        
        $form_data['issued_by'] = 'Admin';
        $form_data['issue_by_id'] = 1;
        $form_data['status'] = get_status('approval')['issued'];
        // pp($form_data);
        // $this->->update()
        if($this->requestitems->insert($form_data)){
            $data['request_name'] = $requestlist->request_name;
            $data['item_id'] = $requestlist->item_id;
            $data['item_name'] = $requestlist->item_name;
            $last_id = $this->requestitems->last_id();
            $this->requestitems->update($last_id, $data);
            set_flashdata('success', "New Request Item succesfully added");
        }else{
            set_flashdata('error', 'Sorry Request Item addition failed, Please Try Again!!!');
        }

    }
        
        redirect($_SERVER['HTTP_REFERER']); ///change to requestlistitem/manage
    }
            
    public function reIssueItem($item_id){
        $data = new stdClass();
        $form_data['status'] = $this->input->post('status', true);
        $form_data['re_issued_to'] = $this->input->post('re_issued_to', true);
        $form_data['remarks'] = $this->input->post('remarks', true);
        $form_data['request_id'] = $this->input->post('request_id', true);
        $form_data['issued_by'] = 'Admin';
        $form_data['issue_by_id'] = 1;
        $form_data['status'] = get_status('approval')['issued'];
        $requestlist = $this->model->getWhere($form_data['request_id'])->row();
        $form_data['request_name'] = $requestlist->request_name;
        $form_data['item_id'] = $requestlist->item_id;
        $form_data['item_name'] = $requestlist->item_name;
        
        // $form_data['qty'] = !empty($this->input->post('serial_no')) ? count($this->input->serial_no) : 0;
        $form_data['serial_no'] = serialize(array_filter($this->input->post('serial_no')));
        if(!empty($this->input->post('serial_no'))){
            $qty = 0;
            foreach($this->input->post('serial_no') as $v){
                if(!empty($v)) {
                    $qty += 1;

                }
            }
        }else{
            $qty = 0;
        }
        $form_data['qty'] = $qty;
        $issued_qty = get_assigned_qty($form_data['request_id']);
        if($issued_qty > $requestlist->total_qty){
            set_flashdata('error', 'total quantity must be less that total requested qty');
            redirect($_SERVER['HTTP_REFERER']);
        }
        $form_data['status'] = get_status('approval')['issued'];

        // pp($form_data);
        if($this->requestitems->update($item_id, $form_data)){
            set_flashdata('success', 'Item Status Updated');
        }else{
            set_flashdata('error', 'Item Status Update Fail');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function finalItemIssue($issuedItems){

        $i = 0;
          foreach($issuedItems as $item){
            //   pp($item);
            if(!empty($item->serial_no)){
                foreach(unserialize($item->serial_no) as $x){
                    $issued[$i]['request_id'] = $item->request_id;
                    $issued[$i]['request_name'] = $item->request_name;
                    $issued[$i]['item_id'] = $item->item_id;
                    $issued[$i]['item_name'] = $item->item_name;
                    $issued[$i]['vehicle_no'] = $item->vehicle_no;
                    $issued[$i]['serial_no'] = $x;
                    $issued[$i]['issued_by'] = $item->issued_by;
                    $issued[$i]['issued_by_id'] = $item->issue_by_id;
                    $i++;
                }
            }
        }
        $this->load->model('issuedItemsModel', 'issueitem');
        $this->issueitem->insert_batch($issued);
    }

    public function doneIssueItem($item_id, $request_id){
        $issuedItems = $this->requestitems->getByRequestId($request_id)->result();
        $qtyIssued = 0;
        foreach($issuedItems as $item){
            $qtyIssued += $item->qty;
        }

        $stockItem = $this->stockitem->getWhere($item_id)->row();
        if($stockItem->inventory > 1){
            $status = get_status('approval');
            $data['stock'] = $stockItem->stock - $qtyIssued;
            $data['stock_issued'] = $stockItem->stock_issued + $qtyIssued;
            $data['inventory'] = $data['stock'] - $data['stock_issued'];
            $data['entry_by'] = 'Admin';
            $data['entry_by_id'] = 1;
            $data['entry_date'] = date('Y-m-d H:i:s');
            $this->stockitem->update($item_id, $data);
            $d['status'] = $status['issued'];
            $this->requestitems->updateByRequestId($request_id, $d);
            $rd['issued_qty'] = $data['stock_issued'];
            $rd['request_status'] =  $status['issued'];
            $this->model->update($request_id, $rd);
            $this->finalItemIssue($issuedItems);
            $this->setCurrentStatus($request_id, 'issued');

            set_flashdata('success', $qtyIssued." Items Issued");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function getSerialNo(){
        $item_id = $_GET['item_id'];

        // pp('hello');
        $requestitems = $this->requestitems->getWhere($item_id)->row();
        $serialNos = unserialize($requestitems->serial_no);
        echo send_json(array('message' => 'success', 'data' => $serialNos));
    }

    
    public function setCurrentStatus($request_id, $current_status){
        $status = $this->config->item('approval');
        $data = $this->getActivityData($request_id);
        $request = $this->model->getWhere($request_id)->row();
        $data['request_status'] = $status[$current_status];
        // pp($data);
        $data['qty'] = $request->total_qty;
        $this->requestactivity->insert($data);
        $update_data['request_status'] = $data['request_status'];
        $update_data['entry_by'] = $data['entry_by'];
        $update_data['entry_by_id'] = $data['entry_by_id'];
        $this->model->update($request_id, $update_data);
    }

    public function getActivityData($request_id){
        $status = $this->config->item('approval');
        $request = $this->model->getWhere($request_id)->row();
        $form_data['request_status'] = $this->input->post('request_status');
        $form_data['remarks'] = $this->input->post('remarks');
        $form_data['qty'] = get_assigned_qty($request->id, $status['approved']);
        $form_data['request_id']= $request->id;
        $form_data['entry_by'] = 'Admin';
        $form_data['entry_by_id'] = 1;

        return $form_data;
    }
    public function requestStatusExists($request_id, $status){
        $activities = $this->requestactivity->getStatusByRequestId($request_id)->result();
        foreach ($activities as $activity) {
            if($activity->request_status === $status){
                return true;
            }
        }
        return false;
    }

    public function requestAction(){
        $status = $this->input->get('action');
        $request_id = $this->input->get('request_id');

        $approvalStatus = get_status('approval');
        if(!empty($request_id) && !array_key_exists($status, $approvalStatus)){
            set_flashdata('error', 'Invalid Status');
            redirect('requestlist/pendingApproval');
        }

        $data['request_id'] = $request_id;
        $data['request_status'] = $approvalStatus[$status];
        $this->requestactivity->insert($request_id, $data);
        redirect('requestlist/pendingapproval');
    }



    public function show(){
        $data = new stdClass();
        $getStatus = $this->input->get('status');
        $status  = $this->config->item('approval');
        $data->requestlists =  $this->model->getRequestWithActivitiesByStatus($status[$getStatus])->result();
        // pp($data->requestlists);
        $data->title = "Request List - ".$status[$getStatus];
        $data->statusColors = $this->config->item('statusColor');
        $data->approvalStatus = $status;
        
        $data->count = 0;
        $data->status = $status[$getStatus];
        // pp($data->status);
        $this->showListView($getStatus, $data);
    }
    
    public function showListView($setStatus, $data){
        $this->load->view('templates/header', $data);
        switch ($setStatus) {
            case 'awaiting_receive':
            $this->load->view('requestlist/lists/awaitingReceiveList');
            break;
            case 'received':
            $this->load->view('requestlist/lists/ReceivedList');
            break;
            case 'pending_issue':
            $this->load->view('requestlist/lists/pendingIssueList');
            # code...
            break;
            case 'issued':
            $this->load->view('requestlist/lists/issuedList');
            break;
            case 'approved':
            $this->load->view('requestlist/lists/approvedList');
            break;
            case 'denied':
            // $this->load->view('requestlist/lists/deniedList');
            break;
            default:
            // pp($data);
                $this->load->view('requestlist/lists/pendingapprovallist');
            break;
        }
    
        $this->load->view('templates/footer');
    }
    
    public function showItems($request_id){
        $data = new stdClass();
        $this->load->model('stockItemmodel', 'stockitems');
        $data->request = $this->model->getWhere($request_id)->row();
        $data->requestitems = $this->requestitems->getByRequestId($request_id)->result();
        $data->count = 0;
        $data->approvalStatus = $this->config->item('approval');
        $data->items = $this->stockitems->get('item_name')->result();
        // pp($data->items);
        $data->issued_qty = get_assigned_qty($request_id, $data->approvalStatus['approved']);
        $this->load->model('vehiclemodel', 'vehicle');
        $data->vehicles = $this->vehicle->get('vehicle_no')->result();
        $data->title = 'Approve Request Items';
        $data->modalTitle = 'Approve Item';
        $this->load->view('templates/header', $data);
        $this->load->view('requestapproval/requestItems', $data);
        $this->load->view('templates/footer');
    }


    // duplicated
    public function updateRequestStatus($request_id){
        $data = new stdClass();
        $request = $this->model->getWhere($request_id)->row();
        $status = $this->config->item('approval');
        $form_data['request_status'] = $this->input->post('request_status');
        $form_data['approval_remarks'] = $this->input->post('approval_remarks');
        
        $this->load->model('requestlistitemmodel', 'requestItem');
        if($this->input->post('applyall')){
            if($this->model->update($request_id, $form_data)){
                $d['status'] = $form_data['request_status'];
                $this->requestItems->updateByRequestId($request_id, $d);

                    set_flashdata('success', 'Request Status Successfully Updated');
                }else{
                    set_flashdata('error', 'Request Status Update Failed');
                }
            }else{
                
                $d['status'] = $form_data['request_status'];
            if($this->requestItems->updateByRequestId($request_id, $d)){
                set_flashdata('success', 'All Request Item Status Successfully Updated');
            }else{
                set_flashdata('error', 'Request Item Status Update Failed');
            }
        }

        
        redirect('requestlist/showitems/'.$request_id);
    }

    public function updateItemStatus($item_id){
        $this->load->model('requestlistitemmodel', 'requestitems');
        $form_data['status'] = $this->input->post('status', true);
        $form_data['remarks'] = $this->input->post('remarks', true);
        $form_data['request_id'] = $this->input->post('request_id', true);

        //  pp($this->requestitems->update($item_id, $form_data));
        $request = $this->model->getWhere($form_data['request_id'])->row();
        $issued_qty = get_assigned_qty($request->id, $form_data['status']);
        $d['total_qty'] = $request->total_qty;
        $d['issued_qty'] = $issued_qty;

        if($this->requestitems->update($item_id, $form_data)){
            

            set_flashdata('success', 'Item Status Updated');
        }else{
            set_flashdata('error', 'Item Status Update Fail');
        }



        redirect($_SERVER['HTTP_REFERER']);
    }

    public function getStockData($form_data){
        // pp($form_data);
        // $issued_qty = get_assigned_qty($form_data['request_id'],$form_data['request_status']);
        // $data['stock_issued'] = $issued_qty;
        // $data['inventory'] = $data['stock'] - $data['stock_issued'];
        $data['request_status'] = $form_data['request_status'];
        $data['stock'] = $form_data['qty'];
        $data['entry_by'] = 'admin';
        $data['entry_by_id'] = 1;
        $data['entry_date'] = date('Y-m-d H:i:s');
        
        return $data;
    }
    
        
    
    
    // public function updateInventory($request_id){
    //     $requestItem = $this->model->getWhere($request_id)->row();

    //     $data['item_name'] = $requestItem->item_name;
    //     $data['stock'] = $requestItem->total_qty;
    //     // $data['stock_issued'] = 
        
    // }

    public function jqUpdateItemStatus(){
        $data = $this->input->post(null, true);

        $request_id = $data['requestId'];
        $status = empty($data['selectedStatus']) ? 'pending' : $data['selectedStatus'];
        $selectedStatus = $this->config->item('approval')[$status];
        // $selectedIds = $data['selectedItems'];
        $this->load->model('requestlistitemmodel', 'requestitems');
        // pp($selectedIds);
        $selectedItems = $this->prepBatchSelectedItemsAjax($data['selectedItems'], $selectedStatus);
        
        if(is_array($data['selectedItems'])){
            $this->requestitems->batchUpdateByRequestId($request_id, $selectedItems);
        }else{
            $this->requestitems->update($data['selectedItems'], $selectedItems);
        }

        $items = $this->requestitems->getByRequestId($request_id)->result();
        print(json_encode($data));
    }
    
    public function prepBatchSelectedItemsAjax($selectedItems, $selectedStatus){
        $data = [];
        if(!is_array($selectedItems)){
            $data['status'] = $selectedStatus;
            return $data;
        }
        
        for($i = 0; $i < count($selectedItems); $i++){
            $data[] = array(
                'id' => $selectedItems[$i],
                'status' => $selectedStatus);
        }


        return $data;
    }

    public function getInputFromIssueModal(){ // change name
        $this->config->load('setting');
        $status = $this->config->item('approval');

        $form_data['vehicle_id'] = $this->input->post('vehicle_id', true);
        // $form_data['re_assigned_to'] = $this->input->post('re_assigned_to', true);
        $form_data['qty'] = $this->input->post('qty', true);
        $form_data['request_id'] = $this->input->post('request_id', true);
        // $form_data['status'] = $status['pending_approval'];
        $form_data['entry_date'] = date('Y-m-d H:i:s');
        return $form_data;
    }

    
    // public func
    
    public function create(){
        $this->load->library('form_validation');
        $data = new stdClass();
        $data->vendors = $this->vendor->get('id')->result();
        $data->requesttypes = $this->requesttype->get('id')->result();
        // pp($data->requesttypes);
        $data->stockitems = $this->stockitem->get('id')->result();
        $data->vehicles = $this->vehicle->get('vehicle_id')->result();
        $data->title = "Create New Request";
        $data->approvalStatus = $this->config->item('approval');
        $this->load->view('templates/header', $data);
		$this->load->view('requestlist/create');
		$this->load->view('templates/footer');
    }
    
    public function edit($id){
        $this->load->helper('db_helper');
        $data = new stdClass();
        if(!is_numeric($id)){
            $this->session->set_flashdata('invalid ID');
            redirect('requestlist/create','refresh');
        }
        
        $data->request = $this->model->getWhere($id)->row();
        // pp($data->request);
        $data->vendors = $this->vendor->get('name')->result();
        $data->requesttypes = $this->requesttype->get('id')->result();
        $data->vehicles = $this->vehicle->get('vehicle_id')->result();
        $data->approvalStatus = $this->config->item('approval');
        $data->stockitems = $this->stockitem->get('item_name')->result();
        $data->state = false;
        $data->title = "Edit Driver";
        $this->load->view('templates/header', $data);
		$this->load->view('requestlist/edit');
		$this->load->view('templates/footer');
    }
    
    
    public function update($id){
        $form_data = $this->getRequestInputData();
        $this->validateRequestForm();
        if ($this->form_validation->run()) {
            unset($form_data['entry_by']);
            unset($form_data['entry_by_id']);
            unset($form_data['entry_date']);
            unset($form_data['request_status']);
            $form_data['vendor_name'] = $this->getVendorName($form_data['vendor_id']);
            $form_data['item_name'] = $this->getStockItemName($form_data['item_id']);
            $form_data['request_name'] = $this->getStockItemName($form_data['request_type_id']);
            
            if($this->model->update($id, $form_data)){
                set_flashdata('success', "New Request succesfully Updated");
            }else{
                set_flashdata('error', 'Sorry Request update failed, Please Try Again!!!');
            }
            
        }else{
            set_flashdata('error',validation_errors());
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function delete($id){
        if($this->model->delete($id)){

            set_flashdata('success', 'Request List Successfully Deleted');
        }
        redirect('requestlist/manage');
    }
    
    public function validateRequestForm(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('request_type_id','Request Type',  'trim|required');
        $this->form_validation->set_rules('item_id','Item Name',  'trim|required');
        $this->form_validation->set_rules('vendor_id','Vendor',  'trim|required');
        $this->form_validation->set_rules('date_needed','Date Needed',  'required');
        $this->form_validation->set_rules('justification','Justification', 'trim|required');
        $this->form_validation->set_rules('unit_price','Unit Price', 'trim|required|callback_unit_price_check|callback_unit_price_zero_check'); // custom validation
    }

    public function getStockItemName($stock_id){
        $item = $this->stockitem->getWhere($stock_id)->row();
        return $item->item_name;
    }

    public function getVendorName($vendor_id){
        $vendor = $this->vendor->getWhere($vendor_id)->row();
        return $vendor->name;
    }

    public function getRequestName($request_type_id){
        $request = $this->requesttype->getWhere($request_type_id)->row();
        
        return $request->request_name;
    }

    public function getRequestInputData(){
        $this->config->load('setting');
        $status = $this->config->item('approval');
        
        $status = get_status('approval');
        
        $form_data['total_qty'] = ($this->input->post('qty')) ? array_sum($this->input->post('qty')) : 0;
        $form_data['request_type_id'] = $this->input->post('request_type_id', true);
        $form_data['date_needed'] = $this->input->post('date_needed', true);
        $form_data['vendor_id'] = $this->input->post('vendor_id', true);
        $form_data['item_id'] = $this->input->post('item_id', true);
        $form_data['unit_price'] = $this->input->post('unit_price', true);
        $form_data['justification'] = $this->input->post('justification', true);

        $form_data['vendor_name'] = $this->getVendorName($form_data['vendor_id']);
        $form_data['vendor_name'] = $this->getVendorName($form_data['vendor_id']);
        $form_data['item_name'] = $this->getStockItemName($form_data['item_id']);
        $form_data['request_name'] = $this->getRequestName($form_data['request_type_id']);
        $form_data['entry_date'] = date('Y-m-d H:s:i');
        $form_data['entry_by'] = 'Admin';
        $form_data['entry_by_id'] = 1;
        $form_data['request_status'] = $status['pending_approval'];
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