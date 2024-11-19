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
            <!-- alertbox  -->
            <?php
            require("../including/alertbox.php");
            ?>

            <?php
            require('../including/topheader.php');
            ?>

            <div class="dashboard-content">

                <div class="dashboard-title">
                    <h2>Employee Section</h2>
                    <h3><a href="dashboard.php">Dashboard</a> | Employee Section</h3>
                </div>

                <div class="table-container">

                    <div class="table-header">
                        <h2>Employee List</h2>
                        <div class="addbtn">
                            <a href="addemployee.php"><span class="material-symbols-rounded">add_circle</span>Add
                                Employee</a>
                        </div>
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
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Employee Id</th>
                                    <th>Department</th>
                                    <th>Join On</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET['search']) && !empty($_GET['search'])) {
                                    $value = $_GET['search'];
                                    $sql = "SELECT * FROM employee WHERE CONCAT(id, fname, ' ', lname) LIKE '%$value%'";
                                } else {
                                    $sql = "SELECT * FROM employee ORDER BY id ASC";
                                }
                                $data = mysqli_query($conn, $sql);
                                $total = mysqli_num_rows($data);
                                if ($total > 0) {
                                    $counter = 1;
                                    while ($row = mysqli_fetch_assoc($data)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $counter++; ?></td>
                                            <td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                            <td><?php echo $row['employeeid']; ?></td>
                                            <td><?php echo $row['department']; ?></td>
                                            <td><?php echo $row['regdate']; ?></td>
                                            <td
                                                class="<?php echo ($row['status'] == 1) ? 'status-active' : 'status-inactive'; ?>">
                                                <?php echo ($row['status'] == 1) ? 'Active' : 'Inactive'; ?>
                                            </td>

                                            <td class="actionbtn">
                                                <a href="editemployee.php?id=<?php echo $row['id']; ?>" class="btn update"><span
                                                        class="material-symbols-rounded">edit_square</span></a>
                                                <a href="deleteemployee.php?id=<?php echo $row['id']; ?>"
                                                    class="btn delete"><span class="material-symbols-rounded">delete</span></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>No records found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="totalcount">
                        <p>Showign 1 to <span><?php echo $total ?></span> of <span><?php echo $total ?></span> Entries
                        </p>
                    </div>


                </div>

            </div>

        </div>

    </div>

</body>
<script>
    $(document).ready(function () {
        $('.delete').click(function (e) {
            e.preventDefault();
            var id = $(this).closest('tr').find('td:first').text();
            $('.alertbox').css({
                "opacity": "1", "pointer-events": "auto", "transition": "top 0ms ease-in-out 0ms, opacity 200ms ease-in-out 0ms, transform 20ms ease-in-out 0ms"
            }).data('delete-id', id);
        });

        $('.btn1').click(function (e) {
            e.preventDefault();
            $('.alertbox').css({
                "opacity": "0", "pointer-events": "none", "transition": "top 0ms ease-in-out 200ms, opacity 200ms ease-in-out 0ms,transform 20ms ease-in-out 0ms"
            });
        });

        $('.btn2').click(function (e) {
            e.preventDefault();
            var id = $('.alertbox').data('delete-id');
            if (id) {
                window.location.href = 'deleteemployee.php?id=' + id;
            }
        });
    });

</script>

<script src="../js/script.js"></script>

</html>