<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title; ?></title>
    <meta content="Best Scraper For CPA" name="description">

    <!-- Favicons -->
    <link href="assets/images/favicon.ico" rel="icon">
    <link href="assets/images/favicon.ico" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/home/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/home/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/home/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/home/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/home/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/home/css/style.css" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center">
                <img src="assets/images/logo-sm.svg" alt="">
                <span><?= $judul; ?></span>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#pricing">Pricing</a></li>
                    <li><a class="nav-link scrollto" href="/<?= (logged_in()) ? 'dashboard' : 'login' ?>"><?= (logged_in()) ? 'Dashboard' : 'Login' ?></a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Solusi Baru dan Tidak Buang-Buang Waktu.</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">Dengan Scraper Tidak Perlu Menunggu, Semua Jauh Lebih Instan.</h2>
                    <div data-aos="fade-up" data-aos-delay="600">
                        <div class="text-center text-lg-start">
                            <a href="/register" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Daftar Sekarang</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="assets/home/img/hero-img.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= Values Section ======= -->
        <section id="about" class="values">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Our Values</h2>
                    <p>Kenapa Harus Menggunakan Situs ini?</p>
                </header>

                <div class="row">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="box">
                            <img src="assets/home/img/values-1.png" class="img-fluid" alt="">
                            <h3>Instan, Tidak Perlu Menunggu</h3>
                            <p>Berbeda dengan bot scraper yang perlu kita tunggu, disini sekali klik langsung selesai.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
                        <div class="box">
                            <img src="assets/home/img/values-2.png" class="img-fluid" alt="">
                            <h3>Harga yang Sangat Murah</h3>
                            <p>Disini bukan jual bot, tetapi jual hasilnya saja. Sehingga harganya bisa lebih murah dan cepat tentunya.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
                        <div class="box">
                            <img src="assets/home/img/values-3.png" class="img-fluid" alt="">
                            <h3>Mudah Dalam Mengelola File</h3>
                            <p>File hasil scrape dari situs ini pasti lebih mudah di kelola daripada file hasil scrape sendiri.</p>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- End Values Section -->

        <!-- ======= Pricing Section ======= -->
        <section id="pricing" class="pricing">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Pricing</h2>
                    <p>Check our Pricing</p>
                </header>

                <div class="row gy-4" data-aos="fade-left">

                    <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="box">
                            <h3 style="color: #07d5c0;">Paket Kenalanan</h3>
                            <div class="price"><sup>Rp</sup>10<span>.000</span></div>
                            <img src="assets/home/img/pricing-free.png" class="img-fluid" alt="">
                            <a href="/deposit" class="btn-buy">Buy Now</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="box">
                            <h3 style="color: #65c600;">Paket Tanggung</h3>
                            <div class="price"><sup>Rp</sup>30<span>.000</span></div>
                            <img src="assets/home/img/pricing-starter.png" class="img-fluid" alt="">
                            <a href="/deposit" class="btn-buy">Buy Now</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="box">
                            <span class="featured">Featured</span>
                            <h3 style="color: #ff901c;">Paket PAS</h3>
                            <div class="price"><sup>Rp</sup>50<span>.000</span></div>
                            <img src="assets/home/img/pricing-business.png" class="img-fluid" alt="">
                            <a href="/deposit" class="btn-buy">Buy Now</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="box">
                            <h3 style="color: #ff0071;">Paket Tanggung</h3>
                            <div class="price"><sup>Rp</sup>100<span>.000</span></div>
                            <img src="assets/home/img/pricing-ultimate.png" class="img-fluid" alt="">
                            <a href="/deposit" class="btn-buy">Buy Now</a>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- End Pricing Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span><?= $judul; ?></span></strong>. All Rights Reserved
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <!-- <script src="assets/home/vendor/purecounter/purecounter.js"></script> -->
    <script src="assets/home/vendor/aos/aos.js"></script>
    <script src="assets/home/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/home/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/home/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/home/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/home/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/home/js/main.js?v=2"></script>
    <script>
        /**
         * Animation on scroll
         */
        function aos_init() {
            AOS.init({
                duration: 1000,
                easing: "ease-in-out",
                once: true,
                mirror: false
            });
        }
        window.addEventListener('load', () => {
            aos_init();
        });
    </script>

</body>

</html>