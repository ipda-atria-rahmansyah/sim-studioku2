<?php require '../app/views/layouts/header.php'; ?>
<?php require '../app/views/layouts/navbar.php'; ?>
<?php require '../app/views/layouts/sidebar.php'; ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h1>Booking Studio</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="row">

<?php foreach($data['studio'] as $studio): ?>

<div class="col-md-4">

<div class="card">

<?php if(!empty($studio['foto'])): ?>

<img
src="<?= BASEURL; ?>/uploads/studio/<?= $studio['foto']; ?>"
class="card-img-top">

<?php endif; ?>

<div class="card-body">

<h5>
<?= $studio['nama_studio']; ?>
</h5>

<p>

Rp
<?= number_format(
$studio['harga_per_10_menit']
); ?>

/10 menit

</p>

<p>

Kapasitas:
<?= $studio['kapasitas']; ?>

</p>

<a
href="<?= BASEURL; ?>/booking/create/<?= $studio['id_studio']; ?>"
class="btn btn-primary">

Booking

</a>

</div>

</div>

</div>

<?php endforeach; ?>

</div>

</div>

</section>

</div>

<?php require '../app/views/layouts/footer.php'; ?>