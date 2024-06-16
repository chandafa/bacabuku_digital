<?php
require_once("config.php");

$error = ""; // Variable untuk menyimpan pesan error

if (isset($_POST['register'])) {

    // filter data yang diinputkan
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];

    // Check if username or email already exists
    $sql = "SELECT * FROM users WHERE username=:username OR email=:email";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":username" => $username,
        ":email" => $email
    );

    $stmt->execute($params);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Jika user sudah ada, tampilkan pesan error
        $error = "Username atau email sudah terdaftar";
    } else {
        // jika tidak ada user yang sama, lanjutkan proses pendaftaran

        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // menyiapkan query
        $sql = "INSERT INTO users (name, username, email, password) 
                VALUES (:name, :username, :email, :password)";
        $stmt = $db->prepare($sql);

        // bind parameter ke query
        $params = array(
            ":name" => $name,
            ":username" => $username,
            ":password" => $password,
            ":email" => $email
        );

        // eksekusi query untuk menyimpan ke database
        $saved = $stmt->execute($params);

        // jika query simpan berhasil, maka user sudah terdaftar
        // maka buat session dan alihkan ke halaman timeline
        if ($saved) {
            session_start();
            $_SESSION["user"] = [
                "username" => $username,
                "name" => $name,
                "email" => $email,
                "role" => "user"  // Atur default role sebagai "user"
            ];
            echo "<script>
                    alert('Registrasi berhasil! Anda akan diarahkan ke halaman timeline.');
                    window.location.href = 'timeline.php';
                  </script>";
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
    <title>Register Pesbuk</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">

                <p>&larr; <a href="../index.php">Home</a></p>

                <h4>Mari budayakan membaca</h4>
                <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>

                <?php if (!empty($error)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">

                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input class="form-control" type="text" name="name" placeholder="Nama kamu" />
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" name="username" placeholder="Username" />
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" placeholder="Alamat Email" />
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Password" />
                    </div>

                    <input type="submit" class="btn btn-success btn-block" name="register" value="Daftar" />

                </form>

            </div>

            <div class="col-md-6">
                <img class="img img-responsive" src="img/connect.png" />
            </div>

        </div>
    </div>

</body>

</html>