<?php
session_start();
$total = 0;
foreach ($_SESSION['pembelajaan'] as $belanja) {
    $total += $belanja['harga'] * $belanja['jumlah'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayar</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.hello {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 600px;
    width: 100%;
}

.judul {
    margin-bottom: 20px;
}

.masukan p {
    margin-bottom: 10px;
}

.bayar input[type="number"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 80%;
}

.total h3 {
    margin-top: 20px;
}
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.hello {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    padding: 20px;
    max-width: 600px;
    width: 100%;
}

.judul {
    margin-bottom: 20px;
}

.masukan p {
    margin-bottom: 10px;
}

.bayar input[type="number"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 80%;
}

.total h3 {
    margin-top: 20px;
}

.echo {
    color: red;
    margin-top: 10px;
}

.bayarr button {
    background-color: #3498db;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 20px;
    margin-bottom: 10px;
}

.bayarr button:hover {
    background-color: #2980b9;
}

a {
    color: #3498db;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}


    </style>
</head>
<body>
    <div class="hello">
        <div class="card">
            <div class="judul">
                <h2>Bayar Sekarang</h2>
            </div>
            <div class="masukan">
                <p>Masukan Nominal Uang</p>
            </div>
            <form action="" method="post">
                <div class="bayar">
                    <input type="number" name="bayar" placeholder="Pastikan uang yang Anda masukan cukup" required>
                </div>
                <div class="total">
                    <h3>Uang yang harus Anda bayarkan adalah <?= "Rp." . number_format($total, 0, ',', '.'); ?></h3>
                </div>
                <?php
                if (isset($_POST['cash'])) {
                    $uang = $_POST['bayar'];
                    $bayar = $uang - $total;
                    if ($bayar < 0) {
                        echo "<p class='echo'>Uang anda kurang Rp. " . number_format(abs($bayar), 0, ',', '.') . "!!</p>";
                    } else {
                        $_SESSION['kembalian'] = $bayar;
                        $_SESSION['bayar'] = $uang;
                        header("Location: strukbelanja.php");
                        exit();
                    }
                }
                ?>
                <div class="bayarr">
                    <button type="submit" name="cash">Bayar</button>
                </div>
                <a href="main.php">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>
