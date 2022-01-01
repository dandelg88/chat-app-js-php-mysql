<?php session_start();

if (!isset($_SESSION['unique_id'])) {
    header('location: login.php');
}

$user_id = $_SESSION['unique_id'];

$conn = include './app/config.php';

$sql = "SELECT unique_id, fname, lname, email, img, status FROM users WHERE unique_id = '$user_id'";

$query = mysqli_query($conn, $sql);

$user_data = [];

if (mysqli_num_rows($query) > 0) {
    $user_data = mysqli_fetch_assoc($query);
} else {
    header('location: login.php');
}
?>
<?php include_once './header.php'; ?>
<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <div class="content">
                    <img src="./app/uploads/<?php echo $user_data['img']; ?>" alt="profile_photo">
                    <div class="details">
                        <span><?php echo $user_data['fname'] . ' ' . $user_data['lname']; ?></span>
                        <p><?php echo $user_data['status']; ?></p>
                    </div>
                </div>
                <a href="logout.php?user_id=<?php echo $user_data['unique_id']; ?>" class="logout">Cerrar sesión</a>
            </header>
            <div class="search">
                <span class="text">Selecciona un usuario para iniciar conversación</span>
                <input type="text" placeholder="Filtrar por nombre...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list"></div>
        </section>
    </div>
    <script src="./assets/js/users.js"></script>
</body>
</html>
