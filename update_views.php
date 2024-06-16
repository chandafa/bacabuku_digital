<?php
// update_views.php

include "koneksi.php";
$db = new Database();
$conn = $db->getConnection();

if (isset($_GET['id_buku'])) {
    $id_buku = $_GET['id_buku'];

    // Update total_pembaca di tabel buku
    $sql_update_pembaca = "UPDATE buku SET total_pembaca = total_pembaca + 1 WHERE id_buku = $id_buku";
    $result = mysqli_query($conn, $sql_update_pembaca);

    if ($result) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing id_buku parameter']);
}
?>



<?php

if (isset($_GET['id_buku'])) {
    $id_buku = $_GET['id_buku'];
    $conn = mysqli_connect('localhost', 'root', '', 'db');

    if ($conn) {
        // Query untuk meningkatkan jumlah dilihat
        $sql = "UPDATE buku SET dilihat = dilihat + 1 WHERE id_buku = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_buku);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to connect to the database']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID buku tidak ditemukan']);
}

?>