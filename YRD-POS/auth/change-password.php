<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location: ../auth/login.php');
    exit();
}

require_once "../config/config.php";
require_once "../config/functions.php";
require_once "../module/mode-password.php";

$title = "Change Password - Yow POS";
require_once "../templates/header.php";
require_once "../templates/navbar.php";
require_once "../templates/sidebar.php";

// update Password
if (isset($_POST['simpan'])) {
    if (update($_POST)) {
        echo "<script>
                alert('Password berhasil diperbaharui!');
                document.location='change-password.php';
            </script>";
    }
}

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

$alert1 = "<small class='text-danger pl-2 font-italic'>Konfrimasi Password tidak sama dengan password baru</small>";
$alert2 = "<small class='text-danger pl-2 font-italic'>Current Password tidak sama</small>";

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Password</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Password</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form action="" method="POST">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-key nav-icon text-sm"></i> Change Password</h3>
                        <button type="submit" class="btn btn-primary float-right btn-sm" name="simpan"><i class="fas fa-edit"></i> Submit</button>
                        <button type="reset" name="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-times"></i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-8 mb-3">
                            <div class="form-group">
                                <label for="curPass">Current Password</label>
                                <input type="password" name="curPass" id="curPass" class="form-control" placeholder="Masukan password saat ini" required>
                                <?php if ($msg == 'err2') {
                                    echo $alert2;
                                } ?>
                            </div>
                            <div class="form-group">
                                <label for="newPass">New Password</label>
                                <input type="password" name="newPass" id="newPass" class="form-control" placeholder="Masukan password baru" required>
                            </div>
                            <div class="form-group">
                                <label for="confPass">Confirm Password</label>
                                <input type="password" name="confPass" id="confPass" class="form-control" placeholder="Masukan kembali password baru" required>
                                <?php if ($msg == 'err1') {
                                    echo $alert1;
                                } ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <?php

    require_once "../templates/footer.php";

    ?>