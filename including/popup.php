<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../JavaScripts/sweetalert.js"></script>
<?php
if (isset($_SESSION['status']) && $_SESSION['status'] !== '') {
    ?>
    <script>
        swal({
            title: "<?php echo $_SESSION['status'] ?>",
            icon: "<?php echo $_SESSION['status_code'] ?>",
            timer: 2000,
            // button: "OK. Done!",
        });
    </script>
    <?php
    unset($_SESSION['status']);
}

?>