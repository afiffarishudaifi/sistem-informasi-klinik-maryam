<?php
$uri = service('uri');
$session = session();
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('Apoteker/Dashboard'); ?>" class="brand-link">
        <img src="<?= base_url() ?>/docs/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">E-Klinik Maryam</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php if($session->get('foto') == '' || $session->get('foto') == null) { ?>
                <img src="<?= base_url() ?>/docs/adminlte/dist/img/avatar.png"
                    style="width: 30px; img-circle elevation-2" alt="avatar">
                <?php } else { ?>
                <img src="<?= base_url() ?>/<?= $session->get('foto') ?>"
                    style="width: 30px; img-circle elevation-2" alt="avatar">
                <?php } ?>
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
                            <a href="<?= base_url('Apoteker/Kamar'); ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'Kamar') {
                                echo "active";
                            } ?>">
                                <i class="fas fa-bed nav-icon"></i>
                                <p>Kamar</p>
                            </a>
                        </li>
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
                <li class="nav-header">PEMERIKSAAN</li>
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
                    <a href="<?= base_url('Apoteker/LaporanObat'); ?>" class="nav-link <?php
                            if (
                                $uri->getSegment(2) == 'LaporanObat'
                            ) {
                                echo "active";
                            } ?>">
                        <i class="nav-icon fa fa-database"></i>
                        <p>
                            Laporan Obat
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
