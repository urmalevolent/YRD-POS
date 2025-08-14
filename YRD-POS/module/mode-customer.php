<?php

if (userLogin()["jabatan"] == 3) {
    header("location:" . $main_url . "error-page.php");
    exit();
}

function insert($data)
{
    global $koneksi;
    $nama_member = mysqli_real_escape_string($koneksi, $data['nama_member']);
    $nik = mysqli_real_escape_string($koneksi, $data['nik']);
    $nohp = mysqli_real_escape_string($koneksi, $data['nohp']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);

    $query = "INSERT INTO pembeli VALUES (null, '$nama_member', '$nik', '$alamat', '$nohp')";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function delete($id)
{
    global $koneksi;

    $query = "DELETE FROM pembeli WHERE id_member = $id";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


function update($data)
{
    global $koneksi;

    $id_member = mysqli_real_escape_string($koneksi, $data['id']);
    $nama_member = mysqli_real_escape_string($koneksi, $data['nama_member']);
    $nik = mysqli_real_escape_string($koneksi, $data['nik']);
    $nohp = mysqli_real_escape_string($koneksi, $data['nohp']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);

    // // Cek nama pembeli sekarang
    // $queryCustomer = mysqli_query($koneksi, "SELECT * FROM pembeli WHERE id_member='$id_member'");
    // $dataCustomer = mysqli_fetch_assoc($queryCustomer);
    // $currentCustomer = $dataCustomer['nama_member'];

    // // Cek nama pembeli baru
    // $newCustomer = mysqli_query($koneksi, "SELECT nama_member FROM pembeli WHERE nama_member='$nama_member'");

    // if ($nama_member !== $currentCustomer) {
    //     if (mysqli_num_rows($newCustomer)) {
    //         echo "
    //             <script>
    //                 alert('Nama Pembeli sudah terpakai, edit data customer gagal!');
    //                 document.location.href = 'data-customer.php';
    //             </script>
    //             ";
    //         return false;
    //     }
    // }

    mysqli_query($koneksi, "UPDATE pembeli SET 
                            nama_member = '$nama_member',
                            nik = '$nik',
                            nohp = '$nohp',
                            alamat = '$alamat' WHERE id_member='$id_member'");

    return mysqli_affected_rows($koneksi);
}
