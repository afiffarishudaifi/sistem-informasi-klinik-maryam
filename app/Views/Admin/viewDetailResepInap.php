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
                                                <th>Nama Obat</th>
                                                <th>Jumlah Obat</th>
                                                <th>Tagihan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach ($data as $item) {
                                            ?>
                                            <tr>
                                                <td><?= $item['nama_obat']; ?></td>
                                                <td><?= $item['jumlah_obat']; ?></td>
                                                <td><?= $item['total_biaya']; ?></td>
                                                <td>
                                                    <center>
                                                        <a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['id_detail']; ?>)" class="btn btn-sm btn-edit btn-warning">Edit</a>
                                                        <a href="" class="btn btn-sm btn-delete btn-danger" onclick="Hapus(<?= $item['id_detail']; ?>,<?= $item['id_resep_inap']; ?>)" data-toggle="modal"
                                                            data-target="#deleteModal" data-id="<?= $item['id_detail']; ?>">Hapus</a>
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
        <form action="<?php echo base_url('Admin/RawatInap/add_detail_resep'); ?>" method="post" id="form_add"
            data-parsley-validate="true" autocomplete="off" enctype="multipart/form-data">
            <div class="modal fade" id="addModal" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Obat </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" name="id_resep_inap" id="id_resep_inap" value="<?= $id_resep; ?>">
                            <div class="form-group">
                                <label>Obat</label>
                                <select class="form-control select2" id="input_obat" name="input_obat">
                                </select>   
                            </div>

                            <div class="form-group">
                                <label>Harga Obat/Tablet</label>
                                <input type="text" class="form-control" id="input_harga" name="input_harga"
                                    data-parsley-required="true" readonly="">  
                            </div>

                            <div class="form-group">
                                <label>Jumlah Obat</label>
                                <input type="number" class="form-control" id="input_jumlah" name="input_jumlah"
                                    data-parsley-required="true" placeholder="Masukkan Jumlah Obat">  
                            </div>

                            <div class="form-group">
                                <label>Total Tagihan</label>
                                <input type="number" class="form-control" id="input_total" name="input_total"
                                    data-parsley-required="true" readonly="">  
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
        <form action="<?php echo base_url('Admin/RawatInap/update_detail_resep'); ?>" method="post" id="form_edit"
            data-parsley-validate="true" autocomplete="off" enctype="multipart/form-data">
            <div class="modal fade" id="updateModal" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Obat </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_detail" id="id_detail">
                            <input type="hidden" name="edit_resep" id="edit_resep">
                            <input type="hidden" name="old_jumlah" id="old_jumlah">

                            <div class="form-group">
                                <label>Obat</label>
                                <select class="form-control select2" id="edit_obat" name="edit_obat">
                                </select>   
                            </div>

                            <div class="form-group">
                                <label>Harga Obat/Tablet</label>
                                <input type="text" class="form-control" id="edit_harga" name="edit_harga"
                                    data-parsley-required="true" readonly="">  
                            </div>

                            <div class="form-group">
                                <label>Jumlah Obat</label>
                                <input type="number" class="form-control" id="edit_jumlah" name="edit_jumlah"
                                    data-parsley-required="true" placeholder="Masukkan Jumlah Obat">  
                            </div>

                            <div class="form-group">
                                <label>Total Tagihan</label>
                                <input type="text" class="form-control" id="edit_total" name="edit_total"
                                    data-parsley-required="true" readonly="">  
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
        <form action="<?php echo base_url('Admin/RawatInap/delete_detail_resep'); ?>" method="post">
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

                            <h4>Apakah Ingin menghapus detail resep ini?</h4>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" class="id">
                            <input type="hidden" name="id_resep_inap" class="id_resep_inap">
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
        function Hapus(id, id_resep){
            $('.id').val(id);
            $('.id_resep_inap').val(id_resep);
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

            $("#input_obat").select2({
                placeholder: "Pilih Obat",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Admin/RawatInap/data_obat'); ?>',
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

            $("#edit_obat").select2({
                placeholder: "Pilih Obat",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Admin/RawatInap/data_obat'); ?>',
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

            $('#input_obat').on('change', function() {
              $.getJSON('<?php echo base_url('Admin/RawatInap/harga_obat'); ?>' + '/' + this.value, {},
                function(json) {
                    $('#input_harga').val(json.harga_obat);
                    var hasil = $('#input_jumlah').val() * json.harga_obat;
                    $('#input_total').val(hasil);
                });
            });

            $('#edit_obat').on('change', function() {
              $.getJSON('<?php echo base_url('Admin/RawatInap/harga_obat'); ?>' + '/' + this.value, {},
                function(json) {
                    $('#edit_harga').val(json.harga_obat);
                    var hasil = $('#edit_jumlah').val() * json.harga_obat;
                    $('#edit_total').val(hasil);
                });
            });

            $("#input_jumlah").keyup(function() {
                var hasil = $('#input_harga').val() * this.value;
                $('#input_total').val(hasil);
            });

            $("#edit_jumlah").keyup(function() {
                var hasil = $('#edit_harga').val() * this.value;
                $('#edit_total').val(hasil);
            });

            $('#batal').on('click', function() {
                $('#form_add')[0].reset();
                $('#form_edit')[0].reset();
                $("#input_obat").val('');
                $("#input_harga").val('');
                $("#input_jumlah").val('');
                $("#input_total").val('');
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_obat").val('');
                $("#input_harga").val('');
                $("#input_jumlah").val('');
                $("#input_total").val('');
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_obat").val('');
                $("#edit_harga").val('');
                $("#edit_jumlah").val('');
                $("#edit_total").val('');
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Admin/RawatInap/data_edit_detail_resep'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_detail').val(json.id_detail);
                    $('#edit_resep').val(json.id_resep_inap);
                    $('#edit_harga').val(json.harga_obat);
                    $('#edit_jumlah').val(json.jumlah_obat);
                    $('#old_jumlah').val(json.jumlah_obat);
                    $('#edit_total').val(json.total_biaya);

                    $('#edit_obat').append('<option selected value="' + json.id_obat + '">' + json.nama_obat +
                        '</option>');
                    $('#edit_obat').select2('data', {
                        id: json.id_obat,
                        text: json.nama_obat
                    });
                    $('#edit_obat').trigger('change');
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
