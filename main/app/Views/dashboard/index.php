<!DOCTYPE html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <!-- choices css -->
    <link href="assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <?= $this->include('partials/head-css') ?>

</head>

<?= $this->include('partials/body') ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?= $this->include('partials/menu') ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <?= $page_title ?>

                <?= $this->include('partials/info'); ?>

                <?php if (in_groups('user')) : ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Daftar Jadwal</h4>
                                    <div class="flex-shrink-0">
                                        <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#all" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-list-ul"></i></span>
                                                    <span class="d-none d-sm-block">All</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#filter" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-filter"></i></span>
                                                    <span class="d-none d-sm-block">Filter</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">

                                    <!-- Tab panes -->
                                    <div class="tab-content text-muted">
                                        <div class="tab-pane active" id="all" role="tabpanel">
                                            <p class="text-center mx-3">Scraper <b>running sehari sekali</b>, dan jika ada perubahan pada file lama otomatis diupdate.<br>File 2 hari yang lalu akan dihapus.</p>
                                            <table id="jadwal" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>State</th>
                                                        <th>Olahraga</th>
                                                        <th>Gender</th>
                                                        <th>Situs</th>
                                                        <th>Game</th>
                                                        <th>Harga</th>
                                                        <th>Game Date</th>
                                                        <th>Scrape Date</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="filter" role="tabpanel">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="situs" class="form-label font-size-13 text-muted">Situs</label>
                                                        <select class="form-control" data-trigger name="choices-single-default" id="choices-single-default" disabled>
                                                            <option value="maxpreps" selected>Maxpreps</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="gender" class="form-label font-size-13 text-muted">Gender</label>
                                                        <select class="form-control" data-trigger name="gender" id="gender">
                                                            <option value="">Pilih Gender</option>
                                                            <option value="all">Semua</option>
                                                            <option value="boys">Boys</option>
                                                            <option value="girls">Girls</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="olahraga" class="form-label font-size-13 text-muted">Olahraga</label>
                                                        <select class="form-control" name="olahraga" id="olahraga" placeholder="olahraga">
                                                            <option value="">Pilih Olahraga</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="state" class="form-label font-size-13 text-muted">State</label>
                                                        <select class="form-control" name="state" id="state">
                                                            <option value="">Pilih State</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="tanggal" class="form-label font-size-13 text-muted">Tanggal Game</label>
                                                    <select class="form-control tanggal" name="tanggal" id="tanggal" multiple>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- <div class="col">
                                                <div class="square-switch">
                                                    <p class="form-label font-size-13 text-muted" style="font-weight: 500;">Jadikan satu file</p>
                                                    <input type="checkbox" id="square-switch1" switch="none" checked />
                                                    <label for="square-switch1" data-on-label="Yes" data-off-label="No"></label>
                                                </div>
                                            </div> -->
                                            <div class="col d-flex justify-content-end" style="display:none !important" id="detail">
                                                <table>
                                                    <tr>
                                                        <td class="text-left">Total File</td>
                                                        <td class="text-left"><b id="file"></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Game</td>
                                                        <td class="text-left"><b id="game"></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Harga</td>
                                                        <td class="text-left"><b id="harga"></b></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col d-flex justify-content-end" id="beli" style="display: none !important;">
                                                <button type="button" class="btn btn-primary waves-effect btn-label waves-light mt-4" id="bulkBuy"><i class="bx bx-cart label-icon"></i> Beli</button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Riwayat Order</h4>
                                    <div class="flex-shrink-0">
                                        <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#single" onclick="reloadTable()" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-history"></i></span>
                                                    <span class="d-none d-sm-block">Single</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#multi" onclick="reloadTable()" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-folder"></i></span>
                                                    <span class="d-none d-sm-block">Multi</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">

                                    <!-- Tab panes -->
                                    <div class="tab-content text-muted">
                                        <div class="tab-pane active" id="single" role="tabpanel">
                                            <p class="text-center mx-3">File akan <b class="text-danger">dihapus</b> otomatis oleh sistem setiap hari <b>Senin 06.00 WIB.</b> Pastikan setelah beli langsung download, dan backup file.</p>
                                            <table id="order" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>State</th>
                                                        <th>Olahraga</th>
                                                        <th>Gender</th>
                                                        <th>Situs</th>
                                                        <th>Game</th>
                                                        <th>Harga</th>
                                                        <th>Game Date</th>
                                                        <th>Order Date</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="multi" role="tabpanel">
                                            <p class="text-center mx-3">File akan <b class="text-danger">dihapus</b> otomatis oleh sistem setiap hari <b>Senin 06.00 WIB.</b> Pastikan setelah beli langsung download, dan backup file.</p>
                                            <table id="order_bulk" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nama</th>
                                                        <th>Harga</th>
                                                        <th>Tanggal</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                    </div><!-- end row -->

                <?php else : ?>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <span class="text-muted mb-3 d-block text-truncate">Saldo User</span>
                                            <h4 class="mb-3">
                                                Rp<span class="counter-value" data-target="<?= $saldo; ?>">0</span>,-
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="text-nowrap">
                                        <span class="badge bg-soft-success text-success">+Rp20.9k</span>
                                        <span class="ms-1 text-muted font-size-13">Since last week</span>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <span class="text-muted mb-3 d-block text-truncate">Pemasukan</span>
                                            <h4 class="mb-3">
                                                Rp<span class="counter-value" data-target="<?= $pemasukan; ?>">0</span>,-
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="text-nowrap">
                                        <span class="badge bg-soft-success text-success">+ $2.8k</span>
                                        <span class="ms-1 text-muted font-size-13">Since last week</span>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <span class="text-muted mb-3 d-block text-truncate">Pengguna</span>
                                            <h4 class="mb-3">
                                                <span class="counter-value" data-target="<?= $user; ?>">0</span> User
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="text-nowrap">
                                        <span class="badge bg-soft-danger text-danger">-29 Trades</span>
                                        <span class="ms-1 text-muted font-size-13">Since last week</span>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col-->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <span class="text-muted mb-3 d-block text-truncate">Jadwal</span>
                                            <h4 class="mb-3">
                                                <span class="counter-value" data-target="<?= count($file); ?>">0</span> File
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="text-nowrap">
                                        <span class="badge bg-soft-success text-success">+2.95%</span>
                                        <span class="ms-1 text-muted font-size-13">Since last week</span>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div><!-- end row-->
                <?php endif; ?>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?= $this->include('partials/footer') ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<?= $this->include('partials/right-sidebar') ?>

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
<script src="assets/js/pages/sweetalert.init.js?v=1"></script>
<!-- Datatable init js -->
<script src="assets/js/pages/datatables.init.js?v=2"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>

<!-- choices js -->
<script src="assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
<!-- init js -->
<script src="assets/js/pages/form-advanced.init.js?v=2"></script>

<?php if (in_groups('admin')) : ?>
    <script src="assets/js/pages/dashboard.init.js"></script>
<?php endif; ?>
</body>

</html>