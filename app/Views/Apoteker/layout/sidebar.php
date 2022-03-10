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
                    <a href="<?= base_url('Apoteker/Dashboard'); ?>" class="nav-link <?php
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
                                $uri->getSegment(2) == 'Obat'
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
                            <a href="<?= base_url('Apoteker/Obat'); ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'Obat') {
                                echo "active";
                            } ?>">
                                <i class="fa fa-asterisk nav-icon"></i>
                                <p>Obat</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">PERAWATAN</li>
                <li class="nav-item">
                    <a href="#" class="nav-link <?php
                            if (
                                $uri->getSegment(2) == 'resepJalan'
                            ) {
                                echo "active";
                            } ?>">
                        <i class="nav-icon fa fa-pen"></i>
                        <p>
                            Rawat Jalan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('Apoteker/RawatJalan/resepJalan'); ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'resepJalan') {
                                echo "active";
                            } ?>">
                                <i class="fa fa-sticky-note nav-icon"></i>
                                <p>Resep Rawat Jalan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link <?php
                            if (
                                $uri->getSegment(2) == 'resepInap'
                            ) {
                                echo "active";
                            } ?>">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Rawat Inap
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('Apoteker/RawatInap/resepInap'); ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'resepInap') {
                                echo "active";
                            } ?>">
                                <i class="fa fa-sticky-note nav-icon"></i>
                                <p>Resep Rawat Inap</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">LAPORAN</li>
                <li class="nav-item">
                    <a href="#" class="nav-link <?php
                            if (
                                $uri->getSegment(2) == 'LaporanObatInap' ||
                                $uri->getSegment(2) == 'LaporanObatJalan'
                            ) {
                                echo "active";
                            } ?>">
                        <i class="nav-icon fa fa-database"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link <?php
                            if ($uri->getSegment(2) == 'LaporanObatInap' || $uri->getSegment(2) == 'LaporanObatJalan') {
                                echo "active";
                            } ?>">
                                <i class="fa fa-sticky-note nav-icon"></i>
                                <p>Penjualan Obat</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="<?= base_url('Apoteker/LaporanObatInap') ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'LaporanObatInap') {
                                echo "active";
                            } ?>">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Rawat Inap</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="<?= base_url('Apoteker/LaporanObatJalan') ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'LaporanObatJalan') {
                                echo "active";
                            } ?>">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Rawat Jalan</p>
                                </a>
                              </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
