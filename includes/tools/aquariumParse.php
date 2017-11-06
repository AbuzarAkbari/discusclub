<?php
if (isset($_POST['post_aquarium_reply'])) {
    require_once("../../includes/tools/security.php");
    if ($logged_in) {
        $reply_content = $_POST['reply_content'];
        $aquarium_id = $_POST['aquarium_id'];
        $reply_auteur = $_SESSION['user']->id;
        $sql3 = "INSERT INTO aquarium_reply (user_id, aquarium_id, content, created_at) VALUES (:reply_auteur, :aquarium_id, :reply_content, NOW())";

        $result3 = $dbc->prepare($sql3);
        $result3->bindParam(':aquarium_id', $aquarium_id);
        $result3->bindParam(':reply_auteur', $reply_auteur);
        $result3->bindParam(':reply_content', $reply_content);
        $result3->execute();
        header("Location: /aquarium/" . $aquarium_id);
    }
}