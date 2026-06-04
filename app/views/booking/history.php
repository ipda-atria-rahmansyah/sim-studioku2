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

<?php if(!empty($data['booking'])): ?>

    <?php foreach($data['booking'] as $booking): ?>

        <tr>

            <!-- Studio -->
            <td><?= $booking['nama_studio']; ?></td>

            <!-- Tanggal -->
            <td><?= $booking['tanggal_penggunaan']; ?></td>

            <!-- Jam -->
            <td>
                <?= $booking['jam_mulai']; ?> - <?= $booking['jam_selesai']; ?>
            </td>

            <!-- Total -->
            <td>
                Rp <?= number_format($booking['total_harga']); ?>
            </td>

            <!-- STATUS -->
            <td>

                <?php if($booking['status'] == 'menunggu_pembayaran'): ?>

                    <span class="badge badge-warning">Menunggu Pembayaran</span>

                <?php elseif($booking['status'] == 'menunggu_verifikasi'): ?>

                    <span class="badge badge-info">Menunggu Verifikasi</span>

                <?php elseif($booking['status'] == 'dikonfirmasi'): ?>

                    <span class="badge badge-success">Dikonfirmasi</span>

                <?php elseif($booking['status'] == 'dibatalkan'): ?>

                    <span class="badge badge-danger">Dibatalkan</span>

                <?php elseif($booking['status'] == 'kadaluarsa'): ?>

                    <span class="badge badge-secondary">Kadaluarsa</span>

                <?php endif; ?>

            </td>

            <!-- AKSI -->
            <td>

                <?php if($booking['status'] == 'menunggu_pembayaran'): ?>

                    <a href="<?= BASEURL; ?>/booking/detail/<?= $booking['id_booking']; ?>"
                       class="btn btn-info btn-sm">

                        Detail

                    </a>

                    <a href="<?= BASEURL; ?>/pembayaran/upload/<?= $booking['id_booking']; ?>"
                       class="btn btn-primary btn-sm">

                        Upload Bukti

                    </a>

                <?php else: ?>

                    <span class="text-muted">-</span>

                <?php endif; ?>

            </td>

        </tr>

    <?php endforeach; ?>

<?php else: ?>

    <tr>
        <td colspan="6" class="text-center">
            Belum ada booking
        </td>
    </tr>

<?php endif; ?>

</tbody>

</table>

</div>

</section>

</div>

<?php require '../app/views/layouts/footer.php'; ?>