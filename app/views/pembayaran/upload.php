<?php require '../app/views/layouts/header.php'; ?>
<?php require '../app/views/layouts/navbar.php'; ?>
<?php require '../app/views/layouts/sidebar.php'; ?>

<div class="content-wrapper">

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
    <h3 class="card-title">Upload Bukti Pembayaran</h3>
</div>

<div class="card-body">

<?php
$deadline = date('c', strtotime($data['booking']['batas_bayar_sampai']));
?>

<!-- DEADLINE INFO -->
<div class="alert alert-warning">
    ⏰ Batas waktu pembayaran:
    <b><?= $deadline; ?></b>
</div>

<!-- COUNTDOWN -->
<h4 id="countdown" class="text-danger mb-3"></h4>

<!-- FORM UPLOAD -->
<form method="POST"
      action="<?= BASEURL; ?>/pembayaran/store"
      enctype="multipart/form-data"
      id="formUpload">

    <input type="hidden"
           name="id_booking"
           value="<?= $data['id_booking']; ?>">

    <div class="form-group">

        <label>Bukti Pembayaran</label>

        <input type="file"
               name="bukti"
               id="fileBukti"
               class="form-control"
               required>

    </div>

    <button type="submit"
            id="submitBtn"
            class="btn btn-primary">

        Upload

    </button>

</form>

</div>

</div>

</div>

</section>

</div>

<!-- COUNTDOWN + DISABLE LOGIC -->
<script>
var deadline = <?= strtotime($data['booking']['batas_bayar_sampai']) * 1000 ?>;

var countdownEl = document.getElementById("countdown");
var submitBtn = document.getElementById("submitBtn");
var fileInput = document.getElementById("fileBukti");
var form = document.getElementById("formUpload");

var x = setInterval(function () {

    var now = new Date().getTime();
    var distance = deadline - now;

    if (distance < 0) {
        clearInterval(x);

        countdownEl.innerHTML = "⛔ WAKTU HABIS";

        // disable semua input
        submitBtn.disabled = true;
        fileInput.disabled = true;

        //submitBtn.innerText = "Waktu Habis";

        return;
    }

    var hours = Math.floor(distance / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    countdownEl.innerHTML =
        hours + " jam " + minutes + " menit " + seconds + " detik";

}, 1000);
</script>

<?php require '../app/views/layouts/footer.php'; ?>