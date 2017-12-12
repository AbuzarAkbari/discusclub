<?php
loginOrRegister();

function loginOrRegister() {
    require_once("./security.php");
    require_once("./const.php");
    $sth = $dbc->prepare($USER_SELECT . " WHERE u.email = :email");
    $sth->execute([":email" => $_POST["email"]]);
    $res = $sth->fetch(PDO::FETCH_OBJ);

    if (!empty($res)) {

        // if($res->deleted_at) {
        //     header("Location: " . $_SERVER["REQUEST_URI"] . "?deleted");
        //     exit();
        // }

        $_SESSION["user"] = $res;
        echo '{"redirect": "' . (isset($_POST["redirect"]) ? $_POST["redirect"] : "/") . '"}';

    } else {
        $sth = $dbc->prepare("INSERT INTO user(first_name, last_name, username, email, created_at, birthdate) VALUES
                                              (:first_name, :last_name, :username, :email, NOW(), :birthdate)");

        $sth->execute([
            ":first_name" => $_POST["first_name"],
            ":last_name" => $_POST["last_name"],
            ":username" => $_POST["name"],
            ":email" => $_POST["email"],
            ":birthdate" => date('Y-m-d', strtotime($_POST["birthday"]))]);
        loginOrRegister();
    }
}