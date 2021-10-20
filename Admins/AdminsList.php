<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location:../index.html');
}
require "../Config/DbClass.php";
require "../SuperAdminClass.php";


$dbHnd = new DbHandler("localhost", "root", "", "clinic_management");
$results = $dbHnd->dbObject->query('SELECT * FROM admins');
$superAdmin = new SuperAdmin();
while ($row = $results->fetch_assoc()) {
    $admin = new admin();
    $admin->setUsername($row['username']);
    $admin->setPassword($row['password']);
    $admin->setEmail($row['email']);
    $admin->setId($row['id']);
    $superAdmin->addAdmin($admin);
}
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Collapsible sidebar using Bootstrap 4</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="./styles/style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#adminsList').on('click', function() {
                alert("TEST");
            });
        });
    </script>
</head>

<body>
    <div style="height:20px;"></div>
    <div class="well" style="margin:auto; padding:auto; width:80%;">
        <span style="font-size:25px; color:blue">
            <center><strong>Admins Management</strong></center>
        </span>
        <span class="pull-left">
            <?php include('AddNewAdminModal.php'); ?><a href="#addnew" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add New</a></span>
        <div style="height:10px;"></div>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                $admins = $superAdmin->getAdmins();
                if ($admins) {
                    for ($i = 0; $i < count($admins); $i++) {
                ?>
                        <tr>
                            <td><?php echo $admins[$i]->getUsername(); ?></td>
                            <td><?php echo $admins[$i]->getPassword(); ?></td>
                            <td><?php echo $admins[$i]->getEmail(); ?></td>
                            <td>
                                <?php include('EditDeleteAdminModal.php'); ?>
                                <a href="#edit<?php echo $admins[$i]->getId(); ?>" data-toggle="modal" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</a> ||
                                <a href="#del<?php echo $admins[$i]->getId(); ?>" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
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