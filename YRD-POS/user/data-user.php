<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location: ../auth/login.php');
    exit();
}

require_once "../config/config.php";
require_once "../config/functions.php";
require_once "../module/mode-user.php";

$title = "Users - YRD POS";
require_once "../templates/header.php";
require_once "../templates/navbar.php";
require_once "../templates/sidebar.php";
?>

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
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa-solid fa-list fa-sm"></i> Data User</h3>
                    <div class="card-tools">
                        <a href="<?= $main_url ?>user/add-user.php" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus fa-sm"></i>Add User</a>
                    </div>
                </div>
                <div class="card-body table-responsive p-3">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Username</th>
                                <th>Fullname</th>
                                <th>Nomor HP</th>
                                <th>Jabatan</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $users = getData("SELECT * FROM pengguna");
                            foreach ($users as $user) : ?>
                                <tr>
                                    <td class="align-middle pl-3"><?= $no++;  ?></td>
                                    <td><img src="../assets/image/<?= $user['foto']; ?>" class="rounded-circle" style="object-position: center; object-fit: cover;" width="60" height="60"></td>
                                    <td class="align-middle"><?= $user['user_name'];  ?></td>
                                    <td class="align-middle"><?= $user['nama_pengguna'];  ?></td>
                                    <td class="align-middle"><?= $user['nohp_pengguna'];  ?></td>
                                    <td class="align-middle"><?php
                                                                if ($user['jabatan'] === '1') {
                                                                    echo "Administrator";
                                                                } else if ($user['jabatan'] === '2') {
                                                                    echo "Supervisor";
                                                                } else {
                                                                    echo "Operator";
                                                                }
                                                                ?></td>
                                    <td class="align-middle">
                                        <a href="edit-user.php?id=<?= $user['id_pengguna'] ?>" class="btn btn-sm btn-warning" title="edit user">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="delete-user.php?id=<?= $user['id_pengguna'] ?>&foto=<?= $user['foto'] ?>" class="btn btn-sm btn-danger" title="hapus user" onclick="return confirm('Anda yakin akan menghapus user ini?');">
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