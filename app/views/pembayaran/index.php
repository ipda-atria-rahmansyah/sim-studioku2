<?php require '../app/views/layouts/header.php'; ?>
<?php require '../app/views/layouts/navbar.php'; ?>
<?php require '../app/views/layouts/sidebar.php'; ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h1>Verifikasi Pembayaran</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<table class="table table-bordered">

<thead>

<tr>
    <th>ID Booking</th>
    <th>Customer</th>
    <th>Total</th>
    <th>Bukti</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

</thead>

<tbody>

<?php foreach($data['pembayaran'] as $p): ?>

<tr>

    <!-- ID Booking -->
    <td><?= $p['id_booking']; ?></td>

    <!-- Nama Customer -->
    <td><?= $p['nama']; ?></td>

    <!-- Total Harga -->
    <td>
        Rp <?= number_format($p['total_harga']); ?>
    </td>

    <!-- Bukti Transfer -->
    <td>

        <a target="_blank"
           href="<?= BASEURL; ?>/uploads/pembayaran/<?= $p['bukti_pembayaran']; ?>">

            Lihat Bukti

        </a>

    </td>

    <!-- STATUS -->
    <td>

        <?php if($p['status_verifikasi'] == 'pending'): ?>

            <span class="badge badge-warning">Pending</span>

        <?php elseif($p['status_verifikasi'] == 'disetujui'): ?>

            <span class="badge badge-success">Disetujui</span>

        <?php elseif($p['status_verifikasi'] == 'ditolak'): ?>

            <span class="badge badge-danger">Ditolak</span>

        <?php else: ?>

            <span class="badge badge-secondary">-</span>

        <?php endif; ?>

    </td>

    <!-- AKSI -->
    <td>

        <?php if($p['status_verifikasi'] == 'pending'): ?>

            <a href="<?= BASEURL; ?>/pembayaran/verifikasi/<?= $p['id_pembayaran']; ?>"
               class="btn btn-success btn-sm">

                Verifikasi

            </a>

            <a href="<?= BASEURL; ?>/pembayaran/tolak/<?= $p['id_pembayaran']; ?>"
               class="btn btn-danger btn-sm">

                Tolak

            </a>

        <?php else: ?>

            <small class="text-muted">Tidak ada aksi</small>

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