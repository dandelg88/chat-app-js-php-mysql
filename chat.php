<?php session_start();

if (!isset($_SESSION['unique_id'])) {
    header('location: login.php');
}

$conn = include './app/config.php';

$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);

$sql = "SELECT unique_id, fname, lname, img, status FROM users WHERE unique_id = '$user_id'";

$query = mysqli_query($conn, $sql);

$user_data = [];

if (mysqli_num_rows($query) > 0) {
    $user_data = mysqli_fetch_assoc($query);
} else {
    header('location: users.php');
}
?>
<?php include_once './header.php'; ?>
<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="./app/uploads/<?php echo $user_data['img']; ?>" alt="profile_photo">
                <div class="details">
                    <span><?php echo $user_data['fname'] . ' ' . $user_data['lname']; ?></span>
                    <p><?php echo $user_data['status']; ?></p>
                </div>
            </header>
            <div class="chat-box"></div>
            <form action="#" class="typing-area">
                <input type="hidden" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>">
                <input type="hidden" name="incoming_id" value="<?php echo $user_id; ?>">
                <input type="text" name="message" class="input-field" placeholder="Escribe un mensaje aquí...">
                <button type="submit"><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
    <script src="./assets/js/chat.js"></script>
</body>
</html>
