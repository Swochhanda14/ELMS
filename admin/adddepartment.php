<?php
require('../including/db_connection.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}
// Fetch current date
$currentDate = date("Y-m-d");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- primary meta tags -->
    <title>Dashboard Login</title>
    <meta name="description" content="Attendence managemant system" />

    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/logo/roll-call.png" type="image/svg+xml" />


    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- links css      -->
    <?php
    require('../including/links.php');
    ?>
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/customeproperty.css" />
    <link rel="stylesheet" href="../css/typography.css" />

</head>

<body>
    <div class="container">

        <!-- sidebar  -->
        <?php
        require('../including/sidebar.php');
        ?>

        <!-- body part  -->
        <div class="dashboard">

            <?php
            require('../including/topheader.php');
            ?>

            <div class="dashboard-content">

                <div class="dashboard-title">
                    <h2>Add Department</h2>
                    <h3><a href="dashboard.php">Dashboard</a> | <a href="departmentsection.php">View Department</a> |
                        Add
                        Department</h3>
                </div>

                <div class="form-container">

                    <h2>Add Department</h2>

                    <h4>Department Details</h4>

                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

                        <div class="input-field">
                            <label for="dname">Department Name</label>
                            <input type="text" class="form-control" id="dname" name="dname"
                                placeholder="Enter Department Name">
                        </div>

                        <div class="input-field">
                            <label for="shortform">Last Name</label>
                            <input type="text" class="form-control" id="shortform" name="shortform"
                                placeholder="Enter Shortform">
                        </div>

                        <div class="input-field">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" id="code" name="code"
                                placeholder="Enter Code">
                        </div>

                        <input type="hidden" name="regdate" value="<?php echo $currentDate ?>">

                        <input type="submit" name="submit" class="submit-btn" value="Add Department">

                    </form>
                </div>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                    $dname = $_POST['dname'];
                    $shortform = $_POST['shortform'];
                    $code = $_POST['code'];
                    $regdate = $_POST['regdate'];

                    if (
                        !empty($dname) && !empty($shortform) && !empty($code)) {
                        $sql = "INSERT INTO department (dname, shortform, code, cdate) VALUES ('$dname', '$shortform', '$code', '$regdate')";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            $_SESSION['status'] = "Department Added Successfully!";
                            $_SESSION['status_code'] = "success";
                            ?>
                            <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/admin/departmentsection.php">
                            <?php
                        } else {
                            $_SESSION['status'] = "Failed to Add Employee!";
                            $_SESSION['status_code'] = "error";
                            ?>
                            <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/admin/adddepartment.php">
                            <?php
                        }
                    } else {
                        $_SESSION['status'] = "All fields are required!";
                        $_SESSION['status_code'] = "error";
                        ?>
                        <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/admin/adddepartment.php">
                        <?php
                    }
                }
                ?>

            </div>

        </div>

    </div>
    <?php
    require('../including/popup.php');
    ?>

</body>

<script src="../js/script.js"></script>

</html>