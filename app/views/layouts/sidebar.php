<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">
            SIM Studioku
        </span>
    </a>

    <div class="sidebar">

        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= BASEURL; ?>/dashboard"
                       class="nav-link">

                        <i class="nav-icon fas fa-home"></i>

                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- MENU ADMIN -->
                <?php if($_SESSION['role'] == 'admin'): ?>

                <li class="nav-item">
                    <a href="<?= BASEURL; ?>/studio"
                       class="nav-link">

                        <i class="nav-icon fas fa-camera"></i>

                        <p>Studio</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= BASEURL; ?>/pembayaran"
                    class="nav-link">

                        <i class="nav-icon fas fa-money-check"></i>

                        <p>Verifikasi Pembayaran</p>

                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= BASEURL; ?>/pengaturan"
                       class="nav-link">

                        <i class="nav-icon fas fa-cog"></i>

                        <p>Pengaturan</p>
                    </a>
                </li>

                <?php endif; ?>

                <!-- MENU CUSTOMER -->
                <?php if($_SESSION['role'] == 'customer'): ?>

                <li class="nav-item">
                    <a href="<?= BASEURL; ?>/booking"
                       class="nav-link">

                        <i class="nav-icon fas fa-calendar-check"></i>

                        <p>Booking Saya</p>

                    </a>
                </li>

                <?php endif; ?>

                <!-- LOGOUT -->
                <li class="nav-item">
                    <a href="<?= BASEURL; ?>/auth/logout"
                       class="nav-link">

                        <i class="nav-icon fas fa-sign-out-alt"></i>

                        <p>Logout</p>
                    </a>
                </li>

            </ul>

        </nav>

    </div>

</aside>