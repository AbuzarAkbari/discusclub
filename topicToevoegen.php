<?php
if(isset($_POST['post_add_topic']))
{
    require_once('dbc.php');

    $subId= $_POST['subId'];
    $topicTitel = $_POST['add_topic_title'];
    $topicContent = $_POST['add_topic_content'];
    $topicId = $_POST['topic_id'];
    $topicAuteur = "John Doe";
    $sql = "INSERT INTO topic (sub_category_id, title, user_id, content, date) VALUES (".$subId.", '".$topicTitel."', '".$topicAuteur."', '".$topicContent."', NOW())";

    $result = $dbc->prepare($sql);
    $result->execute();
    header("Location: http://localhost/Stage/discusclub/topics.php?id=".$subId);
}