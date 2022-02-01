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
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Alamat</th>
                                                <th>No Telp</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php 
                                                    foreach ($karyawan as $item) {
                                                ?>
                                                <td><?= $item['nama_karyawan']; ?></td>
                                                <td><?= $item['nama_jabatan']; ?></td>
                                                <td><?= $item['alamat_karyawan']; ?></td>
                                                <td><?= $item['no_telp_karyawan']; ?></td>
                                                <td><?= $item['status_karyawan']; ?></td>
                                                <td>
                                                       <center>
                                                            <a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['id_karyawan']; ?>)" class="btn btn-sm btn-edit btn-warning">Edit</a>
                                                            <a href="" class="btn btn-sm btn-delete btn-danger" onclick="Hapus(<?= $item['id_karyawan']; ?>)" data-toggle="modal"
                                                                data-target="#deleteModal" data-id="<?= $item['id_karyawan']; ?>">Hapus</a>
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
        <form action="<?php echo base_url('Admin/Karyawan/add_karyawan'); ?>" method="post" id="form_add"
            data-parsley-validate="true" autocomplete="off">
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Karyawan </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nama Karyawan</label>
                                <input type="text" class="form-control" id="input_nama" name="input_nama"
                                    data-parsley-required="true" placeholder="Masukkan Nama Karyawan" autofocus="on">
                                
                            </div>

                            <div class="form-group">
                                <label>Jabatan</label>
                                <select class="form-control select2" id="input_jabatan" name="input_jabatan">
                                </select>   
                            </div>

                            <div class="form-group">
                                <label>Username Karyawan</label>
                                <input type="text" class="form-control" id="input_username" name="input_username"
                                    data-parsley-required="true" placeholder="Masukkan Nama Karyawan" autofocus="on">
                                <span class="text-danger" id="error_username"></span>
                            </div>

                            <div class="form-group">
                                <label>Password Karyawan</label>
                                <input type="Password" class="form-control" id="input_password" name="input_password"
                                    data-parsley-required="true" placeholder="Masukkan Password Kar" autofocus="on">
                            </div>

                            <div class="form-group">
                                <label>Ulangi Password</label>
                                <input type="Password" class="form-control" id="input_password_konfirmasi" name="input_password_konfirmasi"
                                    data-parsley-required="true" placeholder="Masukkan Ulangi Password" autofocus="on" data-parsley-equalto="#input_password">
                            </div>

                            <div class="form-group">
                                <label>No Telepon Karyawan</label>
                                <input type="text" class="form-control" id="input_no_telp" name="input_no_telp"
                                    data-parsley-required="true" placeholder="Masukkan Nama Karyawan" autofocus="on">
                            </div>

                            <div class="form-group">
                                <label>Alamat Karyawan</label>
                                <input type="text" class="form-control" id="input_alamat" name="input_alamat"
                                    data-parsley-required="true" placeholder="Masukkan Nama Karyawan" autofocus="on">
                            </div>
                            
                            <div class="form-group">
                                <label>Status Karyawan</label>
                                <div class="checkbox">
                                    <label for="example-checkbox1">
                                        <input type="checkbox" id="input_status" name="input_status"
                                            value="Aktif"> &nbsp Aktif
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Foto Karyawan</label>
                                <br>
                                <input type="file" id="input_foto" class="dropify-event" name="input_foto" accept="image/png, image/gif, image/jpeg"/>
                                <span class="text-danger" id="error_foto"></span>
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
        <form action="<?php echo base_url('Admin/Karyawan/update_karyawan'); ?>" method="post" id="form_edit"
            data-parsley-validate="true" autocomplete="off">
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Karyawan</h5>
                                <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_karyawan" id="id_karyawan">

                            <div class="form-group">
                                <label>Nama Karyawan</label>
                                <input type="text" class="form-control" id="edit_nama" name="edit_nama"
                                    data-parsley-required="true" placeholder="Masukkan Nama Karyawan" autofocus="on">
                            </div>

                            <div class="form-group">
                                <label>Jabatan</label>
                                <select class="form-control select2" name="edit_jabatan" id="edit_jabatan">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Username Karyawan</label>
                                <input type="text" class="form-control" id="edit_username" name="edit_username"
                                    data-parsley-required="true" placeholder="Masukkan Nama Karyawan" autofocus="on">
                                <span class="text-danger" id="error_edit_username"></span>
                            </div>
                            <div class="form-group">
                                <label>Password Karyawan</label>
                                <input type="Password" class="form-control" id="edit_password" name="edit_password"
                                    placeholder="Masukkan Password Pasien" autofocus="on">
                            </div>
                            <div class="form-group">
                                <label>Ulangi Password</label>
                                <input type="Password" class="form-control" id="edit_password_konfirmasi" name="edit_password_konfirmasi"
                                    placeholder="Masukkan Ulangi Password" autofocus="on" data-parsley-equalto="#edit_password">
                            </div>
                            <div class="form-group">
                                <label>No Telepon Karyawan</label>
                                <input type="text" class="form-control" id="edit_no_telp" name="edit_no_telp"
                                    data-parsley-required="true" placeholder="Masukkan Nama Karyawan" autofocus="on">
                            </div>
                            <div class="form-group">
                                <label>Alamat Karyawan</label>
                                <input type="text" class="form-control" id="edit_alamat" name="edit_alamat"
                                    data-parsley-required="true" placeholder="Masukkan Nama Karyawan" autofocus="on">
                            </div>

                            <div class="form-group">
                                <label>Status Karyawan</label>
                                <div class="checkbox">
                                    <label for="example-checkbox1">
                                        <input type="checkbox" id="edit_status" name="edit_status"
                                            value="Aktif"> &nbsp Aktif
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Foto Karyawan</label>
                                <br>
                                <input type="file" id="edit_foto" class="dropify-event" name="edit_foto" accept="image/png, image/gif, image/jpeg"/>
                                <span class="text-danger" id="error_edit_foto"></span>
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
        <form action="<?php echo base_url('Admin/Karyawan/delete_karyawan'); ?>" method="post">
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

                            <h4>Apakah Ingin menghapus karyawan ini?</h4>

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
            $("#input_username").keyup(function(){

                var username = $(this).val().trim();
          
                if(username != ''){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Admin/Karyawan/cek_username'); ?>' + '/' + username,
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

                var username = $(this).val().trim();
          
                if(username != '' && username != $('#edit_username_lama').val()){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Admin/Karyawan/cek_username'); ?>' + '/' + username,
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

            $('.select2').select2()

            $("#input_jabatan").select2({
                placeholder: "Pilih Jabatan",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Admin/Karyawan/data_jabatan'); ?>',
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

            $("#edit_jabatan").select2({
                placeholder: "Pilih Jabatan",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Admin/Jabatan/data_jabatan'); ?>',
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
                $("#input_jabatan").val('');
                $("#input_username").val('');
                $("#input_password").val('');
                $("#input_password_konfirmasi").val('');
                $("#input_no_telp").val('');
                $("#input_alamat").val('');
                $("#input_status").prop('checked',false);
                $("#input_foto").val('');
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_nama").val('');
                $("#input_jabatan").val('');
                $("#input_username").val('');
                $("#input_password").val('');
                $("#input_password_konfirmasi").val('');
                $("#input_no_telp").val('');
                $("#input_alamat").val('');
                $("#input_status").prop('checked',false);
                $("#input_foto").val('');
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_nama").val('');
                $("#edit_jabatan").val('');
                $("#edit_username").val('');
                $("#edit_password").val('');
                $("#edit_password_konfirmasi").val('');
                $("#edit_no_telp").val('');
                $("#edit_alamat").val('');
                $("#edit_status").prop('checked',false);
                $("#edit_foto").val('');
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Admin/Karyawan/data_edit'); ?>' + '/' + isi, {},
                function(json) {

                    $('#id_karyawan').val(json.id_karyawan);
                    
                    if(json.status_karyawan=='Aktif'){
                        $("#edit_status").prop('checked',true);
                    }else{
                        $("#edit_status").prop('checked',false);
                    }

                    $('#edit_nama').val(json.nama_karyawan);
                    $('#edit_username').val(json.username_karyawan);
                    $('#edit_no_telp').val(json.no_telp_karyawan);
                    $('#edit_alamat').val(json.alamat_karyawan);
                    $('#edit_foto').val(json.foto_karyawan);

                    $('#edit_jabatan').append('<option selected value="' + json.id_jabatan + '">' + json.nama_jabatan +
                        '</option>');
                    $('#edit_jabatan').select2('data', {
                        id: json.id_jabatan,
                        text: json.nama_jabatan
                    });
                    $('#edit_jabatan').trigger('change');
                   
                    
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