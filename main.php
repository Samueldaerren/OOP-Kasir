<?php
session_start();

if (!isset($_SESSION['pembelajaan'])) {
    $_SESSION['pembelajaan'] = array();
}

if (isset($_POST['tambah'])) {
    $barang = $_POST['barang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    if (empty($barang) || empty($harga) || empty($jumlah)) {
        echo "Belanjaan kosong";
    } else {
        $nemu = false;
        foreach ($_SESSION['pembelajaan'] as &$item) {
            if ($item['barang'] === $barang) {
                $item['jumlah'] += $jumlah;
                $nemu = true;
                break;
            }
        }

        if (!$nemu) {
            $belajaan = array(
                'barang' => $barang,
                'harga' => $harga,
                'jumlah' => $jumlah
            );
            array_push($_SESSION['pembelajaan'], $belajaan);
        }
    }
}

if (isset($_POST['hapus'])) {
    if (isset($_POST['hapuss'])) {
        $belanjaa = $_POST['hapuss'];
        unset($_SESSION['pembelajaan'][$belanjaa]);
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}

if (isset($_POST['bayar'])) {
    if (empty($_SESSION['pembelajaan'])) {
        echo "Mohon Mengisi Barang Yang Inggin Dibeli!";
    } else {
        header("Location: bayar.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="formbelanja">
        <h1>Toko Permata</h1>
    </div>
    <form action="" method="post">
        <div class="barang">
            <input type="text" name="barang" pattern="[a-zA-Z]+" placeholder="Masukan Barang" required>
        </div>
        <div class="harga">
            <input type="text" name="harga" pattern="[0-9]+" placeholder="Harga" required>
        </div>
        <div class="jumlah">
            <input type="text" name="jumlah" pattern="[0-9]+" placeholder="Jumlah" required>
        </div>
        <div class="tambah">
            <button type="submit" name="tambah">Tambah</button>
        </div>
    </form>
    <br>
    <table border="1" cellpadding="6" cellspacing="6">
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <?php
        $i = 1;
        $total = 0;
        foreach ($_SESSION['pembelajaan'] as $belanjaa => $belanja) :
            $total += $belanja['harga'] * $belanja['jumlah'];
        ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= htmlspecialchars($belanja['barang']) ?></td>
            <td><?= "Rp." . number_format($belanja['harga'], 0, ',', '.') ?></td>
            <td><?= htmlspecialchars($belanja['jumlah']) ?></td>
            <td><?= number_format($belanja['harga'] * $belanja['jumlah'], 0, ',', '.') ?></td>
            <td>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="hapuss" value="<?= $belanjaa ?>">
                    <button type="submit" name="hapus">Hapus</button>
                </form>
            </td>
        </tr>
        <?php $i++; endforeach; ?>
        <tr>
            <td colspan="5"> Total Barang</td>
            <td><?= count($_SESSION['pembelajaan']) ?></td>
        </tr>
        <tr>
            <td colspan="5">Total Belanja</td>
            <td><?= "Rp." . number_format($total, 0, ',', '.') ?></td>
        </tr>
        <tr>
            <td colspan="6">
                <form action="" method="post">
                    <button type="submit" name="bayar">Bayar</button>
                </form>
            </td>
        </tr>
    </table>
</body>
</html>
