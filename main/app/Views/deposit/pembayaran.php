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

                <div class="col-sm-4" style="margin: 0 auto;text-align: center;">
                    <div class="card">
                        <div class="card-header sidebar-alert">
                            <h4 class="card-title">Informasi Pembayaran</h4>
                        </div>
                        <div class="card-body">
                            <p>Silahkan melakukan pembayaran sesuai dengan detail di bawah ini, <b>jika sudah melakukan pembayaran harap lapor admin maks 1x24 jam</b>.</p>
                            <table class="mt-3" style="margin: 0 auto;">
                                <tr>
                                    <td class="text-left">No. Referensi</td>
                                    <td class="text-left"><?= $depo['noref']; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Metode</td>
                                    <td class="text-left"><?= $depo['metode']; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">No. Rekening</td>
                                    <td class="text-left"><?= $rek['norek']; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Atas Nama</td>
                                    <td class="text-left"><?= $rek['atas_nama']; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Nominal</td>
                                    <td class="text-left">Rp. <?= number_format($depo['nominal'], 0, ",", "."); ?>,-</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Status</td>
                                    <td class="text-left"><?= $depo['status']; ?></td>
                                </tr>
                            </table>
                            <a href="/deposit" class="btn btn-primary mt-4">Kembali</a>
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

<script src="/assets/js/app.js"></script>

</body>

</html>