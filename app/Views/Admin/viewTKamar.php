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
                                                <th>Nomor Kamar</th>
                                                <th>Biaya Kamar</th>
                                                <th>Status Kamar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach ($kamar as $item) {
                                            ?>
                                            <tr>
            
                                                <td><?= sprintf("%03s", $item['no_kamar']) ; ?></td>
                                                <td><?= $item['biaya_kamar']; ?></td>
                                                <td><?= $item['status_kamar']; ?></td>
                                                <td><a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['id_kamar']; ?>)" class="btn btn-sm btn-edit btn-warning">Edit</a>
                                                            <a href="" class="btn btn-sm btn-delete btn-danger" onclick="Hapus(<?= $item['id_kamar']; ?>)" data-toggle="modal"
                                                                data-target="#deleteModal" data-id="<?= $item['id_kamar']; ?>">Hapus</a></td>
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
        <form action="<?php echo base_url('Admin/Kamar/add_kamar'); ?>" method="post" id="form_add"
            data-parsley-validate="true" autocomplete="off">
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kamar </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nomor Kamar</label>
                                <input type="text" class="form-control" id="input_nomor" name="input_nomor"
                                    data-parsley-required="true" placeholder="Masukkan Nomor Kamar" autofocus="on">
                                <span class="text-danger" id="error_nomor"></span>
                            </div>
                            <div class="form-group">
                                <label>Biaya Kamar</label>
                                <input type="number" class="form-control" id="input_biaya" name="input_biaya"
                                    data-parsley-required="true" placeholder="Masukkan Biaya Kamar" autofocus="on">
                            </div>
                            <div class="form-group">
                                <label>Status Kamar</label>
                                <input type="text" class="form-control" id="input_status" name="input_status"
                                    data-parsley-required="true" placeholder="Masukkan Status Kamar" autofocus="on">
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
        <form action="<?php echo base_url('Admin/Kamar/update_kamar'); ?>" method="post" id="form_edit"
            data-parsley-validate="true" autocomplete="off">
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Kamar</h5>
                                <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_kamar" id="id_kamar">

                            <div class="form-group">
                                <label>Nomor Kamar</label>
                                <input type="text" class="form-control" id="edit_nomor" name="edit_nomor"
                                    data-parsley-required="true" placeholder="Masukkan Nomor Kamar" autofocus="on">
                                <span class="text-danger" id="error_edit_nomor"></span>
                            </div>
                            <div class="form-group">
                                <label>Biaya Kamar</label>
                                <input type="number" class="form-control" id="edit_biaya" name="edit_biaya"
                                    data-parsley-required="true" placeholder="Masukkan Biaya Kamar" autofocus="on">
                            </div>
                            <div class="form-group">
                                <label>Status Kamar</label>
                                <input type="text" class="form-control" id="edit_status" name="edit_status"
                                    data-parsley-required="true" placeholder="Masukkan Status Kamar" autofocus="on">
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
        <form action="<?php echo base_url('Admin/Kamar/delete_kamar'); ?>" method="post">
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

                            <h4>Apakah Ingin menghapus kamar ini?</h4>

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
            $("#input_nomor").keyup(function(){

                var nomor = $(this).val().trim();
          
                if(nomor != ''){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Admin/Kamar/cek_nomor'); ?>' + '/' + nomor,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_nomor").html('Nomor telah dipakai,coba yang lain');
                                $("#input_nomor").val('');
                            }else{
                                $("#error_nomor").html('');
                            }
                        }, error: function () {
            
                            alert('error');
                        }
                    });
                }
          
              });
            $("#edit_nomor").keyup(function(){

                var nomor = $(this).val().trim();
          
                if(nomor != '' && nomor != $('#edit_nomor_lama').val()){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Admin/Kamar/cek_nomor'); ?>' + '/' + nomor,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_edit_nomor").html('Nomor telah dipakai,coba yang lain');
                                $("#edit_nomor").val('');
                            }else{
                                $("#error_edit_nomor").html('');
                            }
                        }, error: function () {
            
                            alert('error');
                        }
                    });
                }
          
            });

            $('#batal').on('click', function() {
                $('#form_add')[0].reset();
                $('#form_edit')[0].reset();
                $("#input_nomor").val('');
                $("#input_biaya").val('');
                $("#input_status").val('');
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_nomor").val('');
                $("#input_biaya").val('');
                $("#input_status").val('');
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_nomor").val('');
                $("#edit_biaya").val('');
                $("#edit_status").val('');
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Admin/Kamar/data_edit'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_kamar').val(json.id_kamar);
                    $('#edit_nomor').val(json.no_kamar);
                    $('#edit_biaya').val(json.biaya_kamar);
                    $('#edit_status').val(json.status_kamar);
                });
        }
    </script>

<script type="text/javascript">
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