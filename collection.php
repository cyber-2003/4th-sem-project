<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../PROJECT/logout.php');
    exit();
}

require('dbconnect.php');
$product = readAll('products');

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
    <link rel="stylesheet" href="../PROJECT/style.css" />
    <title>Fashion</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .card {
            margin: 10px;
            width: 300px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
            background-color: #fff;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card-content {
            padding: 20px;
        }

        .card-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .card-text {
            color: #555;
        }

        .card-btn {
            display: inline-block;
            padding: 8px 16px;
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>


<body>
    <header>
        <nav>
            <div class="logo">
                <h1>FASHION</h1>
            </div>
            <ul class="list-items">
                <li><a href="/dashboard.php" class="link">HOME</a></li>
                <li><a href="collection.php" class="link">COLLECTION</a></li>
                <li><a href="#" class="link">CONTACT US</a></li>
                <li><a href="#" class="link">ABOUT US</a></li>
            </ul>

            <div class="nav-btns">
                <a href="logout.php" class="btn-nav-i"><i class="fas fa-sign-out-alt"></i></a>
                <a href="cart.php" class="btn-nav-i"><i class="fas fa-cart-plus"><span><?=$count?></span></i></a>
                <a href="user.php" class="btn-nav-i"><i class="fas fa-user"></i></a>            </div>
        </nav>
        <div class="main">
            <div class="row">

                <?php
                foreach ($product as $data) :
                ?>
                    <div class="card">
                        <img src="<?=$data['image']?>" alt="Card Image">
                        <div class="card-content">
                            <h3 class="card-title"><?= $data['title'] ?></h3>
                            <p class="card-text"><?= $data['description'] ?></p>
                            <a href="../PROJECT/product.php?product=<?= $data['id'] ?>" class="card-btn">View</a>
                        </div>
                    </div>

                <?php
                endforeach;
                ?>
            </div>

        </div>
    </header>
</body>


</html>
