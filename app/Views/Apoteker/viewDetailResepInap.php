<?php $session = session(); ?>
<!DOCTYPE html>
<html lang="en">

<?= $this->include("Apoteker/layout/head_tabel") ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->include("Apoteker/layout/navbar") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->include("Apoteker/layout/sidebar") ?>

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
                                <!-- <li class="breadcrumb-item"><button class="btn btn-success" data-toggle="modal"
                                        data-target="#addModal"><i class="fa fa-plus"></i>
                                        Tambah Data</button>
                                </li> -->
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
                                                <th style="text-align: center;">Nama Obat</th>
                                                <th style="text-align: center;">Jumlah Obat</th>
                                                <th style="text-align: center;">Tagihan</th>
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
        <?= $this->include("Apoteker/layout/footer") ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    
    <?= $this->include("Apoteker/layout/js_tabel") ?>

    <script>

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
                    url: '<?php echo base_url('Apoteker/RawatInap/data_obat'); ?>',
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
                    url: '<?php echo base_url('Apoteker/RawatInap/data_obat'); ?>',
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
              $.getJSON('<?php echo base_url('Apoteker/RawatInap/harga_obat'); ?>' + '/' + this.value, {},
                function(json) {
                    $('#input_harga').val(json.harga_obat);
                    var hasil = $('#input_jumlah').val() * json.harga_obat;
                    $('#input_total').val(hasil);
                });
            });

            $('#edit_obat').on('change', function() {
              $.getJSON('<?php echo base_url('Apoteker/RawatInap/harga_obat'); ?>' + '/' + this.value, {},
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
            $.getJSON('<?php echo base_url('Apoteker/RawatInap/data_edit_detail_resep'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_detail').val(json.id_detail);
                    $('#edit_resep').val(json.id_rekam_inap);
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
