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
                    <h2>Add Leavetype</h2>
                    <h3><a href="dashboard.php">Dashboard</a> | <a href="leavetype.php">View Leave Type</a> |
                        Add Leave Type</h3>
                </div>

                <div class="form-container">

                    <h2>Add Leave Type</h2>

                    <h4>Leave Type Details</h4>

                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

                        <div class="input-field">
                            <label for="ltype">Leave Type</label>
                            <input type="text" class="form-control" id="ltype" name="ltype"
                                placeholder="Enter Leave Type">
                        </div>

                        <div class="input-field">
                            <label for="desc">Description</label>
                            <textarea class="form-control" id="desc" name="desc"
                                placeholder="Enter Short Description"></textarea>
                        </div>

                        <input type="hidden" name="regdate" value="<?php echo $currentDate ?>">

                        <input type="submit" name="submit" class="submit-btn" value="Add Department">

                    </form>
                </div>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                    $ltype = $_POST['ltype'];
                    $desc = $_POST['desc'];
                    $regdate = $_POST['regdate'];

                    if (
                        !empty($ltype) && !empty($desc)
                    ) {
                        $sql = "INSERT INTO leavetype (ltype, description, cdate) VALUES ('$ltype', '$desc', '$regdate')";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            $_SESSION['status'] = "Leave type Added Successfully!";
                            $_SESSION['status_code'] = "success";
                            ?>
                            <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/admin/leavetype.php">
                            <?php
                        } else {
                            $_SESSION['status'] = "Failed to Add Leavetype!";
                            $_SESSION['status_code'] = "error";
                            ?>
                            <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/admin/addleavetype.php">
                            <?php
                        }
                    } else {
                        $_SESSION['status'] = "All fields are required!";
                        $_SESSION['status_code'] = "error";
                        ?>
                        <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/admin/addleavetype.php">
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