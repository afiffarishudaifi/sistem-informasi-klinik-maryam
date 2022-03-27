<?php $session = session(); ?>
<!DOCTYPE html>
<html lang="en">

<?= $this->include("Admin/layout/head_tabel") ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->include("Admin/layout/navbar") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->include("Admin/layout/sidebar") ?>

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
                                	<div style="padding-bottom: 20px;">
				                		<div class="row">
				                			<div class="col-md-5">
				                				<div class="input-group">
				                                    <div class="input-group-prepend">
				                                        <span class="input-group-text">
				                                            <i class="fa fa-calendar"></i>
				                                        </span>
				                                    </div>
				                                    <input type="text" class="form-control float-right" id="tanggal" name="tanggal">
				                                </div>
				                			</div>
			                                <div class="col-md-5">			                                	
				                                <select class="form-control select2" id="input_pasien" name="input_pasien" onchange="ganti(this.value)">
				                                </select>
			                                </div>
				                            <div class="col-md-2">
				                                <button class="btn btn-sm btn-success"><span class="fa fa-print"></span> Cetak</button>
				                                <button type="button" id="btn_reset" class="btn btn-sm btn-danger"><span class="fa fa-undo"></span> Reset</button>
				                            </div>
				                		</div>
				                	</div>
                                    <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Nama Pasien</th>
                                                <th>Nama Dokter</th>
                                                <th>Hasil Pemeriksaan</th>
                                                <th>Saran</th>
                                                <th>Tanggal Periksa</th>
                                            </tr>
                                        </thead>
                                    </table>
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
        <?= $this->include("Admin/layout/footer") ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    
    <?= $this->include("Admin/layout/js_tabel") ?>

    <script>
        function ganti(poli) {
            $('.table').DataTable().ajax.url('<?= base_url() ?>/Admin/LaporanRekamJalan/data/' + $('#tanggal').val() + '/' + poli).load();
        };

	    $(function() {
	    	$('#tanggal').daterangepicker({
	            locale: {
	                format: 'DD-MM-YYYY'
	            }
	        });

	        $('.select2').select2()

            $("#input_pasien").select2({
                placeholder: "Pilih Pasien",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?= base_url('Admin/LaporanRekamJalan/data_pasien'); ?>',
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

	        $('#tanggal').on('apply.daterangepicker', function(ev, picker) {
	            var tanggal = picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY');
	            $('.table').DataTable().ajax.url('<?= base_url() ?>/Admin/LaporanRekamJalan/data/' + tanggal).load();
	        });
	        $("#btn_reset").click(function (e) {
	            $("#input_pasien").val('').trigger('change')
            	$('.table').DataTable().ajax.url('<?= base_url() ?>/Admin/LaporanRekamJalan/data/' + $('#tanggal').val() + '/' + $("#input_pasien").val()).load();
	        });

	        $(".table").DataTable({
		        "responsive": true,
		        "autoWidth": true,
		        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "ajax": {
                    "url": "<?= base_url() ?>/Admin/LaporanRekamJalan/data/" + $('#tanggal').val() + '/' + $('#input_pasien').val(),
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "nama_pasien"
                    },
                    {
                        "data": "nama_dokter"
                    },
                    {
                        "data": "hasil_pemeriksaan"
                    },
                    {
                        "data": "saran_dokter"
                    },
                    {
                        "data": "tanggal_rekam"
                    }
                ]
		        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
	    });
    </script>
</body>

</html>
