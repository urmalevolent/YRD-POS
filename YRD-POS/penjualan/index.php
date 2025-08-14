<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location: ../auth/login.php');
    exit();
}

require_once "../config/config.php";
require_once "../config/functions.php";
require_once "../module/mode-transaksi.php";

$title = "Transaksi - YRD-POS";
require_once "../templates/header.php";
require_once "../templates/navbar.php";
require_once "../templates/sidebar.php";


if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

if ($msg == 'deleted') {
    $idPrdk = $_GET['idPrdk'];
    $idTransaksi = $_GET['idTransaksi'];
    $qty = $_GET['qty'];
    $tgl = $_GET['tgl'];

    delete($idPrdk, $idTransaksi, $qty);
    echo "<script>
            document.location = '?tgl=$tgl';
            </script>";
}

$kode = @$_GET['pilihPrdk'] ? @$_GET['pilihPrdk'] : '';
if ($kode) {
    $selectPrdk = getData("SELECT * FROM produk WHERE kode_produk='$kode'")[0];
}

// $buffer = array("no_transaksi" => [], "tgl_transaksi" => [], "kode_produk" => [], "nama_produk" => [], "qty" => [], "harga" => [], "total_harga" => []);
if (isset($_POST['addProduk'])) {
    $tgl = $_POST['tglTransaksi'];
    // $carts = insert($_POST, $buffer);
    // var_dump($carts);
    if (insert($_POST)) {
        // $carts = insert($_POST);
        echo "<script>
                document.location = '?tgl=$tgl';
            </script>";
    };
}

$noTransaksi = generateNo();

if (isset($_POST['simpan'])) {
    $nota = $_POST['noTransaksi'];

    if ($_POST['total'] == '0') {
        echo "<script>
                alert('Belum ada produk yang dipilih!');
                document.location.href = '?msg=gagal';
            </script>";
        die();
    }

    if ($_POST['bayar'] == '') {
        echo "<script>
                alert('Field bayar belum diisi!');
                document.location.href = '?msg=gagal';
            </script>";
        die();
    }


    if (simpan($_POST)) {
        echo "<script>
                alert('Data transaksi berhasil disimpan');
                window.onload = () => {
                    let win = window.open('../report/r-struk.php?nota=$nota', 'Struk Belanja', 'width=260, height=400, left=10, top=10', '_blank');
                     if(win){
                        win.focus();
                        window.location = 'index.php';
                     }
                }
            </script>";
    }
}

