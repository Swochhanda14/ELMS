<?php
require('including/db_connection.php');
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- primary meta tags -->
    <title>Admin Dashboard Login</title>
    <meta name="description" content="Attendence managemant system">

    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/logo/roll-call.png" type="image/svg+xml">

    <?php
    require('including/links.php');
    ?>

    <!-- custome links css  -->
    <link rel="stylesheet" href="css/customeproperty.css" />
    <link rel="stylesheet" href="css/typography.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">

</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        $total = mysqli_num_rows($result);

        if ($total == 1) {
            $_SESSION['username'] = $username;
            header('location: admin/dashboard.php');
        } else {
            $_SESSION['status'] = "Invalid Username or Password!";
            $_SESSION['status_code'] = "error";

            ?>
            <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/adminlogin.php">
            <?php
        }
        }

    ?>

    <main>
        <article>

            <div class="form-container">
                <div class="form">

                    <div class="backarrow">
                        <a href="index.php"><span class="material-symbols-rounded"
                                aria-hidden="true">arrow_back</span></a>
                    </div>

                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

                        <h2 class="title-medium">Admin Login Pannel</h2>

                        <h3 class="text-small">Access to Admin dashboard</h3>

                        <div class="form-content">
                            <input type="text" name="username" required maxlength="50" placeholder="Username"
                                id="username">
                            <span class="material-symbols-rounded loginicon">person</span>
                        </div>

                        <div class="form-content">
                            <input type="password" name="password" required maxlength="20" placeholder="Password"
                                id="password">
                            <span class="material-symbols-rounded loginicon">lock</span>
                        </div>


                        <div class="form-content forgotpsd">
                            <input type="checkbox" id="remember">
                            <label for="remember">Remember me</label>
                        </div>


                        <input type="submit" class="contact-btn" name="login" value="Log in">

                        <a href="employeelogin.php">Go to Employee Pannel</a>
                    </form>
                </div>


            </div>

        </article>
    </main>

    <?php
    require('including/popup.php');

    ?>


</body>

</html>