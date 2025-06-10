<?php 
session_start();

require ('../models/Users.php');

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    echo json_encode(['code' => 4, 'message' => 'You are not authorized to access this page']);
    return;
}

$users = new Users();

$email = isset($_POST['email']) ? $_POST['email'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

if(empty($email) || empty($name) || empty($password) || empty($confirmPassword)) {
    echo json_encode(['code' => 3, 'message' => 'Email, Name, Password and Confirm Password are required.']);
    return;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['code' => 3, 'message' => 'Please enter valid email']);
    return;
}

if (($password != $confirmPassword)) {
    echo json_encode(['code' => 3, 'message' => 'Password and confirm password is not match.']);
    return;
}

$check  = $users->checkUser("WHERE email = '". $email ."'");
if($check > 0) {
    echo json_encode(['code' => 3, 'message' => 'Email address already taken']);
    return;
}

$password = hash('sha512', $password);
$dateTime = date('Y-m-d H:i:s');

$data = [
    'email' => $email,
    'name' => $name,
    'password' => $password,
    'created_at' => $dateTime,
    'updated_at' => $dateTime,
];

$resAction = $users->insertData($data);
if(!$resAction) {
    echo json_encode(['code' => 1, 'message' => 'Internal error. Please contact administrator.']);
    return;
}

// Create session for us to login directly
$_SESSION['REGISTER_ID'] = $resAction;

echo json_encode(['code' => 0, 'message' => 'Thank you for registering.']);
return;