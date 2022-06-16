<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Maintenance | Scraper</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <?= $this->include('partials/head-css') ?>

</head>

<?= $this->include('partials/body') ?>

<!-- <body data-layout="horizontal"> -->

<div class="bg-soft-light min-vh-100 py-5">
    <div class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <div class="mb-5">
                            <a href="/">
                                <img src="assets/images/logo-sm.svg" alt="" height="30" class="me-1"><span class="logo-txt text-dark font-size-22">Scraper</span>
                            </a>
                        </div>

                        <div class="maintenance-cog-icon text-primary pt-4">
                            <i class="mdi mdi-cog spin-right display-3"></i>
                            <i class="mdi mdi-cog spin-left display-4 cog-icon"></i>
                        </div>
                        <h3 class="mt-4">Site is Under Maintenance</h3>
                        <p>Please check back in sometime.</p>

                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
</div>
<!-- end  -->

<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>

</body>

</html>