<?php
if (isset($_POST['post_add_topic'])) {
    require_once("../../includes/tools/security.php");
    if ($logged_in) {
        $subId = $_POST['subId'];
        $topicTitle = $_POST['add_topic_title'];
        $topicAuteur = $_SESSION['user']->id;
        $topicContent = htmlentities($_POST['add_topic_content']);

        $sql = "INSERT INTO topic (sub_category_id, title, user_id, content) VALUES (:subId, :topicTitle, :topicAuteur, :topicContent)";

        $result = $dbc->prepare($sql);

        $result->bindParam(':subId', $subId);
        $result->bindParam(':topicTitle', $topicTitle);
        $result->bindParam(':topicAuteur', $topicAuteur);
        $result->bindParam(':topicContent', $topicContent);

        $result->execute();

        $lastId = $dbc->lastInsertId();

        header("Location: http://localhost/htdocs-backup/Stage/discusclub/bericht.php?id=".$lastId);
    }
}
