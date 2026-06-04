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

<div class="register-box">

  <!-- TITLE -->
  <div class="register-logo">
    <b>Register</b> Booking Studio
  </div>

  <div class="card">

    <div class="card-body register-card-body">

      <p class="login-box-msg">Buat akun baru</p>

      <!-- FORM -->
      <form method="POST" action="<?= BASEURL; ?>/auth/registerProcess">

        <!-- NAMA -->
        <div class="input-group mb-3">
          <input type="text"
                 name="nama"
                 class="form-control"
                 placeholder="Nama Lengkap"
                 required>

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

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

        <!-- NO HP -->
        <div class="input-group mb-3">
          <input type="text"
                 name="no_hp"
                 class="form-control"
                 placeholder="Nomor HP"
                 required>

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
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
        <button type="submit" class="btn btn-primary btn-block">
          Daftar
        </button>

      </form>

      <p class="mt-3 text-center">
        <a href="<?= BASEURL; ?>/auth">
          Sudah punya akun? Login
        </a>
      </p>

    </div>

  </div>

</div>

<!-- JS -->
<script src="<?= BASEURL; ?>/assets/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="<?= BASEURL; ?>/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASEURL; ?>/assets/adminlte/dist/js/adminlte.min.js"></script>

</body>
</html>