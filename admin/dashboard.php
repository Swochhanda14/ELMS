<?php
require('../including/db_connection.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}
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
                    <h2>Welcome Admin!</h2>
                    <h3>Dashboard</h3>
                </div>

                <div class="dashboard-card">

                    <div class="card">
                        <div class="card-icon">
                            <span class="material-symbols-rounded">group</span>
                        </div>
                        <div class="card-info">
                            <span class="total">
                                <?php
                                $sql = "SELECT * FROM leavedetail";
                                $result = mysqli_query($conn, $sql);
                                $total = mysqli_num_rows($result);
                                echo $total;
                                ?>
                            </span>

                            <h3>Available Leave Types</h3>

                            <div class="line">
                                <div class="percent"></div>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-icon">
                            <span class="material-symbols-rounded">groups</span>
                        </div>
                        <div class="card-info">
                            <span class="total">
                                <?php
                                $sql = "SELECT * FROM employee";
                                $result = mysqli_query($conn, $sql);
                                $total = mysqli_num_rows($result);
                                echo $total;
                                ?>
                            </span>

                            <h3>Registered Employees</h3>

                            <div class="line">
                                <div class="percent"></div>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-icon">
                            <span class="material-symbols-rounded">person</span>
                        </div>
                        <div class="card-info">
                            <span class="total">
                                <?php
                                $sql = "SELECT * FROM department";
                                $result = mysqli_query($conn, $sql);
                                $total = mysqli_num_rows($result);
                                echo $total;
                                ?>
                            </span>

                            <h3>Available Departments</h3>

                            <div class="line">
                                <div class="percent"></div>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-icon">
                            <span class="material-symbols-rounded">real_estate_agent</span>
                        </div>
                        <div class="card-info">
                            <span class="total">
                                <?php
                                $sql = "SELECT * FROM leavedetail WHERE status = 0";
                                $result = mysqli_query($conn, $sql);
                                $total = mysqli_num_rows($result);
                                echo $total;
                                ?>
                            </span>

                            <h3>Pending Application</h3>

                            <div class="line">
                                <div class="percent"></div>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-icon">
                            <span class="material-symbols-rounded">apartment</span>
                        </div>
                        <div class="card-info">
                            <span class="total">
                                <?php
                                $sql = "SELECT * FROM leavedetail WHERE status = 2";
                                $result = mysqli_query($conn, $sql);
                                $total = mysqli_num_rows($result);
                                echo $total;
                                ?>
                            </span>

                            <h3>Declined Application</h3>

                            <div class="line">
                                <div class="percent"></div>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-icon">
                            <span class="material-symbols-rounded">home</span>
                        </div>
                        <div class="card-info">
                            <span class="total">
                                <?php
                                $sql = "SELECT * FROM leavedetail WHERE status = 1";
                                $result = mysqli_query($conn, $sql);
                                $total = mysqli_num_rows($result);
                                echo $total;
                                ?>
                            </span>

                            <h3>Approved Application</h3>

                            <div class="line">
                                <div class="percent"></div>
                            </div>

                        </div>
                    </div>

                </div>


                <div class="table-container">

                    <div class="table-header">
                        <h2>Recent List</h2>
                    </div>



                    <div class="table">
                        <table class="user-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Employee Id</th>
                                    <th>Full Name</th>
                                    <th>Leave Type</th>
                                    <th>Applied On</th>
                                    <th>Current Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT leavedetail.id, employee.employeeid, employee.fname, employee.lname, leavedetail.ltype, leavedetail.regdate, leavedetail.status 
                                FROM leavedetail JOIN employee ON leavedetail.emp_email = employee.email ORDER BY leavedetail.id DESC";

                                $data = mysqli_query($conn, $sql);

                                $total = mysqli_num_rows($data);
                                if ($total > 0) {
                                    $counter = 1;

                                    while ($row = mysqli_fetch_assoc($data)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $counter++; ?></td>
                                            <td><?php echo $row['employeeid']; ?></td>
                                            <td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                            <td><?php echo $row['ltype']; ?></td>
                                            <td><?php echo $row['regdate']; ?></td>
                                            <td> <?php $stats = $row['status'];
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
                                            <td class="actionbtn">
                                                <a href="viewleave.php?id=<?php echo $row['id']; ?>" class="update btn"><span
                                                        class="material-symbols-rounded">visibility</span></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>No pending leave requests found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="totalcount">
                        <p>Showign 1 to <span></span> of <span></span> Entries
                        </p>
                    </div>


                </div>

            </div>

        </div>

    </div>

</body>

<script src="../js/script.js"></script>

</html>