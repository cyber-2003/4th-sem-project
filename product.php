<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../PROJECT/logout.php');
    exit();
}

require('../PROJECT/dbconnect.php');
$id = $_GET['product'];
$condition = "where id = '" . $id . "'";
$product = read('products', $condition);
$allProduct = readAll('products', "ORDER BY created_at DESC LIMIT 5");

$user_id = $_SESSION['user_id'];
$sql = "select count(*) from cart_items where user_id = $user_id";
$count = sql($sql);
$count = $count[0]['count(*)'];
// var_dump($product);
// output : array(6) { ["id"]=> int(1) ["title"]=> string(9) "Product 1" ["description"]=> string(13) "Description 1" ["image"]=> string(11) "clothes.jpg" ["price"]=> string(5) "19.99" ["user_id"]=> int(1) }
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
            margin: 30px;
            width: 100vh;
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

        .product {
            width: 100%;
            height: 100% !important;
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

        .main {
            height: 100vh;
            margin: 5px;

        }

        .row {
            display: flex;
        }

        .mt-2 {
            margin-top: 20px;
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

        input {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
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
                <li><a href="../PROJECT/dashboard.php" class="link">HOME</a></li>
                <li><a href="../PROJECT/collection.php" class="link">COLLECTION</a></li>
                <li><a href="#" class="link">CONTACT US</a></li>
                <li><a href="#" class="link">ABOUT US</a></li>
            </ul>

            <div class="nav-btns">
                <a href="../PROJECT/logout.php" class="btn-nav-i"><i class="fas fa-sign-out-alt"></i></a>
                <a href="../PROJECT/cart.php" class="btn-nav-i"><i class="fas fa-cart-plus"><span><?=$count?></span></i></a>
                <a href="../PROJECT/user.php" class="btn-nav-i"><i class="fas fa-user"></i></a>            </div>
        </nav>
        <div class="main">
            <?php

            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
            ?>

                <p style="color: white; background-color:red;"><?= $message ?></p>

            <?php
                unset($_SESSION['message']);
            }
            ?>
            <?php if($product): ?>
            <div class="row">
                <div class="card">
                    <img class="product" src="<?=$product['image']?>" alt="Card Image">
                </div>
                <div class="card-content">
                    <h3 class="card-title"><?= $product['title'] ?></h3>
                    <p class="card-text"><?= $product['description'] ?></p>
                    <p class="card-text mt-2"><?= $product['price'] ?></p>
                    <form action="../PROJECT/update_cart.php" method="post">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <div class="mt-2">
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity" value="1" min="1" max="10">
                        </div>

                        <button class="card-btn" type="submit"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                    </form>

                </div>

            </div>
            <?php endif; ?>
            <h1>New Arrival Product</h1>
            <div class="row">
                <?php foreach ($allProduct as $product) : ?>
                    <div class="card">
                        <img src="<?=$product['image']?>" alt="Card Image">
                        <div class="card-content">
                            <h3 class="card-title"><?= $product['title'] ?></h3>
                            <a href="../PROJECT/product.php?product=<?= $product['id'] ?>" class="card-btn">View</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </header>
    <script>
        function updateSelectedQuantity(value) {
            document.getElementById('selectedQuantity').innerText = value;
        }
    </script>
</body>

</html>
