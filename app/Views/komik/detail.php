<?= $this->extend('layout/templateadmin'); ?> #Kita kasih tau CI kalo kita bakalan render template
<?= $this->section('contentadmin') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Detail Komik</h2>
            <div class="card mb-3" style="width:750px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $komik['sampul']; ?>" class="img-fluid rounded-start" alt="..."> <!-- Gambar diambil dari tabel komik bagian sampul-->
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title"><?= $komik['judul']; ?></h3><!-- judul diambil dari tabel komik bagian judul-->
                            <p class="card-text"><b>Penulis : <?= $komik['penulis']; ?></b></p>
                            <p class="card-text"><b>Genre : <?= $komik['genre']; ?></b></p>
                            <p class="card-text"><b>Stok : <?= $komik['stok']; ?></b></p>
                            <p class="card-text"><b>Harga : <?= $komik['harga']; ?></b></p><!-- penulis diambil dari tabel komik bagian penulis-->
                            <p class="card-text"><small class="text-body-secondary"><b>Sinopsis : <?= $komik['sinopsis']; ?></b></p><!-- penerbit diambil dari tabel komik bagian penerbit-->

                            <br>

                            <a href="/Admin/edit/<?= $komik['judul']; ?>" class="btn btn-warning ">Edit</a>

                            <form action="/admin/delete/<?= $komik['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Delete</button>
                            </form>
                            <br></br>
                            <a href="/komik" class="btn btn-outline-dark d-block mx-auto">Kembali ke daftar komik</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>