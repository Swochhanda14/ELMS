<?php
require('../including/db_connection.php');
session_start();
error_reporting(0);

if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit();
}
// Fetch current date
$currentDate = date("Y-m-d");

// Get employee details
$email = $_SESSION['email'];

$query = "SELECT * FROM employee WHERE email = '$email'";

$data = mysqli_query($conn, $query);

$result = mysqli_fetch_assoc($data);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- primary meta tags -->
    <title>Employee Dashboard</title>
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
        require('../included/sidebar.php');
        ?>

        <!-- body part  -->
        <div class="dashboard">

            <?php
            require('../included/topheader.php');
            ?>

            <div class="dashboard-content">


                <div class="dashboard-title">
                    <h2>My Profile</h2>
                    <h3><a href="applyleave.php">Home</a> | My Profile</h3>
                </div>


                <div class="profile-container">

                    <div class="left">
                        <div class="profile-holder">
                            <img src="../upload/employee/<?php echo !empty($result['profile']) ? $result['profile'] : 'default.png'; ?>"
                                alt="Profile Image" id="profile-pic">


                            <h2 class="name"><?php echo $result['employeeid'] ?></h2>

                            <div class="profile-detail">
                                <h4>Email: <span><?php echo $result['email'] ?></span></h4>
                                <h4>Name: <span><?php echo $result['fname'] . $result['lname']?></span></h4>
                                <h4>Gender: <span><?php echo $result['gender'] ?></span></h4>
                                <h4>Phone Number: <span><?php echo $result['contact'] ?></span> </h4>

                            </div>


                        </div>
                    </div>

                    <div class="right">
                        <div class="profile-form">
                            <h2>Edit Profile</h2>

                            <form action="<?php $_SERVER['PHP_SELF'] . "?username=$id" ?>" method="post"
                                enctype="multipart/form-data">

                                <div class="input-field">
                                    <label for="fname">First Name</label>
                                    <input type="text" id="fname" name="fname"
                                        value="<?php echo $result['fname'] ?>">
                                </div>

                                <div class="input-field">
                                    <label for="lname">Last Name</label>
                                    <input type="text" id="lname" name="lname" value="<?php echo $result['lname'] ?>">
                                </div>

                                <div class="input-field">
                                    <label for="gender">Gender</label>
                                    <select id="gender" name="gender" class="select">
                                        <option value="" disabled <?php if (empty($result['gender']))
                                            echo "selected"; ?>>Select Gender</option>
                                        <option value="Male" <?php if ($result['gender'] == 'Male')
                                            echo "selected"; ?>>
                                            Male</option>
                                        <option value="Female" <?php if ($result['gender'] == 'Female')
                                            echo "selected"; ?>>Female</option>
                                    </select>
                                </div>


                                <div class="input-field">
                                    <label for="contact">Phone Number</label>
                                    <input type="tel" id="contact" name="contact" value="<?php echo $result['contact'] ?>">
                                </div>



                                <div class="input-field">
                                    <label for="input-file" class="third">Change Profile</label>
                                    <input type="file" name="photo" accept="image/jpeg, image/png, image/jpg"
                                        id="input-file">
                                </div>

                                <input type="submit" value="Update" style="display: inline; color: white;">
                            </form>


                        </div>
                    </div>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $fname = $_POST['fname'];
                        $lname = $_POST['lname'];
                        $gender = $_POST['gender'];
                        $contact = $_POST['contact'];

                        // Check if a new photo was uploaded
                        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
                            $photo = $_FILES['photo']['name'];
                            $tempphoto = $_FILES['photo']['tmp_name'];
                            $folder = "../upload/employee/" . $photo;
                            move_uploaded_file($tempphoto, $folder);
                        } else {
                            // Use the existing photo if no new upload
                            $photo = $result['profile'];
                        }

                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            echo "Invalid email format";
                        }

                        // Validate required fields
                        if (!empty($fname) && !empty($lname) && !empty($email) && !empty($contact) && !empty($gender)) {
                            $sql = "UPDATE employee SET fname='$fname',  lname='$lname', contact='$contact', gender='$gender', profile='$photo' WHERE email='$email'";

                            $data = mysqli_query($conn, $sql);
                            if ($data) {
                                $_SESSION['status'] = "Updated successfully!";
                                $_SESSION['status_code'] = "success";
                                echo "<meta http-equiv='refresh' content='2; url=http://localhost/employeeLMS/employee/profile.php'> ";

                            } else {
                                $_SESSION['status'] = "Failed to update!";
                                $_SESSION['status_code'] = "error";
                            }
                        } else {
                            $_SESSION['status'] = "Fill all the field!";
                            $_SESSION['status_code'] = "error";
                        }
                    }
                    ?>

                </div>

            </div>

        </div>

    </div>

    <?php
    require('../including/popup.php');
    ?>
</body>

<script src="../js/script.js"></script>

</html>