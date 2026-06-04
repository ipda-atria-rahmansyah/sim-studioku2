<?php require '../app/views/layouts/header.php'; ?>
<?php require '../app/views/layouts/navbar.php'; ?>
<?php require '../app/views/layouts/sidebar.php'; ?>

<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid">
        <h1>Detail Booking</h1>
    </div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-body">

<table class="table table-bordered">

<tr>
    <th>Studio</th>
    <td><?= $data['booking']['nama_studio']; ?></td>
</tr>

<tr>
    <th>Customer</th>
    <td><?= $data['booking']['nama']; ?></td>
</tr>

<tr>
    <th>Tanggal</th>
    <td><?= $data['booking']['tanggal_penggunaan']; ?></td>
</tr>

<tr>
    <th>Jam</th>
    <td>
        <?= $data['booking']['jam_mulai']; ?> -
        <?= $data['booking']['jam_selesai']; ?>
    </td>
</tr>

<tr>
    <th>Total</th>
    <td>Rp <?= number_format($data['booking']['total_harga']); ?></td>
</tr>

<tr>
    <th>Status</th>
    <td><?= $data['booking']['status']; ?></td>
</tr>

</table>

</div>

</div>

</div>

</section>

</div>

<?php require '../app/views/layouts/footer.php'; ?>