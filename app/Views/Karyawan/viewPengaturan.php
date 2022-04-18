<?php $session = session(); ?>
<!DOCTYPE html>
<html lang="en">

<?= $this->include("Karyawan/layout/head_tabel") ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->include("Karyawan/layout/navbar") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->include("Karyawan/layout/sidebar") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?= $judul; ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><?= $judul; ?></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                	<!-- Modal Edit Class-->
							        <form action="<?php echo base_url('Karyawan/Pengaturan/update_karyawan'); ?>" method="post" data-parsley-validate="true" autocomplete="off">
							            
							            <?= csrf_field(); ?>
							                
			                            <input type="hidden" name="nik_karyawan" id="nik_karyawan" value="<?= $session->get('user_id'); ?>">

			                            <div class="form-group">
			                                <label>Nama Karyawan</label>
			                                <input type="text" class="form-control" id="edit_nama" name="edit_nama"
			                                    data-parsley-required="true" placeholder="Masukkan Nama Karyawan" autofocus="on">
			                            </div>
			                            <div class="form-group">
			                                <label>Password Karyawan</label>
			                                <input type="Password" class="form-control" id="edit_password" name="edit_password"
			                                    placeholder="Masukkan Password Pasien" autofocus="on" data-parsley-equalto="#edit_password_konfirmasi">
			                            </div>
			                            <div class="form-group">
			                                <label>Ulangi Password</label>
			                                <input type="Password" class="form-control" id="edit_password_konfirmasi" name="edit_password_konfirmasi"
			                                    placeholder="Masukkan Ulangi Password" autofocus="on" data-parsley-equalto="#edit_password">
			                            </div>
			                            <div class="form-group">
			                                <label>No Telepon Karyawan</label>
			                                <input type="text" class="form-control" id="edit_no_telp" name="edit_no_telp"
			                                    data-parsley-type="number" placeholder="Masukkan No Telp Karyawan" autofocus="on">
			                            </div>
			                            <div class="form-group">
			                                <label>Alamat Karyawan</label>
			                                <input type="text" class="form-control" id="edit_alamat" name="edit_alamat"
			                                    placeholder="Masukkan Alamat Karyawan" autofocus="on">
			                            </div>

			                            <div class="form-group">
			                                <label>Foto Karyawan</label>
			                                <br>
			                                <input type="file" id="edit_foto" class="dropify-event" name="edit_foto" accept="image/png, image/gif, image/jpeg"/>
			                                <span class="text-danger" id="error_edit_foto"></span>
			                            </div>

			                            <div class="form-group">
			                            	<center>
                                                <a href="<?= base_url('Karyawan/Dashboard'); ?>" class="btn btn-secondary">Batal</a>
					                            <button type="submit" name="update" class="btn btn-primary">Simpan</button>
			                            	</center>
			                            </div>
							        </form>
							        <!-- End Modal Edit Class-->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <!-- /.content-wrapper -->
        <?= $this->include("Karyawan/layout/footer") ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?= $this->include("Karyawan/layout/js_tabel") ?>

    <script>
        $( document ).ready(function() {
            if ('<?= $session->getFlashdata('sukses'); ?>' != '') {
                toastr.success('<?= $session->getFlashdata('sukses'); ?>')
            } else if ('<?= $session->getFlashdata('gagal'); ?>' != '') {
                toastr.error('<?= $session->getFlashdata('gagal'); ?>')
            }
        });

        $(function() {
            $.getJSON('<?php echo base_url('Karyawan/Pengaturan/data_edit'); ?>' + '/' + <?= $session->get('user_id'); ?>, {},
                function(json) {
                    $('#edit_nama').val(json.nama_karyawan);
                    $('#nik_karyawan').val(json.nik_karyawan);
                    $('#edit_no_telp').val(json.no_telp_karyawan);
                    $('#edit_alamat').val(json.alamat_karyawan);
                    $('#edit_foto').val(json.foto_karyawan);
                });
        });
    </script>
</body>

</html>
