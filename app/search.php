<?php session_start();

if (
    isset($_SESSION['unique_id'])
    && !empty($_SESSION['unique_id'])
) {
    $conn = include __DIR__ . '/config.php';
    $sender_id = $_SESSION['unique_id'];
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    if (!empty($search)) {
        $html = '';
        $sql = "SELECT unique_id, fname, lname, img, status FROM users
                WHERE NOT unique_id = $sender_id
                AND (fname LIKE '%$search%' OR lname LIKE '%$search%')";

        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0) {
            while ($user_data = mysqli_fetch_assoc($query)) {
                $sql2 = "SELECT * FROM messages WHERE (receiver_id = " . $user_data['unique_id'] . " OR sender_id = " . $user_data['unique_id'] . ")
                    AND (receiver_id = " . $sender_id . " OR sender_id = " . $sender_id . ")
                    ORDER BY id DESC LIMIT 1";

                $query2 = mysqli_query($conn, $sql2);
                $msg_data = mysqli_fetch_assoc($query2);

                if (mysqli_num_rows($query2) > 0) {
                    $last_msg = $msg_data['content'];
                } else {
                    $last_msg = "Sin mensajes disponibles.";
                    $msg_data['sender_id'] = '';
                }

                $last_msg = strlen($last_msg) > 28 ? substr($last_msg, 0, 28) . '...' : $last_msg;

                $sender_user = $sender_id === $msg_data['sender_id'] ? 'Tú: ' : '';

                $html .= '<a href="chat.php?user_id=' . $user_data['unique_id'] . '">
                        <div class="content">
                            <img src="./app/uploads/' . $user_data['img'] . '" alt="profile_photo">
                            <div class="details">
                                <span>' . $user_data['fname'] . ' ' . $user_data['lname'] . '</span>
                                <p>' . $sender_user . $last_msg . '</p>
                            </div>
                        </div>
                        <div class="status-dot"><i class="fas fa-circle"></i></div>
                    </a>';
            }
        } else {
            $html .= "<p style='text-align: center;'>No hay resultados para: $search</p>";
        }

        echo $html;
    }
} else {
    header("location: login.php");
}
