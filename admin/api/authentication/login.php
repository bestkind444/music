<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../../../classes/Login.php';
header("Content-Type: application/json"); 

$auth = new Login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    
    $auth->login($username, $password);
}
