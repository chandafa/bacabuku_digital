<?php // delete.php


include "database_conn.php";

$id = $_GET["id"];

$query = "DELETE FROM users WHERE id='" . $id . "'";

if (mysqli_query($db_connect, $query)) {
    $message = 3;
} else {
    $message = 4;
}

header("Location: index.php?message=" . $message . "");