<?php
session_start();
session_destroy();
header("Location: ../PROJECT/login.php");
?>
