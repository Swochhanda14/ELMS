<?php
require('../including/db_connection.php');
session_start();


if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}

$id = $_SESSION['username'];

$query = "SELECT * FROM admin WHERE username ='$id'";

$data = mysqli_query($conn, $query);

$result = mysqli_fetch_assoc($data);

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
                    <h2>My Profile</h2>
                    <h3><a href="dashboard.php">Dashboard</a> | My Profile</h3>
                </div>

                <div class="profile-container">

                    <div class="left">
                        <div class="profile-holder">
                            <img src="../upload/admin/<?php echo !empty($result['profile']) ? $result['profile'] : 'default.png'; ?>"
                                alt="Profile Image" id="profile-pic">


                            <h2 class="name"><?php echo $result['username'] ?></h2>

                            <div class="profile-detail">
                                <h4>Email: <span><?php echo $result['email'] ?></span></h4>
                                <h4>Name: <span><?php echo $result['name'] ?></span></h4>
                                <h4>Gender: <span><?php echo $result['gender']?></span></h4>
                                <h4>Phone Number: <span><?php echo $result['phone']?></span> </h4>
                                
                            </div>


                        </div>
                    </div>

                    <div class="right">
                        <div class="profile-form">
                            <h2>Edit Profile</h2>

                            <form action="<?php $_SERVER['PHP_SELF'] . "?username=$id" ?>" method="post" enctype="multipart/form-data">

                                <div class="input-field">
                                    <label for="username">Username</label>
                                    <input type="text" id="name" name="username" value="<?php echo $result['username'] ?>">
                                </div>

                                <div class="input-field">
                                    <label for="name">Full Name</label>
                                    <input type="text" id="name" name="name" value="<?php echo $result['name'] ?>">
                                </div>

                                <div class="input-field">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" name="email" value="<?php echo $result['email'] ?>">
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
                                    <input type="tel" id="contact" name="contact"
                                        value="<?php echo $result['phone']?>">
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
                            $username = $_POST['username'];
                            $name = $_POST['name'];
                            $email = $_POST['email'];
                            $gender = $_POST['gender'];
                            $contact = $_POST['contact'];
                        
                            // Check if a new photo was uploaded
                            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
                                $photo = $_FILES['photo']['name'];
                                $tempphoto = $_FILES['photo']['tmp_name'];
                                $folder = "../upload/admin/" . $photo;
                                move_uploaded_file($tempphoto, $folder);
                            } else {
                                // Use the existing photo if no new upload
                                $photo = $result['profile'];
                            }

                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                echo "Invalid email format";
                            }
                        
                            // Validate required fields
                            if (!empty($username) && !empty($name) && !empty($email) && !empty($contact) && !empty($gender)) {
                                $sql = "UPDATE admin SET username='$username',  name='$name', email='$email', phone='$contact', gender='$gender', profile='$photo' WHERE username='$id'";
                        
                                $data = mysqli_query($conn, $sql);
                                if ($data) {
                                        $_SESSION['status'] = "Updated successfully!";
                                        $_SESSION['status_code'] = "success";
                                        echo "<meta http-equiv='refresh' content='2; url=http://localhost/employeeLMS/admin/profile.php'> ";
                            
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