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
                                    <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Nama Pasien</th>
                                                <th style="text-align: center;">Alamat</th>
                                                <th style="text-align: center;">No Hp</th>
                                                <th style="text-align: center;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach ($data as $item) {
                                            ?>
                                            <tr>
                                                <td><?= $item['nama_pasien']; ?></td>
                                                <td><?= $item['alamat_pasien']; ?></td>
                                                <td><?= $item['no_telp_pasien']; ?></td>
                                                <td>
                                                    <center>
                                                        <a href="<?= base_url('Karyawan/RawatJalan/rekamJalanDetail') . '/' . $item['nik']; ?>" class="btn btn-sm btn-edit btn-info" title="Detail"><i class="fa fa-eye"></i></a>
                                                    </center>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
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
        function Hapus(id){
            $('.id').val(id);
            $('#deleteModal').modal('show');
        };

        $( document ).ready(function() {
            if ('<?= $session->getFlashdata('sukses'); ?>' != '') {
                toastr.success('<?= $session->getFlashdata('sukses'); ?>')
            } else if ('<?= $session->getFlashdata('gagal'); ?>' != '') {
                toastr.error('<?= $session->getFlashdata('gagal'); ?>')
            }
        });

        $("#input_pasien").select2({
            placeholder: "Pilih Pasien",
            theme: 'bootstrap4',
            ajax: {
                url: '<?php echo base_url('Karyawan/RawatJalan/data_pasien'); ?>',
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
        $("#edit_pasien").select2({
            placeholder: "Pilih Pasien",
            theme: 'bootstrap4',
            ajax: {
                url: '<?php echo base_url('Karyawan/RawatJalan/data_pasien'); ?>',
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

        $("#input_dokter").select2({
            placeholder: "Pilih Dokter",
            theme: 'bootstrap4',
            ajax: {
                url: '<?php echo base_url('Karyawan/RawatJalan/data_dokter'); ?>',
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
        $("#edit_dokter").select2({
            placeholder: "Pilih Dokter",
            theme: 'bootstrap4',
            ajax: {
                url: '<?php echo base_url('Karyawan/RawatJalan/data_dokter'); ?>',
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

        $("#input_penyakit").select2({
            placeholder: "Pilih Penyakit",
            theme: 'bootstrap4',
            ajax: {
                url: '<?php echo base_url('Karyawan/RawatJalan/data_penyakit'); ?>',
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
        $("#edit_penyakit").select2({
            placeholder: "Pilih Penyakit",
            theme: 'bootstrap4',
            ajax: {
                url: '<?php echo base_url('Karyawan/RawatJalan/data_penyakit'); ?>',
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

        $('#batal').on('click', function() {
            $('#form_add')[0].reset();
            $('#form_edit')[0].reset();
            $("#input_saran").val('');
            $("#input_pasien").val('');
            $("#input_dokter").val('');
            $("#input_penyakit").val('');
            $("#input_tensi").val('');
            $("#input_saran").val('');
        });

        $('#batal_add').on('click', function() {
            $('#form_add')[0].reset();
            $("#input_saran").val('');
            $("#input_pasien").val('');
            $("#input_dokter").val('');
            $("#input_penyakit").val('');
            $("#input_tensi").val('');
            $("#input_saran").val('');
        });

        $('#batal_up').on('click', function() {
            $('#form_edit')[0].reset();
            $("#edit_saran").val('');
            $("#edit_pasien").val('');
            $("#edit_dokter").val('');
            $("#edit_penyakit").val('');
            $("#edit_tensi").val('');
            $("#edit_saran").val('');
        });

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Karyawan/RawatJalan/data_edit_rekam'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_rekam').val(json.id_rekam);

                    $('#edit_saran').val(json.saran_dokter);
                    $('#edit_tensi').val(json.tensi_darah);
                    $('#edit_hasil').val(json.hasil_pemeriksaan);

                    $('#edit_pasien').append('<option selected value="' + json.nik + '">' + json.nama_pasien +
                        '</option>');
                    $('#edit_pasien').select2('data', {
                        id: json.nik,
                        text: json.nama_pasien
                    });
                    $('#edit_pasien').trigger('change');

                    $('#edit_dokter').append('<option selected value="' + json.nik_dokter + '">' + json.nama_dokter +
                        '</option>');
                    $('#edit_dokter').select2('data', {
                        id: json.nik_dokter,
                        text: json.nama_dokter
                    });
                    $('#edit_dokter').trigger('change');

                    $('#edit_penyakit').append('<option selected value="' + json.id_penyakit + '">' + json.nama_penyakit +
                        '</option>');
                    $('#edit_penyakit').select2('data', {
                        id: json.id_penyakit,
                        text: json.nama_penyakit
                    });
                    $('#edit_penyakit').trigger('change');
                });
        }
        
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            });
    });
    </script>
</body>

</html>
