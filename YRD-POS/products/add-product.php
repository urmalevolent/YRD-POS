<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location: ../auth/login.php');
    exit();
}

require_once "../config/config.php";
require_once "../config/functions.php";
require_once "../module/mode-product.php";

$title = "Tambah Product - YRD POS";
require_once "../templates/header.php";
require_once "../templates/navbar.php";
require_once "../templates/sidebar.php";

$alert = '';

if (isset($_POST["simpan"])) {
    if (insert($_POST)) {
        $alert = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <i class='icon fas fa-check'></i>Data produk baru berhasil ditambahkan!
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
                    <h1 class="m-0">Products</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>products/data-products.php">Products</a></li>
                        <li class="breadcrumb-item active">Add Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa-solid fa-plus fa-sm"></i> Add Product
                        </h3>
                        <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                        <button type="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fa-solid fa-xmark"></i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 mb-3 pr-3">
                                <?php if ($alert != '') {
                                    echo $alert;
                                } ?>
                                <div class="form-group">
                                    <label for="kode_produk">Kode Produk</label>
                                    <input type="text" name="kode_produk" id="kode_produk" class="form-control" value="<?= generatedId();  ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama_produk">Nama Produk *</label>
                                    <input type="text" name="nama_produk" id="nama_produk" class="form-control" placeholder="Masukan nama produk" autocomplete="off" autofocus required>
                                </div>
                                <div class="form-group">
                                    <label for="satuan">Satuan *</label>
                                    <select name="satuan" class="form-control" id="satuan" required>
                                        <option value="">-- Satuan Produk--</option>
                                        <option value="piece">piece</option>
                                        <option value="botol">botol</option>
                                        <option value="kaleng">kaleng</option>
                                        <option value="bungkus">bungkus</option>
                                        <option value="liter">liter</option>
                                        <option value="kg">kg</option>
                                        <option value="butir">butir</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="harga_jual">Harga Jual Produk *</label>
                                    <input type="number" name="harga_jual" id="harga_jual" class="form-control" placeholder="Rp. 0" autocomplete="off" required>
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