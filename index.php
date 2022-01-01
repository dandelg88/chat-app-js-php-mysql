<?php session_start();

if (
    isset($_SESSION['unique_id'])
    && !empty($_SESSION['unique_id'])
) {
    header('location: users.php');
}

?>
<?php include_once './header.php'; ?>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Chat App en tiempo real</header>
            <form action="#" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>
                <div class="name-details">
                    <div class="field input">
                        <label>Nombre</label>
                        <input type="text" name="fname" placeholder="Nombre" required>
                    </div>
                    <div class="field input">
                        <label>Apellido</label>
                        <input type="text" name="lname" placeholder="Apellido" required>
                    </div>
                </div>
                <div class="field input">
                    <label>Dirección de correo</label>
                    <input type="email" name="email" placeholder="Ingresa tu correo" required>
                </div>
                <div class="field input">
                    <label>Contraseña</label>
                    <input type="password" name="password" placeholder="Ingresa una contraseña" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Selecciona una foto de perfil</label>
                    <input type="file" name="profile_img" required>
                </div>
                <div class="field button">
                    <input type="submit" value="Continua al chat">
                </div>
            </form>
            <div class="link">¿Ya tienes cuenta? <a href="login.php">Ingresa ahora</a></div>
        </section>
    </div>
    <script src="./assets/js/pass-show-hide.js"></script>
    <script src="./assets/js/signup.js"></script>
</body>
</html>
