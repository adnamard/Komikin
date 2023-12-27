<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php if (session()->has('success')) : ?>
    <div class="alert alert-success">
        <?= session('success') ?>
    </div>
<?php elseif (session()->has('error')) : ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>

<div class="container mx-auto" style="margin-top: 225px;">
    <div class="row">
        <?php foreach ($komik as $k) : ?>
            <div class="col-md-4 mb-4;" style="margin-bottom: 20px;">
                <div class="card" style="width: 25rem;background-color: rgba(255, 255, 255, 0.45); border-radius: 20px;">
                    <img src="/img/<?= $k['sampul']; ?>" class="card-img-top" alt="Comic Image">
                    <div class="card-body">
                        <h5 class="card-title"><?= $k['judul']; ?></h5>
                        <p class="card-text" style="font-size: 14px;"><?= $k['sinopsis']; ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Penulis: <?= $k['penulis']; ?></li>
                        <li class="list-group-item">Genre: <?= $k['genre']; ?></li>

                        <li class="list-group-item">Harga: IDR. <?= $k['harga']; ?></li>
                    </ul>
                    <?php if (session()->has('userData')) : ?>
                        <div class="card-body">
                            <a href="/checkout/add/<?= $k['id']; ?>" class="btn btn-outline-dark d-block mx-auto">Beli Komik</a>
                        </div>
                    <?php else : ?>
                        <div class="card-body">
                            <button class="btn btn-outline-dark d-block mx-auto" onclick="showAlert()">Beli Komik</button>
                        </div>
                    <?php endif ?>

                    <script>
                        function showAlert() {
                            alert('Maaf, anda harus login terlebih dahulu untuk membeli komik.');
                        }
                    </script>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?= $this->endSection(); ?>