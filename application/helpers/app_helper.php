<?php  defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('ci')){
    function ci()
    {
        return $CI =& get_instance();
        
    }
}




if(!function_exists('assign_color_to_status')){
    function assign_color_to_status($statusColors, $status){
        $statusColor = '';
       switch($status){
            case 'Approved':
                $statusColor =  $statusColors['approved'];
                break;
            case 'Denied':
                $statusColor =  $statusColors['denied'];
                break;    
            case 'received':
                $statusColor =  $statusColors['received'];
                break;    
            case 'awaiting_receive':
                $statusColor =  $statusColors['awaiting_receive'];
                break;    
            case 'pending_approval':
                $statusColor =  $statusColors['pending_approval'];
                break;    
            case 'issued':
                $statusColor =  $statusColors['issued'];
                break;    
            default:
                $statusColor = $statusColors['pending'];
            break;
       }

       return $statusColor;
    }
}

if(!function_exists('get_status')){
    function get_status($config_item){
        return CI()->config->item($config_item);
    }
}

if(!function_exists('set_hidden')){
    function set_hidden($state = true){
        $uri_segment = CI()->uri->segment(1);
        $urlArr = explode('/',current_url());
        return in_array($uri_segment, $urlArr) && $state === true ? 'hidden' : '';
    }
}

if(!function_exists('set_readonly')){
    function set_readonly($state = true){
        $uri_segment = CI()->uri->segment(1);
        $urlArr = explode('/',current_url());
        return in_array($uri_segment, $urlArr) && $state === true ? 'disabled' : '';
    }
}

if(!function_exists('get_validation_errors')){
    function get_validation_errors(){
        CI()->load->library('form_validation');
       if(!empty(validation_errors()))
        return  alert_template('error', validation_errors());
    
        
    }
}

if(!function_exists('alert_template')){
    function alert_template($type, $message){
        
        $template =  "<div class='alert alert-$type alert-dismissible fade show' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                <h5><i class='icon fas fa-check'></i>".ucfirst($type)."!</h5>
                            $message
                    </div>" ;
    
        return $template;
        
    }
}

if(!function_exists('set_flashdata')){
    function set_flashdata($type, $value){
        $alertType = $type;
        if($type === 'error') $alertType =  'danger';

        $alert_template =  "<div class='alert alert-$alertType alert-dismissible fade show' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                <h5><i class='icon fas fa-check'></i>".ucfirst($type)."!</h5>
                            $value
                    </div>" ;
    
 
        ci()->session->set_flashdata('message', $alert_template);
    }
}

if(!function_exists('get_flashdata')){
    function get_flashdata(){
        return ci()->session->flashdata('message');
    }
}

if(!function_exists('send_json')){
    function send_json($data){ 
        header('Content-type: application/json');
        return json_encode($data);
    }
}

if (!function_exists( 'pp' )) {
    function pp($dump)
    { 
        echo highlight_string("<?php\n\$data =\n" . var_export($dump, true) . ";\n//>");
        echo '<script>document.getElementsByTagName("code")[0].getElementsByTagName("span")[1].remove() ;document.getElementsByTagName("code")[0].getElementsByTagName("span")[document.getElementsByTagName("code")[0].getElementsByTagName("span").length - 1].remove() ; </script>';
        die();
    }
}

if(!function_exists('selected_option')){
    function selected_option($option,$selected_option){
        if($option == $selected_option){
            $selected = 'selected';
        }else{
            $selected = null;
        }

        return $selected;
    }
}

