<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once("dbc.php");

// logout script
if (isset($_GET["logout"])) {
    unset($_SESSION["user"]);
}

// check loggedin status
$logged_in = !empty($_SESSION["user"]);
if ($logged_in) {
    // to update last login date
    $sth = $dbc->prepare("UPDATE user SET id = :id WHERE id = :id");
    $sth->execute([
      ":id" => $_SESSION["user"]->id,
    ]);
}
