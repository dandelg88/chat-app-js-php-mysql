<?php session_start();

if (
    isset($_SESSION['unique_id'])
    && !empty($_SESSION['unique_id'])
) {
    $conn = include __DIR__ . '/config.php';

    if (
        isset($_POST['message'], $_POST['outgoing_id'], $_POST['incoming_id'])
        && !empty($_POST['message'])
        && !empty($_POST['outgoing_id'])
        && !empty($_POST['incoming_id'])
    ) {
        $msg_sender_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $msg_receiver_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        if (!empty($message)) {
            $sql = "INSERT INTO messages (sender_id, receiver_id, content)
                    VALUES ($msg_sender_id, $msg_receiver_id, '$message')";

            if (mysqli_query($conn, $sql)) {
                echo 'success';
            } else {
                echo 'El mensaje no pudo enviarse. Intenta nuevamente';
            }
        }
    } else {
        echo "El contenido del mensaje está vacío";
    }
} else {
    header("location: login.php");
}
