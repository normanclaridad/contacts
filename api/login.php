<?php
session_start();

require ('../models/Users.php');

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    echo json_encode(['code' => 4, 'message' => 'You are not authorized to access this page']);
    return;
}

$users = new Users();

$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if(empty($email) || empty($password))
{
    echo json_encode(['code' => 3, 'message' => 'Email and password are required.']);
    return;
}

$password = hash('sha512', $password);

$resCheckUser = $users->validateUser($email, $password);

if(empty($resCheckUser)) 
{
    echo json_encode(['code' => 2, 'message' => 'Invalid email and password.']);
    return;
}

$_SESSION['SESS_ID'] = $resCheckUser['id'];
$_SESSION['SESS_NAME'] = $resCheckUser['name'];
$_SESSION['SESS_EMAIL'] = $resCheckUser['email'];
 
echo json_encode(['code' => 0, 'message' => 'Successful.']);
return;