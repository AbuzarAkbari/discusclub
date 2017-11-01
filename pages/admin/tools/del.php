<?php
require_once("../../../includes/tools/security.php");
if($logged_in)
{
    $sql = "DELETE FROM topic WHERE id = :id";
    $result = $dbc->prepare($sql);
    $result->bindParam(':id', $_GET['id']);
    //$result->execute();

//    echo '<pre>';
//    var_dump($_GET['id']);
//    exit();

    //header("Location: ../../forum/");
}