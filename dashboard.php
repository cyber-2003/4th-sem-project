<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: logout.php');
    exit();
}
require('../PROJECT/dbconnect.php');

$user_id = $_SESSION['user_id'];
$sql = "select count(*) from cart_items where user_id = $user_id";
$count = sql($sql);
$count = $count[0]['count(*)'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
    <title>Fashion</title>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <h1>FASHION</h1>
            </div>
            <ul class="list-items">
                <li><a href="../PROJECT/dashboard.php" class="link">HOME</a></li>
                <li><a href="../PROJECT/collection.php" class="link">COLLECTION</a></li>
                <li><a href="#" class="link">CONTACT US</a></li>
                <li><a href="#" class="link">ABOUT US</a></li>
            </ul>

            <div class="nav-btns">
                <a href="../PROJECT/logout.php" class="btn-nav-i"><i class="fas fa-sign-out-alt"></i></a>
                <a href="../PROJECT/cart.php" class="btn-nav-i"><i class="fas fa-cart-plus"><span><?=$count?></span></i></a>
                <a href="../PROJECT/user.php" class="btn-nav-i"><i class="fas fa-user"></i></a>
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
                <img src="clothes.jpg" />
            </div>
        </div>
    </header>
</body>


</html>
