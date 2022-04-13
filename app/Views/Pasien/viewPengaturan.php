<?php $session = session(); ?>
<!DOCTYPE html>
<html lang="en">

<?= $this->include("Pasien/layout/head_tabel") ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->include("Pasien/layout/navbar") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->include("Pasien/layout/sidebar") ?>

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
							        <form action="<?php echo base_url('Pasien/Pengaturan/update_pasien'); ?>" method="post" data-parsley-validate="true" autocomplete="off">
							            
							            <?= csrf_field(); ?>
							            <input type="hidden" name="nik" id="nik" value="<?= $session->get('user_id'); ?>">
			                            <input type="hidden" name="id_user" id="id_user">

			                            <div class="form-group">
			                                <label>Nama Pasien</label>
			                                <input type="text" class="form-control" id="edit_nama" name="edit_nama"
			                                    data-parsley-required="true" placeholder="Masukkan Nama Pasien" autofocus="on">
			                            </div>
			                            <div class="form-group">
			                                <label>NIK Pasien</label>
			                                <input type="number" class="form-control" id="edit_nik" name="edit_nik"
			                                    data-parsley-required="true" placeholder="Masukkan NIK Pasien" minlength="16" maxlength="16" autofocus="on">
			                                <span class="text-danger" id="error_nik_edit"></span>
			                                <small id="emailHelp" class="form-text text-muted">Masukkan 16 karakter.</small>
			                            </div>
			                            <div class="form-group">
			                                <label>Email Pasien</label>
			                                <input type="email" class="form-control" id="edit_email" name="edit_email"
			                                    data-parsley-required="true" placeholder="Masukkan Email Pasien" autofocus="on">
			                                <span class="text-danger" id="error_edit_email"></span>
			                            </div>
			                            <div class="form-group">
			                                <label>Password Pasien</label>
			                                <input type="Password" class="form-control" id="edit_password" name="edit_password"
			                                    placeholder="Masukkan Password Pasien" autofocus="on" data-parsley-equalto="#edit_password_konfirmasi">
			                            </div>
			                            <div class="form-group">
			                                <label>Ulangi Password</label>
			                                <input type="Password" class="form-control" id="edit_password_konfirmasi" name="edit_password_konfirmasi"
			                                    placeholder="Masukkan Ulangi Password" autofocus="on" data-parsley-equalto="#edit_password">
			                            </div>
			                            <div class="form-group">
			                                <label>Alamat Pasien</label>
			                                <textarea class="form-control" id="edit_alamat" name="edit_alamat" placeholder="Masukkan alamat" data-parsley-required="true"></textarea>
			                            </div>
			                            <div class="form-group">
			                                <label>No Telp Pasien</label>
			                                <input type="number" class="form-control" id="edit_no_telp" name="edit_no_telp"
			                                    data-parsley-required="true" placeholder="Masukkan No Telp Pasien" autofocus="on">
			                            </div>

			                            <div class="form-group">
			                                <label>Jenis Kelamin</label>
			                                <select class="form-control" id="edit_kelamin" name="edit_kelamin">
			                                    <option value="Laki - Laki">Laki - Laki</option>
			                                    <option value="Perempuan">Perempuan</option>
			                                </select>
			                            </div>
			                            
			                            <div class="form-group">
			                                <label>Tanggal Lahir</label>
			                                <input type="date" value="<?= date('Y-m-d') ?>" class="form-control" id="edit_tanggal" name="edit_tanggal" 
                                            data-parsley-required="true" autocomplete="off" />
			                            </div>

			                            <div class="form-group">
			                                <label>Agama</label>
			                                <input type="text" class="form-control" id="edit_agama" name="edit_agama"
			                                    data-parsley-required="true" placeholder="Masukkan Agama" autofocus="on">
			                                <span class="text-danger" id="error_email"></span>
			                            </div>

			                            <div class="form-group">
			                            	<center>
			                            		<a href="<?= base_url('Pasien/Dashboard'); ?>" class="btn btn-secondary">Batal</a>
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
        <?= $this->include("Pasien/layout/footer") ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?= $this->include("Pasien/layout/js_tabel") ?>

    <script>
        $( document ).ready(function() {
            if ('<?= $session->getFlashdata('sukses'); ?>' != '') {
                toastr.success('<?= $session->getFlashdata('sukses'); ?>')
            } else if ('<?= $session->getFlashdata('gagal'); ?>' != '') {
                toastr.error('<?= $session->getFlashdata('gagal'); ?>')
            }
        });

        $(function() {
            $.getJSON('<?php echo base_url('Pasien/Pengaturan/data_edit'); ?>' + '/' + <?= $session->get('nik'); ?>, {},
                function(json) {
                    $('#nik').val(json.nik);
                    $('#id_user').val(json.id_user);
                    $('#edit_nama').val(json.nama_pasien);
                    $('#edit_nik').val(json.nik);
                    $('#edit_email').val(json.email);
                    $('#edit_alamat').val(json.alamat_pasien);
                    $('#edit_no_telp').val(json.no_telp_pasien);
                    $('#edit_tanggal').val(json.tgl_lahir);
                    $('#edit_agama').val(json.agama);
                    if(json.jenis_kelamin == 'Perempuan'){
                        document.getElementById("edit_kelamin").selectedIndex = 1;
                    }else{
                        document.getElementById("edit_kelamin").selectedIndex = 0;
                    }
                });
        });
    </script>
</body>

</html>
