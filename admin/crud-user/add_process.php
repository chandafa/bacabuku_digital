<?php // add_process.php

include "database_conn.php";

if (count($_POST) > 0) {
    $username = $_POST["username"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, name, email, password) VALUES ('$username', '$name', '$email', '$password')";

    if (mysqli_query($db_connect, $query)) {
        $message = 1;
    } else {
        $message = 4;
    }
}

header("Location: index.php?message=" . $message . "");