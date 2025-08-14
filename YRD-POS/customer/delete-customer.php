<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location: ../auth/login.php');
    exit();
}
require_once "../config/config.php";
require_once "../config/functions.php";
require_once "../module/mode-customer.php";

$id = $_GET['id'];

if (delete($id) > 0) {
    echo "
            <script>
                document.location.href = 'data-customer.php?msg=deleted';
            </script>
        ";
} else {
    echo "
            <script>
                document.location.href = 'data-customer.php?msg=aborted';
            </script>
        ";
}
