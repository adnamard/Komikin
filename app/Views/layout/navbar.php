<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Komikin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">About Us</a>
                </li>
            </ul>
            <?php if (session()->has('userData')) : ?>
                <ul class="navbar-nav" style="margin-left: -3cm;">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Keranjang</a>
                    </li>
                    <li class="nav-item dropdown ms-auto" style="padding-right: 3cm;">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Riwayat Peminjaman</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('Auth/logout'); ?>">Logout</a></li>
                        </ul>
                    </li>
                    <!-- Akhir bagian yang ingin dipindahkan ke sisi kanan -->
                </ul>
            <?php else : ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="<?= base_url('Auth/loginpage'); ?>" class="btn btn-outline-success">Login</a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>