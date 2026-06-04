<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $data['title']; ?></title>

  <!-- AdminLTE -->
  <link rel="stylesheet" href="<?= BASEURL; ?>/assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= BASEURL; ?>/assets/adminlte/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">

<div class="login-box">

  <!-- Logo / Title -->
  <div class="login-logo">
    <b>Booking</b> Studio
  </div>

  <div class="card">

    <div class="card-body login-card-body">

      <p class="login-box-msg">Silakan login untuk melanjutkan</p>

      <!-- FORM -->
      <form method="POST" action="<?= BASEURL; ?>/auth/loginProcess">

        <!-- EMAIL -->
        <div class="input-group mb-3">
          <input type="email"
                 name="email"
                 class="form-control"
                 placeholder="Email"
                 required>

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <!-- PASSWORD -->
        <div class="input-group mb-3">
          <input type="password"
                 name="password"
                 class="form-control"
                 placeholder="Password"
                 required>

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <!-- BUTTON -->
        <div class="row">

          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">
              Login
            </button>
          </div>

        </div>

      </form>

      <p class="mb-0 mt-3 text-center">
        <a href="<?= BASEURL; ?>/auth/register" class="text-center">
          Belum punya akun? Daftar
        </a>
      </p>

    </div>

  </div>

</div>

<!-- JS -->
<script src="<?= BASEURL; ?>/assets/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="<?= BASEURL; ?>/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASEURL; ?>/assets/adminlte/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>