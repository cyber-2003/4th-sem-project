<?php 
require('../project/dbconnect.php');
session_start();
if(isset($_POST['email']) AND isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $condition = "where email = '".$email."'";
    $userData= readAll('users', $condition );

    if( empty($userData)){ // email uniqe xa ki nai 
        // print_r( $userData);
        $data = [
            'email' => $email,
            'password' => $password,
        ];
        $createUser = create('users', $data);

        if($createUser){
           $_SESSION['message'] = 'Register Done ';
           header('Location: login.php');
           exit();

        }else{
            $_SESSION['message'] = 'Register Failed ';
            header('Location: register.php');
            exit();
        }
    }else{
        $_SESSION['message'] = 'Enter Valid Email';
        echo $_SESSION['message'];
        header('Location: register.php');
        exit();
    }
}else{
    $_SESSION['message'] = 'Fill the form';
    echo $_SESSION['message'];
}
?>