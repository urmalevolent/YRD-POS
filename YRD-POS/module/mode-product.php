<?php

if (userLogin()["jabatan"] == 3) {
    header("location:" . $main_url . "error-page.php");
    exit();
}


function generatedId()
{
    global $koneksi;

    $query = mysqli_query($koneksi, "SELECT max(kode_produk) AS maxid FROM produk");
    $data = mysqli_fetch_array($query);
    $maxid = $data["maxid"];
    if ($maxid == NULL) {
        $maxid = "0";
    }
    $noUrut = (int) substr($maxid, 3, 3);
    $noUrut++;
    $maxid = "PD-" . sprintf("%03s", $noUrut);

    return $maxid;
}

function insert($data)
{
    global $koneksi;

    $id = mysqli_real_escape_string($koneksi, $data['kode_produk']);
    $nama_produk = mysqli_real_escape_string($koneksi, $data['nama_produk']);
    $satuan = mysqli_real_escape_string($koneksi, $data['satuan']);
    $harga_jual = mysqli_real_escape_string($koneksi, $data['harga_jual']);


    $query = "INSERT INTO produk VALUES ('$id', '$nama_produk', '$satuan', '$harga_jual')";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function delete($id)
{
    global $koneksi;

    $query = "DELETE FROM produk WHERE kode_produk='$id'";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}



function update($data)
{
    global $koneksi;

    $kode_produk = mysqli_real_escape_string($koneksi, $data['kode_produk']);
    $nama_produk = mysqli_real_escape_string($koneksi, $data['nama_produk']);
    $satuan = mysqli_real_escape_string($koneksi, $data['satuan']);
    $harga_jual = mysqli_real_escape_string($koneksi, $data['harga_jual']);

    // Cek nama produk sekarang
    $query = mysqli_query($koneksi, "SELECT * FROM produk WHERE kode_produk='$kode_produk'");
    $dataProduct = mysqli_fetch_assoc($query);
    $currentProduct = $dataProduct['nama_produk'];

    // Cek nama produk baru
    $newCustomer = mysqli_query($koneksi, "SELECT nama_produk FROM produk WHERE nama_produk='$nama_produk'");

    if ($nama_produk !== $currentProduct) {
        if (mysqli_num_rows($newCustomer)) {
            echo "
                <script>
                    document.location.href = 'edit-product.php?id=" . $kode_produk . "&msg=available';
                </script>
                ";
            exit();
        }
    }

    mysqli_query($koneksi, "UPDATE produk SET 
                            nama_produk = '$nama_produk',
                            satuan = '$satuan',
                            harga_jual = '$harga_jual' WHERE kode_produk='$kode_produk'");

    return mysqli_affected_rows($koneksi);
}
