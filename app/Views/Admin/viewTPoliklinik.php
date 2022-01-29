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
                                                <th>No</th>
                                                <th>Nama Poli</th>
                                                <th>Status Poli</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                foreach ($poli as $item) {
                                                ?>
                                                <tr>
                                                    <td width="1%"><?= $no++; ?></td>
                                                    <td><?= $item['nama_poli']; ?></td>
                                                    <td><?= $item['status_poli']; ?></td>
                                                    <td>
                                                        <center>
                                                            <a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['id_poli']; ?>)" class="btn btn-sm btn-edit btn-warning">Edit</a>
                                                            <a href="" class="btn btn-sm btn-delete btn-danger" onclick="Hapus(<?= $item['id_poli']; ?>)" data-toggle="modal"
                                                                data-target="#deleteModal" data-id="<?= $item['id_poli']; ?>">Hapus</a>
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
        <form action="<?php echo base_url('Admin/Poliklinik/add_poliklinik'); ?>" method="post" id="form_add"
            data-parsley-validate="true" autocomplete="off">
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Poliklinik </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nama Poliklinik</label>
                                <input type="text" class="form-control" id="input_nama" name="input_nama"
                                    data-parsley-required="true" placeholder="Masukkan Nama Poliklinik" autofocus="on">
                                <span class="text-danger" id="error_nama"></span>
                            </div>

                            <div class="form-group">
                                <label>Status Poliklinik</label>
                                <div class="checkbox">
                                    <label for="example-checkbox1">
                                        <input type="checkbox" id="input_status" name="input_status"
                                            value="Aktif"> &nbsp Aktif
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
        <form action="<?php echo base_url('Admin/Poliklinik/update_poliklinik'); ?>" method="post" id="form_edit"
            data-parsley-validate="true" autocomplete="off">
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Poliklinik</h5>
                                <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_poli" id="id_poli">

                            <div class="form-group">
                                <label>Nama Poliklinik</label>
                                <input type="text" class="form-control" id="edit_nama" name="edit_nama"
                                    data-parsley-required="true" placeholder="Masukkan Nama Poliklinik" autofocus="on">
                                <span class="text-danger" id="error_edit_nama"></span>
                            </div>

                            <div class="form-group">
                                <label>Status Poliklinik</label>
                                <div class="checkbox">
                                    <label for="example-checkbox1">
                                        <input type="checkbox" id="edit_status" name="edit_status"
                                            value="Aktif"> &nbsp Aktif
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
        <form action="<?php echo base_url('Admin/Poliklinik/delete_poliklinik'); ?>" method="post">
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

                            <h4>Apakah Ingin menghapus Poliklinik ini?</h4>

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
            $("#input_nama").keyup(function(){

                var nama = $(this).val().trim();
          
                if(nama != ''){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Admin/Poliklinik/cek_nama'); ?>' + '/' + nama,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_nama").html('Nama telah dipakai,coba yang lain');
                                $("#input_nama").val('');
                            }else{
                                $("#error_nama").html('');
                            }
                        }, error: function () {
            
                            alert('error');
                        }
                    });
                }
          
              });
            $("#edit_nama").keyup(function(){

                var nama = $(this).val().trim();
          
                if(nama != '' && nama != $('#edit_nama_lama').val()){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Admin/Poliklinik/cek_nama'); ?>' + '/' + nama,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_edit_nama").html('Nama telah dipakai,coba yang lain');
                                $("#edit_nama").val('');
                            }else{
                                $("#error_edit_nama").html('');
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
                $("#input_nama").val('');
                $("#input_status").prop('checked',false);
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_nama").val('');
                $("#input_status").prop('checked',false);
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_nama").val('');
                $("#edit_status").prop('checked',false);
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Admin/Poliklinik/data_edit'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_poli').val(json.id_poli);
                    $('#edit_nama').val(json.nama_poli);
                    if(json.status_poli=='Aktif'){
                        $("#edit_status").prop('checked',true);
                    }else{
                        $("#edit_status").prop('checked',false);
                    }
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