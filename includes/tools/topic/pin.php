<?php
require_once("../../../includes/tools/security.php");

if($logged_in){

    $state_id = 3; //pin
    $id = $_GET['id'];
    $sql = "UPDATE topic SET state_id = :state_id WHERE id = :id";
    $result = $dbc->prepare($sql);
    $result->execute([":state_id" => $state_id, ":id" => $id]);

    header("Location: /forum/topic/".$id);
}