<?php session_start();

$conn = include __DIR__ . '/config.php';

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($email) && !empty($password)) {
    // verificar que el email este asociado al registro de un usuario
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);

        //verificar que la contraseña ingresada coincida con el registro del usuario
        if ($password === $row['password']) {
            $status = 'en línea';
            $sql2 = "UPDATE users SET status = '$status' WHERE unique_id = {$row['unique_id']}";

            if (mysqli_query($conn, $sql2)) {
                $_SESSION['unique_id'] = $row['unique_id'];
                echo 'success';
            }
        } else {
            echo '¡Contraseña incorrecta!';
        }
    } else {
        echo '¡Usuario no registrado!';
    }
} else {
    echo '¡Ingresa tus credenciales de acceso!';
}
