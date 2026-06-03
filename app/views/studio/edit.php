<?php require '../app/views/layouts/header.php'; ?>
<?php require '../app/views/layouts/navbar.php'; ?>
<?php require '../app/views/layouts/sidebar.php'; ?>

<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid">
        <h1>Edit Studio</h1>
    </div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-body">

<form method="POST"
      action="<?= BASEURL; ?>/studio/update"
      enctype="multipart/form-data">

<input type="hidden"
       name="id_studio"
       value="<?= $data['studio']['id_studio']; ?>">

    <div class="form-group">

        <label>Nama Studio</label>

        <input type="text"
               name="nama_studio"
               class="form-control"
               value="<?= $data['studio']['nama_studio']; ?>"
               required>

    </div>

    <div class="form-group">

        <label>Harga per 10 Menit</label>

        <input type="number"
               name="harga_per_10_menit"
               class="form-control"
               value="<?= $data['studio']['harga_per_10_menit']; ?>"
               required>

    </div>

    <div class="form-group">

        <label>Kapasitas</label>

        <input type="number"
               name="kapasitas"
               class="form-control"
               value="<?= $data['studio']['kapasitas']; ?>"
               required>

    </div>

    <div class="form-group">

    <label>Deskripsi</label>

    <textarea name="deskripsi"
              class="form-control"><?= $data['studio']['deskripsi']; ?></textarea>
    </div>

    <div class="form-group">

        <label>Foto Saat Ini</label>

        <br>

        <?php if(!empty($data['studio']['foto'])): ?>

            <img
                src="<?= BASEURL; ?>/uploads/studio/<?= $data['studio']['foto']; ?>"
                width="150">

        <?php endif; ?>

    </div>

    <div class="form-group">

        <label>Ganti Foto</label>

        <input
            type="file"
            name="foto"
            class="form-control">

    </div>

    <div class="form-group">

        <label>Status</label>

        <select
            name="status"
            class="form-control">

            <option value="aktif"
                <?= $data['studio']['status'] == 'aktif' ? 'selected' : ''; ?>>
                Aktif
            </option>

            <option value="nonaktif"
                <?= $data['studio']['status'] == 'nonaktif' ? 'selected' : ''; ?>>
                Nonaktif
            </option>

        </select>

    </div>

        <!--<div class="form-group">

            <label>Foto Studio</label>

            <input type="file"
                name="foto"
                class="form-control">

        </div> -->

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