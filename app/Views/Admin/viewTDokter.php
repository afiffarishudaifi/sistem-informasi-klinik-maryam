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
                                                <th style="text-align: center;">Nama Dokter</th>
                                                <th style="text-align: center;">Alamat</th>
                                                <th style="text-align: center;">No Telepon</th>
                                                <th style="text-align: center;">Status</th>
                                                <th style="text-align: center;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach ($dokter as $item) {
                                            ?>
                                            <tr>
                                                <td><?= $item['nama_dokter']; ?></td>
                                                <td><?= $item['alamat_dokter']; ?></td>
                                                <td><?= $item['no_telp_dokter']; ?></td>
                                                <td><?= $item['status_dokter']; ?></td>
                                                <td>
                                                        <center>
                                                            <a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['nik_dokter']; ?>)" class="btn btn-sm btn-edit btn-warning">Edit</a>
                                                            <a href="" class="btn btn-sm btn-delete btn-danger" onclick="Hapus(<?= $item['nik_dokter']; ?>)" data-toggle="modal"
                                                                data-target="#deleteModal" data-id="<?= $item['nik_dokter']; ?>">Hapus</a>
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
        <form action="<?php echo base_url('Admin/Dokter/add_dokter'); ?>" method="post" id="form_add"
            data-parsley-validate="true" autocomplete="off" enctype="multipart/form-data">
            <div class="modal fade" id="addModal" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Dokter </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>NIK Dokter</label>
                                <input type="text" onkeyup='onlyNumber(event)' class="form-control" id="input_nik" name="input_nik" placeholder="Masukkan NIK Dokter" autofocus="on">
                            </div>

                            <div class="form-group">
                                <label>Nama Dokter</label>
                                <input type="text" class="form-control" id="input_nama" name="input_nama"
                                    data-parsley-required="true" placeholder="Masukkan Nama Dokter" autofocus="on">  
                            </div>
                            <!-- <div class="form-group">
                                <label>Poli</label>
                                <select class="form-control select2" id="input_poli" name="input_poli">
                                </select>   
                            </div> -->
                            <div class="form-group">
                                <label>Alamat Dokter</label>
                                <input type="text" class="form-control" id="input_alamat" name="input_alamat"
                                    placeholder="Masukkan Alamat Dokter" autofocus="on">
                            </div>
                            <div class="form-group">
                                <label>No Telp Dokter</label>
                                <input type="text" onkeyup='onlyNumber(event)' class="form-control" id="input_no_telp" name="input_no_telp" placeholder="Masukkan No Telp Dokter" autofocus="on">
                            </div>

                            <div class="form-group">
                                <label>Status Dokter</label>
                                <div class="checkbox">
                                    <label for="example-checkbox1">
                                        <input type="checkbox" id="input_status" name="input_status"
                                            value="Aktif"> &nbsp Aktif
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" id="input_kelamin" name="input_kelamin">
                                    <option value="Laki - Laki">Laki - Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" id="input_tanggal" name="input_tanggal" placeholder="Masukkan Tanggal Lahir" autofocus="on">
                            </div>

                            <div class="form-group">
                                <label>Foto Dokter</label>
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
        <form action="<?php echo base_url('Admin/Dokter/update_dokter'); ?>" method="post" id="form_edit"
            data-parsley-validate="true" autocomplete="off" enctype="multipart/form-data">
            <div class="modal fade" id="updateModal" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Dokter </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>NIK Dokter</label>
                                <input type="text" onkeyup='onlyNumber(event)' class="form-control" id="edit_nik" name="edit_nik" placeholder="Masukkan NIK Dokter" autofocus="on">
                            </div>

                            <div class="form-group">
                                <label>Nama Dokter</label>
                                <input type="text" class="form-control" id="edit_nama" name="edit_nama"
                                    data-parsley-required="true" placeholder="Masukkan Nama Dokter" autofocus="on">  
                            </div>

                             <!-- <div class="form-group">
                                <label>Poli</label>
                                <select class="form-control select2" name="edit_poli" id="edit_poli">
                                </select>
                            </div> -->

                            <div class="form-group">
                                <label>Alamat Dokter</label>
                                <input type="text" class="form-control" id="edit_alamat" name="edit_alamat"
                                    placeholder="Masukkan Nama Dokter" autofocus="on">   
                            </div>

                            <div class="form-group">
                                <label>No Telp Dokter</label>
                                <input type="text" onkeyup='onlyNumber(event)' class="form-control" id="edit_no_telp" name="edit_no_telp" placeholder="Masukkan Nama Dokter" autofocus="on">   
                            </div>

                            <div class="form-group">
                                <label>Status Dokter</label>
                                <div class="checkbox">
                                    <label for="example-checkbox1">
                                        <input type="checkbox" id="edit_status" name="edit_status"
                                            value="Aktif"> &nbsp Aktif
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" id="edit_kelamin" name="edit_kelamin">
                                    <option value="Laki - Laki">Laki - Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" id="edit_tanggal" name="edit_tanggal" placeholder="Masukkan Tanggal Lahir" autofocus="on">
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <center>
                                        <img id="foto_lama" style="width: 120px; height: 160px;" src="">
                                    </center>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Foto Dokter</label>
                                <br>
                                <input type="file" id="input_foto" class="dropify-event" name="input_foto" accept="image/png, image/gif, image/jpeg"/>
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
        <form action="<?php echo base_url('Admin/Dokter/delete_dokter'); ?>" method="post">
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

                            <h4>Apakah Ingin menghapus dokter ini?</h4>

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

            $('#batal').on('click', function() {
                $('#form_add')[0].reset();
                $('#form_edit')[0].reset();
                $("#input_nik").val('');
                $("#input_nama").val('');
                // $("#input_poli").val('');
                $("#input_alamat").val('');
                $("#input_no_telp").val('');
                $("#input_status").prop('checked',false);
                $("#input_kelamin").val('');
                $("#input_tanggal").val('');
                $("#input_foto").val('');
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_nik").val('');
                $("#input_nama").val('');
                // $("#input_poli").val('');
                $("#input_alamat").val('');
                $("#input_no_telp").val('');
                $("#input_status").prop('checked',false);
                $("#input_kelamin").val('');
                $("#input_tanggal").val('');
                $("#input_foto").val('');
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_nik").val('');
                $("#edit_nama").val('');
                // $("#edit_poli").val('');
                $("#edit_alamat").val('');
                $("#edit_no_telp").val('');
                $("#edit_status").prop('checked',false);
                $("#edit_kelamin").val('');
                $("#edit_tanggal").val('');
                $("#edit_foto").val('');
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Admin/Dokter/data_edit'); ?>' + '/' + isi, {},
                function(json) {
                    $('#edit_nik').val(json.nik_dokter);
                    $('#edit_nama').val(json.nama_dokter);

                    $('#edit_alamat').val(json.alamat_dokter);
                    $('#edit_no_telp').val(json.no_telp_dokter);

                    if(json.status_dokter=='Aktif'){
                        $("#edit_status").prop('checked',true);
                    }else{
                        $("#edit_status").prop('checked',false);
                    }
                    $('#edit_foto').val(json.foto_dokter);
                    $('#edit_tanggal').val(json.tanggal_lahir);
                    if(json.jenis_kelamin == 'Perempuan'){
                        document.getElementById("edit_kelamin").selectedIndex = 1;
                    }else{
                        document.getElementById("edit_kelamin").selectedIndex = 0;
                    };

                    if (json.foto_dokter != 'n') {
                        $("#foto_lama").attr("src", "<?= base_url() . '/' ?>" + json.foto_dokter);
                    } else {
                        $("#foto_lama").attr("src", "<?= base_url() . '/' ?>" + "/docs/img/img_karyawan/noimage.jpg");
                    }
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
