<?php
$uri = service('uri');
$session = session();
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url() ?>/docs/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">E-Klinik Maryam</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url() ?>/docs/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $session->get('nama_login'); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="<?= base_url('Admin/Dashboard'); ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'Dashboard') {
                                echo "active";
                            } ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">MASTER DATA</li>
                <li class="nav-item">
                    <a href="#" class="nav-link <?php
                            if (
                                $uri->getSegment(2) == 'Admin' ||
                                $uri->getSegment(2) == 'Dokter' || $uri->getSegment(2) == 'Hari' ||
                                $uri->getSegment(2) == 'Jabatan' || $uri->getSegment(2) == 'JadwalDokter' ||
                                $uri->getSegment(2) == 'Kamar' || $uri->getSegment(2) == 'Karyawan' || $uri->getSegment(2) == 'Obat' || $uri->getSegment(2) == 'Pasien' || $uri->getSegment(2) == 'Poliklinik' || $uri->getSegment(2) == 'Sesi'
                            ) {
                                echo "active";
                            } ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Data Master
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/Admin'); ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'Admin') {
                                echo "active";
                            } ?>">
                                <i class="fa fa-user nav-icon"></i>
                                <p>Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/Dokter'); ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'Dokter') {
                                echo "active";
                            } ?>">
                                <i class="fa fa-user-md nav-icon"></i>
                                <p>Dokter</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/Hari'); ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'Hari') {
                                echo "active";
                            } ?>">
                                <i class="fa fa-calendar nav-icon"></i>
                                <p>Hari</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/Jabatan'); ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'Jabatan') {
                                echo "active";
                            } ?>">
                                <i class="fa fa-address-card nav-icon"></i>
                                <p>Jabatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/JadwalDokter'); ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'JadwalDokter') {
                                echo "active";
                            } ?>">
                                <i class="fa fa-clock nav-icon"></i>
                                <p>Jadwal Dokter</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/Kamar'); ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'Kamar') {
                                echo "active";
                            } ?>">
                                <i class="fa fa-bed nav-icon"></i>
                                <p>Kamar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/Karyawan'); ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'Karyawan') {
                                echo "active";
                            } ?>">
                                <i class="fa fa-users nav-icon"></i>
                                <p>Karyawan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/Obat'); ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'Obat') {
                                echo "active";
                            } ?>">
                                <i class="fa fa-asterisk nav-icon"></i>
                                <p>Obat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/Pasien'); ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'Pasien') {
                                echo "active";
                            } ?>">
                                <i class="fa fa-user-plus nav-icon"></i>
                                <p>Pasien</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/Poliklinik'); ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'Poliklinik') {
                                echo "active";
                            } ?>">
                                <i class="fa fa-medkit nav-icon"></i>
                                <p>Poliklinik</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/Sesi'); ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'Sesi') {
                                echo "active";
                            } ?>">
                                <i class="fa fa-window-restore nav-icon"></i>
                                <p>Sesi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">PERAWATAN</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-pen"></i>
                        <p>
                            Rawat Jalan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/RawatJalan'); ?>" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon"></i>
                                <p>Daftar Rawat Jalan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/RawatJalan/rekamJalan'); ?>" class="nav-link">
                                <i class="fa fa-file nav-icon"></i>
                                <p>Rekam Medis Rawat Jalan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="fa fa-sticky-note nav-icon"></i>
                                <p>Resep Rawat Jalan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Rawat Inap
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/RawatInap'); ?>" class="nav-link">
                                <i class="fa fa-plus-square nav-icon"></i>
                                <p>Daftar Rawat Inap</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/RawatInap/rekamInap'); ?>" class="nav-link">
                                <i class="fa fa-file nav-icon"></i>
                                <p>Rekam Medis Rawat Inap</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="fa fa-sticky-note nav-icon"></i>
                                <p>Resep Rawat Jalan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">LAPORAN</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-database"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="fa fa-file nav-icon"></i>
                                <p>Rawat Jalan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="fa fa-file nav-icon"></i>
                                <p>Rawat Inap</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="fa fa-sticky-note nav-icon"></i>
                                <p>Penjualan Obat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="fa fa-sticky-note nav-icon"></i>
                                <p>Rekam Medis</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>