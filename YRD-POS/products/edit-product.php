<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location: ../auth/login.php');
    exit();
}
require_once "../config/config.php";
require_once "../config/functions.php";
require_once "../module/mode-product.php";


$title = "Edit Product - YRD POS";
require_once "../templates/header.php";
require_once "../templates/navbar.php";
require_once "../templates/sidebar.php";


if (isset($_POST['edit-btn'])) {
    if (update($_POST)) {
        echo "<script>document.location.href = 'data-products.php?msg=updated'</script>";
    }
}

$alert = '';

$id = $_GET['id'];

if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'available') {
        $alert = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <i class='icon fas fa-exclamation-triangle'></i>Nama produk sudah terpakai, data produk gagal diedit!
            <button type='button' class='close' data-dismiss='alert' aria-lable='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
    }
}

$query = "SELECT * FROM produk WHERE kode_produk='$id'";

$product = getData($query)[0];


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Products</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>products/data-products.php">Products</a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if ($alert != '') {
                echo $alert;
            } ?>
            <div class="card">
                <form action="" method="POST">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa-solid fa-pen fa-sm"></i> Edit Product
                        </h3>
                        <button type="submit" name="edit-btn" class="btn btn-primary btn-sm float-right"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                        <button type="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fa-solid fa-xmark"></i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 mb-3">
                                <div class="form-group">
                                    <label for="kode_produk">Kode Produk</label>
                                    <input type="text" name="kode_produk" id="kode_produk" class="form-control" value="<?= $product["kode_produk"] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama_produk">Nama Produk</label>
                                    <input type="text" name="nama_produk" id="nama_produk" class="form-control" placeholder="Masukan nama produk" autofocus autocomplete="off" value="<?= $product['nama_produk'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="satuan">Satuan *</label>
                                    <select name="satuan" class="form-control" id="satuan" required>
                                        <option value="">-- Satuan Produk--</option>
                                        <?php
                                        $productSatuan  = ["piece", "botol", "kaleng", "poach"];
                                        foreach ($productSatuan as $satuan) {
                                            if ($product['satuan'] == $satuan) {
                                        ?>
                                                <option value="<?= $satuan ?>" selected><?= $satuan ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $satuan ?>"><?= $satuan ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="harga_jual">Harga Jual</label>
                                    <input type="number" name="harga_jual" id="harga_jual" class="form-control" value="<?= $product["harga_jual"] ?>" placeholder="Rp. 0" autocomplete="off" required>
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