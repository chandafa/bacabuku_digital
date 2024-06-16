<?php // message.php

$messages = [
    1 => "Data successfully added",
    2 => "Data successfully updated",
    3 => "Data successfully deleted",
    4 => "MySQL Database Error, please check the entered query",
];

$messages_id = isset($_GET["message"]) ? (int) $_GET["message"] : 0;

if ($messages_id != 0 && in_array($messages_id, [1, 2, 3, 4])) {
    echo $messages[$messages_id];
} else {
    echo "Data Pengguna ";
}