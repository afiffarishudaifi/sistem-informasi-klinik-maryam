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
                                                <th style="text-align: center;">No</th>
                                                <th style="text-align: center;">Nama</th>
                                                <th style="text-align: center;">No Telp</th>
                                                <th style="text-align: center;">Alamat</th>
                                                <th style="text-align: center;">Status</th>
                                                <th style="text-align: center;">Divisi</th>
                                                <th style="text-align: center;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                foreach ($karyawan as $item) {
                                                ?>
                                                <tr>
                                                    <td width="1%"><?= $no++; ?></td>
                                                    <td><?= $item['nama_karyawan']; ?></td>
                                                    <td><?= $item['no_telp_karyawan']; ?></td>
                                                    <td><?= $item['alamat_karyawan']; ?></td>
                                                    <td><?= $item['status_karyawan']; ?></td>
                                                    <td><?= $item['divisi']; ?></td>
                                                    <td>
                                                        <center>
                                                            <a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['nik_karyawan']; ?>)" class="btn btn-sm btn-edit btn-warning">Edit</a>
                                                            <a href="" class="btn btn-sm btn-delete btn-danger" onclick="Hapus(<?= $item['nik_karyawan']; ?>,<?= $item['id_user']; ?>)" data-toggle="modal"
                                                                data-target="#deleteModal" data-id="<?= $item['nik_karyawan']; ?>">Hapus</a>
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
        <form action="<?= base_url('Admin/Karyawan/add_karyawan'); ?>" method="post" id="form_add"
            data-parsley-validate="true" autocomplete="off" enctype="multipart/form-data">
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
                                <label>NIK Karyawan</label>
                                <input type="text" onkeyup="onlyNumber(event)" class="form-control" id="input_nik" name="input_nik"
                                    data-parsley-required="true" placeholder="Masukkan NIK Karyawan" minlength="16" maxlength="16" autofocus="on">
                                <span class="text-danger" id="error_nik"></span>
                                <small id="emailHelp" class="form-text text-muted">Masukkan 16 karakter.</small>
                            </div>

                            <div class="form-group">
                                <label>Email Karyawan</label>
                                <input type="email" class="form-control" id="input_email" name="input_email"
                                    data-parsley-required="true" placeholder="Masukkan Email Karyawan" autofocus="on">
                                <span class="text-danger" id="error_email"></span>
                            </div>

                            <div class="form-group">
                                <label>Password Karyawan</label>
                                <input type="Password" class="form-control" id="input_password" name="input_password"
                                    data-parsley-required="true" placeholder="Masukkan Password Kar" autofocus="on" data-parsley-equalto="#input_password_konfirmasi">
                            </div>

                            <div class="form-group">
                                <label>Ulangi Password</label>
                                <input type="Password" class="form-control" id="input_password_konfirmasi" name="input_password_konfirmasi"
                                    data-parsley-required="true" placeholder="Masukkan Ulangi Password" autofocus="on" data-parsley-equalto="#input_password">
                            </div>

                            <div class="form-group">
                                <label>No Telepon Karyawan</label>
                                <input type="text" onkeyup="onlyNumber(event)" class="form-control" id="input_no_telp" name="input_no_telp" placeholder="Masukkan Telp Karyawan" autofocus="on">
                            </div>

                            <div class="form-group">
                                <label>Alamat Karyawan</label>
                                <textarea class="form-control" id="input_alamat" name="input_alamat"
                                    placeholder="Masukkan Alamat Karyawan"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" id="input_kelamin" name="input_kelamin">
                                    <option value="Laki - Laki">Laki - Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Divisi</label>
                                <select class="form-control" id="input_divisi" name="input_divisi">
                                    <option value="Pendaftaran">Pendaftaran</option>
                                    <option value="Poli">Poli</option>
                                </select>
                            </div>

                            <div class="form-group" id="input_poli_view" style="display: none;">
                                <label>Poli</label>
                                <select class="form-control select2" id="input_poli" name="input_poli">
                                </select>   
                            </div>
                            
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" value="<?= date('Y-m-d') ?>" class="form-control" id="input_tanggal" name="input_tanggal" data-parsley-required="true" autocomplete="off" />
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
            data-parsley-validate="true" autocomplete="off" enctype="multipart/form-data">
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
                            <input type="hidden" name="nik_karyawan" id="nik_karyawan">
                            <input type="hidden" name="email_lama" id="email_lama">
                            <input type="hidden" name="id_user" id="id_user">
                            <input type="hidden" name="poli_lama" id="poli_lama">

                            <div class="form-group">
                                <label>Nama Karyawan</label>
                                <input type="text" class="form-control" id="edit_nama" name="edit_nama"
                                    data-parsley-required="true" placeholder="Masukkan Nama Karyawan" autofocus="on">
                            </div>

                            <div class="form-group">
                                <label>NIK Karyawan</label>
                                <input type="text" onkeyup="onlyNumber(event)" class="form-control" id="edit_nik" name="edit_nik"
                                    data-parsley-required="true" placeholder="Masukkan NIK Karyawan" minlength="16" maxlength="16" autofocus="on">
                                <span class="text-danger" id="error_nik"></span>
                                <small id="emailHelp" class="form-text text-muted">Masukkan 16 karakter.</small>
                            </div>

                            <div class="form-group">
                                <label>Email Karyawan</label>
                                <input type="text" class="form-control" id="edit_email" name="edit_email"
                                    data-parsley-required="true" placeholder="Masukkan Email Karyawan" autofocus="on">
                                <span class="text-danger" id="error_edit_email"></span>
                            </div>
                            <div class="form-group">
                                <label>Password Karyawan</label>
                                <input type="Password" class="form-control" id="edit_password" name="edit_password"
                                    placeholder="Masukkan Password Pasien" autofocus="on" data-parsley-equalto="#edit_password_konfirmasi">
                            </div>
                            <div class="form-group">
                                <label>Ulangi Password</label>
                                <input type="Password" class="form-control" id="edit_password_konfirmasi" name="edit_password_konfirmasi"
                                    placeholder="Masukkan Ulangi Password" autofocus="on" data-parsley-equalto="#edit_password">
                            </div>
                            <div class="form-group">
                                <label>No Telepon Karyawan</label>
                                <input type="text" onkeyup="onlyNumber(event)" class="form-control" id="edit_no_telp" name="edit_no_telp" placeholder="Masukkan Telp Karyawan" autofocus="on">
                            </div>
                            <div class="form-group">
                                <label>Alamat Karyawan</label>
                                <textarea class="form-control" id="edit_alamat" name="edit_alamat"
                                    placeholder="Masukkan Alamat Karyawan"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" id="edit_kelamin" name="edit_kelamin">
                                    <option value="Laki - Laki">Laki - Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Divisi</label>
                                <select class="form-control" id="edit_divisi" name="edit_divisi">
                                    <option value="Pendaftaran">Pendaftaran</option>
                                    <option value="Poli">Poli</option>
                                </select>
                            </div>

                            <div class="form-group" id="edit_poli_view" style="display: none;">
                                <label>Poli</label>
                                <select class="form-control select2" id="edit_poli" name="edit_poli">
                                </select>   
                            </div>
                            
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" id="edit_tanggal" name="edit_tanggal" data-parsley-required="true" autocomplete="off" />
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
                                <div class="col-md-12">
                                    <center>
                                        <img id="foto_lama" style="width: 120px; height: 160px;" src="">
                                    </center>
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
                            <input type="hidden" name="id_user" class="id_user">
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
        function Hapus(id, id_user){
            $('.id').val(id);
            $('.id_user').val(id_user);
            $('#deleteModal').modal('show');
        };
        
        $( document ).ready(function() {
            if ('<?= $session->getFlashdata('sukses'); ?>' != '') {
                toastr.success('<?= $session->getFlashdata('sukses'); ?>')
            } else if ('<?= $session->getFlashdata('gagal'); ?>' != '') {
                toastr.error('<?= $session->getFlashdata('gagal'); ?>')
            }
        });

        function detail_edit(isi) {
            $.getJSON('<?= base_url('Admin/Karyawan/data_edit'); ?>' + '/' + isi, {},
                function(json) {
                    $('#edit_nama').val(json.nama_karyawan);
                    $('#nik_karyawan').val(json.nik_karyawan);
                    $('#edit_nik').val(json.nik_karyawan);
                    $('#id_user').val(json.id_user);
                    $('#edit_tanggal').val(json.tgl_lahir);
                    $('#poli_lama').val(json.id_poli);

                    if(json.jenis_kelamin == 'Perempuan'){
                        document.getElementById("edit_kelamin").selectedIndex = 1;
                    }else{
                        document.getElementById("edit_kelamin").selectedIndex = 0;
                    }

                    if(json.divisi == 'Poli'){
                        document.getElementById("edit_divisi").selectedIndex = 1;
                    }else{
                        document.getElementById("edit_divisi").selectedIndex = 0;
                    }

                    if (json.divisi == 'Poli') {
                        $('#edit_poli_view').show();

                        $('#edit_poli').append('<option selected value="' + json.id_poli + '">' + json.nama_poli +
                        '</option>');
                        $('#edit_poli').select2('data', {
                            id: json.id_poli,
                            text: json.nama_poli
                        });
                        $('#edit_poli').trigger('change');
                    } else {
                        $('#edit_poli_view').hide();
                    }
                    
                    if(json.status_karyawan=='Aktif'){
                        $("#edit_status").prop('checked',true);
                    }else{
                        $("#edit_status").prop('checked',false);
                    }

                    $('#edit_email').val(json.email);
                    $('#email_lama').val(json.email);
                    $('#edit_no_telp').val(json.no_telp_karyawan);
                    $('#edit_alamat').val(json.alamat_karyawan);                    
                    if (json.foto_karyawan != 'n') {
                        $("#foto_lama").attr("src", "<?= base_url() . '/' ?>" + json.foto_karyawan);
                    } else {
                        $("#foto_lama").attr("src", "<?= base_url() . '/' ?>" + "/docs/img/img_karyawan/noimage.jpg");
                    }
                    
                });
        }
    </script>

    
    <script type="text/javascript">
        $(function() {

            $("#input_divisi").change(function() {
                if (this.value == "Pendaftaran"){
                    $('#input_poli_view').hide();
                    $('#input_poli').val('').change();
                } else {
                    $('#input_poli_view').show();
                }
            }).change();

            $("#edit_divisi").change(function() {
                if (this.value == "Pendaftaran"){
                    $('#edit_poli_view').hide();
                    $('#edit_poli').val('').change();
                } else {
                    $('#edit_poli_view').show();
                    $('#edit_poli').val($('#poli_lama').val()).change();
                }
            }).change();

            $('.select2').select2()

            $("#input_poli").select2({
                placeholder: "Pilih Poliklinik",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Admin/Karyawan/data_poli'); ?>',
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
                placeholder: "Pilih Poliklinik",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Admin/Karyawan/data_poli'); ?>',
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

            $("#input_email").keyup(function(){

                var username = $(this).val().trim();
          
                if(username != ''){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Admin/Karyawan/cek_email'); ?>' + '/' + username,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_email").html('Username telah dipakai,coba yang lain');
                                $("#input_email").val('');
                            }else{
                                $("#error_email").html('');
                            }
                        }, error: function () {
            
                            alert('error');
                        }
                    });
                }
          
              });

            $("#edit_email").keyup(function(){

                var email = $(this).val().trim();
          
                if(email != '' && $('#email_lama').val()){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Admin/Karyawan/cek_email'); ?>' + '/' + email,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_email").html('Email telah dipakai,coba yang lain');
                                $("#edit_email").val('');
                            }else{
                                $("#error_email").html('');
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
                $("#input_nik").val('');
                $("#input_tanggal").val('');
                $("#input_kelamin").val('');
                $("#input_nama").val('');
                $("#input_email").val('');
                $("#input_password").val('');
                $("#input_password_konfirmasi").val('');
                $("#input_no_telp").val('');
                $("#input_alamat").val('');
                $("#input_status").prop('checked',false);
                $("#input_foto").val('');
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_nik").val('');
                $("#input_tanggal").val('');
                $("#input_kelamin").val('');
                $("#input_nama").val('');
                $("#input_email").val('');
                $("#input_password").val('');
                $("#input_password_konfirmasi").val('');
                $("#input_no_telp").val('');
                $("#input_alamat").val('');
                $("#input_status").prop('checked',false);
                $("#input_foto").val('');
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_nik").val('');
                $("#edit_tanggal").val('');
                $("#edit_kelamin").val('');
                $("#edit_nama").val('');
                $("#edit_email").val('');
                $("#edit_password").val('');
                $("#edit_password_konfirmasi").val('');
                $("#edit_no_telp").val('');
                $("#edit_alamat").val('');
                $("#edit_status").prop('checked',false);
                $("#edit_foto").val('');
            });

        });
    </script>
</body>

</html>
