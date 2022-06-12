<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert-->
    <link href="/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

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

                <?php if (in_groups('user')) : ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade active show" id="month" role="tabpanel" aria-labelledby="monthly">
                                    <div class="row">
                                        <?php foreach ($paket as $p) : ?>
                                            <div class="col-xl-3 col-sm-6">
                                                <div class="card <?= ($p['jenis'] == 'best') ? 'bg-primary' : 'sidebar-alert'; ?> mb-xl-0">
                                                    <div class="card-body">
                                                        <div class="p-2">
                                                            <?php if ($p['jenis'] == 'best') : ?>
                                                                <div class="pricing-badge">
                                                                    <span class="badge">BEST</span>
                                                                </div>
                                                            <?php endif; ?>
                                                            <h5 class="font-size-16 <?= ($p['jenis'] == 'best') ? 'text-white' : ''; ?>"><?= $p['nama']; ?></h5>
                                                            <h1 class="mt-3 <?= ($p['jenis'] == 'best') ? 'text-white' : ''; ?>"><span class="<?= ($p['jenis'] == 'best') ? 'text-white' : ''; ?> font-size-20 fw-bold">Rp.</span><?= number_format($p['harga'], 0, ",", "."); ?>,-</h1>
                                                            <div class="mt-4 pt-2">
                                                                <form id="paket_<?= $p['id']; ?>" action="/deposit/metode_pembayaran" method="post">
                                                                    <?= csrf_field(); ?>
                                                                    <input type="hidden" name="data-id" value="<?= $p['id']; ?>">
                                                                    <button type="button" class="btn btn-<?= ($p['jenis'] == 'best') ? 'light' : 'outline-primary'; ?> w-100" onclick="cekDepo('paket_<?= $p['id']; ?>')">Pilih</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end card body -->
                                                </div>
                                                <!-- end card -->
                                            </div>
                                            <!-- end col -->
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- end row -->
                                </div>
                                <!-- end tab pane -->

                            </div>
                            <!-- end tab content -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                <?php endif; ?>

                <div class="row">
                    <div class="col-12">
                        <?php if (in_groups('user')) : ?>
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="page-title mb-0 font-size-18 mt-5">Riwayat Deposit</h4>
                            </div>
                        <?php endif; ?>
                        <div class="card">
                            <div class="card-body">
                                <table id="<?= (in_groups('user')) ? 'riwayat_depo' : 'riwayat_depo_admin' ?>" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <?php if (in_groups('admin')) : ?>
                                                <th>Email</th>
                                            <?php endif; ?>
                                            <th>No. Ref</th>
                                            <th>Paket</th>
                                            <th>Nominal</th>
                                            <th>Metode</th>
                                            <th>Tempo</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
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

        <!-- Scrollable modal -->
        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Deposit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="id" value="">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="noref">No. Ref</label>
                                    <input type="text" class="form-control" id="noref" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="metode">Metode</label>
                                    <input type="text" class="form-control" id="metode" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" class="form-control" id="email" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="paket">Paket</label>
                                    <input type="text" class="form-control" id="paket" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="nominal">Nominal</label>
                                    <div class="input-group">
                                        <div class="input-group-text">Rp</div>
                                        <input type="text" class="form-control" id="nominal" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select id="depostatus" class="form-select">
                                        <option value="BELUM BAYAR">BELUM BAYAR</option>
                                        <option value="LUNAS">LUNAS</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveChangeDepo()">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

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
<script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
<script src="/assets/js/pages/sweetalert.init.js"></script>

<!-- Datatable init js -->
<script src="assets/js/pages/datatables.init.js"></script>

<script src="assets/js/app.js"></script>

</body>

</html>