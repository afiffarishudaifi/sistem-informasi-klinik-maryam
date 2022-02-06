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
                                                <th>Nama Pasien</th>
                                                <th>Nomor Kamar</th>
                                                <th>Waktu Masuk</th>
                                                <th>Waktu Keluar</th>
                                                <th>Total Tagihan Inap</th>
                                                <th>Status Inap</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach ($data as $item) {
                                            ?>
                                            <tr>
                                                <td><?= $item['nama_pasien']; ?></td>
                                                <td><?= $item['no_kamar']; ?></td>
                                                <td><?= $item['waktu_masuk']; ?></td>
                                                <td><?= $item['waktu_keluar']; ?></td>
                                                <td><?= $item['total_tagihan_inap']; ?></td>
                                                <td><?= $item['status_inap']; ?></td>
                                                <td>
                                                        <center>
                                                            <a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['id_inap']; ?>)" class="btn btn-sm btn-edit btn-warning">Edit</a>
                                                            <a href="" class="btn btn-sm btn-delete btn-danger" onclick="Hapus(<?= $item['id_inap']; ?>)" data-toggle="modal"
                                                                data-target="#deleteModal" data-id="<?= $item['id_inap']; ?>">Hapus</a>
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
        <form action="<?php echo base_url('Admin/RawatInap/add_pendaftaran'); ?>" method="post" id="form_add"
            data-parsley-validate="true" autocomplete="off" enctype="multipart/form-data">
            <div class="modal fade" id="addModal" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Rawat Inap </h5>
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
                                <label>Waktu Keluar</label>
                                <input type="date" class="form-control" id="input_keluar" name="input_keluar" autocomplete="off" />
                            </div>

                            <div class="form-group">
                                <label>Total Biaya</label>
                                <input type="number" disabled class="form-control" id="input_tagihan" name="input_tagihan"
                                autofocus="on">
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
        <form action="<?php echo base_url('Admin/RawatInap/update_pendaftaran'); ?>" method="post" id="form_edit"
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
                            <input type="hidden" name="id_inap" id="id_inap">

                            <div class="form-group">
                                <label>Pasien</label>
                                <select class="form-control select2" id="edit_pasien" name="edit_pasien">
                                </select>   
                            </div>
                            <div class="form-group">
                                <label>No Kamar</label>
                                <select class="form-control select2" id="edit_kamar" name="edit_kamar">
                                </select>   
                            </div>
                            <div class="form-group">
                                <label>Waktu Masuk</label>
                                <input type="datetime-local" class="form-control" id="edit_masuk" name="edit_masuk" data-parsley-required="true" autocomplete="off" />
                            </div>
                            <div class="form-group">
                                <label>Waktu Keluar</label>
                                <input type="date" class="form-control" id="edit_keluar" name="edit_keluar" data-parsley-required="true" autocomplete="off" />
                            </div>

                            <div class="form-group">
                                <label>Total Biaya</label>
                                <input type="number" class="form-control" id="edit_tagihan" name="edit_tagihan"
                                    data-parsley-required="true" data-parsley-type="number" autofocus="on">
                            </div>

                            <div class="form-group">
                                <label>Status Inap</label>
                                <div class="checkbox">
                                    <label for="example-checkbox1">
                                        <input type="checkbox" id="edit_status" name="edit_status"
                                            value="Selesai"> &nbsp Selesai
                                    </label>
                                </div>
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
        <form action="<?php echo base_url('Admin/RawatInput/delete_pendaftaran'); ?>" method="post">
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
                    url: '<?php echo base_url('Admin/RawatInap/data_pasien'); ?>',
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
                    url: '<?php echo base_url('Admin/RawatInap/data_pasien'); ?>',
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

            $("#input_kamar").select2({
                placeholder: "Pilih Kamar",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Admin/RawatInap/data_kamar'); ?>',
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

            $("#edit_kamar").select2({
                placeholder: "Pilih Kamar",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Admin/RawatInput/data_kamar'); ?>',
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
                $("#input_pasien").val('');
                $("#input_kamar").val('');
                $("#input_masuk").val('');
                $("#input_keluar").val('');
                $("#input_status").prop('checked',false);
                $("#input_biaya").val('');
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_pasien").val('');
                $("#input_kamar").val('');
                $("#input_masuk").val('');
                $("#input_keluar").val('');
                $("#input_status").prop('checked',false);
                $("#input_biaya").val('');
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_nama").val('');
                $("#edit_kamar").val('');
                $("#edit_masuk").val('');
                $("#edit_keluar").val('');
                $("#edit_status").prop('checked',false);
                $("#edit_biaya").val('');
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Admin/RawatInap/data_edit'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_inap').val(json.id_inap);
                    $('#edit_masuk').val(json.waktu_masuk);
                    $('#edit_keluar').val(json.waktu_keluar);
                    $('#total_tagihan_inap').val(json.total_tagihan_inap);

                    if(json.status_inap=='Selesai'){
                        $("#edit_status").prop('checked',true);
                    }else{
                        $("#edit_status").prop('checked',false);
                    }

                    $('#edit_pasien').append('<option selected value="' + json.id_pasien + '">' + json.nama_pasien +
                        '</option>');
                    $('#edit_pasien').select2('data', {
                        id: json.id_pasien,
                        text: json.nama_pasien
                    });
                    $('#edit_pasien').trigger('change');

                    $('#edit_kamar').append('<option selected value="' + json.id_kamar + '">' + json.no_kamar +
                        '</option>');
                    $('#edit_kamar').select2('data', {
                        id: json.id_kamar,
                        text: json.no_kamar
                    });
                    $('#edit_kamar').trigger('change');
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