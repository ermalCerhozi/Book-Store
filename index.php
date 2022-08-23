<?php
session_start();
if (isset($_SESSION['permisson'])) {
    unset($_SESSION['permisson']);
}
if (isset($_SESSION['access_token'])) {
    unset($_SESSION['access_token']);
}
if (!isset($_SESSION['role'])) {
    header('Location: Authentification/login.php');
    exit();
}
if ($_SESSION['role'] == "user") {
    header('Location: User/home.php');
    exit();
} else {
    header('Location: Admin/home.php');
    exit();
}
