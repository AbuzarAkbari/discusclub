<?php
session_start();
$loggen_in = !empty($_SESSION["user"]);
if ($loggen_in) {
    require_once("dbc.php");

    // to update last login date
    $sth = $dbc->prepare("UPDATE user SET id = :id WHERE id = :id");
    $sth->execute([
      ":id" => $_SESSION["user"]->id,
    ]);
}
