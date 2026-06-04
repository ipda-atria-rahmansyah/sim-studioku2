<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- LEFT -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- RIGHT -->
    <ul class="navbar-nav ml-auto">

        <!-- 🔔 NOTIFICATION -->
        <li class="nav-item dropdown">

            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">3</span>
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                <span class="dropdown-header">3 Notifikasi</span>

                <div class="dropdown-divider"></div>

                <a href="#" class="dropdown-item">
                    <i class="fas fa-calendar mr-2"></i> Booking baru
                </a>

                <div class="dropdown-divider"></div>

                <a href="#" class="dropdown-item">
                    <i class="fas fa-money-bill mr-2"></i> Pembayaran masuk
                </a>

            </div>

        </li>

        <!-- 👤 USER -->
        <li class="nav-item dropdown user-menu">

            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">

                <img src="<?= BASEURL; ?>/public/img/user.png"
                     class="user-image img-circle elevation-2">

                <span class="d-none d-md-inline">
                    <?= $_SESSION['nama']; ?>
                </span>

            </a>

            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                <!-- HEADER -->
                <li class="user-header bg-gradient-primary">

                    <img src="<?= BASEURL; ?>/public/img/user.png"
                         class="img-circle elevation-2">

                    <p>
                        <?= $_SESSION['nama']; ?>
                        <small>
                            <span class="badge badge-light">
                                <?= $_SESSION['role']; ?>
                            </span>
                        </small>
                    </p>

                </li>

                <!-- BODY QUICK ACTION -->
                <li class="p-2 text-center">

                    <a href="<?= BASEURL; ?>/profile" class="btn btn-primary btn-sm">
                        Profile
                    </a>

                    <a href="<?= BASEURL; ?>/settings" class="btn btn-secondary btn-sm">
                        Settings
                    </a>

                </li>

                <!-- FOOTER -->
                <li class="user-footer">

                    <a href="<?= BASEURL; ?>/auth/logout"
                       class="btn btn-danger btn-block">
                        Logout
                    </a>

                </li>

            </ul>

        </li>

    </ul>

</nav>