<?php require '../app/views/layouts/header.php'; ?>
<?php require '../app/views/layouts/navbar.php'; ?>
<?php require '../app/views/layouts/sidebar.php'; ?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>Dashboard Admin</h1>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-body">

                    Selamat datang
                    <?= $_SESSION['nama']; ?>

                </div>

            </div>

        </div>

    </section>

</div>

<?php require '../app/views/layouts/footer.php'; ?>