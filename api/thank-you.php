<?php 
session_start();

require ('../models/Users.php');

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    echo json_encode(['code' => 4, 'message' => 'You are not authorized to access this page']);
    return;
}

$users = new Users();

if(!isset($_SESSION['REGISTER_ID'])) {
    echo json_encode(['code' => 3, 'message' => 'Internal error. Please contact administrator.']);
    return;
}

$id = $_SESSION['REGISTER_ID'];
$resUser = $users->getUser("WHERE id = $id");

if(empty($resUser)) {
    echo json_encode(['code' => 2, 'message' => 'Invalid user. Please contact administrator.']);
    return;
}

$_SESSION['SESS_ID'] = $resUser['id'];
$_SESSION['SESS_NAME'] = $resUser['name'];
$_SESSION['SESS_EMAIL'] = $resUser['email'];
 
echo json_encode(['code' => 0, 'message' => 'Successful.']);
return;