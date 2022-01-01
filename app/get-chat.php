<?php session_start();

if (
    isset($_SESSION['unique_id'])
    && !empty($_SESSION['unique_id'])
) {
    $html = '';
    if (
        isset($_POST['outgoing_id'], $_POST['incoming_id'] )
        && !empty($_POST['outgoing_id'])
        && !empty($_POST['incoming_id'])
    ) {
        $conn = include __DIR__ . '/config.php';
        $msg_sender_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $msg_receiver_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $sql = "SELECT messages.*, users.img sender_img FROM messages
                LEFT JOIN users ON users.unique_id = messages.sender_id
                WHERE messages.sender_id = $msg_sender_id AND messages.receiver_id = $msg_receiver_id
                OR messages.sender_id = $msg_receiver_id AND messages.receiver_id = $msg_sender_id
                ORDER BY messages.id";

        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0) {
            while ($msg_data = mysqli_fetch_assoc($query)) {
                if ($msg_data['sender_id'] === $msg_sender_id) {
                    $html .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $msg_data['content'] . '</p>
                                </div>
                            </div>';
                } else {
                    $html .= '<div class="chat incoming">
                                <img src="./app/uploads/' . $msg_data['sender_img']. '" alt="profile_photo">
                                <div class="details">
                                    <p>' . $msg_data['content'] . '</p>
                                </div>
                            </div>';
                }
            }
        }

        echo $html;
    }
} else {
    header("location: login.php");
}
