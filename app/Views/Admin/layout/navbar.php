  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <li class="nav-item">
          </li>

          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
          </li>
          <li class="nav-item">
              <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="dropdown" href="#">
                  <img src="<?= base_url() ?>/docs/adminlte/dist/img/avatar.png"
                      style="width: 30px; border-radius: 50%;" alt="avatar">
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                      <i class="fa fa-cogs mr-2"></i> Pengaturan Akun
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" data-toggle="modal" data-target="#logoutModal" class="dropdown-item">
                      <i class="fa fa-arrow-right mr-2"></i> Keluar
                  </a>
                  <div class="dropdown-divider"></div>
              </div>
          </li>
      </ul>
  </nav>

  <!-- begin modal logout -->
  <div class="modal" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Keluar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
        <div class="modal-body">
          <p><i class="fa fa-question-circle"></i> Apakah anda yakin ingin keluar? <br /></p>
          <div class="actionsBtns">
              <center>
                  <a href="<?php echo base_url('Login/logout'); ?>" class="btn btn-danger">Keluar</a>
                  <button class="btn btn-default" data-dismiss="modal">Batal</button>
              </center>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end modal logout -->
