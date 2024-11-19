<?php
require('../including/db_connection.php');

$id = (int)$_GET['id'];

$sql = "DELETE FROM employee WHERE id='$id'";

$data = mysqli_query($conn, $sql);

if ($data) {
    echo "<script>alert('Employee Account is deleted!')</script>";
?>
    <meta http-equiv="refresh" content="0; url=http://localhost/employeeLMS/admin/employeesection.php">
<?php
}else{
    echo "<script>alert('Failed to delete!')</script>";
}
?>