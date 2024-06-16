<?php
session_start();

// check apakah session user sudah ada atau belum
if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// check apakah user adalah admin
if ($_SESSION['user']['role'] !== 'admin') {
    // jika bukan admin, alihkan ke halaman pengguna
    header('Location: ../index.php'); // atau halaman lain yang sesuai
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>BacaBuku! - Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">
    <link rel="icon" type="image/svg" href="../img/fav.svg">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- custom css -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- Animasi -->
    <link rel="stylesheet" href="../css/animate.min.css">

</head>

<body>
    <!-- navigation bar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #393E46;" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="../index.php">
                    <img src="../img/logo1.png" alt="" height="30">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/logout.php">
                                <button class="btn btn-primary" type="button" id="logout"
                                    style="height: auto; width:100px;">Keluar</button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <!-- jumbotron -->
        <div class="jumbotron">
            <section class="py-4 text-center container">
                <div class="row py-lg-5" id="head">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <img class="animate__animated animate__tada" src="../img/logo.svg" alt="" height="80">
                        <p class="lead text-muted">Baca buku apa saja secara <span
                                style="font-weight: 600;">gratis</span> disini.</p>
                    </div>
                </div>
            </section>
        </div>

        <div class="album py-5 bg-light">
            <div class="container">
                <h4 class="text-center my-3" style="text-transform: uppercase; letter-spacing: 2.5px;">Halaman
                    <?php echo $_SESSION['user']['role'] === 'admin' ? 'Admin' : 'Pengguna'; ?></h4>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3">
                    <!-- Input Buku -->
                    <div class="col" id="home">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title mt-3 mb-4">Tambah Buku</h5>
                                <div class="text-center mb-3">
                                    <a href="../admin/input_buku.php"><button type="button"
                                            class="btn btn-sm btn-outline-primary"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Tambah
                                            Buku</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- List Buku -->
                    <div class="col" id="home">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title mt-3 mb-4">Daftar Buku</h5>
                                <div class="text-center mb-3">
                                    <a href="../admin/list_buku.php"><button type="button"
                                            class="btn btn-sm btn-outline-primary"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Daftar
                                            Buku</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- List Penulis -->
                    <div class="col" id="home">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title mt-3 mb-4">Daftar Penulis</h5>
                                <div class="text-center mb-3">
                                    <a href="../admin/list_penulis.php"><button type="button"
                                            class="btn btn-sm btn-outline-primary"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Daftar
                                            Penulis</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- List Kategori -->
                    <div class="col" id="home">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title mt-3 mb-4">Daftar Kategori</h5>
                                <div class="text-center mb-3">
                                    <a href="../admin/list_kategori.php"><button type="button"
                                            class="btn btn-sm btn-outline-primary"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Daftar
                                            Kategori</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">

                    <?php require 'pengunjung.php' ?>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="text-muted py-5 shadow-sm">
        <div class="container">
            <p class="mb-1">Desa Lamajang</p>
            <p class="mb-0">Teknik Informatika Universitas Pasundan &copy; 2024</p>
        </div>
    </footer>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.5.1.min.js"></script>

</body>

</html>