<?php require '../app/views/layouts/header.php'; ?>
<?php require '../app/views/layouts/navbar.php'; ?>
<?php require '../app/views/layouts/sidebar.php'; ?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>Data Studio</h1>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">

                    <a href="<?= BASEURL; ?>/studio/create"
                       class="btn btn-primary">

                        Tambah Studio

                    </a>

                </div>

                <div class="card-body">
                    <!--<a href="<?= BASEURL; ?>/studio/create"
                    class="btn btn-primary mb-3">

                        Tambah Studio

                    </a> -->

                    <table class="table table-bordered">

                        <thead>

                        <tr>
                            <th>ID</th>
                            <th>Nama Studio</th>
                            <th>Harga</th>
                            <th>Foto</th>
                            <th>Kapasitas</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>

                        </thead>

                        <tbody>

                        <?php foreach($data['studio'] as $studio): ?>

                            <tr>

                                <td><?= $studio['id_studio']; ?></td>

                                <td><?= $studio['nama_studio']; ?></td>

                                <td>
                                    Rp <?= number_format($studio['harga_per_10_menit']); ?>
                                </td>
                                <td>
                                    <?php if(!empty($studio['foto'])): ?>

                                        <img
                                            src="<?= BASEURL; ?>/uploads/studio/<?= $studio['foto']; ?>"
                                            width="100">

                                    <?php endif; ?>
                                </td>

                                <td><?= $studio['kapasitas']; ?></td>

                                <td>
                                    <?php if($studio['status'] == 'aktif'): ?>

                                        <span class="badge badge-success">
                                            Aktif
                                        </span>

                                    <?php else: ?>

                                        <span class="badge badge-danger">
                                            Nonaktif
                                        </span>

                                    <?php endif; ?>
                                </td>

                                <td>

                                    <a href="<?= BASEURL; ?>/studio/edit/<?= $studio['id_studio']; ?>"
                                    class="btn btn-warning btn-sm">

                                    Edit

                                    </a>

                                    <a href="<?= BASEURL; ?>/studio/delete/<?= $studio['id_studio']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus data?')">

                                    Hapus

                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</div>

<?php require '../app/views/layouts/footer.php'; ?>