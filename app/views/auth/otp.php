<h2>Verifikasi OTP</h2>

<p>Kode OTP sudah dikirim ke email kamu</p>

<?php if(isset($_SESSION['error'])): ?>
    <p style="color:red;">
        <?= $_SESSION['error']; ?>
    </p>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form method="POST" action="<?= BASEURL; ?>/auth/verifyOtp">

    <label>Masukkan OTP</label>
    <input type="text" name="otp" maxlength="6" required>

    <button type="submit">Verifikasi</button>

</form>