<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>

</head>

<?= $this->include('partials/body') ?>

<!-- <body data-layout="horizontal"> -->

<!-- Begin page -->
<div id="layout-wrapper">

    <?= $this->include('partials/menu') ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <?= $page_title ?>
                <!-- end page title -->
                <?= $this->include('partials/info'); ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-center mt-3">
                                    <div class="col-xl-5 col-lg-8">
                                        <div class="text-center">
                                            <h5>Tentang Situs Ini</h5>
                                            <p class="text-muted mt-3">Scraper adalah situs milik perorangan dan dibuat dengan serba minim, jadi mohon maklumi jika terdapat banyak kekurangan.
                                                <br>
                                                Situs ini dibuat untuk memenuhi kebutuhan scraper, untuk saat ini kami hanya fokus pada satu situs saja. Tidak menutup kemungkinan jika besok akan menambah layanan scrape untuk situs lain.
                                                <br>
                                                <br>
                                            </p>

                                            <h3 class="mt-3">F.A.Q</h3>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row mt-3">
                                    <div class="col-xl-4 col-sm-6 mb-3">
                                        <div class="card h-100 mb-0">
                                            <div class="card-body overflow-hidden position-relative">
                                                <div>
                                                    <i class="bx bx-help-circle widget-box-1-icon text-primary"></i>
                                                </div>
                                                <div class="faq-count">
                                                    <h5 class="text-primary">01.</h5>
                                                </div>
                                                <h5 class="mt-3">Kapan list jadwal diperbarui?</h5>
                                                <p class="text-muted mt-3 mb-0">Untuk saat ini server hanya mampu update sehari sekali, scraper jalan setiap pagi jam 03:00 WIB - 06:00 WIB. Pastikan untuk tidak beli jadwal di jam tersebut.</p>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end col -->
                                    <div class="col-xl-4 col-sm-6 mb-3">
                                        <div class="card h-100 mb-0">
                                            <div class="card-body overflow-hidden position-relative">
                                                <div>
                                                    <i class="bx bx-help-circle widget-box-1-icon text-primary"></i>
                                                </div>
                                                <div class="faq-count">
                                                    <h5 class="text-primary">02.</h5>
                                                </div>
                                                <h5 class="mt-3">Apakah file yang sudah dibeli ikut diperbarui?</h5>
                                                <p class="text-muted mt-3 mb-0">Tidak. Sistem hanya memperbarui jadwal yang belum di beli, jadi lebih baik membeli jadwal di tanggal yang terdekat dengan tanggal hari ini.</p>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end col -->

                                    <div class="col-xl-4 col-sm-6 mb-3">
                                        <div class="card h-100 mb-0">
                                            <div class="card-body overflow-hidden position-relative">
                                                <div>
                                                    <i class="bx bx-help-circle widget-box-1-icon text-primary"></i>
                                                </div>
                                                <div class="faq-count">
                                                    <h5 class="text-primary">03.</h5>
                                                </div>
                                                <h5 class="mt-3">Apakah list jadwal ada yang dihapus?</h5>
                                                <p class="text-muted mt-3 mb-0">Ya, untuk kelancaran server dan kemudahan user mencari jadwal sistem menghapus file jadwal yang sudah berlalu 2 hari atau lebih.</p>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end col -->

                                    <div class="col-xl-4 col-sm-6 mb-3">
                                        <div class="card h-100 mb-0">
                                            <div class="card-body overflow-hidden position-relative">
                                                <div>
                                                    <i class="bx bx-help-circle widget-box-1-icon text-primary"></i>
                                                </div>
                                                <div class="faq-count">
                                                    <h5 class="text-primary">04.</h5>
                                                </div>
                                                <h5 class="mt-3">Apakah file yang sudah dibeli juga dihapus?</h5>
                                                <p class="text-muted mt-3 mb-0">Ya. Sistem menghapus file yang sudah dibeli user setiap hari senin jam 06:00 WIB. Pastikan langsung download file setelah membeli.</p>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end col -->

                                    <div class="col-xl-4 col-sm-6 mb-3">
                                        <div class="card h-100 mb-0">
                                            <div class="card-body overflow-hidden position-relative">
                                                <div>
                                                    <i class="bx bx-help-circle widget-box-1-icon text-primary"></i>
                                                </div>
                                                <div class="faq-count">
                                                    <h5 class="text-primary">05.</h5>
                                                </div>
                                                <h5 class="mt-3">Apakah bisa membeli banyak jadwal sekaligus?</h5>
                                                <p class="text-muted mt-3 mb-0">Bisa, pada tabel daftar jadwal klik tombol/teks Filter di bagian kanan atas tabel. Semua jadwal yang didownload sekaligus akan dijadikan satu file / tidak terpisah.</p>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end col -->

                                    <div class="col-xl-4 col-sm-6 mb-3">
                                        <div class="card h-100 mb-0">
                                            <div class="card-body overflow-hidden position-relative">
                                                <div>
                                                    <i class="bx bx-help-circle widget-box-1-icon text-primary"></i>
                                                </div>
                                                <div class="faq-count">
                                                    <h5 class="text-primary">06.</h5>
                                                </div>
                                                <h5 class="mt-3">Apa keuntungan mengajak teman melalui link referral?</h5>
                                                <p class="text-muted mt-3 mb-0">Jika temanmu mendaftar dengan link referralmu, kamu akan mendapatkan bonus saldo 10% dari jumlah deposit pertama temanmu dan 5% untuk temanmu. Saldo bonus tidak dapat diuangkan.</p>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end col -->

                                    <div class="col-xl-4 col-sm-6 mb-3">
                                        <div class="card h-100 mb-0">
                                            <div class="card-body overflow-hidden position-relative">
                                                <div>
                                                    <i class="bx bx-help-circle widget-box-1-icon text-primary"></i>
                                                </div>
                                                <div class="faq-count">
                                                    <h5 class="text-primary">07.</h5>
                                                </div>
                                                <h5 class="mt-3">Bagaiaman cara mendapatkan link referral?</h5>
                                                <p class="text-muted mt-3 mb-0">Pergi ke halaman <a href="/profile">profile</a>, jika link referral tidak muncul silahkan klik tombol generate.</p>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end col -->

                                    <div class="col-xl-4 col-sm-6 mb-3">
                                        <div class="card h-100 mb-0">
                                            <div class="card-body overflow-hidden position-relative">
                                                <div>
                                                    <i class="bx bx-help-circle widget-box-1-icon text-primary"></i>
                                                </div>
                                                <div class="faq-count">
                                                    <h5 class="text-primary">08.</h5>
                                                </div>
                                                <h5 class="mt-3">Sudah deposit tapi saldo belum bertambah?</h5>
                                                <p class="text-muted mt-3 mb-0">Deposit dengan pembayaran manual membutuhkan waktu 1x24 jam, jika lebih dari itu kamu bisa kirim <a href="/profile">tiket</a> kepada kami.</p>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end col -->

                                    <div class="col-xl-4 col-sm-6 mb-3">
                                        <div class="card h-100 mb-0">
                                            <div class="card-body overflow-hidden position-relative">
                                                <div>
                                                    <i class="bx bx-help-circle widget-box-1-icon text-primary"></i>
                                                </div>
                                                <div class="faq-count">
                                                    <h5 class="text-primary">09.</h5>
                                                </div>
                                                <h5 class="mt-3">Apakah bisa refund saldo?</h5>
                                                <p class="text-muted mt-3 mb-0">Tidak. Sebelum melakukan deposit, pastikan terlebih dahulu kamu paham dengan situs ini karena tidak ada refund dengan alasan apapun.</p>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="text-center">
                                    <p class="mt-3">Jika memiliki pertanyaan lain, silahkan kirim tiket kepada kami.</p>
                                    <div>
                                        <a href="/tiket" class="btn btn-primary mt-2 me-2 waves-effect waves-light">Kirim Tiket</a>
                                    </div>
                                </div>
                            </div>
                            <!-- end  card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <?= $this->include('partials/footer') ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<?= $this->include('partials/right-sidebar') ?>

<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>

<script src="assets/js/app.js?v=<?= INIT_VERSION; ?>"></script>

</body>

</html>