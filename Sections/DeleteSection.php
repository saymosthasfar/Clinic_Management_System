<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location:../index.html');
}
require "../Config/DbClass.php";
require "../SuperAdminClass.php";
require "../Clinics/ClinicClass.php";

if (isset($_GET['id']) && $_GET['id'] != "") {
    $clinic = new clinic();
    //
    $clinic->removeSectionFromDb($_GET['id']);
    header('location:../Dashboard.php');
}
