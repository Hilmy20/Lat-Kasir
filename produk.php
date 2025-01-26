<div class="container-fluid px-4">
    <h1 class="mt-4">Produk</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Produk</li>
    </ol>
    <a href="?page=produk_tambah" class="btn btn-primary">+ Tambah Data</a>
    <hr>
    <table class="table">
        <tr>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stock</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM produk");
        while ($data = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?= $data['nama_produk'] ?></td>
            <td><?= $data['harga'] ?></td>
            <td><?= $data['stock'] ?></td>
            <td>
                <a href="?page=produk_ubah&&id=<?= $data['id_produk']; ?>" class="btn btn-secondary">Ubah</a>
                <a href="?page=produk_hapus&&id=<?= $data['id_produk']; ?>" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>