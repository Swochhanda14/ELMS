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
                    <h2>Department Section</h2>
                    <h3><a href="dashboard.php">Dashboard</a> | Department Section</h3>
                </div>

                <div class="table-container">

                    <div class="table-header">
                        <h2>Department List</h2>
                        <div class="addbtn">
                            <a href="adddepartment.php"><span class="material-symbols-rounded">add_circle</span>Add
                                Department</a>
                        </div>
                    </div>

                    <div class="table">
                        <table class="user-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Department Name</th>
                                    <th>Short Form</th>
                                    <th>Department Code</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                               $sql = "SELECT * FROM department";
                               $data = mysqli_query($conn, $sql);
                               $total = mysqli_num_rows($data);
                               if ($total > 0) {
                                $counter = 1;
                                while ($row = mysqli_fetch_assoc($data)) {
                                     ?>
                                    <tr>
                                        <td><?php echo $counter++;?></td>
                                        <td><?php echo $row['dname'];?></td>
                                        <td><?php echo $row['shortform'];?></td>
                                        <td><?php echo $row['code'];?></td>
                                        <td><?php echo $row['cdate'];?></td>
                                        <td class="actionbtn">
                                                <a href="editdepartment.php?id=<?php echo $row['id']; ?>" class="btn update"><span
                                                        class="material-symbols-rounded">edit_square</span></a>
                                                <a href="deletedepartment.php?id=<?php echo $row['id']; ?>"
                                                    class="btn delete"><span class="material-symbols-rounded">delete</span></a>
                                            </td>
                                    </tr>
                                    <?php
                                     }
                                }else{
                                     echo "<tr><td colspan='6'>No records found.</td></tr>";
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
                window.location.href = 'deletedepartment.php?id=' + id;
            }
        });
    });

</script>

<script src="../js/script.js"></script>

</html>