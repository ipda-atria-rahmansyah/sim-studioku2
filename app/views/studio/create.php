<?php require '../app/views/layouts/header.php'; ?>
<?php require '../app/views/layouts/navbar.php'; ?>
<?php require '../app/views/layouts/sidebar.php'; ?>

<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid">
        <h1>Tambah Studio</h1>
    </div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-body">

<form method="POST"
      action="<?= BASEURL; ?>/studio/store"
      enctype="multipart/form-data">

    <div class="form-group">

        <label>Nama Studio</label>

        <input type="text"
               name="nama_studio"
               class="form-control"
               required>

    </div>

    <div class="form-group">

        <label>Harga per 10 Menit</label>

        <input type="number"
               name="harga_per_10_menit"
               class="form-control"
               required>

    </div>

    <div class="form-group">

        <label>Kapasitas</label>

        <input type="number"
               name="kapasitas"
               class="form-control"
               required>

    </div>

    <div class="form-group">

        <label>Deskripsi</label>

        <textarea name="deskripsi"
                  class="form-control"></textarea>

    </div>

    <div class="form-group">

        <label>Foto Studio</label>

        <input type="file"
               name="foto"
               class="form-control">

    </div>

    <div class="form-group">

        <label>Status</label>

        <select
            name="status"
            class="form-control">

            <option value="aktif">
                Aktif
            </option>

            <option value="nonaktif">
                Nonaktif
            </option>

        </select>

    </div>

    <button class="btn btn-primary">
        Simpan
    </button>

    <a href="<?= BASEURL; ?>/studio"
       class="btn btn-secondary">

        Kembali

    </a>

</form>

</div>

</div>

</div>

</section>

</div>

<?php require '../app/views/layouts/footer.php'; ?>