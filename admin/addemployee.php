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
                    <h2>Add Employee</h2>
                    <h3><a href="dashboard.php">Dashboard</a> | <a href="employeesection.php">View Employee</a> | Add
                        Employee</h3>
                </div>

                <div class="form-container">

                    <h2>Add Employee</h2>

                    <h4>Employee Details</h4>

                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="flex">
                            <div class="input-field">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname"
                                    placeholder="Enter First name">
                            </div>

                            <div class="input-field">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname"
                                    placeholder="Enter Last name">
                            </div>
                        </div>

                        <div class="flex">
                            <div class="input-field">
                                <label for="employeeid">Employee ID</label>
                                <input type="text" class="form-control" id="employeeid" name="employeeid"
                                    placeholder="Enter Employee ID">
                            </div>

                            <div class="input-field">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Email">
                            </div>
                        </div>

                        <div class="flex">
                            <div class="input-field">
                                <label for="department">Preferred Department</label>
                                <select name="department" id="department">
                                    <option value="">Select Department</option>
                                    <?php
                                    $sql = "SELECT * FROM department";
                                    $data = mysqli_query($conn, $sql);

                                    while ($row = mysqli_fetch_assoc($data)) {
                                        echo "<option value='" . $row['dname'] . "'>" . $row['dname'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="input-field">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="input-field">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob">
                            </div>

                            <div class="input-field">
                                <label for="contact">Contact Number</label>
                                <input type="tel" class="form-control" id="contact" name="contact"
                                    placeholder="Enter Contact Number">
                            </div>
                        </div>

                        <div class="flex">

                            <div class="input-field">
                                <label for="country">Country</label>
                                <select name="country" id="country">
                                    <option value="">Select Country</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="India">India</option>
                                    <option value="USA">United States</option>
                                    <option value="UK">United Kingdom</option>
                                </select>
                            </div>

                            <div class="input-field">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address"
                                    placeholder="Enter Address"></textarea>
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

                        <input type="hidden" name="regdate" value="<?php echo $currentDate?>">

                        <input type="submit" name="submit" class="submit-btn" value="Add Employee">

                    </form>
                </div>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $employeeid = $_POST['employeeid'];
                    $email = $_POST['email'];
                    $department = $_POST['department'];
                    $gender = $_POST['gender'];
                    $dob = $_POST['dob'];
                    $contact = $_POST['contact'];
                    $country = $_POST['country'];
                    $address = $_POST['address'];
                    $password = $_POST['password'];
                    $cpassword = $_POST['cpassword'];
                    $status = 1;
                    $regdate = $_POST['regdate'];

                    if ($password != $cpassword) {
                        $_SESSION['status'] = "Password does not Match!";
                        $_SESSION['status_code'] = "error";

                        ?>
                        <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/admin/addemployee.php">
                        <?php
                    }

                    if (
                        !empty($fname) && !empty($lname) && !empty($employeeid) && !empty($email) && !empty($department) && !empty($gender) && !empty($department) && !empty($gender) && !empty($dob) && !empty($contact) && !empty($country)
                        && !empty($contact) && !empty($country) && !empty($address) && !empty($password) && !empty($cpassword)
                    ) {

                        $sql = "INSERT INTO employee (fname, lname, employeeid, email, department, gender, dob, contact, country, address, password, status, regdate) VALUES ('$fname', '$lname', '$employeeid', '$email', '$department', '$gender', '$dob', '$contact', '$country', '$address', '$password', '$status', '$regdate')";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            $_SESSION['status'] = "Employee Added Successfully!";
                            $_SESSION['status_code'] = "success";
                            ?>
                            <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/admin/employeesection.php">
                            <?php
                        } else {
                            $_SESSION['status'] = "Failed to Add Employee!";
                            $_SESSION['status_code'] = "error";
                            ?>
                            <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/admin/addemployee.php">
                            <?php
                        }
                    } else {
                        $_SESSION['status'] = "All fields are required!";
                        $_SESSION['status_code'] = "error";
                        ?>
                        <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/admin/addemployee.php">
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