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
                                                <th>Id Pemeriksaan</th>
                                                <th>Nama Pasien</th>
                                                <th>Nama Dokter</th>
                                                <th>Tagihan</th>
                                                <th>Pemeriksaan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach ($data as $item) {
                                            ?>
                                            <tr>
                                                <td><?= $item['id_pemeriksaan']; ?></td>
                                                <td><?= $item['nama_pasien']; ?></td>
                                                <td><?= $item['nama_dokter']; ?></td>
                                                <td><?= $item['tagihan_obat']; ?></td>
                                                <td><?= $item['created_at']; ?></td>
                                                <td>
                                                    <center>
                                                        <a href="<?= base_url('Admin/RawatJalan/detailResep') . '/' . $item['id_resep']; ?>" name="btn-edit" class="btn btn-sm btn-edit btn-info">Detail Resep</a>
                                                        <a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['id_resep']; ?>)" class="btn btn-sm btn-edit btn-warning">Edit</a>
                                                        <a href="" class="btn btn-sm btn-delete btn-danger" onclick="Hapus(<?= $item['id_resep']; ?>)" data-toggle="modal"
                                                            data-target="#deleteModal" data-id="<?= $item['id_resep']; ?>">Hapus</a>
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
        <form action="<?php echo base_url('Admin/RawatJalan/add_resep'); ?>" method="post" id="form_add"
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
                                <label>Pemeriksaan</label>
                                <select class="form-control select2" id="input_pemeriksaan" name="input_pemeriksaan">
                                </select>   
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
        <form action="<?php echo base_url('Admin/RawatJalan/update_resep'); ?>" method="post" id="form_edit"
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
                            <input type="hidden" name="id_resep" id="id_resep">

                            <div class="form-group">
                                <label>Pemeriksaan</label>
                                <select class="form-control select2" id="edit_pemeriksaan" name="edit_pemeriksaan">
                                </select>   
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
        <form action="<?php echo base_url('Admin/RawatJalan/delete_resep'); ?>" method="post">
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

                            <h4>Apakah Ingin menghapus resep ini?</h4>

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

            $("#input_pemeriksaan").select2({
                placeholder: "Pilih Pemeriksaan",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Admin/RawatJalan/data_pemeriksaan'); ?>',
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
                    url: '<?php echo base_url('Admin/RawatJalan/data_pemeriksaan'); ?>',
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
            $.getJSON('<?php echo base_url('Admin/RawatJalan/data_edit_resep'); ?>' + '/' + isi, {},
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