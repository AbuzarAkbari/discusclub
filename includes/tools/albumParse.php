<?php
if (isset($_POST['post_album_reply'])) {
    require_once("../../includes/tools/security.php");
    if ($logged_in) {
        $reply_content = $_POST['reply_content'];
        $album_id = $_POST['album_id'];
        $reply_auteur = $_SESSION['user']->id;
        $sql3 = "INSERT INTO album_reply (user_id, album_id, content, created_at) VALUES (:reply_auteur, :album_id, :reply_content, NOW())";

        $result3 = $dbc->prepare($sql3);
        $result3->bindParam(':album_id', $album_id);
        $result3->bindParam(':reply_auteur', $reply_auteur);
        $result3->bindParam(':reply_content', $reply_content);
        $result3->execute();
        header("Location: /album/" . $album_id);
    }
}
