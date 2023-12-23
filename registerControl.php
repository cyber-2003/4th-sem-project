<?php
require('../PROJECT/dbconnect.php');
session_start();
if (isset($_POST['email']) and isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $condition = "where email = '" . $email . "'";
    $userData = readAll('users', $condition);

    if (empty($userData)) { // email uniqe xa ki nai
        // print_r( $userData);
        $data = [
            'email' => $email,
            'password' => $password,
        ];
        $createUser = create('users', $data);

        if ($createUser) {
            $_SESSION['message'] = 'Register Done ';
            header('Location: ../PROJECT/login.php');
            exit();
        } else {
            $_SESSION['message'] = 'Register Failed ';
            header('Location: ../PROJECT/register.php');
            exit();
        }
    } else {
        $_SESSION['message'] = 'Enter Valid Email';
        echo $_SESSION['message'];
        header('Location: ../PROJECT/register.php');
        exit();
    }
} else {
    $_SESSION['message'] = 'Fill the form';
    header('Location: ../PROJECT/register.php');
    exit();
}
