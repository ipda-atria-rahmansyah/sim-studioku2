<?php require '../app/views/layouts/header.php'; ?>
<?php require '../app/views/layouts/navbar.php'; ?>
<?php require '../app/views/layouts/sidebar.php'; ?>

<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid">
        <h1>Dashboard Customer</h1>
        <p>Selamat datang <?= $_SESSION['nama']; ?></p>
    </div>
</section>

<section class="content">

<div class="container-fluid">

<div class="row">

<!-- TOTAL BOOKING -->
<div class="col-lg-3 col-6">
    <div class="small-box bg-info">
        <div class="inner">
            <h3><?= $data['total_booking']; ?></h3>
            <p>Total Booking</p>
        </div>
    </div>
</div>

<!-- PENDING -->
<div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
        <div class="inner">
            <h3><?= $data['pending_booking']; ?></h3>
            <p>Menunggu Pembayaran</p>
        </div>
    </div>
</div>

<!-- PROSES -->
<div class="col-lg-3 col-6">
    <div class="small-box bg-info">
        <div class="inner">
            <h3><?= $data['proses_booking']; ?></h3>
            <p>Proses Verifikasi</p>
        </div>
    </div>
</div>

<!-- SELESAI -->
<div class="col-lg-3 col-6">
    <div class="small-box bg-success">
        <div class="inner">
            <h3><?= $data['selesai_booking']; ?></h3>
            <p>Selesai</p>
        </div>
    </div>
</div>

</div>

</div>

</section>

</div>

<?php require '../app/views/layouts/footer.php'; ?>