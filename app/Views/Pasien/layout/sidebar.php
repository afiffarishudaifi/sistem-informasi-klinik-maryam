<?php
$uri = service('uri');
$session = session();
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('Pasien/Dashboard'); ?>" class="brand-link">
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
                    <a href="<?= base_url('Pasien/Dashboard'); ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'Dashboard') {
                                echo "active";
                            } ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
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
                                <i class="fa fa-sticky-note nav-icon"></i>
                                <p>Riwayat Rekam Medis</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="<?= base_url('Pasien/RekamMedisInap') ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'RekamMedisInap') {
                                echo "active";
                            } ?>">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Rawat Inap</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="<?= base_url('Pasien/RekamMedisJalan') ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'RekamMedisJalan') {
                                echo "active";
                            } ?>">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Rawat Jalan</p>
                                </a>
                              </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="fa fa-sticky-note nav-icon"></i>
                                <p>Riwayat Resep</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="<?= base_url('Pasien/ResepRawatInap') ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'ResepRawatInap') {
                                echo "active";
                            } ?>">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Rawat Inap</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="<?= base_url('Pasien/ResepRawatJalan') ?>" class="nav-link <?php
                            if ($uri->getSegment(2) == 'ResepRawatJalan') {
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
