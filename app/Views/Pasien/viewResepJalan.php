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
                                    <div style="padding-bottom: 20px;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" id="tanggal" name="tanggal">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-sm btn-success"><span class="fa fa-print"></span> Cetak</button>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Nama Pasien</th>
                                                <th style="text-align: center;">Nama Dokter</th>
                                                <th style="text-align: center;">Tagihan</th>
                                                <th style="text-align: center;">Resep Dibuat</th>
                                                <th style="text-align: center;">Aksi</th>
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
        $(function() {
            $('#tanggal').daterangepicker({
                locale: {
                    format: 'DD-MM-YYYY'
                }
            });

            $('#tanggal').on('apply.daterangepicker', function(ev, picker) {
                var tanggal = picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY');
                $('.table').DataTable().ajax.url('<?= base_url() ?>/Pasien/ResepRawatJalan/data/' + tanggal ).load();
            });

            $(".table").DataTable({
                "responsive": true,
                "autoWidth": true,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "ajax": {
                    "url": "<?= base_url() ?>/Pasien/ResepRawatJalan/data/" + $('#tanggal').val(),
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "nama_pasien"
                    },
                    {
                        "data": "nama_dokter"
                    },
                    {
                        "data": "tagihan_obat"
                    },
                    {
                        "data": "tanggal"
                    },
                    {
                        "data": "aksi"
                    }
                ]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
</body>

</html>
