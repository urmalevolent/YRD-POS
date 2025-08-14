<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location: ../auth/login.php');
    exit();
}
require_once "../config/config.php";
require_once "../config/functions.php";
require_once "../module/mode-user.php";

$id = $_GET['id'];
$foto = $_GET['foto'];

if (delete($id, $foto)) {
    echo "
            <script>
                alert('User berhasil dihapus..');
                document.location.href = 'data-user.php';
            </script>
        ";
} else {
    echo "
            <script>
                alert('User gagal dihapus..');
                document.location.href = 'data-user.php';
            </script>
        ";
}
