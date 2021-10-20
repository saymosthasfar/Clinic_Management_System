<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location:../index.html');
}
require "../Config/DbClass.php";
require "../SuperAdminClass.php";

if (
    isset($_POST['id']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) &&
    $_POST['id'] != "" && $_POST['password'] != "" && $_POST['username'] != "" && $_POST['email'] != ""
) {
    $admin = new admin();
    $superAdmin = new SuperAdmin();
    //
    $admin->setUsername($_POST['username']);
    $admin->setPassword($_POST['password']);
    $admin->setEmail($_POST['email']);
    //
    $superAdmin->editAdmin($_POST['id'], $admin);
    header('location:../Dashboard.php');
}