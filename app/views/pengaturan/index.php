<?php require '../app/views/layouts/header.php'; ?>
<?php require '../app/views/layouts/navbar.php'; ?>
<?php require '../app/views/layouts/sidebar.php'; ?>

<div class="content-wrapper">

```
<section class="content-header">

    <div class="container-fluid">

        <h1>Pengaturan Sistem</h1>

    </div>

</section>

<section class="content">

    <div class="container-fluid">

        <div class="card">

            <div class="card-header">

                Batas Pembayaran

            </div>

            <div class="card-body">

                <form
                    method="POST"
                    action="<?= BASEURL; ?>/pengaturan/update"
                    id="formPengaturan">

                    <div class="form-group">

                        <label>
                            Batas Pembayaran Default (Menit)
                        </label>

                        <input
                            type="number"
                            name="batas_pembayaran_default"
                            class="form-control"
                            value="<?= $data['pengaturan']['batas_pembayaran_default']; ?>"
                            min="1"
                            required>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary"
                        id="btnSimpan">

                        Simpan

                    </button>

                </form>

            </div>

        </div>

    </div>

</section>
```

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

document.getElementById('btnSimpan')
.addEventListener('click', function(e){

    e.preventDefault();

    Swal.fire({
        title: 'Simpan Pengaturan?',
        text: 'Perubahan akan diterapkan ke sistem',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Simpan',
        cancelButtonText: 'Batal'
    }).then((result) => {

        if(result.isConfirmed)
        {
            document
            .getElementById('formPengaturan')
            .submit();
        }

    });

});

</script>

<?php if(isset($_SESSION['success'])) : ?>

<script>

Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '<?= $_SESSION['success']; ?>',
    confirmButtonText: 'OK'
});

</script>

<?php unset($_SESSION['success']); ?>

<?php endif; ?>

<?php require '../app/views/layouts/footer.php'; ?>


</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if(isset($_SESSION['success'])) : ?>

<script>

Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '<?= $_SESSION['success']; ?>',
    confirmButtonText: 'OK'
});

</script>

<?php unset($_SESSION['success']); ?>

<?php endif; ?>

<?php require '../app/views/layouts/footer.php'; ?>