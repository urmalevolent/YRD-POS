<?php

function uploadImg($url = null)
{
    $namaFile = $_FILES['image']['name'];
    $ukuran = $_FILES['image']['size'];
    $tmp = $_FILES['image']['tmp_name'];

    // Validasi file gambar yang boleh diupload
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        if ($url != null) {
            echo "<script>alert('File yang anda upload bukan gambar, Data gagal diedit!');
            document.location.href='" . $url . "';</script>";
            die();
        } else {
            echo "<script>alert('File yang anda upload bukan gambar, Data gagal ditambahkan!');</script>";
            return false;
        }
    }

    // Validasi ukuran gambar max 5 MB
    if ($ukuran > 5000000) {
        if ($url != null) {
            echo "<script>alert('Ukuran gambar melebihi 5 MB, Data gagal diedit!');
            document.location.href='" . $url . "';</script>";
            die();
        } else {
            echo "<script>alert('Ukuran gambar melebihi 5 MB, Data gagal ditambahkan!');</script>";
            return false;
        }
    }

    $namaFileBaru = rand(10, 1000) . "-" . $namaFile;
    move_uploaded_file($tmp, '../assets/image/' . $namaFileBaru);
    return $namaFileBaru;
}


function getData($query)
{
    global $koneksi;

    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function userLogin()
{
    $userActive = $_SESSION["user"];
    $dataUser = getData("SELECT * FROM pengguna WHERE user_name='$userActive'")[0];
    return $dataUser;
}

function userMenu()
{
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $menu = $uri_segments[2];
    return $menu;
}

function menuHome()
{
    if (userMenu() == 'dashboard.php') {
        $result = 'active';
    } else {
        $result = null;
    }

    return $result;
}

function menuPenjualan()
{
    if (userMenu() == 'penjualan') {
        $result = 'active';
    } else {
        $result = null;
    }

    return $result;
}

function menuSetting()
{
    if (userMenu() == 'user') {
        $result = 'menu-is-opening menu-open';
    } else {
        $result = null;
    }
    return $result;
}

function menuUser()
{
    if (userMenu() == 'user') {
        $result = 'active';
    } else {
        $result = null;
    }

    return $result;
}

function menuMaster()
{
    if (userMenu() == 'customer' || userMenu() == 'products') {
        $result = 'menu-is-opening menu-open';
    } else {
        $result = null;
    }
    return $result;
}

function menuCustomer()
{
    if (userMenu() == 'customer') {
        $result = 'active';
    } else {
        $result = null;
    }

    return $result;
}

function menuProducts()
{
    if (userMenu() == 'products') {
        $result = 'active';
    } else {
        $result = null;
    }

    return $result;
}
