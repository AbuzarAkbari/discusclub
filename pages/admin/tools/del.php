<?php
require_once("../../../includes/tools/security.php");
if($logged_in)
{
    $sql = "UPDATE reply SET deleted_at = NOW()";
    $result = $dbc->prepare($sql);
    $result->execute();

    header("Location: ../../forum/");
}