<?php
require('../including/db_connection.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
<div class="dashboard-header">
    <div class="hidden">

    </div>

    <h1>Employee Leave Managemanet System</h1>

    <div class="sideicon">
        <ul>
            <!-- <li>
                <a href="#">
                    <span class="material-symbols-rounded">notifications</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="material-symbols-rounded">chat_bubble</span>
                </a>
            </li> -->

            <li>
                <a href="profile.php" class="profileholder">
                    <img src="../upload/employee/<?php echo !empty($result['profile']) ? $result['profile'] : 'default.png'; ?>"
                    alt="Profile Image" id="profile-pic">
                </a>
            </li>
        </ul>
    </div>
</div>