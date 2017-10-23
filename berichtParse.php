<?php 
if(isset($_POST['post_reply']))
{
require_once('dbc.php');

    $reply_content = $_POST['reply_content'];
    $bericht_id = $_POST['bericht_id'];
    $reply_auteur = 1;
    $sql3 = "INSERT INTO reply (topic_id, user_id, content, created_at) VALUES (".$bericht_id.", '".$reply_auteur."', '".$reply_content."', NOW())";


    $result3 = $dbc->prepare($sql3);
    $result3->execute();
    header("Location: http://localhost/Stage/discusclub/bericht.php?id=".$bericht_id);
}