<?php
session_start();

// Check apakah session email sudah ada atau belum.
// Jika belum maka akan diredirect ke halaman index (login)
if (empty($_SESSION['user'])) {
    header('Location: login.php');
}

include '../koneksi.php';
$db = new database();
$con = mysqli_connect('localhost', 'root', '', 'db');
$penulis = mysqli_query($con, "SELECT * FROM penulis ORDER BY penulis ASC");
$kategori = mysqli_query($con, "SELECT * FROM kategori ORDER BY kategori ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>BacaBuku! - Tambah Buku</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">
    <link rel="icon" type="image/svg" href="../img/fav.svg">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- Animasi -->
    <link rel="stylesheet" href="../css/animate.min.css">
</head>

<body>
    <!-- Navigation bar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #393E46;" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="../index.php">
                    <img src="../img/logo.svg" alt="" height="30">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../tentang.html">Tentang Kami</a>
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
        <!-- Jumbotron -->
        <div class="jumbotron">
            <section class="py-4 text-center container">
                <div class="row py-lg-5" id="head">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <img class="animate__animated animate__tada" src="../img/logo.svg" alt="" height="80">
                        <p class="lead text-muted">Baca buku apa saja secara <span
                                style="font-weight: 600;">gratis</span>
                            disini.</p>
                    </div>
                </div>
            </section>
        </div>

        <div class="album py-5 bg-light">
            <div class="container">
                <h4 class="text-center" style="text-transform: uppercase; letter-spacing: 2.5px;">Tambah Buku</h4>
                <form action="../proses.php?aksi=tambah" method="POST" enctype="multipart/form-data" class="mt-5">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" name="judul" placeholder="Judul" class="form-control" id="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <select name="id_penulis" class="form-control" id="penulis" required>
                            <option>--Pilih Penulis--</option>
                            <?php while ($data = mysqli_fetch_array($penulis)) : ?>
                            <option value="<?php echo $data['id_penulis']; ?>"><?php echo $data['penulis']; ?></option>
                            <?php endwhile; ?>
                        </select>
                        <a href="input_penulis.php">
                            <button class="btn btn-outline-secondary mx-2" type="button">Tambah Penulis</button>
                        </a>
                        <a href="list_penulis.php">
                            <button class="btn btn-outline-secondary" type="button">Lihat Daftar</button>
                        </a>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="id_kategori" class="form-control" id="kategori" required>
                            <option>--Pilih Kategori--</option>
                            <?php while ($data = mysqli_fetch_array($kategori)) : ?>
                            <option value="<?php echo $data['id_kategori']; ?>"><?php echo $data['kategori']; ?>
                            </option>
                            <?php endwhile; ?>
                        </select>
                        <a href="input_kategori.php">
                            <button class="btn btn-outline-secondary mx-2" type="button">Tambah Kategori</button>
                        </a>
                        <a href="list_kategori.php">
                            <button class="btn btn-outline-secondary" type="button">Lihat Daftar</button>
                        </a>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_hlm" class="form-label">Jumlah Halaman</label>
                        <input type="text" name="jumlah_hlm" placeholder="Jumlah Halaman" class="form-control"
                            id="jumlah_hlm" required>
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" placeholder="Tahun Terbit" class="form-control"
                            id="tahun">
                    </div>
                    <div class="mb-3">
                        <label for="sinopsis" class="form-label">Sinopsis</label>
                        <textarea name="sinopsis" placeholder="Sinopsis" class="form-control" id="sinopsis" rows="5"
                            minlength="20" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" name="isbn" placeholder="ISBN" class="form-control" id="isbn">
                    </div>
                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi Buku</label>
                        <input type="text" name="lokasi" placeholder="Lokasi Buku" class="form-control" id="lokasi">
                    </div>
                    <div class="mb-3">
                        <label for="nama_file" class="form-label">File PDF</label>
                        <div class="custom-file">
                            <input type="file" name="nama_file" class="custom-file-input" id="nama_file" required>
                            <label class="custom-file-label" for="nama_file">Pilih File PDF</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="cover" class="form-label">Cover</label>
                        <div class="custom-file">
                            <input type="file" name="cover" class="custom-file-input" id="cover" required>
                            <label class="custom-file-label" for="cover">Pilih Cover</label>
                        </div>
                    </div>
                    <div class="my-4">
                        <button type="submit" class="btn btn-primary me-md-2">Upload Buku</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button class="btn btn-secondary" type="button" onclick="goBack()">Batal</button>
                    </div>
                </form>
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
    <script>
    // Update nama file saat memilih file di input box
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    // Fungsi untuk kembali ke halaman sebelumnya
    function goBack() {
        window.history.back();
    }
    </script>

</body>

</html>