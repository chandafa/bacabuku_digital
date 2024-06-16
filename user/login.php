<?php
session_start();

// Cek apakah user sudah login
if (isset($_SESSION["user"])) {
    // Jika user adalah admin, alihkan ke halaman admin
    if ($_SESSION["user"]["role"] === "admin") {
        header("Location: ../admin/index.php");
        exit();
    } else {
        // Jika user adalah user biasa, alihkan ke halaman timeline
        header("Location: timeline.php");
        exit();
    }
}

require_once("config.php");

if (isset($_POST['login'])) {

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM users WHERE username=:username OR email=:email";
    $stmt = $db->prepare($sql);

    // Bind parameter ke query
    $params = array(
        ":username" => $username,
        ":email" => $username
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Jika user terdaftar
    if ($user) {
        // Verifikasi password
        if (password_verify($password, $user["password"])) {
            // Buat session
            $_SESSION["user"] = [
                "username" => $user["username"],
                "name" => $user["name"], // Simpan nama user
                "email" => $user["email"], // Simpan email user
                "photo" => $user["photo"], // Simpan foto user
                "role" => $user["role"] // Pastikan role disimpan dalam sesi
            ];
            // Login sukses, alihkan ke halaman yang sesuai dengan role
            if ($user["role"] === "admin") {
                header("Location: ../admin/index.php");
            } else {
                header("Location: timeline.php");
            }
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Pesbuk</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">

                <p>&larr; <a href="../index.php">Home</a>

                <h4>Masuk ke Pojok Baca</h4>
                <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>

                <form action="" method="POST">

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" name="username" placeholder="Username atau email" />
                    </div>


                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Password" />
                    </div>

                    <input type="submit" class="btn btn-success btn-block" name="login" value="Masuk" />

                </form>

            </div>

            <div class="col-md-6">
                <!-- isi dengan sesuatu di sini -->
            </div>

        </div>
    </div>

</body>

</html>