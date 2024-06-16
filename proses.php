<?php
// include 'koneksi.php';
// $db = new database();

// $aksi = $_GET['aksi'];
// if ($aksi == "tambah") {
//     $db->input_buku(trim($_POST['judul']), trim($_POST['id_penulis']), trim($_POST['id_kategori']), trim($_POST['jumlah_hlm']), trim($_POST['tahun_terbit']), date("Y-m-d H:i:s"), trim($_POST['isbn']), trim($_POST['lokasi']), trim($_POST['sinopsis']), trim($_FILES['nama_file']['name']), trim($_FILES['cover']['name']));
// } elseif ($aksi == "hapus") {
//     $db->hapus_buku($_GET['id_buku']);
// } elseif ($aksi == "update") {
//     $db->update_buku(trim($_POST['id_buku']), trim($_POST['judul']), trim($_POST['id_penulis']), trim($_POST['id_kategori']), trim($_POST['jumlah_hlm']), trim($_POST['tahun_terbit']), trim($_POST['isbn']), trim($_POST['lokasi']), trim($_POST['sinopsis']), trim($_FILES['cover']['name']));
// } elseif ($aksi == "tambah_penulis") {
//     $db->input_penulis(trim($_POST['penulis']));
// } elseif ($aksi == "hapus_penulis") {
//     $db->hapus_penulis($_GET['id_penulis']);
// } elseif ($aksi == "edit_penulis") {
//     $db->update_penulis(trim($_POST['id_penulis']), trim($_POST['penulis']));
// } elseif ($aksi == "tambah_kategori") {
//     $db->input_kategori(trim($_POST['kategori']));
// } elseif ($aksi == "hapus_kategori") {
//     $db->hapus_kategori($_GET['id_kategori']);
// } elseif ($aksi == "edit_kategori") {
//     $db->update_kategori(trim($_POST['id_kategori']), trim($_POST['kategori']));
// }

include 'koneksi.php';
$db = new database();

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

if ($aksi == "tambah") {
    // Tangkap data dari form
    $judul = trim($_POST['judul']);
    $id_penulis = trim($_POST['id_penulis']);
    $id_kategori = trim($_POST['id_kategori']);
    $jumlah_hlm = trim($_POST['jumlah_hlm']);
    $tahun_terbit = trim($_POST['tahun_terbit']);
    $sinopsis = trim($_POST['sinopsis']);
    $isbn = trim($_POST['isbn']);
    $lokasi = trim($_POST['lokasi']);
    $nama_file = trim($_FILES['nama_file']['name']);
    $cover = trim($_FILES['cover']['name']);
    $tgl_masuk = date("Y-m-d H:i:s"); // Tanggal masuk saat ini

    // Direktori untuk menyimpan file
    $dir_file = "../file/buku/";
    $dir_cover = "../file/cover/";

    // Upload file PDF dan cover
    move_uploaded_file($_FILES['nama_file']['tmp_name'], $dir_file . $nama_file);
    move_uploaded_file($_FILES['cover']['tmp_name'], $dir_cover . $cover);

    // Panggil method input_buku untuk memasukkan data ke database
    $db->input_buku($judul, $id_penulis, $id_kategori, $jumlah_hlm, $tahun_terbit, $tgl_masuk, $sinopsis, $isbn, $lokasi, $nama_file, $cover);
} elseif ($aksi == "hapus") {
    $db->hapus_buku($_GET['id_buku']);
} elseif ($aksi == "update") {
    // Tangkap data dari form
    $id_buku = trim($_POST['id_buku']);
    $judul = trim($_POST['judul']);
    $id_penulis = trim($_POST['id_penulis']);
    $id_kategori = trim($_POST['id_kategori']);
    $jumlah_hlm = trim($_POST['jumlah_hlm']);
    $tahun_terbit = trim($_POST['tahun_terbit']);
    $sinopsis = trim($_POST['sinopsis']);
    $isbn = trim($_POST['isbn']);
    $lokasi = trim($_POST['lokasi']);
    $cover = trim($_FILES['cover']['name']);

    // Upload cover jika ada perubahan
    if (!empty($cover)) {
        move_uploaded_file($_FILES['cover']['tmp_name'], $dir_cover . $cover);
    }

    // Panggil method update_buku untuk memperbarui data buku
    $db->update_buku($id_buku, $judul, $id_penulis, $id_kategori, $jumlah_hlm, $tahun_terbit, $sinopsis, $isbn, $lokasi, $cover);
} elseif ($aksi == "tambah_penulis") {
    $db->input_penulis(trim($_POST['penulis']));
} elseif ($aksi == "hapus_penulis") {
    $db->hapus_penulis($_GET['id_penulis']);
} elseif ($aksi == "edit_penulis") {
    $db->update_penulis(trim($_POST['id_penulis']), trim($_POST['penulis']));
} elseif ($aksi == "tambah_kategori") {
    $db->input_kategori(trim($_POST['kategori']));
} elseif ($aksi == "hapus_kategori") {
    $db->hapus_kategori($_GET['id_kategori']);
} elseif ($aksi == "edit_kategori") {
    $db->update_kategori(trim($_POST['id_kategori']), trim($_POST['kategori']));
}
