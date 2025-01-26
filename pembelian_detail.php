<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM penjualan LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan WHERE id_penjualan = $id");
$data = mysqli_fetch_array($query);
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Detail Pembelian</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Detail Pembelian</li>
    </ol>
    <a href="?page=pembelian" class="btn btn-primary">Kembali</a>
    <hr>

    <table class="table table-bordered">
        <tr>
            <th width="200">Nama Pelanggan</th>
            <td width="1">:</td>
            <td><?= $data['nama_pelanggan']; ?></td>
        </tr>
        <?php
        $pro = mysqli_query($koneksi, "SELECT * FROM detail_penjualan LEFT JOIN produk ON produk.id_produk = detail_penjualan.id_produk WHERE id_penjualan = $id");
        $total = 0;
        while ($produk = mysqli_fetch_array($pro)) {
            $total += $produk['sub_total'];
        ?>
        <tr>
            <td><?= $produk['nama_produk']; ?></td>
            <td>:</td>
            <td>
                Harga Satuan: <?= number_format($produk['harga'], 0, ',', '.'); ?><br>
                Jumlah: <?= $produk['jumlah_produk']; ?><br>
                Sub Total: <?= number_format($produk['sub_total'], 0, ',', '.'); ?>
            </td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <th>Total</th>
            <td>:</td>
            <td><strong><?= number_format($total, 0, ',', '.'); ?></strong></td>
        </tr>
    </table>
</div>