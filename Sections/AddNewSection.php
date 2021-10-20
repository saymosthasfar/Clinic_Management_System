<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location:../index.html');
}
require "../Config/DbClass.php";
require "../SuperAdminClass.php";
require "../Clinics/ClinicClass.php";

if (isset($_POST['title']) && $_POST['title'] != "") {
    $section = new section();
    $clinic = new clinic();
    //
    $section->setTitle($_POST['title']);
    $section->setIsActive(isset($_POST['active']) ? "1" : "0");
    //
    $clinic->addSectionToDb($section);
    header('location:../Dashboard.php');
}