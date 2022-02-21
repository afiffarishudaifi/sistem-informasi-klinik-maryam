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
                                <li class="breadcrumb-item"><button class="btn btn-success" data-toggle="modal"
                                        data-target="#addModal"><i class="fa fa-plus"></i>
                                        Tambah Data</button>
                                </li>
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
                                    <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Nama Pasien</th>
                                                <th>Nama Poli</th>
                                                <th>Nama Dokter</th>
                                                <th>Hasil Pemeriksaan</th>
                                                <th>Saran Dokter</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach ($data as $item) {
                                            ?>
                                            <tr>
                                                <td><?= $item['nama_pasien']; ?></td>
                                                <td><?= $item['nama_poli']; ?></td>
                                                <td><?= $item['nama_dokter']; ?></td>
                                                <td><?= $item['hasil_pemeriksaan']; ?></td>
                                                <td><?= $item['saran_dokter']; ?></td>
                                                <td>
                                                        <center>
                                                            <a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['id_pemeriksaan']; ?>)" class="btn btn-sm btn-edit btn-warning">Edit</a>
                                                            <a href="" class="btn btn-sm btn-delete btn-danger" onclick="Hapus(<?= $item['id_pemeriksaan']; ?>)" data-toggle="modal"
                                                                data-target="#deleteModal" data-id="<?= $item['id_pemeriksaan']; ?>">Hapus</a>
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

        <!-- Start Modal Add Class-->
        <form action="<?php echo base_url('Karyawan/RawatJalan/add_rekam'); ?>" method="post" id="form_add"
            data-parsley-validate="true" autocomplete="off" enctype="multipart/form-data">
            <div class="modal fade" id="addModal" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Rekam Medis </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Pendaftaran</label>
                                <select class="form-control select2" id="input_pendaftaran" name="input_pendaftaran">
                                </select>   
                            </div>
                            <div class="form-group">
                                <label>Hasil Pemeriksaan</label>
                                <textarea class="form-control" id="input_hasil" name="input_hasil" placeholder="Masukkan hasil pemeriksaan"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Saran Dokter</label>
                                <textarea class="form-control" id="input_saran" name="input_saran" placeholder="Masukkan saran dokter"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tensi Darah Pasien</label>
                                <input type="number" class="form-control" id="input_tensi" name="input_tensi"
                                    data-parsley-required="true" placeholder="Masukkan Umur Pasien" autofocus="on">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" id="batal_add"
                                data-dismiss="modal">Batal</button>
                            <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Add Class-->

        <!-- Modal Edit Class-->
        <form action="<?php echo base_url('Karyawan/RawatJalan/update_rekam'); ?>" method="post" id="form_edit"
            data-parsley-validate="true" autocomplete="off" enctype="multipart/form-data">
            <div class="modal fade" id="updateModal" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Rekam Medis </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_pemeriksaan" id="id_pemeriksaan">

                            <div class="form-group">
                                <label>Pendaftaran</label>
                                <select class="form-control select2" id="edit_pendaftaran" name="edit_pendaftaran">
                                </select>   
                            </div>
                            <div class="form-group">
                                <label>Hasil Pemeriksaan</label>
                                <textarea class="form-control" id="edit_hasil" name="edit_hasil" placeholder="Masukkan hasil pemeriksaan"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Saran Dokter</label>
                                <textarea class="form-control" id="edit_saran" name="edit_saran" placeholder="Masukkan saran dokter"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tensi Darah Pasien</label>
                                <input type="number" class="form-control" id="edit_tensi" name="edit_tensi"
                                    data-parsley-required="true" placeholder="Masukkan Umur Pasien" autofocus="on">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" id="batal_up"
                                data-dismiss="modal">Batal</button>
                            <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Edit Class-->

        <!-- Start Modal Delete Class -->
        <form action="<?php echo base_url('Karyawan/RawatJalan/delete_rekam'); ?>" method="post">
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <h4>Apakah Ingin menghapus rekam medis ini?</h4>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" class="id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Delete Class -->

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

        $("#input_pendaftaran").select2({
            placeholder: "Pilih Pendaftaran",
            theme: 'bootstrap4',
            ajax: {
                url: '<?php echo base_url('Karyawan/RawatJalan/data_pendaftaran'); ?>',
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
        $("#edit_pendaftaran").select2({
            placeholder: "Pilih Pendaftaran",
            theme: 'bootstrap4',
            ajax: {
                url: '<?php echo base_url('Karyawan/RawatJalan/data_pendaftaran'); ?>',
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
            $("#input_pendaftaran").val('');
            $("#input_tensi").val('');
            $("#input_saran").val('');
        });

        $('#batal_add').on('click', function() {
            $('#form_add')[0].reset();
            $("#input_saran").val('');
            $("#input_pendaftaran").val('');
            $("#input_tensi").val('');
            $("#input_saran").val('');
        });

        $('#batal_up').on('click', function() {
            $('#form_edit')[0].reset();
            $("#edit_saran").val('');
            $("#edit_pendaftaran").val('');
            $("#edit_tensi").val('');
            $("#edit_saran").val('');
        });

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Karyawan/RawatJalan/data_edit_rekam'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_pemeriksaan').val(json.id_pemeriksaan);

                    $('#edit_saran').val(json.saran_dokter);
                    $('#edit_pendaftaran').val(json.no_telp_dokter);
                    $('#edit_tensi').val(json.tensi_darah);
                    $('#edit_hasil').val(json.hasil_pemeriksaan);

                    $('#edit_pendaftaran').append('<option selected value="' + json.id_pendaftaran + '">' + json.tanggal_daftar + " pasien " + json.nama_pasien +
                        '</option>');
                    $('#edit_pendaftaran').select2('data', {
                        id: json.id_pendaftaran,
                        text: json.tanggal_daftar
                    });
                    $('#edit_pendaftaran').trigger('change');
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
