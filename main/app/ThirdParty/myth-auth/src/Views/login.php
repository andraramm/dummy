<!doctype html>
<html lang="en">

<head>

	<meta charset="utf-8" />
	<title>Login | Scraper</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Best & Cheap Scraper for CPA" name="description" />
	<!-- App favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<?= $this->include('partials/head-css') ?>

</head>

<?= $this->include('partials/body') ?>

<!-- <body data-layout="horizontal"> -->
<div class="auth-page">
	<div class="container-fluid p-0">
		<div class="row g-0">
			<div class="col-xxl-3 col-lg-4 col-md-5">
				<div class="auth-full-page-content d-flex p-sm-5 p-4">
					<div class="w-100">
						<div class="d-flex flex-column h-100">
							<div class="mb-4 mb-md-5 text-center">
								<a href="/" class="d-block auth-logo">
									<img src="assets/images/logo-sm.svg" alt="" height="28"> <span class="logo-txt">Scraper</span>
								</a>
							</div>
							<div class="auth-content my-auto">
								<div class="text-center">
									<h5 class="mb-0">Welcome Back !</h5>
									<p class="text-muted mt-2">Sign in to continue to Scraper.</p>
								</div>
								<?= view('Myth\Auth\Views\_message_block') ?>

								<form action="<?= route_to('login') ?>" method="post">
									<?= csrf_field() ?>
									<div class="mb-3">
										<label class="form-label">Username</label>
										<input type="text" name="login" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" id="username" placeholder="Enter username">
										<div class="invalid-feedback">
											<?= session('errors.login') ?>
										</div>
									</div>
									<div class="mb-3">
										<div class="d-flex align-items-start">
											<div class="flex-grow-1">
												<label class="form-label">Password</label>
											</div>
											<?php if ($config->activeResetter) : ?>
												<div class="flex-shrink-0">
													<div class="">
														<a href="<?= route_to('forgot') ?>" class="text-muted">Forgot password?</a>
													</div>
												</div>
											<?php endif; ?>
										</div>

										<div class="input-group auth-pass-inputgroup">
											<input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
											<div class="invalid-feedback">
												<?= session('errors.password') ?>
											</div>
											<button class="btn btn-light ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
										</div>
									</div>
									<?php if ($config->allowRemembering) : ?>
										<div class="row mb-4">
											<div class="col">
												<div class="form-check">
													<input class="form-check-input" name="remember" type="checkbox" id="remember-check" <?php if (old('remember')) : ?> checked <?php endif ?>>
													<label class="form-check-label" for="remember-check">
														Remember me
													</label>
												</div>
											</div>
										</div>
									<?php endif; ?>
									<div class="mb-3">
										<button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
									</div>
								</form>

								<?php if ($config->allowRegistration) : ?>
									<div class="mt-5 text-center">
										<p class="text-muted mb-0">Don't have an account ? <a href="<?= route_to('register') ?>" class="text-primary fw-semibold"> Signup now </a> </p>
									</div>
								<?php endif; ?>
							</div>
							<div class="mt-4 mt-md-5 text-center">
								<p class="mb-0">© <?= date('Y'); ?> Scraper.</p>
							</div>
						</div>
					</div>
				</div>
				<!-- end auth full page content -->
			</div>
			<!-- end col -->
			<div class="col-xxl-9 col-lg-8 col-md-7">
				<div class="auth-bg pt-md-5 p-4 d-flex">
					<div class="bg-overlay bg-bg"></div>
					<ul class="bg-bubbles">
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
					</ul>
					<!-- end bubble effect -->
					<div class="row justify-content-center align-items-center">
						<div class="col-xl-7">
							<div class="p-0 p-sm-4 px-xl-0">
								<div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
									<div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
										<button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
										<button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
										<button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
									</div>
									<!-- end carouselIndicators -->
									<div class="carousel-inner">
										<div class="carousel-item active">
											<div class="testi-contain text-white">
												<i class="bx bxs-quote-alt-left text-success display-6"></i>

												<h4 class="mt-4 fw-medium lh-base text-white">“This is the real secret of life -
													to be completely engaged with what you are doing in the here and now.
													And instead of calling it work,
													realize it is play.”
												</h4>
												<div class="mt-4 pt-3 pb-5">
													<div class="d-flex align-items-start">
														<div class="flex-shrink-0">
															<p>—</p>
														</div>
														<div class="flex-grow-1 ms-3 mb-4">
															<h5 class="font-size-18 text-white">Alan Watts
															</h5>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="carousel-item">
											<div class="testi-contain text-white">
												<i class="bx bxs-quote-alt-left text-success display-6"></i>

												<h4 class="mt-4 fw-medium lh-base text-white">“Confidence is not a guarantee of success, but a pattern of thinking that will improve your likelihood of success, a tenacious search for ways to make things work.”</h4>
												<div class="mt-4 pt-3 pb-5">
													<div class="d-flex align-items-start">
														<div class="flex-shrink-0">
															<p>—</p>
														</div>
														<div class="flex-grow-1 ms-3 mb-4">
															<h5 class="font-size-18 text-white">John Eliot
															</h5>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="carousel-item">
											<div class="testi-contain text-white">
												<i class="bx bxs-quote-alt-left text-success display-6"></i>

												<h4 class="mt-4 fw-medium lh-base text-white">“No experience is a cause of success or failure. We do not suffer from the shock of our experiences, so-called trauma - but we make out of them just what suits our purposes.”</h4>
												<div class="mt-4 pt-3 pb-5">
													<div class="d-flex align-items-start">
														<p>—</p>
														<div class="flex-1 ms-3 mb-4">
															<h5 class="font-size-18 text-white">Alfred Adler</h5>
															</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- end carousel-inner -->
								</div>
								<!-- end review carousel -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end col -->
		</div>
		<!-- end row -->
	</div>
	<!-- end container fluid -->
</div>


<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>
<!-- password addon init -->
<script src="assets/js/pages/pass-addon.init.js"></script>

</body>

</html>