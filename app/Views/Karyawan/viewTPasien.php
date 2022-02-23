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
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>No Telp</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                foreach ($pasien as $item) {
                                                ?>
                                                <tr>
                                                    <td width="1%"><?= $no++; ?></td>
                                                    <td><?= $item['nama_pasien']; ?></td>
                                                    <td><?= $item['alamat_pasien']; ?></td>
                                                    <td><?= $item['no_telp_pasien']; ?></td>
                                                    <td>
                                                        <center>
                                                            <a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['id_pasien']; ?>)" class="btn btn-sm btn-edit btn-warning">Edit</i></a>
                                                            <a href="" class="btn btn-sm btn-delete btn-danger" onclick="Hapus(<?= $item['id_pasien']; ?>)" data-toggle="modal"
                                                                data-target="#deleteModal" data-id="<?= $item['id_pasien']; ?>">Hapus</a>
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
        <form action="<?php echo base_url('Karyawan/Pasien/add_pasien'); ?>" method="post" id="form_add"
            data-parsley-validate="true" autocomplete="off">
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pasien </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nama Pasien</label>
                                <input type="text" class="form-control" id="input_nama" name="input_nama"
                                    data-parsley-required="true" placeholder="Masukkan Nama Pasien" autofocus="on">
                            </div>
                            <div class="form-group">
                                <label>NIK Pasien</label>
                                <input type="number" class="form-control" id="input_nik" name="input_nik"
                                    data-parsley-required="true" placeholder="Masukkan NIK Pasien" minlength="16" maxlength="16" autofocus="on">
                                <span class="text-danger" id="error_nik"></span>
                                <small id="emailHelp" class="form-text text-muted">Masukkan 16 karakter.</small>
                            </div>
                            <div class="form-group">
                                <label>Username Pasien</label>
                                <input type="text" class="form-control" id="input_username" name="input_username"
                                    data-parsley-required="true" placeholder="Masukkan Username Pasien" autofocus="on">
                                <span class="text-danger" id="error_username"></span>
                            </div>
                            <div class="form-group">
                                <label>Password Pasien</label>
                                <input type="Password" class="form-control" id="input_password" name="input_password"
                                    data-parsley-required="true" placeholder="Masukkan Password Pasien" autofocus="on" data-parsley-equalto="#input_password_konfirmasi">
                            </div>
                            <div class="form-group">
                                <label>Ulangi Password</label>
                                <input type="Password" class="form-control" id="input_password_konfirmasi" name="input_password_konfirmasi"
                                    data-parsley-required="true" placeholder="Masukkan Ulangi Password" autofocus="on" data-parsley-equalto="#input_password">
                            </div>
                            <div class="form-group">
                                <label>Alamat Pasien</label>
                                <textarea class="form-control" id="input_alamat" name="input_alamat" placeholder="Masukkan alamat"></textarea>
                            </div>
                            <div class="form-group">
                                <label>No Telp Pasien</label>
                                <input type="number" class="form-control" id="input_no_telp" name="input_no_telp"
                                    data-parsley-required="true" placeholder="Masukkan No Telp Pasien" autofocus="on">
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
        <form action="<?php echo base_url('Karyawan/Pasien/update_pasien'); ?>" method="post" id="form_edit"
            data-parsley-validate="true" autocomplete="off">
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pasien</h5>
                                <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_pasien" id="id_pasien">

                            <div class="form-group">
                                <label>Nama Pasien</label>
                                <input type="text" class="form-control" id="edit_nama" name="edit_nama"
                                    data-parsley-required="true" placeholder="Masukkan Nama Pasien" autofocus="on">
                            </div>
                            <div class="form-group">
                                <label>NIK Pasien</label>
                                <input type="number" class="form-control" id="edit_nik" name="edit_nik"
                                    data-parsley-required="true" placeholder="Masukkan NIK Pasien" minlength="16" maxlength="16" autofocus="on">
                                <span class="text-danger" id="error_nik_edit"></span>
                                <small id="emailHelp" class="form-text text-muted">Masukkan 16 karakter.</small>
                            </div>
                            <div class="form-group">
                                <label>Username Pasien</label>
                                <input type="text" class="form-control" id="edit_username" name="edit_username"
                                    data-parsley-required="true" placeholder="Masukkan Username Pasien" autofocus="on">
                                <span class="text-danger" id="error_edit_username"></span>
                            </div>
                            <div class="form-group">
                                <label>Password Pasien</label>
                                <input type="Password" class="form-control" id="edit_password" name="edit_password"
                                    placeholder="Masukkan Password Pasien" autofocus="on" data-parsley-equalto="#edit_password_konfirmasi">
                            </div>
                            <div class="form-group">
                                <label>Ulangi Password</label>
                                <input type="Password" class="form-control" id="edit_password_konfirmasi" name="edit_password_konfirmasi"
                                    placeholder="Masukkan Ulangi Password" autofocus="on" data-parsley-equalto="#edit_password">
                            </div>
                            <div class="form-group">
                                <label>Alamat Pasien</label>
                                <textarea class="form-control" id="edit_alamat" name="edit_alamat" placeholder="Masukkan alamat"></textarea>
                            </div>
                            <div class="form-group">
                                <label>No Telp Pasien</label>
                                <input type="number" class="form-control" id="edit_no_telp" name="edit_no_telp"
                                    data-parsley-required="true" placeholder="Masukkan No Telp Pasien" autofocus="on">
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
        <form action="<?php echo base_url('Karyawan/Pasien/delete_pasien'); ?>" method="post">
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

                            <h4>Apakah Ingin menghapus Pasien ini?</h4>

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
            $("#input_username").keyup(function(){

                var nama = $(this).val().trim();
          
                if(nama != ''){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Karyawan/Pasien/cek_username'); ?>' + '/' + nama,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_username").html('Username telah dipakai,coba yang lain');
                                $("#input_username").val('');
                            }else{
                                $("#error_username").html('');
                            }
                        }, error: function () {
            
                            alert('error');
                        }
                    });
                }
          
              });
            $("#edit_username").keyup(function(){

                var nama = $(this).val().trim();
          
                if(nama != '' && nama != $('#edit_username_lama').val()){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Karyawan/Pasien/cek_username'); ?>' + '/' + nama,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_edit_username").html('Username telah dipakai,coba yang lain');
                                $("#edit_username").val('');
                            }else{
                                $("#error_edit_username").html('');
                            }
                        }, error: function () {
            
                            alert('error');
                        }
                    });
                }
            });

            $("#input_nik").keyup(function(){

                var nik = $(this).val().trim();
          
                if(nik != ''){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Karyawan/Pasien/cek_nik'); ?>' + '/' + nik,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_nik").html('NIK telah dipakai,coba yang lain');
                                $("#input_nik").val('');
                            }else{
                                $("#error_nik").html('');
                            }
                        }, error: function () {
            
                            alert('error');
                        }
                    });
                }
          
              });
            $("#edit_nik").keyup(function(){

                var nik = $(this).val().trim();
          
                if(nik != '' && nik != $('#edit_username_lama').val()){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Karyawan/Pasien/cek_nik'); ?>' + '/' + nik,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_edit_nik").html('NIK telah dipakai,coba yang lain');
                                $("#edit_nik").val('');
                            }else{
                                $("#error_edit_nik").html('');
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
                $("#input_nik").val('');
                $("#input_username").val('');
                $("#input_password").val('');
                $("#input_password_konfirmasi").val('');
                $("#input_alamat").val('');
                $("#input_no_telp").val('');
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_nama").val('');
                $("#input_nik").val('');
                $("#input_username").val('');
                $("#input_password").val('');
                $("#input_password_konfirmasi").val('');
                $("#input_alamat").val('');
                $("#input_no_telp").val('');
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_nama").val('');
                $("#edit_nik").val('');
                $("#edit_username").val('');
                $("#edit_password").val('');
                $("#edit_password_konfirmasi").val('');
                $("#edit_alamat").val('');
                $("#edit_no_telp").val('');
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Karyawan/Pasien/data_edit'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_pasien').val(json.id_pasien);
                    $('#edit_nama').val(json.nama_pasien);
                    $('#edit_nik').val(json.nik);
                    $('#edit_username').val(json.username_pasien);
                    $('#edit_alamat').val(json.alamat_pasien);
                    $('#edit_no_telp').val(json.no_telp_pasien);
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