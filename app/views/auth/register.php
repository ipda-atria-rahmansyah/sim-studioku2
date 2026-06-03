<!DOCTYPE html>
<html>
<head>
    <title><?= $data['title']; ?></title>
</head>
<body>

<h1>Register Booking Studio</h1>

<form method="POST"
      action="<?= BASEURL; ?>/auth/registerProcess">

    <input type="text"
           name="nama"
           placeholder="Nama Lengkap">

    <br><br>

    <input type="email"
           name="email"
           placeholder="Email">

    <br><br>

    <input type="text"
           name="no_hp"
           placeholder="Nomor HP">

    <br><br>

    <input type="password"
           name="password"
           placeholder="Password">

    <br><br>

    <button type="submit">
        Daftar
    </button>

</form>

<br>

<a href="<?= BASEURL; ?>/auth">
    Sudah punya akun? Login
</a>

</body>
</html>