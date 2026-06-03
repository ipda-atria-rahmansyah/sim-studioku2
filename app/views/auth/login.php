<!DOCTYPE html>
<html>
<head>
    <title><?= $data['title']; ?></title>
</head>
<body>

<h1>Login Booking Studio</h1>

<form method="POST"
      action="<?= BASEURL; ?>/auth/loginProcess">

    <input
        type="email"
        name="email"
        placeholder="Email"
        required>

    <br><br>

    <input
        type="password"
        name="password"
        placeholder="Password"
        required>

    <br><br>

    <button type="submit">
        Login
    </button>

</form>

<br>

<a href="<?= BASEURL; ?>/auth/register">
    Belum punya akun?
</a>

</body>
</html>