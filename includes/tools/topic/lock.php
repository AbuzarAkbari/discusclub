<?php
require_once("../../../includes/tools/security.php");

if($logged_in){

    $state_id = 2; //lock
    $id = $_GET['id'];
    $sub_id = $_GET['sub_id'];
    $sql = "UPDATE topic SET state_id = :state_id WHERE id = :id";
    $result = $dbc->prepare($sql);
    $result->execute([":state_id" => $state_id, ":id" => $id]);

    header("Location: /forum/topic/".$sub_id);
}