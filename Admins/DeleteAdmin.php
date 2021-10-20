<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location:../index.html');
}
require "../Config/DbClass.php";
require "../SuperAdminClass.php";

if (isset($_GET['id']) && $_GET['id'] != "") {
    $superAdmin = new SuperAdmin();
    //
    $superAdmin->removeAdminFromDb($_GET['id']);
    header('location:../Dashboard.php');
}
