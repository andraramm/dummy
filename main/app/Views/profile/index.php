<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
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
                <?php if (!in_groups('marketing') && !$marketing) : ?>
                    <div class="alert alert-primary" id="offer_marketing">
                        <p class="text-center mb-0">Jago promosi dan mau dapat penghasilan? Join tim marketing scraper sekarang! <br><button class="btn btn-primary btn-sm mt-1" data-bs-toggle="modal" data-bs-target="#daftar_marketing">Daftar Disini</button></p>
                    </div>
                <?php endif; ?>

                <!-- modal -->
                <div class="modal fade" id="daftar_marketing" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="daftar_marketingTitle">Form Pendaftaran Marketing</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Masukan detail informasi pembayaran yang akan digunakan untuk menerima pembayaran dari hasil marketing.</p>
                                <div class="mb-3">
                                    <label class="form-label">Metode Pembayaran<br><span class="text-danger">*Hanya menerima metode dibawah ini</span></label>
                                    <select id="payment" class="form-control">
                                        <option value="bca">BCA</option>
                                        <option value="bri">BRI</option>
                                        <option value="dana">Dana</option>
                                        <option value="shopeepay">ShopeePay</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">No. Rekening / ID E-Wallet</label>
                                    <input type="text" class="form-control" id="norek" placeholder="837209385894">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Atas Nama</label>
                                    <input type="text" class="form-control" id="atasnama" placeholder="John Doe">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="daftar_marketing_button">Daftar</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>

                <div class="row">
                    <div class="col-sm-5">
                        <div class="card">
                            <div class="card-header sidebar-alert">
                                <h4 class="card-title">Detail Profile</h4>
                            </div>
                            <div class="card-body">
                                <table class="d-flex justify-content-center font-size-16">
                                    <tr>
                                        <td class="text-left">Username</td>
                                        <td class="text-left"><?= $username; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Email</td>
                                        <td class="text-left"><?= $email; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Join</td>
                                        <td class="text-left"><?= $tanggal; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php if (in_groups('marketing') || $marketing) : ?>
                            <div class="card">
                                <div class="card-header sidebar-alert">
                                    <h4 class="card-title">Detail Marketing</h4>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" id="data_id" value="<?= $marketing['id']; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Metode Pembayaran<br><span class="text-danger">*Hanya menerima metode dibawah ini</span></label>
                                        <select id="payment1" class="form-control">
                                            <option value="bca" <?= ($marketing['status'] == 'bca') ? 'selected' : ''; ?>>BCA</option>
                                            <option value="bri" <?= ($marketing['status'] == 'bri') ? 'selected' : ''; ?>>BRI</option>
                                            <option value="dana" <?= ($marketing['status'] == 'dana') ? 'selected' : ''; ?>>Dana</option>
                                            <option value="shopeepay" <?= ($marketing['status'] == 'shopeepay') ? 'selected' : ''; ?>>ShopeePay</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">No. Rekening / ID E-Wallet</label>
                                        <input type="text" class="form-control" id="norek1" placeholder="837209385894" value="<?= $marketing['norek']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Atas Nama</label>
                                        <input type="text" class="form-control" id="atasnama1" placeholder="John Doe" value="<?= $marketing['atasnama']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <h6>Status : <span class="badge bg-<?= ($marketing['status'] == 'waiting') ? 'warning' : 'primary'; ?>"><?= strtoupper($marketing['status']); ?></span></h6>
                                    </div>

                                    <button class="btn btn-primary" id="edit_marketing_button">Edit Perubahan</button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-7">
                        <div class="card">
                            <div class="card-header sidebar-alert">
                                <h4 class="card-title">Referral <?= (in_groups('marketing')) ? '<span class="badge bg-warning">MARKETING</span>' : ''  ?></h4>
                            </div>
                            <div class="card-body">
                                <p class="text-center">Komisi muncul setelah teman yang kamu ajak melakukan deposit pertama.<br>Klik generate jika url referral belum muncul.</p>
                                <div class="col-sm-6 mb-4" style="margin: 0 auto;">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="url" placeholder="Url referral" value="<?= ($refCode) ? site_url('register?ref=' . $refCode) : '' ?>">
                                        <button class="btn btn-primary shadow-none" id="generate" <?= ($refCode) ? 'style="display: none;"' : ''; ?>>Generate</button>
                                        <button class="btn btn-primary shadow-none" id="copy" <?= ($refCode) ? '' : 'style="display: none;"'; ?>><i class="bx bx-copy"></i></button>
                                    </div>
                                </div>
                                <p class="text-center">Komisi yang akan kamu dapat <b><?= (in_groups('marketing')) ? '50%' : '10%'; ?> dari jumlah deposit pertama</b> teman yang jadi referralmu dan <b>5% untuk temanmu.</b></p>
                                <h5 class="text-center mb-4">Total Komisi : <span id="komisi">Rp <?= number_format($komisi, 0, '.', '.'); ?>,-</span></h5>
                                <table id="<?= (in_groups('marketing')) ? 'referral_marketing' : 'referral'; ?>" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Komisi</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
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

<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/jszip/jszip.min.js"></script>
<script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Sweet Alerts js -->
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
<script src="assets/js/pages/sweetalert.init.js?v=<?= INIT_VERSION; ?>"></script>
<!-- Datatable init js -->
<script src="assets/js/pages/datatables.init.js?v=<?= INIT_VERSION; ?>"></script>

<script src="assets/js/app.js?v=<?= INIT_VERSION; ?>"></script>

</body>

</html>