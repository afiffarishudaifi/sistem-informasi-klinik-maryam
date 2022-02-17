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
	                            		<h4 style="padding-top: 20px; padding-bottom: 20px;">
	                            			Pasien masih melakukan rawat inap di Klinik Maryam.
	                            		</h4>
                            		</center>
                            	<?php } else {  ?>
                                <div class="card-header">
                                    <h3 class="card-title"><?= $judul; ?></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                	<form action="<?php echo base_url('Pasien/PasienRawatInap/add_pendaftaran'); ?>" method="post" id="form_add"
							            data-parsley-validate="true" autocomplete="off" enctype="multipart/form-data">
							            
							            <?= csrf_field(); ?>
			                            <div class="form-group">
			                                <label>No Kamar</label>
			                                <select class="form-control select2" id="input_kamar" name="input_kamar">
			                                </select>   
			                            </div>
			                            <div class="form-group">
			                                <label>Waktu Masuk</label>
			                                <input type="datetime-local" class="form-control" id="input_masuk" name="input_masuk" data-parsley-required="true" autocomplete="off" />
			                                </select>   
			                            </div>

			                            <div class="form-group">
			                                <label>Status Inap</label>
			                                <div class="checkbox">
			                                    <label for="example-checkbox1">
			                                        <input type="checkbox" id="input_status" name="input_status"
			                                            value="Selesai"> &nbsp Selesai
			                                    </label>
			                                </div>
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

            $("#input_kamar").select2({
                placeholder: "Pilih Kamar",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Pasien/PasienRawatInap/data_kamar'); ?>',
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