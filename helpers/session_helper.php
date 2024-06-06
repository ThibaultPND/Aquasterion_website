<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function loginUser($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
}

function logoutUser() {
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    session_destroy();
}

function redirect($url) {
    header("Location: " . BASE_URL . $url);
    exit;
}
?>
