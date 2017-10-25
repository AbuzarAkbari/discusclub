<?php 
if(isset($_POST['post_reply']))
{
require_once('dbc.php');

    $reply_content = $_POST['reply_content'];
    $bericht_id = $_POST['bericht_id'];
    $reply_auteur = 1;
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
    header("Location: http://localhost/htdocs-backup/Stage/discusclub/bericht.php?id=".$bericht_id."#post-".$dbc->lastInsertId());
}