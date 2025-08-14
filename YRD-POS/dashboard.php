<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location: auth/login.php');
    exit();
}

require_once "config/config.php";
require_once "config/functions.php";

$title = "Dashboard - YRD POS";
require_once "templates/header.php";
require_once "templates/navbar.php";
require_once "templates/sidebar.php";


$getTotalUsers = mysqli_query($koneksi, "SELECT COUNT(*) AS 'total' FROM pengguna");
$totalUsers = mysqli_fetch_assoc($getTotalUsers);
$getTotalCustomers = mysqli_query($koneksi, "SELECT COUNT(*) AS 'total' FROM pembeli");
$totalCustomers = mysqli_fetch_assoc($getTotalCustomers);
$getTotalProducts = mysqli_query($koneksi, "SELECT COUNT(*) AS 'total' FROM produk");
$totalProducts = mysqli_fetch_assoc($getTotalProducts);
$getTotalTransaksi = mysqli_query($koneksi, "SELECT COUNT(*) AS 'total' FROM transaksi");
$totalTransaksi = mysqli_fetch_assoc($getTotalTransaksi);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $totalUsers['total'];  ?></h3>

                            <p>Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="<?= $main_url ?>user/data-user.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $totalCustomers['total'];  ?></h3>

                            <p>Customer</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                        <a href="<?= $main_url ?>customer/data-customer.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $totalProducts['total'];  ?></h3>

                            <p>Products</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-cart"></i>
                        </div>
                        <a href="<?= $main_url ?>products/data-products.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $totalTransaksi['total'];  ?></h3>

                            <p>Transaksi</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-card"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->

    <?php

    require_once "templates/footer.php";

    ?>