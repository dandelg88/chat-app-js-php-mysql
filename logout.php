<?php session_start();

if (
    isset($_SESSION['unique_id'])
    && !empty($_SESSION['unique_id'])
) {
    $conn = include __DIR__ . '/app/config.php';
    $user_id = mysqli_real_escape_string($conn, $_SESSION['unique_id']);
    $status = "no conectado";
    $sql = "UPDATE users SET status = '$status' WHERE unique_id = $user_id";

    if (mysqli_query($conn, $sql)) {
        session_unset();
        session_destroy();
        header("location: login.php");
    }
} else {
    header("location: login.php");
}
