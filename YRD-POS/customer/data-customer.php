<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location: ../auth/login.php');
    exit();
}

require_once "../config/config.php";
require_once "../config/functions.php";
require_once "../module/mode-customer.php";

$title = "Customer - YRD POS";
require_once "../templates/header.php";
require_once "../templates/navbar.php";
require_once "../templates/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

$alert = '';

if ($msg == 'deleted') {
    $alert = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <i class='icon fas fa-check'></i>Data Pembeli berhasil dihapus!
            <button type='button' class='close' data-dismiss='alert' aria-lable='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
} else if ($msg == 'aborted') {
    $alert = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <i class='icon fas fa-exclamation-triangle'></i>Data Pembeli gagal dihapus!
            <button type='button' class='close' data-dismiss='alert' aria-lable='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
}

if ($msg == 'updated') {
    $alert = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <i class='icon fas fa-check'></i>Data Pembeli berhasil diedit!
            <button type='button' class='close' data-dismiss='alert' aria-lable='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
}

?>

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
                        <li class="breadcrumb-item active">Customers</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <?php if ($alert != '') {
                echo $alert;
            } ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa-solid fa-list fa-sm"></i> Data Customers</h3>
                    <div class="card-tools">
                        <a href="<?= $main_url ?>customer/add-customer.php" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus fa-sm"></i>Add Customer</a>
                    </div>
                </div>
                <div class="card-body table-responsive p-3">
                    <table class="table table-hover text-nowrap" id="tblData">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Nomor HP</th>
                                <th>Alamat</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $customers = getData("SELECT * FROM pembeli");
                            foreach ($customers as $customer) : ?>
                                <tr>
                                    <td class="align-middle pl-3"><?= $no++;  ?></td>
                                    <td class="align-middle"><?= $customer['nama_member'];  ?></td>
                                    <td class="align-middle"><?= $customer['nik'];  ?></td>
                                    <td class="align-middle"><?= $customer['nohp'];  ?></td>
                                    <td class="align-middle"><?= $customer['alamat'];  ?></td>
                                    <td class="align-middle">
                                        <a href="edit-customer.php?id=<?= $customer['id_member'] ?>" class="btn btn-sm btn-warning" title="edit customer">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="delete-customer.php?id=<?= $customer['id_member'] ?>" class="btn btn-sm btn-danger" title="hapus customer" onclick="return confirm('Anda yakin akan menghapus customer ini?');">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php
    require_once "../templates/footer.php";

    ?>