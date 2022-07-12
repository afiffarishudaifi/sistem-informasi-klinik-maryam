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
                                	<div style="padding-bottom: 20px;">
                                        <form method="post" action="<?= base_url('') ?>/Karyawan/LaporanRawatJalan/data_cetak">
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
    				                                <select class="form-control select2" id="input_poli" name="input_poli" onchange="ganti(this.value)">
    				                                </select>
    			                                </div>
    				                            <div class="col-md-2">
    				                                <button type="submit" class="btn btn-sm btn-success"><span class="fa fa-print"></span> Cetak</button>
    				                                <button type="button" id="btn_reset" class="btn btn-sm btn-danger"><span class="fa fa-undo"></span> Reset</button>
    				                            </div>
    				                		</div>
                                        </form>
				                	</div>
                                    <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Nama Pasien</th>
                                                <th style="text-align: center;">Nama Poli</th>
                                                <th style="text-align: center;">No Telp</th>
                                                <th style="text-align: center;">Aamat</th>
                                                <th style="text-align: center;">Tanggal Daftar</th>
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
        function ganti(poli) {
            $('.table').DataTable().ajax.url('<?= base_url() ?>/Karyawan/LaporanRawatJalan/data/' + $('#tanggal').val() + '/' + poli).load();
        };

	    $(function() {
	    	$('#tanggal').daterangepicker({
	            locale: {
	                format: 'DD-MM-YYYY'
	            }
	        });

	        $('.select2').select2()

            $("#input_poli").select2({
                placeholder: "Pilih Poliklinik",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?= base_url('Karyawan/LaporanRawatJalan/data_poli'); ?>',
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
	            $('.table').DataTable().ajax.url('<?= base_url() ?>/Karyawan/LaporanRawatJalan/data/' + tanggal).load();
	        });
	        $("#btn_reset").click(function (e) {
	            $("#input_poli").val('').trigger('change')
            	$('.table').DataTable().ajax.url('<?= base_url() ?>/Karyawan/LaporanRawatJalan/data/' + $('#tanggal').val() + '/' + $("#input_poli").val()).load();
	        });

	        $(".table").DataTable({
		        "responsive": true,
		        "autoWidth": true,
		        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "ajax": {
                    "url": "<?= base_url() ?>/Karyawan/LaporanRawatJalan/data/" + $('#tanggal').val() + '/' + $('#input_poli').val(),
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "nama_pasien"
                    },
                    {
                        "data": "nama_poli"
                    },
                    {
                        "data": "no_telp_pasien"
                    },
                    {
                        "data": "alamat_pasien"
                    },
                    {
                        "data": "tanggal_daftar"
                    }
                ]
		        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
	    });
    </script>
</body>

</html>
