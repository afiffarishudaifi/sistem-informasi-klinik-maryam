<?php $session = session(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-Klinik Maryam</title>

  <link rel="shortcut icon" href="<?= base_url() ?>/docs/adminlte/dist/img/AdminLTELogo.png">
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
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>E-Klinik Maryam</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Calon Pasien Baru</p>

      <form action="<?= base_url('Login/simpanPasien'); ?>" method="post" data-parsley-validate="true" autocomplete="off">
        <div class="form-group">
            <label>Nama Pasien</label>
            <input type="text" class="form-control" id="input_nama" name="input_nama"
                data-parsley-required="true" placeholder="Masukkan Nama Pasien" autofocus="on">
        </div>
        <div class="form-group">
            <label>NIK Pasien</label>
            <input type="number" class="form-control" id="input_nik" name="input_nik"
                data-parsley-required="true" placeholder="Masukkan NIK Pasien" minlength="16" maxlength="16" autofocus="on">
            <span class="text-danger" id="error_nik"></span>
            <small id="emailHelp" class="form-text text-muted">Masukkan 16 karakter.</small>
        </div>
        <div class="form-group">
            <label>Username Pasien</label>
            <input type="text" class="form-control" id="input_username" name="input_username"
                data-parsley-required="true" placeholder="Masukkan Username Pasien" autofocus="on">
            <span class="text-danger" id="error_username"></span>
        </div>
        <div class="form-group">
            <label>Password Pasien</label>
            <input type="Password" class="form-control" id="input_password" name="input_password"
                data-parsley-required="true" placeholder="Masukkan Password Pasien" autofocus="on">
        </div>
        <div class="form-group">
            <label>Ulangi Password</label>
            <input type="Password" class="form-control" id="input_password_konfirmasi" name="input_password_konfirmasi"
                data-parsley-required="true" placeholder="Masukkan Ulangi Password" autofocus="on" data-parsley-equalto="#input_password">
        </div>
        <div class="form-group">
            <label>Alamat Pasien</label>
            <textarea class="form-control" id="input_alamat" name="input_alamat" placeholder="Masukkan alamat"></textarea>
        </div>
        <div class="form-group">
            <label>No Telp Pasien</label>
            <input type="number" class="form-control" id="input_no_telp" name="input_no_telp"
                data-parsley-required="true" placeholder="Masukkan No Telp Pasien" autofocus="on">
        </div>
        <div class="social-auth-links text-center">
          <button type="submit" name="tambah" class="btn btn-primary"><i class="fas fa-user-plus"></i>
            Pendaftaran Pasien</button>
	     </div>
      </form>
      <a href="<?= base_url('Login') ?>" class="text-center">Saya sudah memiliki akun pasien</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="<?= base_url() ?>/docs/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/docs/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/docs/adminlte/dist/js/adminlte.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>/docs/adminlte/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url() ?>/docs/tambahan/assets/plugins/parsleyjs/dist/parsley.min.js"></script>

<script type="text/javascript">
  $("#input_username").keyup(function(){

    var nama = $(this).val().trim();

    if(nama != ''){
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '<?php echo base_url('Admin/Pasien/cek_username'); ?>' + '/' + nama,
            success: function (data) {
                if(data['results']>0){
                    $("#error_username").html('Username telah dipakai,coba yang lain');
                    $("#input_username").val('');
                }else{
                    $("#error_username").html('');
                }
            }, error: function () {

                alert('error');
            }
        });
    }
  });

  $(document).ready(function() {
      if ('<?= $session->getFlashdata('msg'); ?>' != '') {
          toastr.error('<?= $session->getFlashdata('msg'); ?>')
      } else if ('<?= $session->getFlashdata('sukses'); ?>' != '') {
          toastr.success('<?= $session->getFlashdata('sukses'); ?>')
      }
  });
</script>
</body>
</html>
