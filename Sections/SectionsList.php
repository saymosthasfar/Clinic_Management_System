<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location:../index.html');
}
require "../Config/DbClass.php";
require "../SuperAdminClass.php";
require "../Clinics/ClinicClass.php";

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
    $results = $dbHnd->dbObject->query('SELECT * FROM sections');
    $clinic = new clinic();
    while ($row = $results->fetch_assoc()) {
        $section = new section();
        $section->setTitle($row['title']);
        $section->setId($row['id']);
        $clinic->addSection($section);
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
</head>

<body>
    <div style="height:20px;"></div>
    <div class="well" style="margin:auto; padding:auto; width:80%;">
        <?php
        if (!isset($_GET['id']))
            echo '<span style="font-size:25px; color:blue">
                <center><strong>Sections Management</strong></center>
            </span>
            <span class="pull-left">
                <?php include("AddNewSectionModal.php");?> <a href="#addnew" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add New</a></span>';
        ?>
        <?php include("AddNewSectionModal.php"); ?>
        <div style="height:10px;"></div>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <th>Title</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                $sections = $clinic->getSections();
                if ($sections) {
                    for ($i = 0; $i < count($sections); $i++) {
                ?>
                        <tr>
                            <td><?php echo $sections[$i]->getTitle(); ?></td>
                            <td>
                                <?php include('EditDeleteSectionModal.php'); 
                                ?>
                                <a href="#edit<?php echo $sections[$i]->getId(); ?>" data-toggle="modal" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</a> ||
                                <a href="#del<?php echo $sections[$i]->getId(); ?>" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>