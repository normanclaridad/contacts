<?php
session_start();

require ('../models/Contacts.php');

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    echo json_encode(['code' => 4, 'message' => 'You are not authorized to access this page']);
    return;
}

$contacts = new Contacts();

$id = isset($_POST['id']) ? $_POST['id'] : ''; 
$actionType = isset($_POST['action_type']) ? $_POST['action_type']: ''; 
$name  = isset($_POST['name']) ? $_POST['name']: '';
$company = isset($_POST['company']) ? $_POST['company']: '';
$phone = isset($_POST['phone']) ? $_POST['phone']: '';
$email = isset($_POST['email']) ? $_POST['email']: '';

$userId     = $_SESSION['SESS_ID'];

$dateTime   = date('Y-m-d H:i:s');
$data = [
    'name'   => $name,
    'company'  => $company,
    'phone'     => $phone,
    'email'     => $email,
    'updated_by'    => $userId,
    'updated_at'    => $dateTime
];

if($actionType == 'add') {
    $data = array_merge($data, ['created_at' => $dateTime, 'created_by' => $userId]);
}

// if($actionType == 'add') {
//     $where = "AND course_no = '$courseNo'";
//     $validateDuplicate = $subjects->getWhere($where);

//     if(!empty($validateDuplicate)) {
//         echo json_encode(['code' => 2, 'message' => "$name already exist in our database."]);
//         return;
//     }
// }

//Add data
if($actionType == 'add') {
    $resAction = $contacts->insertData($data);
} else if($actionType == 'update') {
    $where = " id = $id";
    $resAction = $contacts->updateData($data, $where);
} else if($actionType == 'delete') {
    $resAction = $contacts->delete($id);
}

if(!$resAction) {
    echo json_encode(['code' => 1, 'message' => 'Internal error. Please contact administrator.']);
    return;
}

$actionMessage = 'added';
if($actionType == 'update') {
    $actionMessage = 'updated';
} else if($actionType == 'delete') {
    $actionMessage = 'deleted';
}

echo json_encode(['code' => 0, 'message' => 'Record has been successully ' . $actionMessage]);
return;