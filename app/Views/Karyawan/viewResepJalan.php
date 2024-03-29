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
                                <li class="breadcrumb-item">
                                    <?php if($session->get('divisi') != 'Pendaftaran') { ?>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i>
                                        Tambah Data</button>
                                    <?php } ?>
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
                                                <th style="text-align: center;">Id Resep</th>
                                                <th style="text-align: center;">Nama Pasien</th>
                                                <th style="text-align: center;">Nama Dokter</th>
                                                <th style="text-align: center;">Tagihan</th>
                                                <th style="text-align: center;">Pemeriksaan</th>
                                                <th style="text-align: center;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach ($data as $item) {
                                            ?>
                                            <tr>
                                                <td><?= $item['id_resep']; ?></td>
                                                <td><?= $item['nama_pasien']; ?></td>
                                                <td><?= $item['nama_dokter']; ?></td>
                                                <td>
                                                    <?php if($item['tagihan_obat'] != null) { 
                                                        echo $item['tagihan_obat'];
                                                    } else {
                                                        echo "0";
                                                    } ?>
                                                </td>
                                                <td><?= $item['tanggal']; ?></td>
                                                <td>
                                                    <center>
                                                        <a href="<?= base_url('Karyawan/RawatJalan/detailResep') . '/' . $item['id_resep']; ?>"  title="Detail"  name="btn-edit" class="btn btn-sm btn-edit btn-info"><i class="fa fa-eye"></i></a>
                                                        <?php if($session->get('divisi') != 'Pendaftaran') { ?>
                                                            <a href="" title="Edit" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['id_resep']; ?>)" class="btn btn-sm btn-edit btn-warning"><i class="fa fa-edit"></i></a>
                                                            <a href="" title="Hapus" class="btn btn-sm btn-delete btn-danger" onclick="Hapus(<?= $item['id_resep']; ?>, <?= $id_rekam ?>)" data-toggle="modal" data-target="#deleteModal" data-id="<?= $item['id_resep']; ?>"><i class="fa fa-trash"></i></a>
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
        <form action="<?php echo base_url('Karyawan/RawatJalan/add_resep'); ?>" method="post" id="form_add"
            data-parsley-validate="true" autocomplete="off" enctype="multipart/form-data">
            <div class="modal fade" id="addModal" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Resep</h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="input_rekam" id="input_rekam" value="<?= $id_rekam; ?>">

                            <div class="form-group">
                                <label>Tanggal Pemberian Resep</label>
                                <input type="date" class="form-control" id="input_tanggal" name="input_tanggal"
                                    data-parsley-required="true" autofocus="on">  
                            </div>

                            <div class="form-group">
                                <label>Status Pembayaran</label>
                                <div class="checkbox">
                                    <label for="example-checkbox1">
                                        <input type="checkbox" id="input_status" name="input_status"
                                            value="Lunas"> &nbsp Lunas
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
        <form action="<?php echo base_url('Karyawan/RawatJalan/update_resep'); ?>" method="post" id="form_edit"
            data-parsley-validate="true" autocomplete="off" enctype="multipart/form-data">
            <div class="modal fade" id="updateModal" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Resep</h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_resep" id="id_resep">
                            <input type="hidden" name="edit_rekam" id="edit_rekam" value="<?= $id_rekam; ?>">

                            <div class="form-group">
                                <label>Tanggal Pemberian Resep</label>
                                <input type="date" class="form-control" id="edit_tanggal" name="edit_tanggal"
                                    data-parsley-required="true" autofocus="on">  
                            </div>

                            <div class="form-group">
                                <label>Status Pembayaran</label>
                                <div class="checkbox">
                                    <label for="example-checkbox1">
                                        <input type="checkbox" id="edit_status" name="edit_status"
                                            value="Lunas"> &nbsp Lunas
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
        <form action="<?php echo base_url('Karyawan/RawatJalan/delete_resep'); ?>" method="post">
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
                            <input type="hidden" name="id_rekam" class="id_rekam">
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
        function Hapus(id, id_rekam){
            $('.id').val(id);
            $('.id_rekam').val(id_rekam);
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
            $('.select2').select2();

            $('#batal').on('click', function() {
                $('#form_add')[0].reset();
                $('#form_edit')[0].reset();
                $("#input_rekam").val('');
                $("#input_tanggal").val('');
                $("#input_status").prop('checked',false);
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_rekam").val('');
                $("#input_tanggal").val('');
                $("#input_status").prop('checked',false);
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_rekam").val('');
                $("#edit_tanggal").val('');
                $("#edit_status").prop('checked',false);
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Karyawan/RawatJalan/data_edit_resep'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_resep').val(json.id_resep);
                    $('#edit_tanggal').val(json.tanggal);
                    $('#edit_rekam').val(json.id_rekam);

                    if(json.status_bayar=='Lunas'){
                        $("#edit_status").prop('checked',true);
                    }else{
                        $("#edit_status").prop('checked',false);
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
