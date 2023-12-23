<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../PROJECT/logout.php');
    exit();
}
require('../PROJECT/dbconnect.php');

$user_id = $_SESSION['user_id'];
$sql = "select count(*) from cart_items where user_id = $user_id";
$count = sql($sql);
$count = $count[0]['count(*)'];

$userDetails = readUserById($user_id);
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
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            height: 100vh;
        }

        h2 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .card {
            margin: 10px;
            display: flex;
            /* justify-content: center;
            align-items: center; */
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

        .container-2 {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
                <a href="../PROJECT/cart.php" class="btn-nav-i"><i class="fas fa-cart-plus"><span><?= $count ?></span></i></a>
                <a href="../PROJECT/user.php" class="btn-nav-i"><i class="fas fa-user"></i></a>
                <?php if($userDetails['role'] === 'admin'): ?>
                 <a href="../PROJECT/admin/" class="btn-nav-i"><i class="fas fa-unlock"></i></a>
                 <?php endif; ?>
            </div>
        </nav>
        <div class="container-2" style="height:100%">
            <div class="card ">
                <div class="m-2">
                    <form action="../PROJECT/userControl.php" method="post">

                        <label for="email">Email:</label>
                        <input type="email" name="email" value="<?php echo $userDetails['email']; ?>" required>

                        <label for="username">Password:</label>
                        <input type="password" name="password" placeholder="*********">

                        <button name="update" name="update" type="submit">Update Profile</button>
                    </form>

                    <form action="../PROJECT/userControl.php" method="post">
                        <button type="submit" name="delete" class="delete-btn">Delete Account</button>
                    </form>
                </div>
            </div>
        </div>
    </header>
</body>


</html>
