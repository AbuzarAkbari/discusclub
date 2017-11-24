<?php
if (isset($_POST['post_reply'])) {
    require_once("../../includes/tools/security.php");
    if ($logged_in) {
        $reply_content = rmScript($_POST['reply_content']);
        $bericht_id = $_POST['bericht_id'];
        $reply_auteur = $_SESSION['user']->id;

        $sql3 = "INSERT INTO reply (topic_id, user_id, content, created_at) VALUES (:bericht_id, :reply_auteur, :reply_content, NOW())";

        $sql = "UPDATE topic SET last_changed = NOW() WHERE id = :bericht_id";
        $result = $dbc->prepare($sql);
        $result->bindParam(':bericht_id', $bericht_id);
        $result->execute();


        $result3 = $dbc->prepare($sql3);
        $result3->bindParam(':bericht_id', $bericht_id);
        $result3->bindParam(':reply_auteur', $reply_auteur);
        $result3->bindParam(':reply_content', $reply_content);
        $result3->execute();
        header("Location: /forum/post/" . $bericht_id . "/" . $_GET["pagina"] . "#post-" . $dbc->lastInsertId());
    }
}
