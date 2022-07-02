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
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Nama Pasien</th>
                                                <th style="text-align: center;">Nama Poli</th>
                                                <th style="text-align: center;">Antrian</th>
                                                <th style="text-align: center;">Status Antrian</th>
                                                <th style="text-align: center;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach ($data as $item) {
                                            ?>
                                            <tr>
                                                <td><?= $item['nama_pasien']; ?></td>
                                                <td><?= $item['nama_poli']; ?></td>
                                                <td><?= $item['no_antrian']; ?></td>
                                                <td><?= $item['status_antrian']; ?></td>
                                                <td>
                                                        <center>
                                                            <?php if($item['status_antrian'] != 'Sudah Dipanggil') { ?>
                                                            <a href="<?= base_url('Karyawan/RawatJalan/SelesaiAntrian') . '/' . $item['id_antrian']; ?>" class="btn btn-sm btn-edit btn-info">Selesai Antrian</a>
                                                            <a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['id_antrian']; ?>)" class="btn btn-sm btn-edit btn-warning">Edit</a>
                                                            <a href="" class="btn btn-sm btn-delete btn-danger" onclick="Hapus(<?= $item['id_antrian']; ?>)" data-toggle="modal"
                                                                data-target="#deleteModal" data-id="<?= $item['id_antrian']; ?>">Hapus</a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
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
        <form action="<?= base_url('Karyawan/RawatJalan/add_pendaftaran'); ?>" method="post" id="form_add"
            data-parsley-validate="true" autocomplete="off" enctype="multipart/form-data">
            <div class="modal fade" id="addModal" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Rawat Jalan </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Pasien</label>
                                <select class="form-control select2" id="input_pasien" name="input_pasien">
                                </select>   
                            </div>

                            <div class="form-group">
                                <label>Poli</label>
                                <select class="form-control select2" id="input_poli" name="input_poli">
                                </select>   
                            </div>

                            <!-- <div class="form-group">
                                <label>Keluhan</label>
                                <input type="text" class="form-control" id="input_keluhan" name="input_keluhan"
                                    data-parsley-required="true" placeholder="Masukkan Keluhan" autofocus="on">
                            </div> -->
                            <div class="form-group">
                                <label>Umur Pasien</label>
                                <input type="number" class="form-control" id="input_umur" name="input_umur"
                                    data-parsley-required="true" placeholder="Masukkan Umur Pasien" autofocus="on">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pendaftaran</label>
                                <input type="datetime-local" value="<?= date('Y-m-d') ?>T00:00" class="form-control" id="input_tanggal" name="input_tanggal" data-parsley-required="true" autocomplete="off" />
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
        <form action="<?= base_url('Karyawan/RawatJalan/update_pendaftaran'); ?>" method="post" id="form_edit"
            data-parsley-validate="true" autocomplete="off" enctype="multipart/form-data">
            <div class="modal fade" id="updateModal" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Rawat Jalan </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_antrian" id="id_antrian">

                            <div class="form-group">
                                <label>Pasien</label>
                                <select class="form-control select2" id="edit_pasien" name="edit_pasien">
                                </select>   
                            </div>

                            <div class="form-group">
                                <label>Poli</label>
                                <select class="form-control select2" id="edit_poli" name="edit_poli">
                                </select>   
                            </div>
                            <!-- <div class="form-group">
                                <label>Keluhan</label>
                                <input type="text" class="form-control" id="edit_keluhan" name="edit_keluhan"
                                    data-parsley-required="true" placeholder="Masukkan Keluhan" autofocus="on">
                            </div> -->
                            <div class="form-group">
                                <label>Umur Pasien</label>
                                <input type="number" class="form-control" id="edit_umur" name="edit_umur"
                                    data-parsley-required="true" placeholder="Masukkan Umur Pasien" autofocus="on">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pendaftaran</label>
                                <input type="datetime-local" value="<?= date('Y-m-d') ?>T00:00" class="form-control" id="edit_tanggal" name="edit_tanggal" data-parsley-required="true" autocomplete="off" />
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
        <form action="<?= base_url('Karyawan/RawatJalan/delete_pendaftaran'); ?>" method="post">
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

                            <h4>Apakah Ingin menghapus pendaftaran ini?</h4>

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

        $(function() {
            $('.select2').select2()

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

            $("#input_poli").select2({
                placeholder: "Pilih Poli",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Karyawan/RawatJalan/data_poli'); ?>',
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

            $("#edit_poli").select2({
                placeholder: "Pilih Poli",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Karyawan/RawatJalan/data_poli'); ?>',
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
                $("#input_nama").val('');
                $("#input_poli").val('');
                $("#input_alamat").val('');
                $("#input_no_telp").val('');
                $("#input_status").prop('checked',false);
                $("#input_foto").val('');
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_nama").val('');
                $("#input_poli").val('');
                $("#input_alamat").val('');
                $("#input_no_telp").val('');
                $("#input_status").prop('checked',false);
                $("#input_foto").val('');
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_nama").val('');
                $("#edit_poli").val('');
                $("#edit_alamat").val('');
                $("#edit_no_telp").val('');
                $("#edit_status").prop('checked',false);
                $("#edit_foto").val('');
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Karyawan/RawatJalan/data_edit'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_antrian').val(json.id_antrian);

                    $('#edit_alamat').val(json.alamat_dokter);
                    $('#edit_no_telp').val(json.no_telp_dokter);
                    $('#edit_tanggal').val(json.tanggal_daftar);
                    // $('#edit_keluhan').val(json.keluhan);
                    $('#edit_umur').val(json.umur);
                    // $('#edit_poli').val(json.id_poli);

                    if(json.status_dokter=='Aktif'){
                        $("#edit_status").prop('checked',true);
                    }else{
                        $("#edit_status").prop('checked',false);
                    }
                    $('#edit_foto').val(json.foto_dokter);

                    $('#edit_pasien').append('<option selected value="' + json.nik + '">' + json.nama_pasien +
                        '</option>');
                    $('#edit_pasien').select2('data', {
                        id: json.nik,
                        text: json.nama_pasien
                    });
                    $('#edit_pasien').trigger('change');

                    $('#edit_poli').append('<option selected value="' + json.id_poli + '">' + json.nama_poli +
                        '</option>');
                    $('#edit_poli').select2('data', {
                        id: json.id_poli,
                        text: json.nama_poli
                    });
                    $('#edit_poli').trigger('change');

                    $('#edit_jadwal').append('<option selected value="' + json.id_jadwal + '">' + json.nama_hari +
                        '</option>');
                    $('#edit_jadwal').select2('data', {
                        id: json.id_jadwal,
                        text: json.nama_hari
                    });
                    $('#edit_jadwal').trigger('change');
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
