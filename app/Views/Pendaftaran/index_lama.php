<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Klinik Maryam Beranda</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="shortcut icon" href="<?= base_url() ?>/docs/adminlte/dist/img/AdminLTELogo.png">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url() ?>/docs/flexstart/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= base_url() ?>/docs/flexstart/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>/docs/flexstart/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url() ?>/docs/flexstart/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>/docs/flexstart/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url() ?>/docs/flexstart/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url() ?>/docs/flexstart/assets/css/style.css" rel="stylesheet">


    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url() ?>/docs/adminlte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/docs/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() ?>/docs/adminlte/plugins/toastr/toastr.min.css">

  <!-- =======================================================
  * Template Name: FlexStart - v1.9.0
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="<?= base_url() ?>/docs/flexstart/assets/img/logo.png" alt="">
        <span>Klinik Maryam</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="<?= base_url('LandingPage') ?>">Beranda</a></li>
          <li><a class="nav-link scrollto active" href="#pendaftaran">Pendaftaran</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  	<section id="pendaftaran" class="values">

      <div class="container">

        <header class="section-header">
          <h2></h2>
          <p></p>
        </header>

        <div class="row">

          <div class="col-lg-2"></div>
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
          	<a href="javascript:void(0)" id="btnInapDaftar">
	            <div class="box">
	              <img src="<?= base_url() . '/' ?>docs/flexstart/assets/img/rawatinap.png" class="img-fluid">
	              <h3>Pendaftaran Rawat Inap</h3>
	              <p style="color: #000000;">Pendaftaran bagi pasien yang ingin melakukan rawat Inap.</p>
	            </div>
	        </a>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
          	<a href="javascript:void(0)" id="btnJalanDaftar">
	            <div class="box">
	              <img src="<?= base_url() . '/' ?>docs/flexstart/assets/img/rawatjalan.png" class="img-fluid">
	              <h3>Pendaftaran Rawat Jalan</h3>
	              <p style="color: #000000;">Pendaftaran bagi pasien yang ingin melakukan rawat Jalan.</p>
	            </div>
	        </a>
          </div>
          <div class="col-lg-2"></div>
        </div>

      </div>

    </section><!-- End Values Section -->


  <!-- ======= Contact Section ======= -->
    <section id="formInap" class="contact" style="display: none;">

      <div class="container" data-aos="fade-up">

        <header class="section-header" style="padding-top: 20px;">
          <h2></h2>
          <p>Pendaftaran</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-3"></div>

          <div class="col-lg-6">
            <form action="<?= base_url('Pendaftaran/Pendaftaran/add_pendaftaran_inap'); ?>" method="post" id="form_add" autocomplete="off" enctype="multipart/form-data">
	            
	            <div class="row gy-4">
		            <?= csrf_field(); ?>

		            <div class="col-md-12">
	                    <label>NIK Pasien</label>
	                </div>
	                <div class="col-md-12">
	                    <input type="text" class="form-control hanya_angka" autofocus="on" minlength=16 id="input_nik" name="input_nik" maxlength=16 required="" placeholder="Masukkan NIK">
	                </div>

	                <div class="col-md-12">
                        <label>Status Pasien</label>
                    </div>
                    <div class="col-md-12">
                        <div class="checkbox">
                            <label for="example-checkbox1">
                                <input type="checkbox" id="input_status_inap" onchange="showDataInap(this.value)" name="input_status_inap"
                                    value="Baru"> &nbsp Baru
                            </label>
                        </div>
                    </div>

	                <div class="col-md-12 data-pasien-inap" style="display: none;">
                        <label>Nama Pasien</label>
                    </div>
                    <div class="col-md-12 data-pasien-inap" style="display: none;">
                        <input type="text" class="form-control data-pasien-inap-input" id="input_nama" name="input_nama"
                            placeholder="Masukkan Nama Pasien" autofocus="on">
                    </div>

                    <div class="col-md-12 data-pasien-inap" style="display: none;">
                        <label>Alamat Pasien</label>
                    </div>
                    <div class="col-md-12 data-pasien-inap data-pasien-inap-input" style="display: none;">
                        <textarea class="form-control" id="input_alamat" name="input_alamat" placeholder="Masukkan alamat"></textarea>
                    </div>
                    <div class="col-md-12 data-pasien-inap" style="display: none;">
                        <label>No Telp Pasien</label>
                    </div>
                    <div class="col-md-12 data-pasien-inap" style="display: none;">
                        <input type="text" class="form-control data-pasien-inap-input hanya_angka" id="input_no_telp" name="input_no_telp" placeholder="Masukkan No Telp Pasien" autofocus="on">
                    </div>

                    <div class="col-md-12 data-pasien-inap" style="display: none;">
                        <label>Jenis Kelamin</label>
                    </div>
                    <div class="col-md-12 data-pasien-inap" style="display: none;">
                        <select class="form-control" id="input_kelamin" name="input_kelamin">
                            <option value="Laki - Laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="col-md-12 data-pasien-inap" style="display: none;">
                        <label>Tanggal Lahir</label>
                    </div>
                    <div class="col-md-12 data-pasien-inap" style="display: none;">
                        <input type="date" value="<?= date('Y-m-d') ?>" class="form-control data-pasien-inap-input" id="input_tanggal" name="input_tanggal" autocomplete="off" />
                    </div>

                    <div class="col-md-12 data-pasien-inap" style="display: none;">
                        <label>Agama</label>
                    </div>
                    <div class="col-md-12 data-pasien-inap" style="display: none;">
                        <input type="text" class="form-control data-pasien-inap-input" id="input_agama" name="input_agama"
                            placeholder="Masukkan Agama" autofocus="on">
                        <span class="text-danger" id="error_email"></span>
                    </div>

		            <div class="col-md-12">
	                    <label>Pilih Kamar</label> 
	                </div>

	                <div class="col-md-12">
	                    <select class="form-control select2" id="input_kamar" name="input_kamar" required style="width: 100%">
	                    </select>   
	                </div>

	                <div class="col-md-12">
	                    <label>Tanggal Masuk</label> 
	                </div>

	                <div class="col-md-12">
	                    <input type="datetime-local" class="form-control" id="input_masuk" name="input_masuk" autocomplete="off" />
	                    </select>   
	                </div>

		            <div class="form-group form-material floating" data-plugin="formMaterial">
		                <div class="col-xs-12">
		                    <div id="html_element" data-callback="daftarInap"></div>
		                </div>
		            </div>

	                <div class="col-md-12">
	                	<center>
	                        <button type="reset" style="padding: 10px 30px;" class="btn btn-sm btn-secondary" id="batalInap">Batal</button>
	                        <button type="submit" class="btn btn-sm btn-primary" disabled name="tambah" id="simpanInap"  style="background: #03989e;
          							    border: 0;
          							    padding: 10px 30px;
          							    color: #fff;
          							    transition: 0.4s;
          							    border-radius: 4px;">Simpan</button>
	                	</center>
	                </div>
               	</div>
	        </form>

          </div>
          <div class="col-lg-3"></div>

        </div>

      </div>

    </section>

    <section id="formJalan" class="contact" style="display: none;">

      <div class="container" data-aos="fade-up">

        <header class="section-header" style="padding-top: 20px;">
          <h2></h2>
          <p>Pendaftaran</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-3"></div>

          <div class="col-lg-6">
            <form action="<?= base_url('Pendaftaran/Pendaftaran/add_pendaftaran_jalan'); ?>" method="post" id="form_add" autocomplete="off" enctype="multipart/form-data">
							     
				<div class="row gy-4">       
		            <?= csrf_field(); ?>

	                <div class="col-md-12">
	                    <label>NIK Pasien</label>
	                </div>
	                <div class="col-md-12">
	                    <input type="text" class="form-control hanya_angka" autofocus="on" minlength=16 id="input_nik" name="input_nik" maxlength=16 required="" placeholder="Masukkan NIK">
	                </div>

	                <div class="col-md-12">
                        <label>Status Pasien</label>
                    </div>
                    <div class="col-md-12">
                        <div class="checkbox">
                            <label for="example-checkbox1">
                                <input type="checkbox" id="input_status_jalan" onchange="showDataJalan(this.value)" name="input_status_jalan"
                                    value="Baru"> &nbsp Baru
                            </label>
                        </div>
                    </div>

	                <div class="col-md-12 data-pasien-jalan" style="display: none;">
                        <label>Nama Pasien</label>
                    </div>
                    <div class="col-md-12 data-pasien-jalan" style="display: none;">
                        <input type="text" class="form-control data-pasien-jalan-input" id="input_nama_jalan" name="input_nama"
                            placeholder="Masukkan Nama Pasien" autofocus="on">
                    </div>

                    <div class="col-md-12 data-pasien-jalan" style="display: none;">
                        <label>Alamat Pasien</label>
                    </div>
                    <div class="col-md-12 data-pasien-jalan" style="display: none;">
                        <textarea class="form-control data-pasien-jalan-input" id="input_alamat_jalan" name="input_alamat" placeholder="Masukkan alamat"></textarea>
                    </div>
                    <div class="col-md-12 data-pasien-jalan" style="display: none;">
                        <label>No Telp Pasien</label>
                    </div>
                    <div class="col-md-12 data-pasien-jalan" style="display: none;">
                        <input type="text" class="form-control data-pasien-jalan-input hanya_angka" id="input_no_telp_jalan" name="input_no_telp" placeholder="Masukkan No Telp Pasien" autofocus="on">
                    </div>

                    <div class="col-md-12 data-pasien-jalan" style="display: none;">
                        <label>Jenis Kelamin</label>
                    </div>
                    <div class="col-md-12 data-pasien-jalan" style="display: none;">
                        <select class="form-control" id="input_kelamin" name="input_kelamin">
                            <option value="Laki - Laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="col-md-12 data-pasien-jalan" style="display: none;">
                        <label>Tanggal Lahir</label>
                    </div>

                    <div class="col-md-12 data-pasien-jalan" style="display: none;">
                        <input type="date" value="<?= date('Y-m-d') ?>" class="form-control data-pasien-jalan-input" id="input_tanggal_jalan" name="input_tanggal" autocomplete="off" />
                    </div>

                    <div class="col-md-12 data-pasien-jalan" style="display: none;">
                        <label>Agama</label>
                    </div>

                    <div class="col-md-12 data-pasien-jalan" style="display: none;">
                        <input type="text" class="form-control data-pasien-jalan-input" id="input_agama_jalan" name="input_agama" placeholder="Masukkan Agama" autofocus="on">
                        <span class="text-danger" id="error_email"></span>
                    </div>

	                <div class="col-md-12">
	                    <label>Poli</label>
	                </div>
	                <div class="col-md-12">
	                    <select class="form-control select2" id="input_poli" name="input_poli" required style="width: 100%">
	                    </select>   
	                </div>
	                <!-- <div class="col-md-12">
	                    <label>Keluhan</label>
	                </div>
	                <div class="col-md-12">
	                    <input type="text" class="form-control" id="input_keluhan" name="input_keluhan"placeholder="Masukkan Keluhan" required>
	                </div> -->
	                <!-- <div class="col-md-12">
	                    <label>Umur Pasien</label>
	                </div>
	                <div class="col-md-12">
	                    <input type="number" class="form-control" id="input_umur" name="input_umur"
	                       placeholder="Masukkan Umur Pasien" required="">
	                </div> -->
	                <div class="col-md-12">
	                    <label>Tanggal Daftar</label>
	                </div>
	               	<div class="col-md-12">
	                    <input type="datetime-local" value="<?= date('Y-m-d') ?>T00:00" class="form-control" id="input_tanggal" name="input_tanggal"autocomplete="off" />
	                </div>
		            <div class="form-group form-material floating" data-plugin="formMaterial">
		                <div class="col-xs-12">
		                    <div id="html_element_jalan" data-callback="daftarJalan"></div>
		                </div>
		            </div>
	                <div class="col-md-12">
	                	<center>
	                        <button type="reset" class="btn btn-secondary" style="padding: 10px 30px;" id="batalJalan">Batal</button>
	                        <button type="submit" name="tambah" disabled class="btn btn-primary" style="background: #03989e;
        							    border: 0;
        							    padding: 10px 30px;
        							    color: #fff;
        							    transition: 0.4s;
        							    border-radius: 4px;">Simpan</button>
	                    </center>
	                </div>
	            </div>
	        </form>

          </div>
          <div class="col-lg-3"></div>

        </div>

      </div>

    </section>

  </main><!-- End #main -->

  <!-- Vendor JS Files -->
  <script src="<?= base_url() ?>/docs/flexstart/assets/vendor/purecounter/purecounter.js"></script>
  <script src="<?= base_url() ?>/docs/flexstart/assets/vendor/aos/aos.js"></script>
  <script src="<?= base_url() ?>/docs/flexstart/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>/docs/flexstart/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= base_url() ?>/docs/flexstart/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= base_url() ?>/docs/flexstart/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= base_url() ?>/docs/flexstart/assets/vendor/php-email-form/validate.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

  <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
  <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback2&render=explicit" async defer></script>
	<script>


	var onloadCallback = function() {
	    if (document.getElementById('reChaptcha-login') != null) {
	        grecaptcha.render('reChaptcha-login', {
	            'sitekey' : '6LcHgtMeAAAAAC7rnGpIJKktILKUvdZbc-PFayHP'
	        });
	    }

	    grecaptcha.render('html_element', {
	        'sitekey' : '6LcHgtMeAAAAAC7rnGpIJKktILKUvdZbc-PFayHP',
	    });
	};

	function daftarInap() {
	    document.getElementById('simpanInap').disabled = false;
	}

	function daftarJalan() {
	    document.getElementById('simpanJalan').disabled = false;
	}
	</script>

	<!-- Parsley -->
	<script src="<?= base_url() ?>/docs/tambahan/assets/plugins/parsleyjs/dist/parsley.min.js"></script>

	<!-- Select2 -->
	<script src="<?= base_url() ?>/docs/adminlte/plugins/select2/js/select2.full.min.js"></script>

