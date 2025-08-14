<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= $main_url ?>dashboard.php" class="brand-link">
        <img src="<?= $main_url ?>assets/image/Logo-Politeknik-Negeri-Bali.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">YRD POS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $main_url ?>assets/image/<?= userLogin()['foto']; ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <?php
                $username = userLogin()['user_name'];
                $queryIdPengguna = mysqli_query($koneksi, "SELECT nama_pengguna FROM pengguna WHERE user_name='$username'");
                $pengguna = mysqli_fetch_array($queryIdPengguna);
                $namaPengguna = $pengguna[0];
                ?>
                <a href="#" class="d-block"><?=  $namaPengguna ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= $main_url ?>dashboard.php" class="nav-link <?= menuHome() ?>">
                        <i class="fa-solid fa-gauge-high nav-icon text-sm"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php if (userLogin()['jabatan'] != 3) : ?>
                    <li class="nav-item <?= menuMaster() ?>">
                        <a href="#" class="nav-link">
                            <i class="fa-solid fa-folder nav-icon text-sm"></i>
                            <p>Master
                                <i class="fa-solid fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $main_url ?>customer/data-customer.php" class="nav-link <?= menuCustomer(); ?>">
                                    <i class="fa-regular fa-circle nav-icon text-sm"></i>
                                    <p>Customers</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $main_url ?>products/data-products.php" class="nav-link <?= menuProducts(); ?>">
                                    <i class="fa-regular fa-circle nav-icon text-sm"></i>
                                    <p>Products</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <li class="nav-header">Transaksi</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-cart-shopping nav-icon text-sm"></i>
                        <p>Pembelian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $main_url ?>penjualan" class="nav-link <?= menuPenjualan(); ?>">
                        <i class="fa-solid fa-file-invoice nav-icon text-sm"></i>
                        <p>Penjualan</p>
                    </a>
                </li>
                <li class="nav-header">Report</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-chart-pie nav-icon text-sm"></i>
                        <p>Laporan Pembelian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-chart-line nav-icon text-sm"></i>
                        <p>Laporan Penjualan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-warehouse nav-icon text-sm"></i>
                        <p>Laporan Stock</p>
                    </a>
                </li>
                <?php if (userLogin()['jabatan'] == 1) : ?>
                    <li class="nav-item <?= menuSetting() ?>">
                        <a href="#" class="nav-link">
                            <i class="fa-solid fa-cog nav-icon text-sm"></i>
                            <p>Pengaturan
                                <i class="fa-solid fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $main_url ?>user/data-user.php" class="nav-link <?= menuUser() ?>">
                                    <i class="fa-regular fa-circle nav-icon text-sm"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>