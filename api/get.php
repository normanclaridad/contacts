<?php

require ('../models/Contacts.php'); 
require ('../inc/app_settings.php');
require ('../inc/Helpers.php');

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    echo json_encode(['code' => 4, 'message' => 'You are not authorized to access this page']);
    return;
}

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$contacts = new Contacts();

//Helpers
$helpers = new Helpers();

$btnAction  = isset($_POST['action']) ? $_POST['action'] : '';

$params = $columns = $totalRecords = $data = [];
 
$params = $_REQUEST;
$urlFormer = '';

$columns = ['name', 'company', 'phone', 'email'];

$whereCondition = $sqlTot = $sqlRec = '';

if( !empty($params['search']['value']) ) {
    $whereCondition .= " AND ";
    $whereCondition .= " ( name LIKE '%". $params['search']['value'] ."%'";
    $whereCondition .= " OR company LIKE '%". $params['search']['value'] ."%'";
    $whereCondition .= " OR phone LIKE '%". $params['search']['value'] ."%'";
    $whereCondition .= " OR email LIKE '%". $params['search']['value'] ."%')";
}

$sortBy = 'id DESC';

if(isset($params['order'])) {
    $sortBy = $columns[$params['order'][0]['column']]."   ". $params['order'][0]['dir'];
}

$start  = $params['start'];
$length = $params['length'];

//Get total
$totalRecords = $contacts->getTotal($whereCondition, $sortBy);

//Get all tsag
$results = $contacts->getJoinWhere($whereCondition, $sortBy, $start, $length);
$data = [];
foreach($results AS $row) {
    $url = BASE_URL . '/contact.php?id=' . $row['id'];
    $action = '<a href="'.$url.'">Edit</a>';
    $action .= ' | <a class="btn-delete" data-id="'. $row['id'] .'" data-name="'.$row['name'].'">Delete</a>';

    $data[] = [
        $row['name'],
        $row['company'],
        $row['phone'],
        $row['email'],
        $action,
    ];
}
$json_data = [
    "draw"            => intval( $params['draw'] ),   
    "recordsTotal"    => intval( $totalRecords ),  
    "recordsFiltered" => intval($totalRecords),
    "data"            => $data,
];

echo json_encode($json_data);