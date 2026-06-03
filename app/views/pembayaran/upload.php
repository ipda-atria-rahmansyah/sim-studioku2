<?php require '../app/views/layouts/header.php'; ?>
<?php require '../app/views/layouts/navbar.php'; ?>
<?php require '../app/views/layouts/sidebar.php'; ?>

<div class="content-wrapper">

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

Upload Bukti Pembayaran

</div>

<div class="card-body">

<form
method="POST"
action="<?= BASEURL; ?>/pembayaran/store"
enctype="multipart/form-data">

<input
type="hidden"
name="id_booking"
value="<?= $data['id_booking']; ?>">

<div class="form-group">

<label>Bukti Pembayaran</label>

<input
type="file"
name="bukti"
class="form-control"
required>

</div>

<button
class="btn btn-primary">

Upload

</button>

</form>

</div>

</div>

</div>

</section>

</div>

<?php require '../app/views/layouts/footer.php'; ?>