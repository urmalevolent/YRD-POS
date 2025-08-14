<?php

function update($data)
{
    global $koneksi;

    $curPass = trim(mysqli_real_escape_string($koneksi, $_POST['curPass']));
    $newPass = trim(mysqli_real_escape_string($koneksi, $_POST['newPass']));
    $confPass = trim(mysqli_real_escape_string($koneksi, $_POST['confPass']));
    $userActive = userLogin()['user_name'];

    if ($newPass != $confPass) {
        echo "<script>
                alert('Password baru gagal diperbaharui!');
                document.location='?msg=err1';
            </script>";
        return false;
    }

    if (!password_verify($curPass, userLogin()['password'])) {
        echo "<script>
                alert('Password baru gagal diperbaharui!');
                document.location='?msg=err2';
            </script>";
        return false;
    } else {
        $pass = password_hash($newPass, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "UPDATE pengguna SET password='$pass' WHERE user_name='$userActive'");
        return mysqli_affected_rows($koneksi);
    }
}
