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
                                                <th style="text-align: center;">Stok</th>
                                                <th style="text-align: center;">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                foreach ($obat as $item) {
                                                ?>
                                                <tr>
                                                    <td width="1%"><?= $no++; ?></td>
                                                    <td><?= $item['nama_obat']; ?></td>
                                                    <td><?= $item['stok_obat']; ?></td>
                                                    <td><?= $item['harga_obat']; ?></td>
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
            $('.select2').select2()

            $("#input_kategori").select2({
                placeholder: "Pilih Kategori",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Karyawan/Obat/data_kategori'); ?>',
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

            $("#edit_kategori").select2({
                placeholder: "Pilih Kategori",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Karyawan/Obat/data_kategori'); ?>',
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

            $("#input_nama").keyup(function(){
                var nama = $(this).val().trim();
                if(nama != ''){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Karyawan/Obat/cek_nama'); ?>' + '/' + nama,
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

            $('#batal').on('click', function() {
                $('#form_add')[0].reset();
                $('#form_edit')[0].reset();
                $("#input_nama").val('');
                $("#input_stok").val('');
                $("#input_harga").val('');
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_nama").val('');
                $("#input_stok").val('');
                $("#input_harga").val('');
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_nama").val('');
                $("#edit_stok").val('');
                $("#edit_harga").val('');
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Karyawan/Obat/data_edit'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_obat').val(json.id_obat);
                    $('#edit_nama').val(json.nama_obat);
                    $('#edit_stok').val(json.stok_obat);
                    $('#edit_harga').val(json.harga_obat);

                    $('#edit_kategori').append('<option selected value="' + json.id_kategori + '">' + json.nama_kategori +
                        '</option>');
                    $('#edit_kategori').select2('data', {
                        id: json.id_kategori,
                        text: json.nama_kategori
                    });
                    $('#edit_kategori').trigger('change');
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
