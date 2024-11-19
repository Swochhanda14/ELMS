<?php
require('../including/db_connection.php');
session_start();
error_reporting(0);

if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit();
}

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
                    <h2><span><?php echo $result['fname']; ?> <?php echo $result['lname']; ?></span> <span
                            style="color: var(--neutral-40);">(<?php echo $result['employeeid']; ?>)</span></h2>
                    <h2 style="color: var(--neutral-40);">Leave History</h2>
                    <h3><a href="applyleave.php">Home</a> | Leave History</h3>
                </div>

                <div class="table-container">

                    <div class="table-header">
                        <h2>My Leave History</h2>

                    </div>

                    <div class="search-container">
                        <form action="" method="GET">
                            <div class="showentrie">
                                <label for="entries">Show</label>
                                <select name="entrie" id="select" onchange="this.form.submit()">
                                    <option value="10" <?php echo isset($_GET['entrie']) && $_GET['entrie'] == 10 ? 'selected' : ''; ?>>10</option>
                                    <option value="20" <?php echo isset($_GET['entrie']) && $_GET['entrie'] == 20 ? 'selected' : ''; ?>>20</option>
                                    <option value="50" <?php echo isset($_GET['entrie']) && $_GET['entrie'] == 50 ? 'selected' : ''; ?>>50</option>
                                    <option value="100" <?php echo isset($_GET['entrie']) && $_GET['entrie'] == 100 ? 'selected' : ''; ?>>100</option>
                                </select>
                                <label for="entries">Entries</label>
                            </div>

                            <div class="searchbar">
                                <input type="search" name="search"
                                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                                    placeholder="Search">
                                <input type="submit" value="Search">
                            </div>
                        </form>
                    </div>

                    <div class="table">
                        <table class="user-table">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Type</th>
                                    <th>Condition</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Applied</th>
                                    <th>Admin's Remark</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET['search']) && !empty($_GET['search'])) {
                                    $value = $_GET['search'];
                                    $sql = "SELECT * FROM leavedetail WHERE CONCAT(id, ltype) LIKE '%$value%'";
                                } else {
                                    $sql = "SELECT * FROM leavedetail WHERE emp_email='$email'";
                                }

                                $data = mysqli_query($conn, $sql);

                                $total = mysqli_num_rows($data);

                                if ($total > 0) {
                                    $counter = 1;
                                    while ($row = mysqli_fetch_assoc($data)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $counter++; ?></td>
                                            <td><?php echo $row['ltype']; ?></td>
                                            <td><?php echo $row['description']; ?></td>
                                            <td><?php echo $row['sdate']; ?></td>
                                            <td><?php echo $row['edate']; ?></td>
                                            <td><?php echo $row['regdate']; ?></td>
                                            <td><?php if ($row['remark'] == "") {
                                                echo htmlentities('Pending');
                                            } else {
                                                echo htmlentities($row['remark'] . " " . "at" . " " . $row['remarkdate']);
                                            }
                                            ?></td>

                                            <td> <?php $stats = $row['status'];
                                            if ($stats == 1) {
                                                ?>
                                                    <span style="color: green; display: flex; gap: 3px;">Approved <span class="material-symbols-rounded">check_circle</span></span>
                                                <?php 
                                                }
                                            if ($stats == 2) 
                                            { 
                                                ?>
                                                    <span style="color: red; display: flex; gap: 3px;">Decline <span class="material-symbols-rounded">cancel</span></span>
                                                <?php }
                                            if ($stats == 0) { 
                                                ?>
                                                    <span style="color: blue; display: flex; gap: 3px;">Pending <span class="material-symbols-rounded">pending</span></span>
                                                <?php } 
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }else{
                                     echo "<tr><td colspan='8'>No records found.</td></tr>";
     
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="totalcount">
                        <p>Showign 1 to <span><?php echo $total;?></span> of <span><?php echo $total;?></span> Entries
                        </p>
                    </div>


                </div>

            </div>

        </div>

    </div>

</body>

<script src="../js/script.js"></script>

</html>