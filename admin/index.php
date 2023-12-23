<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../PROJECT/logout.php');
    exit();
}
require('../PROJECT/dbconnect.php');

$user_id = $_SESSION['user_id'];
$userDetails = readUserById($user_id);
if($userDetails['role'] != 'admin'){
    header('Location: /');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
    <link rel="stylesheet" href="../style.css" />
    <title>ADMIN Fashion</title>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <h1>ADMIN FASHION</h1>
            </div>
            <ul class="list-items">
                <li><a href="../PROJECT/users.php" class="link">USERS</a></li>
                <li><a href="../PROJECTproduts.php" class="link">PRODUCTS</a></li>
                <li><a href="../PROJECTorder.php" class="link">ORDER</a></li>
            </ul>

            <div class="nav-btns">
                <a href="../PROJECT/logout.php" class="btn-nav-i"><i class="fas fa-sign-out-alt"></i></a>
                <a href="../PROJECT" class="btn-nav-i"><i class="fas fa-house-user"></i></a>
            </div>
        </nav>
        <div class="main" style="height:100%;">
            <div class="main-left">
                <div class="social-media">
                    <a href="#" class="s-btn"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="s-btn"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="s-btn"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="banner">
                    <div class="f-text">
                        <h1>
                            FASHION
                            <br />
                            <span>MADE</span>
                            <br />
                            SIMPLE.
                        </h1>
                    </div>
                    <a href="#" class="btn">SHOP NOW</a>
                </div>
            </div>
            <div class="main-right">
                <img src="../clothes.jpg" />
            </div>
        </div>
    </header>
</body>


</html>
