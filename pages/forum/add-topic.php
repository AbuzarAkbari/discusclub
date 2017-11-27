<?php
if (isset($_POST['post_add_topic'])) {
    require_once("../../includes/tools/security.php");
    if ($logged_in) {
        $subId = $_POST['subId'];
        $topicTitle = rmScript($_POST['add_topic_title']);
        $topicAuteur = $_SESSION['user']->id;
        $topicContent = rmScript($_POST['add_topic_content']);

        $sql = "INSERT INTO topic (sub_category_id, title, user_id, content, created_at) VALUES (:subId, :topicTitle, :topicAuteur, :topicContent, NOW())";

        $result = $dbc->prepare($sql);

        $result->bindParam(':subId', $subId);
        $result->bindParam(':topicTitle', $topicTitle);
        $result->bindParam(':topicAuteur', $topicAuteur);
        $result->bindParam(':topicContent', $topicContent);

        $result->execute();

        $lastId = $dbc->lastInsertId();

        $insertSql = "INSERT INTO topic_permission (topic_id, role_id) SELECT :topic_id, id FROM role";
        $insertQuery = $dbc->prepare($insertSql);
        $insertQuery->execute([":topic_id" =>$lastId]);

        header("Location: /forum/post/".$lastId);
    }
}