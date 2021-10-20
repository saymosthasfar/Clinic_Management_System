<?php
session_start();
require "./Config/DbClass.php";
require "./SuperAdminClass.php";

if (
    isset($_POST['username']) && isset($_POST['password']) &&
    $_POST['password'] != "" && $_POST['username'] != ""
) {
    $dbHnd = new DbHandler("localhost", "root", "", "clinic_management");
    $action = $dbHnd->dbObject->prepare("SELECT * FROM admins WHERE username=? AND password=?");
    $action->bind_param("ss", $_POST['username'], $_POST['password']); //password_hash($_POST['password'], PASSWORD_BCRYPT));
    $action->execute();
    $result = $action->get_result();
    if (mysqli_num_rows($result) == 0)
        header("Location:index.html");
    $row = $result->fetch_assoc();
    $id = $row['id'];
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $row['username'];
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
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
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
                $("#adminsListLi").addClass("active");
                $("#clinicsListLi").removeClass("active");
                $("#sectionsListLi").removeClass("active");
                $("#sectionsAssignLi").removeClass("active");
                $("#mainContainer").load("./Admins/AdminsList.php");
            });
            $('#clinicsList').on('click', function() {
                //$("#mainContainer").load("./AdminsList.php");
                $("#clinicsListLi").addClass("active");
                $("#adminsListLi").removeClass("active");
                $("#sectionsListLi").removeClass("active");
                $("#sectionsAssignLi").removeClass("active");
                $("#mainContainer").load("./Clinics/ClinicsList.php");
            });
            $('#sectionsAssign').on('click', function() {
                //$("#mainContainer").load("./AdminsList.php");
                $("#sectionsAssignLi").addClass("active");
                $("#adminsListLi").removeClass("active");
                $("#clinicsListLi").removeClass("active");
                $("#sectionsListLi").removeClass("active");
                $("#mainContainer").load("./Sections/sectionsAssign.php");
            });
            $('#sectionsList').on('click', function() {
                //$("#mainContainer").load("./AdminsList.php");
                $("#sectionsListLi").addClass("active");
                $("#adminsListLi").removeClass("active");
                $("#clinicsListLi").removeClass("active");
                $("#sectionsAssignLi").removeClass("active");
                $("#mainContainer").load("./Sections/sectionsList.php");
            });
        });
    </script>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3><?php echo "Welcome"; ?></h3>
            </div>

            <ul class="list-unstyled components">
                <p>Clinics Management</p>
                <li id="adminsListLi">
                    <a id="adminsList" href="#">Admins</a>
                </li>
                <li id="clinicsListLi">
                    <a id="clinicsList" href="#">Clinics</a>
                <li id="sectionsListLi">
                    <a id="sectionsList" href="#">Sections</a>
                </li>
                </li>
                <li id="sectionsAssignLi">
                    <a id="sectionsAssign" href="#">Sections Assignment</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a id="logOut" href="Logout.php" class="btn btn-danger">Log out</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <div id="mainContainer" class="container">
            </div>
        </div>
    </div>
</body>

</html>