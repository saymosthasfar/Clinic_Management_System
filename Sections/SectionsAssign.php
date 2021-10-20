<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location:../index.html');
}
require "../Config/DbClass.php";
require "../Clinics/ClinicClass.php";
require "../SuperAdminClass.php";

$dbHnd = new DbHandler("localhost", "root", "", "clinic_management");
if (isset($_GET['id']) && $_GET['id'] != "") {
    $id = $_GET['id'];
    $action = $dbHnd->dbObject->prepare("SELECT * FROM sections WHERE id=?");
    $action->bind_param("s", $id);
    $action->execute();
    $results = $action->get_result();
    $clinic = new clinic();
    while ($row = $results->fetch_assoc()) {
        $section = new section();
        $section->setTitle($row['title']);
        $clinic->addSection($section);
    }
} else {
    $results = $dbHnd->dbObject->query('SELECT * FROM clinics');
    $superAdmin = new SuperAdmin();
    while ($row = $results->fetch_assoc()) {
        $clinic = new clinic();
        $clinic->setName($row['name']);
        $clinic->setAddress($row['address']);
        $clinic->setIsActive($row['is_active']);
        $clinic->setPhoneNumber($row['phone']);
        $clinic->setIsFullTime($row['is_full_time']);
        $clinic->setId($row['id']);
        $superAdmin->addClinic($clinic);
    }
}
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="./styles/style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('body').on('change', '#clinicsList', function() {
                $id = $("select#clinicsList option").filter(":selected").val();
                $("#sectionsTable").load("./Sections/SectionsList.php?id="+$id);
            });
        });
    </script>
</head>

<body>
    <div style="height:20px;"></div>
    <div class="well" style="margin:auto; padding:auto; width:80%;">
        <span style="font-size:25px; color:blue">
            <center><strong>Sections Assignment</strong></center>
        </span>
        <span class="pull-left">
            <?php //include('AddNewClinicModal.php'); 
            ?><a href="#addnew" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add New</a></span>
        <span class="pull-left">
            <span class="glyphicon glyphicon-plus"></span>
            <?php
            $clinics = $superAdmin->getClinics();
            echo "<select id='clinicsList'>";
            for ($i = 0; $i < count($clinics); $i++) {
                echo "<option value=" . $clinics[$i]->getId() . ">" . $clinics[$i]->getName() . "</option>";
            }
            echo '</select>';
            ?>
            </a>
        </span>
        <div style="height:10px;"></div>
        <div id="sectionsTable"></div>
    </div>
</body>

</html>