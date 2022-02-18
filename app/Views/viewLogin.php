<?php $session = session(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-Klinik Maryam</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/docs/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url() ?>/docs/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/docs/adminlte/dist/css/adminlte.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url() ?>/docs/adminlte/plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>E-Klinik Maryam</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Login untuk dapat akses ke sistem</p>

      <form action="<?= base_url('Login/loginSistem'); ?>" method="POST" autocomplete="off" data-parsley-validate="true">
        <div class="input-group mb-3">
          <input type="text" required=""  name="username" id="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" required="" name="password" id="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <select name="status" required="" class="form-control" id="status">
                <option value="Pasien" selected="">Pasien</option>
                <option value="Karyawan">Karyawan</option>
            </select>
        </div>

        <div class="social-auth-links text-center mt-2 mb-3">
          <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-sign-in-alt"></i>    Sign In</button>
        </div>
      </form>
      <!-- /.social-auth-links -->

      <div class="social-auth-links text-center">
        <a href="<?= base_url('Login/registrasiPasien') ?>" class="btn btn-block btn-info">
          <i class="fa fa-user-plus mr-2"></i>
          Registrasi Pasien
        </a>
      </div>

      <p class="mb-1">
        Lupa password ? <a href="<?= base_url('Login/resetPasien') ?>"> klik </a>untuk resert password
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url() ?>/docs/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/docs/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/docs/adminlte/dist/js/adminlte.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>/docs/adminlte/plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
      if ('<?= $session->getFlashdata('msg'); ?>' != '') {
          toastr.error('<?= $session->getFlashdata('msg'); ?>')
      }
  });
</script>
</body>
</html>
