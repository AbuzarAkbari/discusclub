<?php
session_start();

if (isset($_GET["logout"])) {
    unset($_SESSION["user"]);
}

$logged_in = !empty($_SESSION["user"]);
if ($logged_in) {
    require_once("dbc.php");

    // to update last login date
    $sth = $dbc->prepare("UPDATE user SET id = :id WHERE id = :id");
    $sth->execute([
      ":id" => $_SESSION["user"]->id,
    ]);
}
