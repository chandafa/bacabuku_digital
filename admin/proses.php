<?php
include '../koneksi.php';

if ($_GET['aksi'] == 'tambah') {
    // Tangkap data dari form
    $judul = $_POST['judul'];
    $id_penulis = $_POST['id_penulis'];
    $id_kategori = $_POST['id_kategori'];
    $jumlah_hlm = $_POST['jumlah_hlm'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $isbn = $_POST['isbn']; // Ditambahkan untuk ISBN
    $lokasi = $_POST['lokasi']; // Ditambahkan untuk Lokasi Buku
    $sinopsis = $_POST['sinopsis'];

    // Upload file PDF
    $nama_file = $_FILES['nama_file']['name'];
    $tmp_file = $_FILES['nama_file']['tmp_name'];
    $dir_file = "../file/buku/";
    move_uploaded_file($tmp_file, $dir_file . $nama_file);

    // Upload cover
    $cover = $_FILES['cover']['name'];
    $tmp_cover = $_FILES['cover']['tmp_name'];
    $dir_cover = "../file/cover/";
    move_uploaded_file($tmp_cover, $dir_cover . $cover);

    // Query SQL untuk insert data buku
    $sql = "INSERT INTO buku (judul, id_penulis, id_kategori, jumlah_hlm, tahun_terbit, isbn, lokasi, sinopsis, nama_file, cover)
            VALUES ('$judul', '$id_penulis', '$id_kategori', '$jumlah_hlm', '$tahun_terbit', '$isbn', '$lokasi', '$sinopsis', '$nama_file', '$cover')";

    // Eksekusi query dan cek hasilnya
    $result = mysqli_query(mysqli_connect('localhost', 'root', '', 'db'), $sql);
    if ($result) {
        // Jika berhasil redirect atau beri pesan sukses
        echo "<script>alert('Buku berhasil ditambahkan');</script>";
        header('Location: index.php'); // Ganti dengan halaman yang sesuai
        exit;
    } else {
        // Jika gagal redirect atau beri pesan error
        echo "<script>alert('Gagal menambahkan buku');</script>";
        header('Location: tambah_buku.php'); // Ganti dengan halaman yang sesuai
        exit;
    }
}
