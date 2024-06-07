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
