<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App en tiempo real - Javascript, PHP & MySQL</title>
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="./assets/fonts/poppins/poppins.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Chat App en tiempo real</header>
            <form action="#">
                <div class="error-text">¡Éste es un mensaje de error!</div>
                <div class="name-details">
                    <div class="field input">
                        <label>Nombre</label>
                        <input type="text" placeholder="Nombre">
                    </div>
                    <div class="field input">
                        <label>Apellido</label>
                        <input type="text" placeholder="Apellido">
                    </div>
                </div>
                <div class="field input">
                    <label>Dirección de correo</label>
                    <input type="text" placeholder="Ingresa tu correo">
                </div>
                <div class="field input">
                    <label>Contraseña</label>
                    <input type="password" placeholder="Ingresa una contraseña">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Selecciona una foto de perfil</label>
                    <input type="file">
                </div>
                <div class="field button">
                    <input type="submit" value="Continua al chat">
                </div>
            </form>
            <div class="link">¿Ya tienes cuenta? <a href="#">Ingresa ahora</a></div>
        </section>
    </div>
    <script src="./assets/js/pass-show-hide.js"></script>
</body>
</html>
