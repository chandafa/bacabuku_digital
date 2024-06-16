<?php
$ip      = $_SERVER['REMOTE_ADDR']; // Dapatkan IP user
$tanggal = date("Ymd"); // Dapatkan tanggal sekarang
$waktu   = time(); // Dapatkan nilai waktu

$konek = mysqli_connect("localhost", "root", "", "db");

// Cek user yang mengakses berdasarkan IP-nya 
$s = mysqli_query($konek, "SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
// Kalau belum ada, simpan datanya sebagai user baru
if (mysqli_num_rows($s) == 0) {
    mysqli_query($konek, "INSERT INTO statistik(ip, tanggal, hits, online) VALUES('$ip', '$tanggal', '1', '$waktu')");
}
// Kalau sudah ada, update data hits user  
else {
    mysqli_query($konek, "UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
}

$query1     = mysqli_query($konek, "SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip");
$pengunjung = mysqli_num_rows($query1);

$query2        = mysqli_query($konek, "SELECT COUNT(hits) as total FROM statistik");
$hasil2        = mysqli_fetch_array($query2);
$totpengunjung = $hasil2['total'];

$query3 = mysqli_query($konek, "SELECT SUM(hits) as jumlah FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal");
$hasil3 = mysqli_fetch_array($query3);
$hits   = $hasil3['jumlah'];

$query4  = mysqli_query($konek, "SELECT SUM(hits) as total FROM statistik");
$hasil4  = mysqli_fetch_array($query4);
$tothits = $hasil4['total'];

// Cek berapa pengunjung yang sedang online
$bataswaktu       = time() - 300;
$pengunjungonline = mysqli_num_rows(mysqli_query($konek, "SELECT * FROM statistik WHERE online > '$bataswaktu'"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Pengunjung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>

    </style>
</head>

<body>

    <div class="container">
        <div class="statistik-card">
            <h3>Statistik Pengunjung</h3>
            <div class="statistik-item">
                <i class="bi bi-calendar-day"></i>
                <span>Pengunjung hari ini: <?php echo $pengunjung; ?></span>
            </div>
            <div class="statistik-item">
                <i class="bi bi-person"></i>
                <span>Total pengunjung: <?php echo $totpengunjung; ?></span>
            </div>
            <div class="statistik-item">
                <i class="bi bi-bar-chart"></i>
                <span>Hits hari ini: <?php echo $hits; ?></span>
            </div>
            <div class="statistik-item">
                <i class="bi bi-bar-chart-fill"></i>
                <span>Total hits: <?php echo $tothits; ?></span>
            </div>
            <div class="statistik-item">
                <i class="bi bi-person-lines-fill"></i>
                <span>Pengunjung Online: <?php echo $pengunjungonline; ?></span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>