$username = userLogin()['user_name'];
$queryIdPengguna = mysqli_query($koneksi, "SELECT id_pengguna, nama_pengguna FROM pengguna WHERE user_name='$username'");
$pengguna = mysqli_fetch_array($queryIdPengguna);
$idPengguna = $pengguna[0];
$namaPengguna = $pengguna[1];


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Transaksi Produk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Transaksi</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section>
        <div class="container-fluid">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-outline card-warning p-3">
                            <div class="form-group row mb-2">
                                <label for="noTransaksi" class="col-sm-2 col-form-label">No</label>
                                <div class="col-sm-4">
                                    <input type="text" name="noTransaksi" class="form-control" id="noTransaksi" value="<?= $noTransaksi; ?>" readonly>
                                </div>
                                <label for="tglTransaksi" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-4">
                                    <input type="date" name="tglTransaksi" class="form-control" id="tglTransaksi" value="<?= date('Y-m-d'); ?>" required>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="namaPengguna" class="col-sm-2 col-form-label">Kasir</label>
                                <div class="col-sm-10">
                                    <input type="text" name="namaPengguna" class="form-control" id="namaPengguna" value="<?= $namaPengguna; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="kodeProduk" class="col-sm-2 col-form-label">SKU</label>
                                <div class="col-sm-10">
                                    <select name="kodeProduk" id="kodeProduk" class="form-control">
                                        <option value="">-- Pilih kode produk --</option>
                                        <?php
                                        $produk = getData("SELECT * FROM produk");
                                        foreach ($produk as $prdk) { ?>
                                            <option value="?pilihPrdk=<?= $prdk['kode_produk']; ?>" <?= @$_GET['pilihPrdk'] == $prdk['kode_produk'] ? 'selected' : null  ?>><?= $prdk['kode_produk'] . ' | ' . $prdk['nama_produk'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-outline card-danger pt-3 px-3 pb-2">
                            <h6 class="font-weight-bold text-right">Total Transaksi</h6>
                            <h1 class="font-weight-bold text-right" style="font-size: 50pt; padding: 15px 0;">
                                <input type="hidden" id="totalTransaksi" name="total" value="<?= totalHarga($noTransaksi) ?>">
                                Rp. <?= number_format(totalHarga($noTransaksi), 0, ',', '.');  ?>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="card pt-1 pb-2 px-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <?php

                                ?>
                                <input type="hidden" name="idPengguna" value="<?= $idPengguna; ?>">
                                <input type="hidden" value="<?= @$_GET['pilihPrdk'] ? $selectPrdk['kode_produk'] : '' ?>" name="kode_produk" id="kode_produk">
                                <label for="namaProduk">Nama Produk</label>
                                <input type="text" name="namaProduk" class="form-control form-control-sm" id="namaProduk" value="<?= @$_GET['pilihPrdk'] ? $selectPrdk['nama_produk'] : '' ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" name="satuan" class="form-control form-control-sm" id="satuan" value="<?= @$_GET['pilihPrdk'] ? $selectPrdk['satuan'] : ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" name="harga" class="form-control form-control-sm" id="harga" value="<?= @$_GET['pilihPrdk'] ? $selectPrdk['harga_jual'] : '' ?>" readonly>
                            </div>
                        </div>
                        <div class=" col-lg-2">
                            <div class="form-group">
                                <label for="qty">Qty</label>
                                <input type="number" name="qty" class="form-control form-control-sm" id="qty" value="<?= @$_GET['pilihPrdk'] ? 1 : '' ?>" min="1">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="jmlHarga">Jumlah Harga</label>
                                <input type="number" name="jmlHarga" class="form-control form-control-sm" id="jmlHarga" value="<?= @$_GET['pilihPrdk'] ? $selectPrdk['harga_jual'] : '' ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-info btn-block" name="addProduk"><i class="fas fa-cart-plus fa-sm"></i> Tambah Produk</button>
                </div>
                <div class="card card-outline card-success table-responsive px-2">
                    <table class="table table-sm table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th class="text-right">Harga</th>
                                <th class="text-right">Qty</th>
                                <th class="text-right">Jumlah Harga</th>
                                <th class="text-center" width="10%">Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $prdkDetail = getData("SELECT * FROM detail_transaksi WHERE no_transaksi='$noTransaksi'");
                            foreach ($prdkDetail as $detail) { ?>
                                <tr>
                                    <td><?= $no++;  ?></td>
                                    <td><?= $detail['kode_produk'];  ?></td>
                                    <td><?= $detail['nama_produk'];  ?></td>
                                    <td class="text-right"><?= number_format($detail['harga_jual'], 0, ',', '.');  ?></td>
                                    <td class="text-right"><?= $detail['qty'];  ?></td>
                                    <td class="text-right"><?= number_format($detail['total_harga'], 0, ',', '.');  ?></td>
                                    <td class="text-center">
                                        <a href="?idPrdk=<?= $detail['kode_produk'] ?>&idTransaksi=<?= $detail['no_transaksi'] ?>&qty=<?= $detail['qty'] ?>&tgl=<?= $detail['tgl_transaksi']; ?>&msg=deleted" class="btn btn-danger btn-sm" title="hapus produk" onclick="return confirm('Anda yakin akan menghapus produk ini?');"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 p-2">
                        <div class="form-group row mb-2">
                            <label for="member" class="col-sm-3 col-form-label col-form-label-sm">Member</label>
                            <div class="col-sm-9">
                                <select name="member" id="member" class="form-control form-control-sm select2" data-placeholder="-- Pilih member --" style="width: 100%;">
                                    <option value="0">-- Pilih member --</option>
                                    <option value="umum">Umum</option>
                                    <?php
                                    $Members = getData("SELECT * FROM pembeli");
                                    foreach ($Members as $member) {
                                    ?>
                                        <option value="<?= $member['nama_member'] ?>"><?= $member['nama_member'];  ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <di class="form-group row mb-2">
                            <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <textarea name="keterangan" id="keterangan" class="form-control form-contorl-sm"></textarea>
                            </div>
                        </di v>
                    </div>
                    <div class="col-lg-4 py-2 px-3">
                        <div class="form-group row mb-2">
                            <label for="bayar" class="col-sm-3 col-form-label">Bayar</label>
                            <div class="col-sm-9">
                                <input type="number" name="bayar" id="bayar" class="form-control form-control-sm text-right">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="kembalian" class="col-sm-3 col-form-label">Kembalian</label>
                            <div class="col-sm-9">
                                <input type="number" name="kembalian" id="kembalian" class="form-control form-control-sm text-right" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4 p-2">
                        <button type="submit" name="simpan" id="simpan" class="btn btn-primary btn-sm btn-block"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </section>




    <script>
        new SlimSelect({
            select: '#kodeProduk',
        })
        new SlimSelect({
            select: '#member',
        })

        let pilihPrdk = document.getElementById('kodeProduk');

        pilihPrdk.addEventListener('change', (e) => {
            document.location.href = e.target[e.target.selectedIndex].value;
        });

        let qty = document.getElementById('qty');
        let jmlHarga = document.getElementById('jmlHarga');
        let harga = document.getElementById('harga');
        let bayar = document.getElementById('bayar');
        let kembalian = document.getElementById('kembalian');
        let total = document.getElementById('totalTransaksi');

        qty.addEventListener('input', () => {
            jmlHarga.value = qty.value * harga.value;
        });

        bayar.addEventListener('input', () => {
            kembalian.value = bayar.value - total.value;
        });
    </script>

    <?php
    require_once "../templates/footer.php";
    ?>