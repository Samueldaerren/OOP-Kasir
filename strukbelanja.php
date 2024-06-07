<?php
session_start();
$total_belanja = 0;
foreach ($_SESSION['pembelajaan'] as $belanjaa => $belanja) {
    $total += $belanja['harga'] * $belanja['jumlah'];
}
$bayar = $_SESSION['bayar'] - $total;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk belanja</title>
    <link rel="stylesheet" href="styless.css">
    <script>
        function updateDateTime() {
            const dateElement = document.getElementById('liveDate');
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            const formattedDate = now.toLocaleDateString('id-ID', options);
            dateElement.innerHTML = formattedDate;
        }

        setInterval(updateDateTime, 1000);

        function printPage() {
            window.print();
        }
    </script>
</head>

<body onload="updateDateTime()">
    <div class="hello">
        <div class="container">
            <div class="judul">
                <h1>Bukti Pembayaran</h1>
            </div>
            <div class="random">
                <div class="rand">
                    <h4>No.Transaksi#<?= rand() ?></h4>
                </div>
                <div class="alon">
                    <h4>Bulan, Tanggal# <span id="liveDate"></span></h4>
                </div>
            </div>
            <hr>
            <?php
            foreach ($_SESSION['pembelajaan'] as $belanjaa => $belanja) :
            ?>
                <div class="nama">
                    <p><?= $belanja['barang'] ?></p>
                    <div class="harga">
                        <p>Rp. <?= number_format($belanja['harga'], 0, ',', '.') ?></p>
                        <div class="jumlah">
                            <p><b>x<?= $belanja['jumlah'] ?></b></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <hr>
            <div class="total">
                <p>Uang yang dibayarkan adalah</p>
                <div class="uang">
                    <p>Rp. <?= number_format($_SESSION['bayar'], 0, ',', '.') ?></p>
                </div>
            </div>
            <div class="total">
                <p>Total harga</p>
                <div class="uang">
                    <p>Rp. <?= number_format($total, 0, ',', '.') ?></p>
                </div>
            </div>
            <div class="total">
                <p>Kembalian</p>
                <div class="uang">
                    <p>Rp. <?= number_format($bayar, 0, ',', '.') ?></p>
                </div>
            </div>
            <div class="ref">
                <p>Terimakasih telah berbelanja di toko <b>Permata</b></p>
                <a href="main.php" onclick="<?php session_destroy(); ?>">Kembali</a>
            </div>
            <div class="ref">
                <button onclick="printPage()">Cetak</button>
            </div>
        </div>
    </div>
</body>

</html>
