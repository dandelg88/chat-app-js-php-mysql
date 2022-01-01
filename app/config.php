<?php

$conn = mysqli_connect('localhost', 'root', '', 'chat_app');

if (!$conn) {
    echo 'Ha ocurrido un error al conectar. ' . mysqli_connect_error();
}

mysqli_set_charset($conn, 'utf8');

return $conn;
