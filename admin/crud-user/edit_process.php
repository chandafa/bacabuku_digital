<?php // edit_process.php

include "database_conn.php";

if (count($_POST) > 0) {
    // ambil id dari customer sebagai penanda
    $id = $_POST["id"];

    $username = $_POST["username"];
    $name = $_POST["name"];
    $email = $_POST["email"];

    $query =
        "UPDATE customers set id='" .
        $id .
        "', username='" .
        $username .
        "', name='" .
        $name .
        "', email='" .
        $email .
        "' WHERE id='" .
        $id .
        "'"; // update form data from the database

    if (mysqli_query($db_connect, $query)) {
        $message = 2;
    } else {
        $message = 4;
    }
}
header("Location: index.php?message=" . $message . "");