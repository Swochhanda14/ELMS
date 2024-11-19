<?php
require('../including/db_connection.php');

$id = (int)$_GET['id'];

$sql = "DELETE FROM admin WHERE id='$id'";

$data = mysqli_query($conn, $sql);

if ($data) {
    echo "<script>alert('Admin is deleted!')</script>";
?>
    <meta http-equiv="refresh" content="0; url=http://localhost/employeeLMS/admin/manageadmin.php">
<?php
}else{
    echo "<script>alert('Failed to delete!')</script>";
}
?>