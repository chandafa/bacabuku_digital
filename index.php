<?php
include "koneksi.php";
$db = new Database();
$conn = $db->getConnection();

$sql = "SELECT * FROM buku";
$sql_add_visitor = "UPDATE buku SET total_pengunjung = total_pengunjung + 1";
mysqli_query($conn, $sql_add_visitor);
// $d = mysqli_query(mysqli_connect('localhost', 'root', '', 'db'), $sql);

// Query untuk mengambil total buku
$sql_total_buku = "SELECT * FROM buku";
$d = mysqli_query($conn, $sql_total_buku);
$jml = mysqli_num_rows($d);

// Query untuk mengambil total pengunjung
$sql_total_pengunjung = "SELECT SUM(total_pengunjung) as total_pengunjung FROM buku";
$result_total_pengunjung = mysqli_query($conn, $sql_total_pengunjung);
$total_pengunjung = mysqli_fetch_assoc($result_total_pengunjung)['total_pengunjung'];

// Query untuk mengambil total pembaca dari semua buku
$sql_total_pembaca = "SELECT SUM(total_pembaca) as total_pembaca FROM buku";
$result_total_pembaca = mysqli_query($conn, $sql_total_pembaca);
$total_pembaca = mysqli_fetch_assoc($result_total_pembaca)['total_pembaca'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require "inc/links.php" ?>
</head>

<body>
    <!-- navigation bar -->
    <?php require "inc/header.php" ?>
    <main>
        <!-- jumbotron -->
        <div class="jumbotron">
            <section class="py-3 text-center container">
                <div class="row py-lg-5 " id="head">
                    <div class="col-lg-6 col-md-8 mx-auto mt-5">
                        <img class="animate__animated animate__tada" src="img/logo.svg" alt="" height="80">
                        <p class="lead text-muted h-font">Baca buku apa saja secara <span style="font-weight: 600;">gratis</span> disini.</p>
                        <p>
                        <form class="d-flex" action="index.php" method="get">
                            <input class="form-control mx-2" name="cari" type="search" placeholder="cari buku disini..." aria-label="Search" id="boxcari">
                            <button class="btn btn-outline-secondary" type="submit" id="cari">Cari</button>
                        </form>
                        </p>


                        <div class="d-flex justify-content-between align-items-center mb-auto">
                            <small class="text-muted fw-bold">
                                Jumlah buku saat ini : <?php echo $jml; ?>
                            </small>
                            <br>
                            <small class="text-muted fw-bold">
                                Total Pengunjung : <?php echo $total_pengunjung; ?>
                            </small>
                            <br>
                            <small class="text-muted fw-bold">
                                Total Pembaca : <?php echo $total_pembaca; ?>
                            </small>
                        </div>

                    </div>
                </div>
            </section>
        </div>

        <div class="album py-4 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php
                    $no = 1;
                    // // memotong sinopsis
                    // function cutText($text, $length, $mode = 2)
                    // {
                    //     if ($mode != 1) {
                    //         $char = $text{
                    //             $length - 1};
                    //         switch ($mode) {
                    //             case 2:
                    //                 while ($char != ' ') {
                    //                     $char = $text{
                    //                         --$length};
                    //                 }
                    //         }
                    //     }
                    //     return substr($text, 0, $length);
                    // }
                    // Pagination
                    $batas = 6;
                    $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                    $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                    $previous = $halaman - 1;
                    $next = $halaman + 1;

                    $total_halaman = ceil($jml / $batas);

                    $nomor = $halaman_awal + 1;

                    if (isset($_GET['cari'])) {
                        $cari = $_GET['cari'];
                        // echo "<h4 class='text-center' style='text-transform: uppercase; letter-spacing: 2.5px;'>Hasil pencarian : " . $cari . "</h4>";
                        echo "<b>Hasil pencarian : " . $cari . "</b>";
                    }
                    if (isset($_GET['cari'])) {
                        $cari = $_GET['cari'];
                        $data_buku = mysqli_query(mysqli_connect('localhost', 'root', '', 'db'), "SELECT * FROM buku JOIN penulis USING (id_penulis) JOIN kategori USING (id_kategori) WHERE judul LIKE '%" . $cari . "%'");
                    } else {
                        $data_buku = mysqli_query(mysqli_connect('localhost', 'root', '', 'db'), "SELECT * FROM buku JOIN penulis USING (id_penulis) JOIN kategori USING (id_kategori) ORDER BY id_buku DESC LIMIT $halaman_awal, $batas ");
                    }
                    //Menampilkan data
                    while ($data = mysqli_fetch_array($data_buku)) {

                    ?>
                        <div class="col" id="home">
                            <div class="card border-0 shadow-sm">

                                <?php
                                if ($data['cover'] == true) {
                                    echo "<img class='thumbnail' height='225' src='file/cover/$data[cover]'>";
                                } else { ?>
                                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                                        <title>Placeholder</title>
                                        <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                                    </svg>

                                <?php
                                }
                                ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $data['judul'] ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $data['penulis'] ?></h6>
                                    <hr>
                                    <p class="card-text">
                                        <?php
                                        $text = $data['sinopsis'];
                                        // echo cutText($text, 180) . '...';
                                        ?>
                                    </p>
                                    <small class="text-muted text-center ms-4"><?php echo $data['jumlah_hlm'] ?>
                                        <span>halaman</span></small>
                                    <div class="d-flex justify-content-between align-items-center mb-auto">
                                        <div class="btn-group">
                                            <a href="view.php?id_buku=<?php echo $data['id_buku']; ?>" class="mr-1" onclick="updateViews(<?php echo $data['id_buku']; ?>)">
                                                <button type="button" class="btn btn-sm btn-outline-primary m-1">Baca
                                                    Buku</button>
                                            </a>
                                        </div>
                                        <small class="text-muted text-center ms-4" id="views-<?php echo $data['id_buku']; ?>">
                                            <?php echo $data['dilihat'] ?>X <span>Dibaca</span>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation ">
                    <ul class="pagination justify-content-center mt-5 pagination-circle">
                        <li class="page-item <?php if ($halaman <= 1) {
                                                    echo 'disabled';
                                                } ?>">
                            <a class="page-link" href="<?php if ($halaman <= 1) {
                                                            echo '#';
                                                        } else {
                                                            echo "?halaman=" . $previous;
                                                        } ?>">Sebelumnya</a>
                        </li>

                        <?php for ($i = 1; $i <= $total_halaman; $i++) : ?>
                            <li class="page-item <?php if ($halaman == $i) {
                                                        echo 'active';
                                                    } ?>">
                                <a class="page-link" href="index.php?halaman=<?= $i; ?>"> <?= $i; ?> </a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?php if ($halaman >= $total_halaman) {
                                                    echo 'disabled';
                                                } ?>">
                            <a class="page-link" href="<?php if ($halaman >= $total_halaman) {
                                                            echo '#';
                                                        } else {
                                                            echo "?halaman=" . $next;
                                                        } ?>">Selanjutnya</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php require "inc/footer.php" ?>

    <script>
        function updateViews(id_buku) {
            fetch(`update_views.php?id_buku=${id_buku}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Jika berhasil, perbarui tampilan jumlah dilihat
                        const viewsElement = document.getElementById(`views-${id_buku}`);
                        const currentViews = parseInt(viewsElement.innerText);
                        viewsElement.innerText = currentViews + 1;
                    } else {
                        console.error('Failed to update views');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
</body>

</html>