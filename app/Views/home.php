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
          <li><a class="nav-link scrollto active" href="#beranda">Beranda</a></li>
          <li><a class="nav-link scrollto" href="#about">Tentang Kami</a></li>
          <li><a class="nav-link scrollto" href="#poliklinik">Poliklinik</a></li>
          <li><a class="nav-link scrollto" href="#faq">FAQ</a></li>
          <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
          <?php $session = session();
          if(session() == FALSE){?>
          <li><a class="getstarted scrollto" href="<?= base_url('Login') ?>">Login</a></li>
          <?php }else{ ?> <li><a class="nav-link scrollto active" href="#"><?=$session->get('nama_login');?></a></li><?php }?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= beranda Section ======= -->
  <section id="beranda" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Klinik Maryam melayani dengan sepenuh hati</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">Siap membantu dengan sigap dan tepat</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="<?= base_url('Registrasi') ?>" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Daftar</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="<?= base_url() ?>/docs/flexstart/assets/img/hero-img.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Klinik Maryam</h3>
              <h2>Adalah salah satu fasilitas kesehatan terpercaya di Kabupaten Madiun yang sudah berdiri sejak tahun 2012.</h2>
              <p>
                Melayani beberapa polikniknik yang siap menangani masalah atau konsultasi kesehatan Anda dan keluarga.
              </p>
              <div class="text-center text-lg-start">
                <!-- <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Read More</span>
                  <i class="bi bi-arrow-right"></i>
                </a> -->
              </div>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="<?= base_url() ?>/docs/flexstart/assets/img/features-2.png" class="img-fluid" alt="">
          </div>

        </div>
      </div>

    </section><!-- End About Section -->

    <!-- ======= Features Section ======= -->
    <section id="poliklinik" class="features">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Poliklik</h2>
          <p>Layanan Poliklinik</p>
        </header>

        <div class="row">

          <div class="col-lg-6">
            <img src="<?= base_url() ?>/docs/flexstart/assets/img/features.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
            <div class="row align-self-center gy-4">

              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <?php 
                      foreach ($poli as $item) {
                  ?>
                  <h3><?= $item['nama_poli']; ?></h3>
                  <?php } ?>
                </div>
              </div>

            </div>
          </div>

        </div> <!-- / row -->

      </div>

    </section><!-- End Features Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>F.A.Q</h2>
          <p>Frequently Asked Questions</p>
        </header>

        <div class="row">
          <div class="col-lg-6">
            <!-- F.A.Q List 1-->
            <div class="accordion accordion-flush" id="faqlist1">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                    Jam berapa klinik mulai dibuka?
                  </button>
                </h2>
                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    Klinik dibuka mulai dari jam 7 pagi.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                    Metode pembayaran seperti apa yang tersedia?
                  </button>
                </h2>
                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    Untuk saat ini masih menggunakan uang tunai saja.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                    Apakah Klinik Maryam juga melayani tebus obat?
                  </button>
                </h2>
                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    Belum, saat ini dokter kami hanya memberi resep. Anda bisa menebus obat di apotek terdekat.
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-lg-6">

            <!-- F.A.Q List 2-->
            <div class="accordion accordion-flush" id="faqlist2">

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-1">
                    Bisakah berkonsultasi & tanya harga melalui telepon?
                  </button>
                </h2>
                <div id="faq2-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    Bisa, anda bisa menghubungi kami melalui telepon dengan nomor (0334) 567890 atau ponsel 087 757 341 567.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-2">
                    Apakah saya bisa melihat riwayat periksa di Klinik Maryam?
                  </button>
                </h2>
                <div id="faq2-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    Bisa, Anda bisa melihat riwayat periksa pribadi dengan login terlebih dahulu. Lalu pilih menu laporan, klik submenu Riwayat Rekam Medis.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-3">
                    Apakah Klinik Maryam melayani rawat inap?
                  </button>
                </h2>
                <div id="faq2-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    Benar, kami menyediakan layanan rawat inap sesuai dengan anjuran dokter. Anda bisa mendaftar pada website.
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>

    </section><!-- End F.A.Q Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Kontak</h2>
          <p>Kontak Kami</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-12">

            <div class="row gy-3">
              <div class="col-md-3">
                <div class="info-box">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Alamat</h3>
                  <p>Desa Kedungpanji, <br> Kec Lembeyan<br>Kab. Magetan, Jawa Timur</p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="info-box">
                  <i class="bi bi-telephone"></i>
                  <h3>Telepon</h3>
                  <p>(0334) 567890<br>087 757 341 567</p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="info-box">
                  <i class="bi bi-envelope"></i>
                  <h3>Email & Fax</h3>
                  <p>klinikmaryam@gmail.com<br>234453679</p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="info-box">
                  <i class="bi bi-clock"></i>
                  <h3>Jam Buka</h3>
                  <p>Senin - Jum'at<br>7:00 - 20:00 WIB</p>
                </div>
              </div>
            </div>

          </div>

        </div>

      </div>

    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <img src="<?= base_url() ?>/docs/flexstart/assets/img/logo.png" alt="">
              <span>Klinik Maryam</span>
            </a>
            <p>Kesehatan yang baik bukanlah sesuatu yang dapat kita beli. Namun, sesuatu yang dapat menjadi tabungan yang sangat berharga.</p>
            <p>-Anne Wilson Schaef-</p>
          </div>

          <div class="col-lg-2 col-6 footer-links">
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#beranda">Beranda</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#about">Tentang Kami</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#poliklinik">Poliklinik</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#faq">FAQ</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#contact">Kontak</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contact Us</h4>
            <p>
              Desa Kedungpanji, Kec Lembeyan <br>
              Kab. Magetan, Jawa Timur<br>
              Indonesia <br><br>
              <strong>Telepon:</strong> (0334) 567890<br>
              <strong>Email:</strong> klinikmaryam@gmail.com<br>
            </p>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Klinik Maryam</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url() ?>/docs/flexstart/assets/vendor/purecounter/purecounter.js"></script>
  <script src="<?= base_url() ?>/docs/flexstart/assets/vendor/aos/aos.js"></script>
  <script src="<?= base_url() ?>/docs/flexstart/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>/docs/flexstart/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= base_url() ?>/docs/flexstart/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= base_url() ?>/docs/flexstart/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= base_url() ?>/docs/flexstart/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url() ?>/docs/flexstart/assets/js/main.js"></script>

</body>

</html>
