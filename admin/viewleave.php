<?php
ob_start();
require('../including/db_connection.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}

$leaveid = $_GET['id'];

$sql = "SELECT leavedetail.*, employee.fname, employee.lname, employee.employeeid, employee.gender, employee.contact 
        FROM leavedetail 
        JOIN employee ON leavedetail.emp_email = employee.email 
        WHERE leavedetail.id='$leaveid'";

$data = mysqli_query($conn, $sql);

$output = mysqli_fetch_assoc($data);

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
    <link rel="stylesheet" href="../css/popupform.css">

</head>

<body>
    <div class="container">

        <!-- sidebar  -->
        <?php
        require('../including/sidebar.php');
        ?>

        <!-- body part  -->
        <div class="dashboard">
            <!-- alertbox  -->
            <?php
            require("../including/alertbox.php");
            ?>

            <?php
            require('../including/topheader.php');
            ?>

            <div class="dashboard-content">

                <div class="dashboard-title">
                    <h2>Leave Detail</h2>
                    <h3><a href="dashboard.php">Dashboard</a> | <a href="pending.php">Pending</a> | Leave Detail
                    </h3>
                </div>

                <div class="table-container">

                    <div class="table-header">
                        <h2>Detail</h2>
                    </div>

                    <div class="table">
                        <table class="user-table">
                            <?php

                            ?>
                            <tr>
                                <td><strong>Employee Name :</strong></td>
                                <td class="value"><?php echo $output['fname'] . ' ' . $output['lname']; ?></td>
                                <td><strong>Emp Id :</strong></td>
                                <td class="value"><?php echo $output['employeeid']; ?></td>
                                <td><strong>Gender :</strong></td>
                                <td class="value"><?php echo $output['gender']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Emp Email Id :</strong></td>
                                <td class="value"><?php echo $output['emp_email']; ?></td>
                                <td><strong>Emp Contact No. :</strong></td>
                                <td class="value"><?php echo $output['contact']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Leave Type :</strong></td>
                                <td class="value"><?php echo $output['ltype']; ?></td>
                                <td><strong>Leave Date :</strong></td>
                                <td class="value">From <?php echo $output['sdate']; ?> to
                                    <?php echo $output['edate']; ?>
                                </td>
                                <td><strong>Posting Date :</strong></td>
                                <td class="value"><?php echo $output['regdate']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Leave Description :</strong></td>
                                <td colspan="5" class="value"><?php echo $output['description']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Leave Status :</strong></td>
                                <td class="value approved"><?php $stats = $output['status'];
                                if ($stats == 1) {
                                    ?>
                                        <span style="color: green; display: flex; gap: 3px;">Approved <span
                                                class="material-symbols-rounded">check_circle</span></span>
                                        <?php
                                }
                                if ($stats == 2) {
                                    ?>
                                        <span style="color: red; display: flex; gap: 3px;">Not Approved <span
                                                class="material-symbols-rounded">cancel</span></span>
                                    <?php }
                                if ($stats == 0) {
                                    ?>
                                        <span style="color: blue; display: flex; gap: 3px;">Pending <span
                                                class="material-symbols-rounded">pending</span></span>
                                    <?php }
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Admin Remark:</strong></td>
                                <td colspan="5" class="value">
                                    <?php
                                    echo !empty($output['remark']) ? $output['remark'] : "Waiting for Action.....";
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Admin Remark date :</strong></td>
                                <td colspan="5" class="value">
                                    <?php
                                    echo !empty($output['remarkdate']) ? $output['remarkdate'] : "N/A";
                                    ?>
                                </td>
                            </tr>

                        </table>

                        <div class="actionbtns">
                            <?php if ($output['status'] == 0): ?>
                                <button class="action" id="show-action">Set Action</button>
                            <?php endif; ?>
                        </div>

                    </div>

                </div>

                <!-- popupform  -->
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['apply'])) {
                    $status = $_POST['condition'];
                    $remark = $_POST['desc'];
                    $remarkdate = $_POST['regdate'];
                
                    if (!empty($status) && !empty($remark)) {
                        $sql = "UPDATE `leavedetail` SET `remark`='$remark', `remarkdate`='$remarkdate', `status`='$status' WHERE id='$leaveid'";
                        $result4 = mysqli_query($conn, $sql);
                
                        if ($result4) {
                            $_SESSION['status'] = "Leave detail Updated Successfully!";
                            $_SESSION['status_code'] = "success";
                            echo "<meta http-equiv='refresh' content='2; url=http://localhost/employeeLMS/admin/leavehistory.php'> ";
                        } else {
                            $_SESSION['status'] = "Failed to Update Leave detailt!";
                            $_SESSION['status_code'] = "error";
                            die("Error updating record: " . mysqli_error($conn)); 
                        }
                    } else {
                        $_SESSION['status'] = "All fields are required!";
                        $_SESSION['status_code'] = "error";
                    }
                }   
                
                ob_end_flush();
                ?>
                <div class="popup">

                    <div class="close-btn">
                        <span class="material-symbols-rounded loginclose">close</span>
                    </div>

                    <div class="form" id="signIn">
                        <form action="<?php echo $_SERVER['PHP_SELF'] . "?id=$leaveid" ?>" method="post">
                            <h2 class="title-medium">Set Action</h2>

                            <div class="form-element">

                                <div class="form-content">
                                    <select id="condition" name="condition">
                                        <option value="">Choose Conditon</option>
                                        <option value="1">Approved</option>
                                        <option value="2">Not Approbed</option>
                                    </select>

                                </div>

                                <div class="form-content">
                                    <textarea id="desc" name="desc" rows="4" placeholder="Write Remark"></textarea>

                                </div>

                                <input type="hidden" name="regdate" value="<?php echo $currentDate?>">

                                <input type="submit" class="contact-btn" name="apply" value="Apply">
                            </div>

                        </form>


                    </div>

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