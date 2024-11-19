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
    <link rel="shortcut icon" href="../assets/logo/logo.png" type="image/svg+xml">

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

    <main>
        <article>

            <div class="form-container">

                <div class="content">

                    <h1 class="title-medium">Employee Leave Management System</h1>

                    <h4 class="text-small">Please Log-In according to your role!!</h4>

                    <div class="flex">
                        <a href="adminlogin.php" class="btn">Admin Login</a>
                        <a href="employeelogin.php" class="btn">Employee Login</a>
                    </div>
                </div>

            </div>

        </article>
    </main>


</body>


</html>