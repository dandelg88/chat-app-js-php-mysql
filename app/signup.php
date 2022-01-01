<?php session_start();

$conn = include __DIR__ . '/config.php';

$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    // verificar que el email sea una dirección válida
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // verificar que el correo exista en la base de datos
        $sql = "SELECT email FROM users WHERE email = '$email'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0) {
            echo '¡La dirección de correo ya existe!';
        } else if (! empty($_FILES['profile_img']['name'])) {
            $img_name = $_FILES['profile_img']['name'];
            // $img_type = $_FILES['profile_img']['type'];
            $tmp_name = $_FILES['profile_img']['tmp_name'];

            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode);

            $allowed_extensions = ['jpeg', 'jpg', 'png'];

            if (in_array($img_ext, $allowed_extensions, true)) {
                // guardar la imágen subida por el usuario a una carpeta en nuestro servidor
                $time = time();
                $new_img_name = $time . $img_name;

                if (move_uploaded_file($tmp_name, __DIR__ . '/uploads/' . $new_img_name)) {
                    $status = 'en línea';
                    $unique_id = rand(time(), 10000000);

                    $sql = "INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES ("
                            . "$unique_id, '$fname', '$lname', '$email', '$password', '$new_img_name', '$status')";

                    if (mysqli_query($conn, $sql)) {
                        $sql = "SELECT * FROM users WHERE email = '$email'";
                        $query = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($query) > 0) {
                            $row = mysqli_fetch_assoc($query);
                            $_SESSION['unique_id'] = $row['unique_id'];
                            echo 'success';
                        }
                    } else {
                        echo '¡Ha ocurrido un error, intenta nuevamente!';
                    }
                }
            } else {
                echo 'Selecciona una imágen válida (jpeg jpg png).';
            }
        } else {
            echo 'Por favor, selecciona una imágen de perfil.';
        }
    } else {
        echo '¡La dirección de correo es inválida!';
    }
} else {
    echo '¡Todos los campos son requeridos!';
}
