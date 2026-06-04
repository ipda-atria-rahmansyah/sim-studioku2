<?php require '../app/views/layouts/header.php'; ?>
<?php require '../app/views/layouts/navbar.php'; ?>
<?php require '../app/views/layouts/sidebar.php'; ?>

<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid">
        <h1>Kalender Booking Studio</h1>
    </div>
</section>

<section class="content">

<div class="container-fluid">

<table class="table table-bordered">

<thead>
<tr>
    <th>Tanggal</th>
    <th>Jam</th>
    <th>Studio</th>
    <th>Status</th>
</tr>
</thead>

<tbody>

<?php foreach($data['booking'] as $b): ?>

<tr>

    <td><?= $b['tanggal_penggunaan']; ?></td>

    <td>
        <?= $b['jam_mulai']; ?> - <?= $b['jam_selesai']; ?>
    </td>

    <td><?= $b['nama_studio']; ?></td>

    <td>

        <?php if($b['status'] == 'dikonfirmasi'): ?>

            <span class="badge badge-success">Booked</span>

        <?php elseif($b['status'] == 'menunggu_pembayaran'): ?>

            <span class="badge badge-warning">Pending</span>

        <?php elseif($b['status'] == 'kadaluarsa'): ?>

            <span class="badge badge-secondary">Expired</span>

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