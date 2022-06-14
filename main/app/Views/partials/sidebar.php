<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <div class="card sidebar-alert border-0 text-center mb-3">
                    <div class="card-body">
                        <div>
                            <p class="font-size-15 mb-1"><?= (user()->saldo > 0) ? 'Saldo' : 'Saldo Habis'; ?></p>
                            <?php if (user()->saldo > 0) : ?>
                                <h5 class="alertcard-title font-size-20" id="saldo">Rp. <?= number_format(user()->saldo, 0, ",", "."); ?>,-</h5>
                            <?php else : ?>
                                <a href="/deposit?now" class="btn btn-primary btn-sm" id="saldo">Isi Saldo</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <li class="menu-title" data-key="t-menu"><?= lang('Files.Menu') ?></li>

                <li>
                    <a href="/dashboard">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard"><?= lang('Files.Dashboard') ?></span>
                    </a>
                </li>

                <li>
                    <a href="/deposit">
                        <i data-feather="credit-card"></i>
                        <span>Deposit</span>
                    </a>
                </li>

                <li>
                    <a href="/profile">
                        <i data-feather="user"></i>
                        <span>Profile</span>
                    </a>
                </li>

                <li>
                    <a href="/tiket">
                        <i data-feather="mail"></i>
                        <span>Tiket</span>
                    </a>
                </li>

                <li>
                    <a href="/faq">
                        <i data-feather="help-circle"></i>
                        <span>F.A.Q</span>
                    </a>
                </li>
                <?php if (in_groups('admin') || user_id() == 2) : ?>


                    <li>
                        <a href="/">
                            <i data-feather="bell"></i>
                            <span>News</span>
                        </a>
                    </li>

                <?php endif; ?>
            </ul>

            <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">
                <div class="card-body">
                    <img src="/assets/images/giftbox.png" alt="">
                    <div class="mt-4">
                        <h5 class="alertcard-title font-size-16">Bonus Referral</h5>
                        <p class="font-size-13">Undang temanmu dan dapatkan saldo bonus untuk kedua belah pihak.</p>
                        <a href="/profile?=offer" class="btn btn-primary mt-2">Undang Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->