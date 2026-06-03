<?php require '../app/views/layouts/header.php'; ?>
<?php require '../app/views/layouts/navbar.php'; ?>
<?php require '../app/views/layouts/sidebar.php'; ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h1>Riwayat Booking</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<table class="table table-bordered">

<thead>

<tr>

<th>Studio</th>
<th>Tanggal</th>
<th>Jam</th>
<th>Total</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php foreach($data['booking'] as $booking): ?>

<tr>

<td>
<?= $booking['nama_studio']; ?>
</td>

<td>
<?= $booking['tanggal_penggunaan']; ?>
</td>

<td>
<?= $booking['jam_mulai']; ?>
-
<?= $booking['jam_selesai']; ?>
</td>

<td>
Rp <?= number_format(
$booking['total_harga']
); ?>
</td>

<td>
<?= $booking['status']; ?>
</td>

<td>

<?php if(
    $booking['status']
    ==
    'menunggu_pembayaran'
): ?>

<a
href="<?= BASEURL; ?>/pembayaran/upload/<?= $booking['id_booking']; ?>"
class="btn btn-primary btn-sm">

Upload Bukti

</a>

<?php endif; ?>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</section>

</div>

<?php require '../app/views/layouts/footer.php'; ?> 