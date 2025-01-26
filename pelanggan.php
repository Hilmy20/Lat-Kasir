<div class="container-fluid px-4">
    <h1 class="mt-4">Pelanggan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pelanggan</li>
    </ol>
    <a href="?page=pelanggan_tambah" class="btn btn-primary">+ Tambah Data</a>
    <hr>
    <table class="table">
        <tr>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM pelanggan");
        while ($data = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?= $data['nama_pelanggan'] ?></td>
            <td><?= $data['alamat'] ?></td>
            <td><?= $data['no_telepon'] ?></td>
            <td>
                <a href="?page=pelanggan_ubah&&id=<?= $data['id_pelanggan']; ?>" class="btn btn-secondary">Ubah</a>
                <a href="?page=pelanggan_hapus&&id=<?= $data['id_pelanggan']; ?>" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>