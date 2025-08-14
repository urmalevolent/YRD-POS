<?php

function generateNo()
{
    global $koneksi;

    $query = mysqli_query($koneksi, "SELECT max(no_transaksi) as maxno FROM transaksi");
    $row = mysqli_fetch_assoc($query);
    $maxno = $row['maxno'];

    if ($maxno == NULL) {
        $maxno = "0";
    }
    $noUrut = (int) substr($maxno, 2, 4);
    $noUrut++;

    $maxno = "TR" . sprintf("%04s", $noUrut);

    return $maxno;
}

function totalHarga($noTransaksi)
{
    global $koneksi;

    $total = mysqli_query($koneksi, "SELECT sum(total_harga) as total FROM detail_transaksi WHERE no_transaksi='$noTransaksi'");
    $data = mysqli_fetch_assoc($total);
    $total = $data['total'];
    if ($total == NULL) {
        $total = "0";
    }

    return $total;
    // $result = 0;
    // foreach ($carts as $cart) {
    //     $result += $cart["total_harga"];
    // }
    // return $result;
    // return $carts;
}

function insert($data)
{
    global $koneksi;
    // var_dump($data);

    $noTransaksi = mysqli_real_escape_string($koneksi, $data['noTransaksi']);
    $tglTransaksi = mysqli_real_escape_string($koneksi, $data['tglTransaksi']);
    $kodeProduk = mysqli_real_escape_string($koneksi, $data['kode_produk']);
    $namaProduk = mysqli_real_escape_string($koneksi, $data['namaProduk']);
    $qty = mysqli_real_escape_string($koneksi, $data['qty']);
    $harga = mysqli_real_escape_string($koneksi, $data['harga']);
    $jmlHarga = mysqli_real_escape_string($koneksi, $data['jmlHarga']);
    $member = mysqli_real_escape_string($koneksi, $data['member']);
    // var_dump($member);
    if ($member != '0' && $member != 'umum') {
        $harga = (int) $harga;
        $sebelumDiskon = $harga;
        $diskon = $harga * 0.03;
        $harga = $sebelumDiskon - $diskon;
        // (int) $harga -= $diskon;
        // $harga -= $diskon;

        $jmlHarga = $harga * (int) $qty;
    };

    // var_dump($harga);

    // $carts['no_transaksi'] += [$noTransaksi];
    // $carts['tgl_transaksi'] += [$tglTransaksi];
    // $carts['kode_produk'] += [$kodeProduk];
    // $carts['nama_produk'] += [$namaProduk];
    // $carts['qty'] += [$qty];
    // $carts['harga'] += [$harga];
    // $carts['total_harga'] += [$jmlHarga];
    // var_dump($carts);   


    // $carts = array("no_transaksi" => $noTransaksi, "tgl_transaksi" => $tglTransaksi, "kode_produk" => $kodeProduk, "nama_produk" => $namaProduk, "qty" => $qty, "harga" => $harga, "total_harga" => $jmlHarga);

    $cekPrdk = mysqli_query($koneksi, "SELECT * FROM detail_transaksi WHERE kode_produk='$kodeProduk' AND no_transaksi='$noTransaksi'");

    if (mysqli_num_rows($cekPrdk)) {
        echo "<script>
                alert('Barang sudah ada, anda harus menghapusnya dulu jika ingin mengubah qty nya...');
             </script>";
        return false;
    }

    if (empty($qty)) {
        echo "<script>
                alert('Qty produk tidak boleh kosong!');
             </script>";
        return false;
    } else {
        $queryTransaksi = "INSERT INTO detail_transaksi VALUES(null, '$noTransaksi', '$tglTransaksi', '$kodeProduk', '$namaProduk', '$qty', '$harga', '$jmlHarga')";
        mysqli_query($koneksi, $queryTransaksi);
    }

    return mysqli_affected_rows($koneksi);
    // return $carts;

}

function delete($idPrdk, $idTransaksi, $qty)
{
    global $koneksi;
    $query = "DELETE FROM detail_transaksi WHERE kode_produk='$idPrdk' AND no_transaksi='$idTransaksi'";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function simpan($data)
{
    global $koneksi;
    // var_dump($data);

    $noTransaksi = mysqli_real_escape_string($koneksi, $data['noTransaksi']);
    $tglTransaksi = mysqli_real_escape_string($koneksi, $data['tglTransaksi']);
    $totalTransaksi = mysqli_real_escape_string($koneksi, $data['total']);
    // $member = strtolower(mysqli_real_escape_string($koneksi, $data['member']));
    $member = $data['member'] === "0" ? "NULL" : $data['member'];
    $idPengguna = mysqli_real_escape_string($koneksi, $data['idPengguna']);
    $jmlBayar = mysqli_real_escape_string($koneksi, $data['bayar']);
    $kembalian = mysqli_real_escape_string($koneksi, $data['kembalian']);


    if ($member !== "NULL") {
        $queryMember = mysqli_query($koneksi, "SELECT id_member FROM pembeli WHERE nama_member='$member'");
        $idMember = mysqli_fetch_array($queryMember)[0];
    } else {
        $idMember = $member;
    }



    $query = "INSERT INTO transaksi VALUES('$noTransaksi', '$tglTransaksi', '$idPengguna', " . $idMember . ", '$totalTransaksi', '$jmlBayar', '$kembalian')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