<!-- Toastr -->
<script src="<?= base_url() ?>/docs/adminlte/plugins/toastr/toastr.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url() ?>/docs/flexstart/assets/js/main.js"></script>
  <script type="text/javascript">
		$(document).ready(function() {
		  $(".hanya_angka").inputFilter(function(value) {
		    return /^\d*$/.test(value);    // Allow digits only, using a RegExp
		  },"Only digits allowed");
		});

		(function($) {
		  $.fn.inputFilter = function(callback, errMsg) {
		    return this.on("input keydown keyup mousedown mouseup select contextmenu drop focusout", function(e) {
		      if (callback(this.value)) {
		        // Accepted value
		        if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
		          $(this).removeClass("input-error");
		          this.setCustomValidity("");
		        }
		        this.oldValue = this.value;
		        this.oldSelectionStart = this.selectionStart;
		        this.oldSelectionEnd = this.selectionEnd;
		      } else if (this.hasOwnProperty("oldValue")) {
		        // Rejected value - restore the previous one
		        $(this).addClass("input-error");
		        this.setCustomValidity(errMsg);
		        this.reportValidity();
		        this.value = this.oldValue;
		        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
		      } else {
		        // Rejected value - nothing to restore
		        this.value = "";
		      }
		    });
		  };
		}(jQuery));

		$(function() {
            $('.select2').select2()

            $("#input_kamar").select2({
                placeholder: "Pilih Kamar",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Pendaftaran/Pendaftaran/data_kamar'); ?>',
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

            $("#input_poli").select2({
                placeholder: "Pilih Poliklinik",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Pendaftaran/Pendaftaran/data_poli'); ?>',
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
        })

  		$('#btnInapDaftar').click(function() {
		  $('#formInap').show();
		  $('#pendaftaran').hide();
        });

        function showDataJalan(data){
        	if ($("#input_status_jalan").prop('checked') == true) {
        		$('.data-pasien-jalan').show();
		        $("#input_nama_jalan").attr('required', '');
		        $("#input_alamat_jalan").attr('required', '');
		        $("#input_no_telp_jalan").attr('required', '');
		        $("#input_agama_jalan").attr('required', '');
        	} else {
        		$('.data-pasien-jalan').hide();
		        $("#input_nama_jalan").removeAttr('required', '');
		        $("#input_alamat_jalan").removeAttr('required', '');
		        $("#input_no_telp_jalan").removeAttr('required', '');
		        $("#input_agama_jalan").removeAttr('required', '');
        	}
        }

        function showDataInap(data){
        	if ($("#input_status_inap").prop('checked') == true) {
        		$('.data-pasien-inap').show();
		        $("#input_nama").attr('required', '');
		        $("#input_alamat").attr('required', '');
		        $("#input_no_telp").attr('required', '');
		        $("#input_agama").attr('required', '');
        	} else {
        		$('.data-pasien-inap').hide();
		        $("#input_nama").removeAttr('required', '');
		        $("#input_alamat").removeAttr('required', '');
		        $("#input_no_telp").removeAttr('required', '');
		        $("#input_agama").removeAttr('required', '');
        	}
        }

        $('#batalInap').click(function() {
		  $('#formInap').hide();
		  $('#pendaftaran').show();
        });

        $('#btnJalanDaftar').click(function() {
		  $('#formJalan').show();
		  $('#pendaftaran').hide();
        });

        $('#batalJalan').click(function() {
		  $('#formJalan').hide();
		  $('#pendaftaran').show();
        });
  </script>

</body>

</html>
