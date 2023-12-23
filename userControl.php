<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../PROJECT/logout.php');
    exit();
}

require('../PROJECT/dbconnect.php');

$user_id = $_SESSION['user_id'];
$user = readUserById($user_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the 'update' button is clicked
    if (isset($_POST['update'])) {

        handleUpdateProfile($user_id);
    }
    // Check if the 'delete' button is clicked
    elseif (isset($_POST['delete'])) {
        handleDeleteAccount();
    }
}

function handleUpdateProfile($user_id)
{
    $newPassword = $_POST['password'];
    $newEmail = $_POST['email'];

    $userDetail = readUserById($user_id);

    if (!empty($newEmail) && $newEmail !== $userDetail['email']) {
        $data = [
            'email' => $newEmail,
        ];

        if (!empty($newPassword)) {
            $data = [
                'email' => $newEmail,
                'password' => $newPassword,
            ];
        }

        $condition = "where id = $user_id";
        if (update('users', $data, $condition)) {
            header('Location: /');
            exit();
        } else {
            $error = "Failed to update profile. Please try again.";
        }
    }
    if (!empty($newPassword)) {
        $data = [
            'email' => $newEmail,
            'password' => $newPassword,
        ];
    }

    $condition = "where id = $user_id";
    if (update('users', $data, $condition)) {
        header('Location: /');
        exit();
    } else {
        $error = "Failed to update profile. Please try again.";
    }
}

function handleDeleteAccount()
{
    $user_id = $_SESSION['user_id'];

    // Delete the user account from the database
    $condition = 'where id = ' . $user_id;
    if (delete('users', $condition)) {
        header('Location: ../PROJECT/logout.php');
        exit();
    } else {
        $error = "Failed to delete account. Please try again.";
    }
}
