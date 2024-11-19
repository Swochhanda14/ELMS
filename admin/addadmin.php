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
                    <h2>Add Admin</h2>
                    <h3><a href="dashboard.php">Dashboard</a> | <a href="manageadmin.php">View admin</a> | Add
                        Admin</h3>
                </div>

                <div class="form-container">

                    <h2>Add Admin</h2>

                    <h4>Admin Details</h4>

                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

                        <div class="input-field">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Enter Username">
                        </div>

                        <div class="flex">
                            <div class="input-field">
                                <label for="fname">Full Name</label>
                                <input type="text" class="form-control" id="fname" name="fname"
                                    placeholder="Enter First name">
                            </div>

                            <div class="input-field">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Email">
                            </div>
                        </div>


                        <div class="flex">
                            <div class="input-field">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Enter Password">
                            </div>

                            <div class="input-field">
                                <label for="cpassword">Confirm Password</label>
                                <input type="password" name="cpassword" id="cpassword"
                                    placeholder="Enter Confirm Passwsord">
                            </div>
                        </div>

                        <input type="hidden" name="regdate" value="<?php echo $currentDate ?>">

                        <input type="submit" name="submit" class="submit-btn" value="Add Admin">

                    </form>
                </div>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                    $username = $_POST['username'];
                    $name = $_POST['fname'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $cpassword = $_POST['cpassword'];
                    $regdate = $_POST['regdate'];

                    if ($password != $cpassword) {
                        $_SESSION['status'] = "Password does not Match!";
                        $_SESSION['status_code'] = "error";

                        ?>
                        <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/admin/addadmin.php">
                        <?php
                    }

                        if (!empty($username) && !empty($name) && !empty($email) && !empty($password)) {

                        $sql = "INSERT INTO `admin`(`name`, `username`, `email`, `password`, `date`) VALUES ('$name', '$username', '$email', '$password', '$regdate')";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            $_SESSION['status'] = "Admin Added Successfully!";
                            $_SESSION['status_code'] = "success";
                            ?>
                            <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/admin/manageadmin.php">
                            <?php
                        } else {
                            $_SESSION['status'] = "Failed to Add Employee!";
                            $_SESSION['status_code'] = "error";
                            ?>
                            <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/admin/addadmin.php">
                            <?php
                        }
                    } else {
                        $_SESSION['status'] = "All fields are required!";
                        $_SESSION['status_code'] = "error";
                        ?>
                        <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/admin/addadmin.php">
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