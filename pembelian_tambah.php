<?php
//tambah 
if (isset($_POST['id_pelanggan'])) {

    $id_pelanggan = $_POST['id_pelanggan'];
    $produk = $_POST['produk'];
    $total = 0;
    $tanggal = date('Y/m/d');

    //query tambah 
    $query = mysqli_query($koneksi, "INSERT INTO penjualan(tanggal_penjualan, id_pelanggan) VALUES('$tanggal', '$id_pelanggan')");

    // Ambil ID penjualan terakhir yang baru saja ditambahkan
    $idTerakhir = mysqli_fetch_array(mysqli_query($koneksi, "SELECT id_penjualan FROM penjualan ORDER BY id_penjualan DESC LIMIT 1"));
    $id_penjualan = $idTerakhir['id_penjualan'];

    foreach ($produk as $key => $val) {
        // Pastikan hanya produk dengan jumlah lebih dari 0 yang diproses
        $pr = mysqli_fetch_array(mysqli_query($koneksi, "SELECT harga FROM produk WHERE id_produk=$key"));

        if ($val > 0) {
            $sub = $val * $pr['harga'];
            $total += $sub;
            $query = mysqli_query($koneksi, "INSERT INTO detail_penjualan(id_penjualan, id_produk, jumlah_produk, sub_total) VALUES('$id_penjualan', '$key', '$val', '$sub')");

            $updateProduk = mysqli_query($koneksi, "UPDATE produk set stock=stock-$val WHERE id_produk=$key");
        }
    }

    // Update total harga dalam tabel penjualan
    $query = mysqli_query($koneksi, "UPDATE penjualan SET total_harga=$total WHERE id_penjualan=$id_penjualan");

    if ($query) {
        echo "<script>
                alert('Tambah Data Berhasil');
              </script>";
    } else {
        echo "<script>
                alert('Tambah Data Gagal');
              </script>";
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Pembelian</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pembelian</li>
    </ol>
    <a href="?page=pembelian" class="btn btn-primary">Kembali</a>
    <hr>

    <form method="post">
        <table>
            <tr>
                <td width="200">Nama Pelanggan</td>
                <td width="1">:</td>
                <td>
                    <select class="form-control form-select" name="id_pelanggan" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php
                        $p = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                        while ($pel = mysqli_fetch_array($p)) {
                        ?>
                        <option value="<?= $pel['id_pelanggan']; ?>"><?= $pel['nama_pelanggan']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <?php
            $pro = mysqli_query($koneksi, "SELECT * FROM produk");
            while ($produk = mysqli_fetch_array($pro)) {
            ?>
            <tr>
                <td><?= $produk['nama_produk'] . ' (Stock : ' . $produk['stock'] . ')' ?></td>
                <td>:</td>
                <td>
                    <input class="form-control" type="number" step="1" min="0" value="0" max="<?= $produk['stock']; ?>"
                        name="produk[<?= $produk['id_produk']; ?>]">
                </td>
            </tr>
            <?php
            }
            ?>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </td>
            </tr>
        </table>
    </form>
</div>