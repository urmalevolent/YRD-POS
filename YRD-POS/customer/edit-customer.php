<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location: ../auth/login.php');
    exit();
}
require_once "../config/config.php";
require_once "../config/functions.php";
require_once "../module/mode-customer.php";


$title = "Edit Customer - YRD POS";
require_once "../templates/header.php";
require_once "../templates/navbar.php";
require_once "../templates/sidebar.php";


if (isset($_POST['edit-btn'])) {
    if (update($_POST)) {
        echo "<script>document.location.href = 'data-customer.php?msg=updated'</script>";
    }
}

$id = $_GET['id'];
$query = "SELECT * FROM pembeli WHERE id_member='$id'";

$customer = getData($query)[0];


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Customers</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>customer/data-customer.php">Customers</a></li>
                        <li class="breadcrumb-item active">Edit Customer</li>
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
                        <h3 class="card-title">
                            <i class="fa-solid fa-pen fa-sm"></i> Edit Customer
                        </h3>
                        <button type="submit" name="edit-btn" class="btn btn-primary btn-sm float-right"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                        <button type="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fa-solid fa-xmark"></i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" value="<?= $customer['id_member'] ?>" name="id">
                            <div class="col-lg-8 mb-3">
                                <div class="form-group">
                                    <label for="nama_member">Nama</label>
                                    <input type="text" name="nama_member" id="nama_member" class="form-control" placeholder="Masukan nama" autofocus autocomplete="off" value="<?= $customer['nama_member'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukan nik" value="<?= $customer['nik'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="nohp">Nomor HP</label>
                                    <input type="text" name="nohp" id="nohp" class="form-control" placeholder="Nomor HP Pembeli" pattern="[0-9]{5,}" value="<?= $customer['nohp'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" rows="3" class="form-control" required placeholder="Alamat Pembeli"><?= $customer['alamat'] ?></textarea>
                                </div>
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