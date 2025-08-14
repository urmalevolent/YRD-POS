<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location: ../auth/login.php');
    exit();
}

require_once "../config/config.php";
require_once "../config/functions.php";

$nota = $_GET['nota'];
$dataJual = getData("SELECT * FROM transaksi WHERE no_transaksi='$nota'")[0];
$itemJual = getData("SELECT * FROM detail_transaksi WHERE no_transaksi='$nota'");


$username = userLogin()['user_name'];
$queryIdPengguna = mysqli_query($koneksi, "SELECT nama_pengguna FROM pengguna WHERE user_name='$username'");
$pengguna = mysqli_fetch_array($queryIdPengguna);
$namaPengguna = $pengguna[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Belanja</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
        }
    </style>
</head>

<body>

    <table style="border-bottom: solid 2px; text-align: center; font-size: 14px; width: 240px;">
        <tr>
            <td><b>YRD POS</b></td>
        </tr>
        <tr>
            <td><?= 'No Nota: ' . $nota;  ?></td>
        </tr>
        <tr>
            <td><?= date('d-m-Y H:i:s');  ?></td>
        </tr>
        <tr>
            <td>Kasir: <?= $namaPengguna;  ?></td>
        </tr>
    </table>

    <table style="border-bottom: dotted 2px; font-size: 14px; width: 240px;">
        <?php
        foreach ($itemJual as $item) {
        ?>
            <tr>
                <td colspan="6"><?= $item['nama_produk'];  ?></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 70px;">Qty: </td>
                <td style="width: 10px; text-align: right;"><?= $item['qty'];  ?></td>
                <td style="width: 70px; text-align: right;">x <?= number_format($item['harga_jual'], 0, ',', '.') ?></td>
                <td style="width: 70px; text-align: right;" colspan="2"><?= number_format($item['total_harga'], 0, ',', '.') ?></td>
            </tr>
        <?php
        }
        ?>
    </table>

    <table style="border-bottom: solid 2px; font-size: 14px; width: 240px;">
        <tr>
            <td colspan="3" style="width: 100px;"></td>
            <td style="width: 50px; text-align: right;">TOTAL</td>
            <td style="width: 70px; text-align: right;" colspan="2"><b><?= number_format($dataJual['total_transaksi'], 0, ',', '.') ?></b></td>
        </tr>
        <tr>
            <td colspan="3" style="width: 100px;"></td>
            <td style="width: 50px; text-align: right;">BAYAR</td>
            <td style="width: 70px; text-align: right;" colspan="2"><b><?= number_format($dataJual['jml_bayar'], 0, ',', '.') ?></b></td>
        </tr>
        <tr>
            <td colspan="3" style="width: 100px;"></td>
            <td style="width: 50px; text-align: right;">KEMBALI</td>
            <td style="width: 70px; text-align: right;" colspan="2"><b><?= number_format($dataJual['kembalian'], 0, ',', '.') ?></b></td>
        </tr>
    </table>
    <table style="text-align: center; margin-top: 5px; font-size: 14px; width: 240px;">
        <tr>
            <td>TERIMA KASIH, SELAMAT BELANJA KEMBALI</td>
        </tr>
    </table>

    <script>
        // setTimeout(() => {
        //     window.print();
        // }, 5000);
    </script>
</body>

</html>