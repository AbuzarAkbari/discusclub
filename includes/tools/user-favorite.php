<?php
require_once("../../includes/tools/security.php");

if($logged_in) {
    $user_id = $_SESSION['user']->id;
    $topic_id = $_GET['id'];

    $sql = "INSERT INTO favorite (user_id, topic_id) VALUES (:user_id, :topic_id)";
    $result = $dbc->prepare($sql);
    $result->execute([":user_id" => $user_id, ":topic_id" => $topic_id]);

    header("Location: /forum/post/".$topic_id);
}