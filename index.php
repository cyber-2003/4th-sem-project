<?php
if(empty($_SESSION['user_id'])){
    header("Location: ../PROJECT/login.php");
}else{
  header('Location: ../PROJECT/dashboard.php');
}
?>

