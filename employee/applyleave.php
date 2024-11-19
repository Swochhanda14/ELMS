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
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                    $email = $_SESSION['email'];
                    $sdate = $_POST['sdate'];
                    $edate = $_POST['edate'];
                    $ltype = $_POST['ltype'];
                    $desc = $_POST['desc'];
                    $regdate = $_POST['regdate'];
                    $status = 0;
                    $isread = 0;
                    


                    // PHP Date Validation
                    if ($edate < $sdate) {
                        $_SESSION['status'] = "End date cannot be earlier than the start date!";
                        $_SESSION['status_code'] = "error";
                        ?>
                        <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/employee/applyleave.php">
                        <?php
                        exit();
                    }

                    $sql = "INSERT INTO leavedetail (sdate, edate, ltype, description, regdate, status, isread, emp_email) VALUES ('$sdate', '$edate', '$ltype', '$desc', '$regdate', '$status', '$isread', '$email')";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $_SESSION['status'] = "Leave applySuccessfully!";
                        $_SESSION['status_code'] = "success";
                        ?>
                        <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/employee/viewleave.php">
                        <?php
                    } else {
                        $_SESSION['status'] = "Failed to apply leave!";
                        $_SESSION['status_code'] = "error";
                        ?>
                        <meta http-equiv="refresh" content="2; url=http://localhost/employeeLMS/employee/applyleave.php">
                        <?php
                    }
                }
                ?>

                <div class="dashboard-title">
                    <h2>Welcome <span><?php echo $result['fname']; ?> <?php echo $result['lname']; ?></span> <span
                            style="color: var(--neutral-40);">(<?php echo $result['employeeid']; ?>)</span></h2>
                    <h3>Home</h3>
                </div>

                <div class="form-container">

                    <h2>Employee Leave form</h2>

                    <h4>Leave Details</h4>

                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="flex">
                            <div class="input-field">
                                <label for="sdate">Starting Date</label>
                                <input type="date" class="form-control" id="sdate" name="sdate">
                            </div>

                            <div class="input-field">
                                <label for="edate">Ending Date</label>
                                <input type="date" class="form-control" id="edate" name="edate">
                            </div>
                        </div>


                        <div class="input-field">
                            <label for="ltype">Leave Type</label>
                            <select name="ltype" id="ltype">
                                <option value="">Select Leave Type</option>
                                <?php
                                $sql = "SELECT * FROM leavetype";
                                $data = mysqli_query($conn, $sql);

                                while ($row = mysqli_fetch_assoc($data)) {
                                    echo "<option value='" . $row['ltype'] . "'>" . $row['ltype'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="input-field">
                            <label for="desc">Describe Your Condition</label>
                            <textarea name="desc" id="desc" placeholder="write short description "></textarea>
                        </div>

                        <input type="hidden" name="regdate" value="<?php echo $currentDate ?>">

                        <input type="submit" name="submit" class="submit-btn">

                    </form>
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