<?php
include "koneksi.php";
$db = new Database();

$sql = "SELECT * FROM buku";
$d = mysqli_query(mysqli_connect('localhost', 'root', '', 'db'), $sql);
$jml = mysqli_num_rows($d);

require_once("auth.php");

// Cek apakah data user tersedia di session
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pesbuk Timeline</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">

                <div class="card">
                    <div class="card-body text-center">

                        <img class="img img-responsive rounded-circle mb-3" width="160" src="img/default.svg" />

                        <h3><?php echo  $_SESSION["user"]["name"] ?></h3>
                        <p><?php echo $_SESSION["user"]["email"] ?></p>

                        <p><a class="btn btn-primary" href="logout.php">Logout</a></p>
                    </div>
                </div>


            </div>


            <div class="album py-4 bg-light">
                <div class="container">
                    <a href="../index.php" class="btn btn-primary">Kembali</a>
                </div>
            </div>

        </div>
    </div>

</body>

</html>