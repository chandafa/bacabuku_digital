<?php
include "koneksi.php";
$db = new Database();

$sql = "SELECT * FROM buku";
$d = mysqli_query(mysqli_connect('localhost', 'root', '', 'db'), $sql);
$jml = mysqli_num_rows($d);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>BacaBuku!</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">
    <link rel="icon" type="image/svg" href="img/fav.svg">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Animasi -->
    <link rel="stylesheet" href="css/animate.min.css">

</head>

<body>
    <!-- navigation bar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #393E46;" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="img/logo1.png" class="logo1" alt="" height="30">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="tentang.php">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="kontak.php">Kontak</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <!-- jumbotron -->
        <div class="jumbotron">
            <section class="py-1 text-center container">
                <img src="img/logo1.png" class="logo1" alt="" height="120" style="margin-top: 100px;">
                <div class="row py-lg-5" id="head">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <img class="animate__animated animate__tada" src="img/logo.svg" alt="" height="80">
                        <p class="lead text-muted" style="text-align: justify;">Selamat datang di website <span style="font-weight: 600;">BacaBuku</span> Desa Lamajang, ruang baca digital yang
                            diciptakan untuk mendukung semangat literasi dan edukasi di Desa Lamajang. Kami berkomitmen
                            untuk menyediakan akses informasi yang luas dan beragam bagi semua lapisan masyarakat,
                            dengan tujuan meningkatkan pengetahuan dan kecintaan terhadap membaca.
                            <br>
                            <br>
                            <br>
                            <span style="font-weight: 600;">BacaBuku</span> Desa Lamajang adalah sebuah inisiatif lokal
                            yang menyediakan platform online bagi
                            warga desa untuk mengakses berbagai macam buku, artikel, dan materi edukasi lainnya secara
                            gratis. Website ini dirancang untuk menjadi pusat literasi digital yang mudah diakses oleh
                            semua kalangan, dari anak-anak hingga orang dewasa.
                        </p>

                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-muted py-5 shadow-sm">
        <div class="container">
            <p class="mb-1">Desa Lamajang </p>
            <p class="mb-0">Teknik Informatika Universitas Pasundan &copy; 2024</p>
        </div>
    </footer>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>

</body>

</html>