<?php  defined('BASEPATH') OR exit('No direct script access allowed');
// Db Helpers

if(!function_exists('ci')){
    function ci()
    {
        return $CI =& get_instance();
        
    }
}

if(!function_exists('count_current_status')){
    function count_current_status($request_status){
        $status = get_status('approval');
        CI()->load->model('requestlistmodel', 'request');
        $result = CI()->request->getRequestWithStatus($request_status)->result();
        pp($result);
        $s = [];
        foreach ($result as $value) {
            if($value->request_status == $status[$request_status]){
                $s = $value->request_status;
            }
        }
        return count($s) > 0 ? count($s) : 0;
    }
}

if(!function_exists('foreign_row')){
    function foreign_row($model, $id){
        CI()->load->model($model, 'model');
        return CI()->$model->getWhere($id)->row();
    }
}

if(!function_exists('foreign_result')){
    function foreign_result($model,$column){
        CI()->load->model($model);
        return CI()->$model->get($column)->result();
    }
}




// if(!function_exists('get_total_item_qty')){
//     function get_total_item_qty($requestId, $status){
//         CI()->load->model('requestitemvehiclemodel', 'itemmodel');
//         // $status = CI()->config->item('approval');
//         $items = CI()->itemmodel->getByRequestId($requestId)->result();
//         $issued_qty = 0;

//         foreach($items as $item){
//             if($item->status !== $status){
//                 continue;
//             }

//             $issued_qty += $item->qty;
            
//         }

//         return $issued_qty;
//     }
// }
if(!function_exists('has_current_status')){
    function has_current_status($request_id, $status){
        CI()->load->model('requestactivitiesmodel', 'activity');
        $activities = CI()->activity->getByRequestId($request_id)->result();
        $current_status = get_status('approval');

        foreach ($activities as $activity) {
            if($activity->request_status != $current_status[$status]){
                continue;
            }
        }
    }
}


if(!function_exists('get_assigned_qty')){
    function get_assigned_qty($requestId, $status = ''){
        CI()->load->model('requestlistitemModel', 'itemmodel');
        // CI()->load->model('requestitemvehiclemodel', 'itemmodel');
        $items = CI()->itemmodel->getByRequestId($requestId)->result();
        $issued_qty = 0;

        foreach($items as $item){
            // if(!empty($status) && $item->status !== $status){
            //     continue;
            // }

            $issued_qty += $item->qty;
            
        }

        // pp($issued_qty);

        return $issued_qty;
    }
}

if(!function_exists('get_total_assigned_qty')){
    function get_total_assigned_qty($request_id, $qty){
        CI()->load->model('requestlistitemModel', 'itemmodel');
        $items= CI()->itemmodel->getByRequestId($request_id)->result();

        $totalQty = 0;
        foreach ($items as $item) {
           $totalQty += $item->qty;
        }

        return $totalQty + $qty;
    }
}

