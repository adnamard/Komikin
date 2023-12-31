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
<div class="container mt-5 mb-10 d-flex flex-column align-items-center text-center">
    <img class="img-profile rounded-circle hover-zoom" src="/img/logo.jpg" style="max-width: 200px;">
    <div style="margin-top:15px">
        <h1 id="hoverTypewriter" style="color: #FDFBEE;">Komikin</h1>
        <h3 class="hover-text">Baca komik dimanapun, kapanpun!</h3>
    </div>
</div>

<div class="container mb-10 d-flex flex-column align-items-center text-center" style="margin-top: 250px;">
    <div style="margin-top:15px;margin-bottom:5px">
        <h1 class="hover-text">---== Koleksi Komik ==---</h1>
    </div>
    <div class="row">
        <?php foreach ($komik as $k) : ?>
            <div class="col-md-4 mb-10;" style="margin-bottom: 20px;">
                <div class="card " style="width: 380px; height: 750px;background-color: rgba(255, 255, 255, 0.45); border-radius: 20px;">
                    <img src="/img/<?= $k['sampul']; ?>" class="card-img-top hover-zoom" alt="Comic Image" style="border-radius: 18px;">
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
                            <button class="btn btn-outline-dark d-block mx-auto" onclick="showLoginModal()">Beli Komik</button>
                        </div>
                    <?php endif ?>

                    <!-- Modal HTML -->
                    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="loginModalLabel">Pemberitahuan</h5>
                                    <button type="button" class="close" onclick="redirectToHome()" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Silakan login terlebih dahulu untuk membeli komik.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function showLoginModal() {
                            $('#loginModal').modal('show');
                        }

                        function redirectToHome() {
                            window.location.href = '/'; // Replace '/' with your homepage URL
                        }
                    </script>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?= $this->endSection(); ?>