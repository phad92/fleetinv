<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['approval'] = array(
    'pending_approval' => 'Pending Approval',
    'awaiting_receive' => 'Awaiting Receive',
    'pending_issue' => 'Pending Issue',
    'received' => 'Received',
    'issued' => 'Issued',
    'approved' => 'Approved',
    'denied' => 'Denied'
);

$config['statusColor'] = array(
    'pending' => 'default',
    'awaiting_receive' => 'secondary',
    'pending_approval' => 'warning',
    'issued' => 'info',
    'received' => 'success',
    'approved' => 'primary',
    'denied'  => 'danger'
);



