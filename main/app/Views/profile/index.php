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
                    </div>
                    <div class="col-sm-7">
                        <div class="card">
                            <div class="card-header sidebar-alert">
                                <h4 class="card-title">Referral</h4>
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
                                <h5 class="text-center mb-4">Total Komisi : <span id="komisi">Rp <?= number_format($komisi, 0, '.', '.'); ?>,-</span></h5>
                                <table id="referral" class="table table-bordered dt-responsive  nowrap w-100">
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