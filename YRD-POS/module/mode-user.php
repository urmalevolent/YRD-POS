<?php

if (userLogin()['jabatan'] != 1) {
    header('location: ' . $main_url . "error-page.php");
    exit();
}

function insert($data)
{
    global $koneksi;

    $user_name = strtolower(mysqli_real_escape_string($koneksi, $data['user_name']));
    $nama_pengguna = mysqli_real_escape_string($koneksi, $data['nama_pengguna']);
    $password = mysqli_real_escape_string($koneksi, $data['password']);
    $password2 = mysqli_real_escape_string($koneksi, $data['password2']);
    $jabatan = mysqli_real_escape_string($koneksi, $data['jabatan']);
    $nohp_pengguna = mysqli_real_escape_string($koneksi, $data['nohp_pengguna']);
    $gambar = mysqli_real_escape_string($koneksi, $_FILES['image']['name']);

    if ($password !== $password2) {
        echo "<script>alert('Konfirmasi password tidak sesuai, User baru gagal ditambahkan!');</script>";
        return false;
    }

    $pass = password_hash($password, PASSWORD_DEFAULT);

    $cekUsername = mysqli_query($koneksi, "SELECT user_name FROM pengguna WHERE user_name='$user_name'");
    if (mysqli_num_rows($cekUsername) > 0) {
        echo "<script>alert('Username sudah terpakai, User baru gagal ditambahkan!');</script>";
        return false;
    }

    if ($gambar != null) {
        $gambar = uploadImg();
    } else {
        $gambar = 'default.png';
    }

    // Gambar tidak sesuai validasi
    if ($gambar == '') {
        return false;
    }

    $query = "INSERT INTO pengguna VALUE(null, '$user_name', '$pass', '$nama_pengguna', '$jabatan', '$nohp_pengguna', '$gambar')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function delete($id, $foto)
{
    global $koneksi;

    $query = "DELETE FROM pengguna WHERE id_pengguna = $id";
    mysqli_query($koneksi, $query);
    if ($foto != 'default.png') {
        unlink('../assets/image/' . $foto);
    }

    return mysqli_affected_rows($koneksi);
}

function selectUser1($jabatan)
{
    $result = null;
    if ($jabatan == 1) {
        $result = 'selected';
    }

    return $result;
}
function selectUser2($jabatan)
{
    $result = null;
    if ($jabatan == 2) {
        $result = 'selected';
    }

    return $result;
}
function selectUser3($jabatan)
{
    $result = null;
    if ($jabatan == 3) {
        $result = 'selected';
    }

    return $result;
}

function update($data)
{
    global $koneksi;

    $id_pengguna = mysqli_real_escape_string($koneksi, $data['id']);
    $user_name = strtolower(mysqli_real_escape_string($koneksi, $data['user_name']));
    $nama_pengguna = mysqli_real_escape_string($koneksi, $data['nama_pengguna']);
    $jabatan = mysqli_real_escape_string($koneksi, $data['jabatan']);
    $nohp_pengguna = mysqli_real_escape_string($koneksi, $data['nohp_pengguna']);
    $gambar = mysqli_real_escape_string($koneksi, $_FILES['image']['name']);
    $fotoLama = mysqli_real_escape_string($koneksi, $data['oldImg']);

    // Cek username sekarang
    $queryUsername = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE id_pengguna='$id_pengguna'");
    $dataUsername = mysqli_fetch_assoc($queryUsername);
    $currentUsername = $dataUsername['user_name'];

    // Cek username baru
    $newUsername = mysqli_query($koneksi, "SELECT user_name FROM pengguna WHERE user_name='$user_name'");

    if ($user_name !== $currentUsername) {
        if (mysqli_num_rows($newUsername)) {
            echo "
                <script>
                    alert('Username sudah terpakai, edit data user gagal!');
                    document.location.href = 'data-user.php';
                </script>
                ";
            return false;
        }
    }

    // Cek gambar 
    if ($gambar != null) {
        $url = 'data-user.php';
        $imgUser = uploadImg($url);
        if ($fotoLama != 'default.png') {
            unlink('../assets/image/' . $fotoLama);
        }
    } else {
        $imgUser = $fotoLama;
    }

    mysqli_query($koneksi, "UPDATE pengguna SET 
                            user_name = '$user_name',
                            nama_pengguna = '$nama_pengguna',
                            jabatan = '$jabatan',
                            nohp_pengguna = '$nohp_pengguna',
                            foto = '$imgUser' WHERE id_pengguna = '$id_pengguna'");

    return mysqli_affected_rows($koneksi);
}
