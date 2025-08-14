<?php
session_start();

if (isset($_SESSION["login"])) {
    header('location: ../index.php');
    exit();
}

require_once "../config/config.php";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['user_name']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $queryLogin = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE user_name='$username'");

    if (mysqli_num_rows($queryLogin) === 1) {
        $row = mysqli_fetch_assoc($queryLogin);
        if (password_verify($password, $row['password'])) {
            // Set Session
            $_SESSION["login"] = true;
            $_SESSION["user"] = $username;

            header('location: ../dashboard.php');
            exit();
        } else {
            echo "<script>alert('Password Salah!');</script>";
        }
    } else {
        echo "<script>alert('Username tidak terdaftar!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | YRD-POS</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= $main_url ?>assets/Admin_akd/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= $main_url ?>assets/Admin_akd/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= $main_url ?>assets/Admin_akd/dist/css/adminlte.min.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= $main_url ?>assets/image/Logo-Politeknik-Negeri-Bali.png">
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="hold-transition login-page" id="login">
    <div class="login-box animate__animated animate__fadeInUp animate__faster" style="margin-top: -70px;">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>YRD</b>POS</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="" method="post">
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" name="user_name" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </form>
                <p class="my-3 text-center">
                    <strong>Copyright &copy; 2024 <span class="text-info">YRD</span></strong>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= $main_url ?>assets/Admin_akd/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= $main_url ?>assets/Admin_akd/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= $main_url ?>assets/Admin_akd/dist/js/adminlte.min.js"></script>
</body>

</html>