<?php require '../app/views/layouts/header.php'; ?>
<?php require '../app/views/layouts/navbar.php'; ?>
<?php require '../app/views/layouts/sidebar.php'; ?>

<div class="content-wrapper">

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

Booking
<?= $data['studio']['nama_studio']; ?>

</div>

<div class="card-body">

<form method="POST"
      action="<?= BASEURL; ?>/booking/store">

<input type="hidden"
       name="id_studio"
       value="<?= $data['studio']['id_studio']; ?>">

<div class="form-group">

<label>
Tanggal Penggunaan
</label>

<input
type="date"
name="tanggal_penggunaan"
class="form-control"
required>

</div>

<div class="form-group">

<label>
Jam Mulai
</label>

<input
type="time"
name="jam_mulai"
class="form-control"
required>

</div>

<div class="form-group">

<label>
Jam Selesai
</label>

<input
type="time"
name="jam_selesai"
class="form-control"
required>

</div>

<button
class="btn btn-primary">

Booking

</button>

</form>

</div>

</div>

</div>

</section>

</div>

<?php require '../app/views/layouts/footer.php'; ?>