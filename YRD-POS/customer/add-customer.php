<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location: ../auth/login.php');
    exit();
}
require_once "../config/config.php";
require_once "../config/functions.php";
require_once "../module/mode-customer.php";


$title = "Tambah Customer - YRD POS";
require_once "../templates/header.php";
require_once "../templates/navbar.php";
require_once "../templates/sidebar.php";

$alert = '';

if (isset($_POST['simpan'])) {
    if (insert($_POST)) {
        $alert = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <i class='icon fas fa-check'></i>Pembeli baru berhasil ditambahkan!
            <button type='button' class='close' data-dismiss='alert' aria-lable='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
    }
}
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
                        <li class="breadcrumb-item active">Add Customer</li>
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
                            <i class="fa-solid fa-plus fa-sm"></i> Add Customer
                        </h3>
                        <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                        <button type="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fa-solid fa-xmark"></i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 mb-3">
                                <?php if ($alert != '') {
                                    echo $alert;
                                } ?>
                                <div class="form-group">
                                    <label for="nama_member">Nama</label>
                                    <input type="text" name="nama_member" id="nama_member" class="form-control" placeholder="Nama Pembeli" autofocus required autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" name="nik" id="nik" class="form-control" placeholder="NIK Pembeli" pattern="[0-9]{16,16}" required>
                                </div>
                                <div class="form-group">
                                    <label for="nohp">Nomor HP</label>
                                    <input type="text" name="nohp" id="nohp" class="form-control" placeholder="Nomor HP Pembeli" pattern="[0-9]{5,}" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" rows="3" class="form-control" required placeholder="Alamat Pembeli"></textarea>
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