<?php $session = session(); ?>
<!DOCTYPE html>
<html lang="en">

<?= $this->include("Apoteker/layout/head_tabel") ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->include("Apoteker/layout/navbar") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->include("Apoteker/layout/sidebar") ?>

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
                                <!-- <li class="breadcrumb-item"><button class="btn btn-success" data-toggle="modal"
                                        data-target="#addModal"><i class="fa fa-plus"></i>
                                        Tambah Data</button>
                                </li> -->
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
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Nama Pasien</th>
                                                <th style="text-align: center;">Nama Dokter</th>
                                                <th style="text-align: center;">Tagihan</th>
                                                <th style="text-align: center;">Pemeriksaan</th>
                                                <th style="text-align: center;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach ($data as $item) {
                                            ?>
                                            <tr>
                                                <td><?= $item['nama_pasien']; ?></td>
                                                <td><?= $item['nama_dokter']; ?></td>
                                                <td>
                                                    <?php if($item['tagihan_obat'] != null) { 
                                                        echo $item['tagihan_obat'];
                                                    } else {
                                                        echo "-";
                                                    } ?>
                                                </td>
                                                <td><?= $item['tanggal']; ?></td>
                                                <td>
                                                    <center>
                                                        <a href="<?= base_url('Apoteker/RawatJalan/detailResep') . '/' . $item['id_resep']; ?>" name="btn-edit" class="btn btn-sm btn-edit btn-info">Detail Resep</a>
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
        <?= $this->include("Apoteker/layout/footer") ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    
    <?= $this->include("Apoteker/layout/js_tabel") ?>

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

            $("#input_pemeriksaan").select2({
                placeholder: "Pilih Pemeriksaan",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Apoteker/RawatJalan/data_pemeriksaan'); ?>',
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

            $("#edit_pemeriksaan").select2({
                placeholder: "Pilih Pemeriksaan",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Apoteker/RawatJalan/data_pemeriksaan'); ?>',
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
                $("#input_pemeriksaan").val('');
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_pemeriksaan").val('');
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_pemeriksaan").val('');
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Apoteker/RawatJalan/data_edit_resep'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_resep').val(json.id_resep);

                    $('#edit_pemeriksaan').append('<option selected value="' + json.id_rekam + '">' + json.created_at + " pasien " + json.nama_pasien +
                        '</option>');
                    $('#edit_pemeriksaan').select2('data', {
                        id: json.id_rekam,
                        text: json.created_at
                    });
                    $('#edit_pemeriksaan').trigger('change');
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
