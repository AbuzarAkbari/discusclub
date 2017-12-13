<?php
// facebook api call if data do shit
require_once("./security.php");
$data = file_get_contents("https://graph.facebook.com/me?fields=id,address,first_name,last_name,birthday,email,name,picture{url}&access_token=" . $_POST["accessToken"]);
$data = json_decode($data);

if(isset($data) && isset($data->id)) {
    loginOrRegister($data, $dbc);
}

function loginOrRegister($data, $dbc) {
    require("./const.php");

    $sth = $dbc->prepare($USER_SELECT . " WHERE u.email = :email");
    $sth->execute([":email" => $data->email]);
    $res = $sth->fetch(PDO::FETCH_OBJ);

    if (!empty($res)) {

        $_SESSION["user"] = $res;
        echo '{"redirect": "' . (isset($_POST["redirect"]) ? $_POST["redirect"] : "/") . '"}';

    } else {

        if($data->picture) {
            $info = pathinfo($data->picture->data->url);
            $ext = substr($info["extension"], 0, strpos($info["extension"], "?"));
            file_put_contents("../../images/profile/" . $data->name . "." . $ext, file_get_contents($data->picture->data->url));

            $sth = $dbc->prepare("INSERT INTO image(path) VALUES(:path)");
            $sth->execute([":path" => "/profile/" . $data->name . "." . $ext]);

        }

        $sth = $dbc->prepare("INSERT INTO user(first_name, last_name, username, email, created_at, birthdate, password, profile_img) VALUES
                                                (:first_name, :last_name, :username, :email, NOW(), :birthdate, '', :img_id)");

        $sth->execute([
            ":first_name" => $data->first_name,
            ":last_name" => $data->last_name,
            ":username" => $data->name,
            ":email" => $data->email,
            ":birthdate" => date('Y-m-d', strtotime($data->birthday)),
            ":img_id" => $data->picture ? $dbc->lastInsertId() : 1
        ]);


        loginOrRegister($data, $dbc);
    }
}