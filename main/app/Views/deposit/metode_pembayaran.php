<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>
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

                <div class="col-sm-8" style="margin: 0 auto;">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-header sidebar-alert">
                                    <h4 class="card-title">Pembayaran Manual</h4>
                                </div>
                                <div class="card-body">
                                    <p class="text-center">Fee lebih kecil dari pembayaran otomatis, perlu konfirmasi manual oleh admin 1x24 jam.</p>
                                    <form id="form_depo" action="/deposit/create" method="post" style="text-align: -webkit-center; max-width: 320px; margin: 0 auto;">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name='tipe' value="manual">
                                        <div class="form-group mb-3 mt-1">
                                            <label class="form-label">Nominal</label>
                                            <div class="input-group">
                                                <div class="input-group-text">Rp</div>
                                                <input type="number" class="form-control" name="nominal" id="nom1" value="<?= number_format($paket_detail['harga'], 0, ",", "."); ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Paket</label>
                                            <select name="paket" id="manual" required="" class="form-control form-select">
                                                <?php foreach ($paket as $p) : ?>
                                                    <option value="<?= $p['id']; ?>" <?= ($p['id'] == $paket_detail['id']) ? 'selected' : ''; ?>><?= $p['nama']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label">Pembayaran</label>
                                            <select name="pembayaran" class="form-control form-select">
                                                <?php foreach ($pembayaran as $pe) : ?>
                                                    <option value="<?= $pe['nama']; ?>"><?= $pe['nama']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <a href="/deposit" class="btn btn-danger waves-effect btn-label waves-light"><i class="bx bx-block label-icon"></i> Cancel</a>
                                        <button type="button" class="btn btn-primary waves-effect btn-label waves-light" onclick="globalConfirm('Lanjut Deposit?')"><i class="bx bx-cart label-icon"></i> Bayar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-header sidebar-alert">
                                    <h4 class="card-title">Pembayaran Otomatis</h4>
                                </div>
                                <div class="card-body">
                                    <p class="text-center">Proses konfirmasi otomatis dan lebih cepat, fee lebih besar dari pembayaran manual.</p>
                                    <?php if (in_groups('admin') || user_id() == 2) : ?>
                                        <form action="" method="post" style="text-align: -webkit-center; max-width: 320px; margin: 0 auto;">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name='tipe' value="otomatis">
                                            <div class="form-group mb-3 mt-1">
                                                <label class="form-label">Nominal</label>
                                                <div class="input-group">
                                                    <div class="input-group-text">Rp</div>
                                                    <input type="number" class="form-control" name="nominal" id="nom2" value="<?= number_format($paket_detail['harga'], 0, ",", "."); ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Paket</label>
                                                <select id="otomatis" required="" class="form-control form-select">
                                                    <?php foreach ($paket as $p) : ?>
                                                        <option value="<?= $p['id']; ?>" <?= ($p['id'] == $paket_detail['id']) ? 'selected' : ''; ?>><?= $p['nama']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label class="form-label">Pembayaran</label>
                                                <select required="" class="form-control form-select">
                                                    <?php foreach ($pembayaran as $pe) : ?>
                                                        <option value="<?= $pe['id']; ?>"><?= $pe['nama']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <a href="/deposit" class="btn btn-danger waves-effect btn-label waves-light"><i class="bx bx-block label-icon"></i> Cancel</a>
                                            <button type="submit" class="btn btn-primary waves-effect btn-label waves-light"><i class="bx bx-cart label-icon"></i> Bayar</button>
                                        </form>
                                    <?php else : ?>
                                        <h2 class="text-center" style="padding-top: 3em;">Dalam tahap pengembangan.</h2>
                                    <?php endif; ?>
                                </div>
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

<!-- Sweet Alerts js -->
<script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
<script src="/assets/js/pages/sweetalert.init.js"></script>

<script src="../assets/js/app.js"></script>

</body>

</html>