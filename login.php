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
        <section class="form login">
            <header>Chat App en tiempo real</header>
            <form action="#" autocomplete="off">
                <div class="error-text"></div>
                <div class="field input">
                    <label>Dirección de correo</label>
                    <input type="text" name="email" placeholder="Ingresa tu correo">
                </div>
                <div class="field input">
                    <label>Contraseña</label>
                    <input type="password" name="password" placeholder="Ingresa tu contraseña">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="submit" value="Continua al chat">
                </div>
            </form>
            <div class="link">¿Aún no tienes cuenta? <a href="/">Regístrate ahora</a></div>
        </section>
    </div>
    <script src="./assets/js/pass-show-hide.js"></script>
    <script src="./assets/js/login.js"></script>
</body>
</html>
