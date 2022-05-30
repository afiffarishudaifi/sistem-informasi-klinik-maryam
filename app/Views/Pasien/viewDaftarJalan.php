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
                            	<?php if ($data != 0) { ?>
                            		<center>
	                            		<h2 style="padding-top: 20px;">
	                            			Nomor antrian anda adalah
	                            			<br>
	                            			<p style="font-size: 500%">
	                            				<?= $antrian; ?>
	                            			</p>
	                            		</h2>
                            		</center>
                            	<?php } else {  ?>
                                <div class="card-header">
                                    <h3 class="card-title"><?= $judul; ?></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form action="<?php echo base_url('Pasien/PasienRawatJalan/add_pendaftaran'); ?>" method="post" id="form_add"
							            data-parsley-validate="true" autocomplete="off" enctype="multipart/form-data">
							            
							            <?= csrf_field(); ?>
			                            <div class="form-group">
			                                <label>Poli</label>
			                                <select class="form-control select2" id="input_poli" name="input_poli" required autofocus="on">
			                                </select>   
			                            </div>
			                            <div class="form-group">
			                                <label>Keluhan</label>
			                                <input type="text" class="form-control" id="input_keluhan" name="input_keluhan"
			                                    data-parsley-required="true" placeholder="Masukkan Keluhan" >
			                            </div>
			                            <div class="form-group">
			                                <label>Umur Pasien</label>
			                                <input type="number" class="form-control" id="input_umur" name="input_umur"
			                                    data-parsley-required="true" placeholder="Masukkan Umur Pasien">
			                            </div>
			                            <div class="form-group">
			                                <label>Tanggal Daftar</label>
			                                <input type="datetime-local" value="<?= date('Y-m-d') ?>T00:00" class="form-control" id="input_tanggal" name="input_tanggal" data-parsley-required="true" autocomplete="off" />
			                            </div>
			                            <div class="form-group">
			                            	<center>
					                            <button type="reset" class="btn btn-secondary">Batal</button>
					                            <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
				                            </center>
			                            </div>
							        </form>
                                </div>                                
                            	<?php }  ?>
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
            $('.select2').select2()

            $("#input_poli").select2({
                placeholder: "Pilih Poliklinik",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Pasien/PasienRawatJalan/data_poli'); ?>',
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            query: params.term, // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response.data
                        };
                    },
                    cache: true
                }
            });
        })
    </script>
</body>

</html>
