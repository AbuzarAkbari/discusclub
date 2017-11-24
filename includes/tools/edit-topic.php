<?php
require_once("../../includes/tools/security.php");
if($logged_in) {
    if(isset($_POST['post_edit_topic'])) {
        $id = $_POST['subId'];
        $title = rmScript($_POST['edit_topic_title']);
        $content = rmScript($_POST['edit_topic_content']);

        $sql = "UPDATE topic SET title = :title, content = :content WHERE id = :id";
        $result = $dbc->prepare($sql);
        $result->execute([":title" => $title, ":content" => $content, ":id" => $id]);

        header("Location: /forum/topic/".$id);
    }
}
