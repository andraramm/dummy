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
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

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
                    <div class="d-flex justify-content-end mb-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Buat Tiket</button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="tiket" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Subjek</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- Create Tiket modal -->
        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Buat Tiket</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" value="">
                        <div class="mb-3">
                            <label class="form-label" for="subjek">Subjek</label>
                            <input type="text" class="form-control" id="subjek">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="pesan">Pesan</label>
                            <textarea type="text" class="form-control" id="pesan"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="buat_tiket">Kirim</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Open Tiket modal -->
        <div class="modal fade" id="tiket_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <?php if (in_groups('user')) : ?>
                            <h5 class="modal-title" id="tiketHeader">Tiket</h5>
                        <?php else : ?>
                            <div class="col">
                                <div class="row">
                                    <h5 class="modal-title" id="userTiket">Elniki</h5>
                                </div>
                                <div class="row">
                                    <span>Terlihat satu jam yang lalu</span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (in_groups('user')) : ?>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <?php else : ?>
                            <button type="button" class="btn"><i class="fas fa-ellipsis-v"></i></button>
                        <?php endif; ?>
                    </div>
                    <div class="modal-body" style="padding-bottom: 0px;padding-top: 0px;">
                        <div class="chat-conversation p-3 px-2" data-simplebar>
                            <input type="hidden" id="idTiket">
                            <ul class="list-unstyled mb-0" id="isi_tiket">
                            </ul>
                        </div>
                    </div>
                    <div class="row" style="padding: 10px;border-top: 1px solid #e3e3e3;">
                        <div class="col">
                            <input type="text" class="form-control" id="isiTiket">
                        </div>
                        <div class="col-auto" style="padding-left: 0px !important;">
                            <button type="button" class="btn btn-primary" id="kirim_isiTiket"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <?= $this->include('partials/footer') ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

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

<?= $this->include('partials/right-sidebar') ?>

<script src="assets/js/app.js?v=<?= INIT_VERSION; ?>"></script>

</body>

</html>