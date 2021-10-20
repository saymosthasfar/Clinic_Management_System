<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location:../index.html');
}
require "../Config/DbClass.php";
require "../SuperAdminClass.php";
require "../Clinics/ClinicClass.php";

if (
    isset($_POST['name']) && isset($_POST['address']) && isset($_POST['phone']) &&
    $_POST['name'] != "" && $_POST['address'] != "" && $_POST['phone'] != ""
) {
    $clinic = new clinic();
    $superAdmin = new SuperAdmin();
    //
    $clinic->setName($_POST['name']);
    $clinic->setAddress($_POST['address']);
    $clinic->setPhoneNumber($_POST['phone']);
    $clinic->setIsFullTime(isset($_POST['fulltime']) ? "1" : "0");
    //
    $superAdmin->addClinicToDb($clinic);
    header('location:../Dashboard.php');
}