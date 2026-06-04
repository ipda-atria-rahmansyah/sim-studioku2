<?php require '../app/views/layouts/header.php'; ?>
<?php require '../app/views/layouts/navbar.php'; ?>
<?php require '../app/views/layouts/sidebar.php'; ?>

<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid">
        <h1>Dashboard Admin</h1>
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
            <p>Pending Booking</p>
        </div>
    </div>
</div>

<!-- SELESAI -->
<div class="col-lg-3 col-6">
    <div class="small-box bg-success">
        <div class="inner">
            <h3><?= $data['selesai_booking']; ?></h3>
            <p>Booking Selesai</p>
        </div>
    </div>
</div>

<!-- INCOME -->
<div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
        <div class="inner">
            <h3>Rp <?= number_format($data['income']); ?></h3>
            <p>Total Income</p>
        </div>
    </div>
</div>

</div>

</div>

</section>

</div>

<?php require '../app/views/layouts/footer.php'; ?>