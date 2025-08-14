<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location: ../auth/login.php');
    exit();
}
require_once "../config/config.php";
require_once "../config/functions.php";
require_once "../module/mode-user.php";


$title = "Edit User - YRD POS";
require_once "../templates/header.php";
require_once "../templates/navbar.php";
require_once "../templates/sidebar.php";

$id = $_GET['id'];
$query = "SELECT * FROM pengguna WHERE id_pengguna='$id'";

$user = getData($query)[0];
$jabatan = $user['jabatan'];

if (isset($_POST['edit-btn'])) {
    if (update($_POST)) {
        echo "
                <script>
                    alert('Data user berhasil diedit..');
                    document.location.href = 'data-user.php';
                </script>
                ";
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
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>user/data-user.php">Users</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
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
                            <i class="fa-solid fa-pen fa-sm"></i> Edit User
                        </h3>
                        <button type="submit" name="edit-btn" class="btn btn-primary btn-sm float-right"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                        <button type="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fa-solid fa-xmark"></i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" value="<?= $user['id_pengguna'] ?>" name="id">
                            <div class="col-lg-8 mb-3">
                                <div class="form-group">
                                    <label for="user_name">Username</label>
                                    <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Masukan username" autofocus autocomplete="off" value="<?= $user['user_name'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama_pengguna">Fullname</label>
                                    <input type="text" name="nama_pengguna" id="nama_pengguna" class="form-control" placeholder="Masukan nama lengkap" value="<?= $user['nama_pengguna'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <select name="jabatan" id="jabatan" class="form-control" required>
                                        <option value="">-- Jabatan User --</option>
                                        <option value="1" <?= selectUser1($jabatan); ?>>Administrator</option>
                                        <option value="2" <?= selectUser2($jabatan); ?>>Supervisor</option>
                                        <option value="3" <?= selectUser3($jabatan); ?>>Operator</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nohp_pengguna">No HP</label>
                                    <input type="text" name="nohp_pengguna" id="nohp_pengguna" class="form-control" placeholder="Masukan nomor hp" value="<?= $user['nohp_pengguna'] ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center">
                                <input type="hidden" name="oldImg" value="<?= $user['foto'] ?>">
                                <img width="100" height="100" style="object-fit: cover;" src="<?= $main_url ?>assets/image/<?= $user['foto'] ?>" class="profile-user-img img-circle mb-3" alt="">
                                <input type="file" name="image" class="form-control">
                                <span class="text-sm">Type file gambar JPG | JPEG | PNG</span><br>
                                <span class="text-sm">Width = Height</span>
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