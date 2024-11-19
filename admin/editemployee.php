<?php
require('../including/db_connection.php');
session_start();

$empid = $_GET['id'];

if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}
// Fetch current date
$currentDate = date("Y-m-d");



$query = "SELECT * FROM employee WHERE id='$empid'";

$data = mysqli_query($conn, $query);

$result2 = mysqli_fetch_assoc($data);

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
                    <h2>Update Employee</h2>
                    <h3><a href="dashboard.php">Dashboard</a> | <a href="employeesection.php">View Employee</a> | Update
                        Employee</h3>
                </div>

                <div class="form-container">

                    <h2>Add Student</h2>

                    <h4>Students Details</h4>

                    <form action="<?php echo $_SERVER['PHP_SELF'] . "?id=$empid" ?>" method="POST">
                        <div class="flex">
                            <div class="input-field">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname"
                                    value="<?php echo $result2['fname'] ?>" placeholder="Enter First name">
                            </div>

                            <div class="input-field">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname"
                                    value="<?php echo $result2['lname'] ?>" placeholder="Enter Last name">
                            </div>
                        </div>

                        <div class="flex">
                            <div class="input-field">
                                <label for="employeeid">Employee ID</label>
                                <input type="text" class="form-control" id="employeeid" name="employeeid"
                                    value="<?php echo $result2['employeeid'] ?>" placeholder="Enter Employee ID">
                            </div>

                            <div class="input-field">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?php echo $result2['email'] ?>" placeholder="Enter Email">
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
                                        $selected = ($row['dname'] == $result2['department']) ? 'selected' : '';
                                        echo "<option value='" . $row['dname'] . "' $selected>" . $row['dname'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="input-field">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male" <?php echo ($result2['gender'] == 'male') ? 'selected' : ''; ?>>
                                        Male</option>
                                    <option value="female" <?php echo ($result2['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="input-field">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob"
                                    value="<?php echo $result2['dob'] ?>">
                            </div>

                            <div class="input-field">
                                <label for="contact">Contact Number</label>
                                <input type="tel" class="form-control" id="contact" name="contact"
                                    value="<?php echo $result2['contact'] ?>" placeholder="Enter Contact Number">
                            </div>
                        </div>

                        <div class="flex">

                            <div class="input-field">
                                <label for="country">Country</label>
                                <select name="country" id="country">
                                    <option value="">Select Country</option>
                                    <option value="Nepal" <?php echo ($result2['country'] == 'Nepal') ? 'selected' : ''; ?>>Nepal</option>
                                    <option value="India" <?php echo ($result2['country'] == 'India') ? 'selected' : ''; ?>>India</option>
                                    <option value="USA" <?php echo ($result2['country'] == 'USA') ? 'selected' : ''; ?>>
                                        United States</option>
                                    <option value="UK" <?php echo ($result2['country'] == 'UK') ? 'selected' : ''; ?>>
                                        United Kingdom</option>
                                </select>
                            </div>

                            <div class="input-field">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address"
                                    placeholder="Enter Address"><?php echo $result2['address'] ?></textarea>
                            </div>
                        </div>


                        <input type="hidden" name="regdate" value="<?php echo $currentDate ?>">

                        <input type="submit" name="submit" class="submit-btn" value="Update Employee">

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
                    $status = 1;


                    if (
                        !empty($fname) && !empty($lname) && !empty($employeeid) && !empty($email) && !empty($department) && !empty($gender) && !empty($department) && !empty($gender) && !empty($dob) && !empty($contact) && !empty($country)
                        && !empty($contact) && !empty($country) && !empty($address)
                    ) {

                        $sql = "UPDATE employee SET `fname`='$fname', `lname`='$lname', `employeeid`='$employeeid', `email`='$email', `department`='$department', `gender`='$gender', `dob`='$dob', 
                        `contact`='$contact',`country`='$country',`address`='$address' WHERE id='$empid'";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            $_SESSION['status'] = "Employee Update Successfully!";
                            $_SESSION['status_code'] = "success";
                            ?>
                            <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/admin/employeesection.php">
                            <?php
                        } else {
                            $_SESSION['status'] = "Failed to Update Employee!";
                            $_SESSION['status_code'] = "error";
                        }
                    } else {
                        $_SESSION['status'] = "All fields are required!";
                        $_SESSION['status_code'] = "error";
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