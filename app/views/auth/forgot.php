<h2>Lupa Password</h2>

<?php if(isset($_SESSION['error'])): ?>
    <p style="color:red;">
        <?= $_SESSION['error']; ?>
    </p>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form method="POST" action="<?= BASEURL; ?>/auth/sendOtp">

    <label>Email</label>
    <input type="email" name="email" required>

    <button type="submit">Kirim OTP</button>

</form>

<p>
    Kembali ke <a href="<?= BASEURL; ?>/auth">Login</a>
</p>