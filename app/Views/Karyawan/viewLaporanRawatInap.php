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
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-pen"></i>
                                                        </span>
                                                    </div>
                                                    <select name="input_status" class="form-control float-right" id="input_status" onchange="ganti(this.value)">
                                                        <option value="null" selected="">Pilih Status</option>
                                                        <option value="Belum Selesai">Belum Selesai</option>
                                                        <option value="Selesai">Selesai</option>
                                                    </select>
                                                </div>
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
                                                <th>Waktu Masuk</th>
                                                <th>Waktu Keluar</th>
                                                <th>Total Tagiahn</th>
                                                <th>Status Inap</th>
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
        function ganti(status) {
            $('.table').DataTable().ajax.url('<?= base_url() ?>/Karyawan/LaporanRawatInap/data/' + $('#tanggal').val() + '/' + status).load();
        };

	    $(function() {
	    	$('#tanggal').daterangepicker({
	            locale: {
	                format: 'DD-MM-YYYY'
	            }
	        });

	        $('#tanggal').on('apply.daterangepicker', function(ev, picker) {
	            var tanggal = picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY');
	            $('.table').DataTable().ajax.url('<?= base_url() ?>/Karyawan/LaporanRawatInap/data/' + tanggal + '/' + $('#input_status').val()).load();
	        });

            $("#btn_reset").click(function (e) {
                document.getElementById("input_status").selectedIndex = 0;
                $('.table').DataTable().ajax.url('<?= base_url() ?>/Karyawan/LaporanRawatInap/data/' + $('#tanggal').val() + '/' + $('#input_status').val()).load();
            });

	        $(".table").DataTable({
		        "responsive": true,
		        "autoWidth": true,
		        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "ajax": {
                    "url": "<?= base_url() ?>/Karyawan/LaporanRawatInap/data/" + $('#tanggal').val() + '/' + $('#input_status').val(),
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "nama_pasien"
                    },
                    {
                        "data": "waktu_masuk"
                    },
                    {
                        "data": "waktu_keluar"
                    },
                    {
                        "data": "total_tagihan_inap"
                    },
                    {
                        "data": "status_inap"
                    }
                ]
		        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
	    });
    </script>
</body>

</html>