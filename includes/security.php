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

// check if user still exists
if ($logged_in) {
    $sth = $dbc->prepare("SELECT id FROM user WHERE id = :id");
    $sth->execute([":id" => $_SESSION["user"]->id]);
    $res = $sth->fetch(PDO::FETCH_OBJ);
    // log user out
    if (empty($res)) {
        $logged_in = false;
        unset($_SESSION["user"]);
    }
}

// update user last login time tingy
if ($logged_in) {
    // to update last login date
    $sth = $dbc->prepare("UPDATE user SET last_changed = NOW() WHERE id = :id");
    $sth->execute([
      ":id" => $_SESSION["user"]->id,
    ]);
}

// stuff for blocked ips
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$sth = $dbc->prepare("SELECT blocked FROM ips WHERE ip_adres = :ip");
$sth->execute([":ip" => $ip]);
$res = $sth->fetchAll(PDO::FETCH_OBJ);

foreach ($res as $value) {
    if ($value->blocked === "1") {
        die("U bent geblokkeerd");
    }
}

// if not set everyone can see it
if (!isset($levels)) {
    $levels = ["gast", "gebruiker", "lid"];
}

if (!$logged_in) {
    $current_level = "gast";
} else {
    $current_level = $_SESSION["user"]->role_name;
}

// they can always go on every page, so I just always push them both.
$levels[] = "admin";
$levels[] = "redacteur";

if (!in_array($current_level, $levels)) {
    header("Location: inloggen?redirect=" . $_SERVER["REQUEST_URI"]);
    die();
}
