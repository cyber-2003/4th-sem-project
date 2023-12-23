<?php
session_start();
require('../PROJECT/dbconnect.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: ../PROJECT/logout.php');
    exit();
}

$id = $_SESSION['user_id'];


// cart order cart remove
if (isset($_POST['cart_item'])) {
    $id = $_POST['cart_item'];
    if (isset($_POST['order_item'])) {

        $condition = "UPDATE cart_items SET status = 'ordered' WHERE id =" . $id . " AND status = 'in_cart'";
        if (sql($condition)) {
            $_SESSION['message'] = 'Order in Process';
        } else {
            $_SESSION['message'] = 'Try again to order';
        }
        header('Location: ../PROJECT/cart.php');
        exit();
    }

    if (isset($_POST['remove_item'])) {
        $condition = "WHERE id = $id";
        if (delete('cart_items', $condition)) {
            $_SESSION['message'] = 'Removed';
        } else {
            $_SESSION['message'] = 'Try Again';
        }
        header('Location: ../PROJECT/cart.php');
        exit();
    }
} else {

    // Check if the required POST parameters are set
    if (!isset($_POST['product_id']) || !isset($_POST['quantity'])) {
        $_SESSION['message'] = 'Empty Field ';
        header('Location: ../PROJECT/product.php?product=' . $_POST['product_id']);
        exit();
    }

    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $condition = "where product_id = $product_id and user_id = $id";
    if (read('cart_items', $condition)) {
        $_SESSION['message'] = 'This item already exits in cart';
        header('Location: ../PROJECT/product.php?product=' . $_POST['product_id']);
        exit();
    }
    // Validate the quantity (ensure it's a positive integer, for example)
    if (!is_numeric($quantity) || $quantity < 1) {
        // Redirect with an error message if the quantity is invalid
        $_SESSION['message'] = 'Enter Validate the quantity';
        header('Location: ../PROJECT/product.php?product=' . $_POST['product_id']);
        exit();
    }

    // Create data array for the update
    $data = [
        'user_id' => $id,
        'product_id' => $product_id,
        'quantity' => $quantity
    ];
    // Perform the update
    if (create('cart_items', $data)) {
        // Redirect with a success message if the update is successful
        $_SESSION['message'] = 'Updated';
        header('Location: ../PROJECT/product.php?product=' . $_POST['product_id']);
        exit();
    } else {
        // Redirect with an error message if the update fails
        $_SESSION['message'] = 'Update fails';
        header('Location: ../PROJECT/product.php?product=' . $_POST['product_id']);
        exit();
    }
}
