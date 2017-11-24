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

// stuff for ips
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

unset($_SESSION["ip_id"]);

if (!isset($_SESSION["ip_id"])) {
    // get ip address id from the db
    $bindings = [":ip" => $ip];
    if (isset($_SESSION["user"])) {
        $sth = $dbc->prepare("SELECT id FROM ip WHERE ip_address = :ip AND user_id = :user_id");
        $bindings["user_id"] = $_SESSION["user"]->id;
    } else {
        $sth = $dbc->prepare("SELECT id FROM ip WHERE ip_address = :ip");
    }
    $sth->execute($bindings);
    $res = $sth->fetch(PDO::FETCH_ASSOC);


    // if the ip isn't in the database insert it
    if (empty($res)) {
        if (isset($_SESSION["user"])) {
            $sth = $dbc->prepare("INSERT INTO ip(ip_address, user_id, created_at) VALUES (:ip, :user_id, NOW())");
        } else {
            $sth = $dbc->prepare("INSERT INTO ip(ip_address, created_at) VALUES (:ip, NOW())");
        }
        $sth->execute($bindings);
        $res = ["id" => $dbc->lastInsertId()];
    }

    // store it in session
    $_SESSION["ip_id"] = $res["id"];
}

$sth = $dbc->prepare("SELECT blocked FROM ip WHERE id = :ip_id");
$sth->execute([":ip_id" => $_SESSION["ip_id"]]);
$res = $sth->fetch(PDO::FETCH_OBJ);


if ($res->blocked === "1") {
    die("U bent geblokkeerd");
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
    header("Location: /user/login?redirect=" . urlencode($_SERVER["REQUEST_URI"]));
    die();
}

$admin_levels = ["admin", "redacteur"];

require_once("../tools/script_remover.php");
