<?php
// facebook api call if data do shit
$data = file_get_contents("https://graph.facebook.com/me?fields=id,address,first_name,last_name,birthday,email,name&access_token=" . $_POST["accessToken"]);
$data = json_decode($data);
if(isset($data) && isset($data->id)) {
    loginOrRegister($data);
}

function loginOrRegister($data) {
    require_once("./security.php");
    require_once("./const.php");

    $sth = $dbc->prepare($USER_SELECT . " WHERE u.email = :email");
    $sth->execute([":email" => $data->email]);
    $res = $sth->fetch(PDO::FETCH_OBJ);

    if (!empty($res)) {

        $_SESSION["user"] = $res;
        echo '{"redirect": "' . (isset($_POST["redirect"]) ? $_POST["redirect"] : "/") . '"}';

    } else {
        $sth = $dbc->prepare("INSERT INTO user(first_name, last_name, username, email, created_at, birthdate) VALUES
                                              (:first_name, :last_name, :username, :email, NOW(), :birthdate)");

        $sth->execute([
            ":first_name" => $data->first_name,
            ":last_name" => $data->last_name,
            ":username" => $data->name,
            ":email" => $data->email,
            ":birthdate" => date('Y-m-d', strtotime($data["birthday"]))]);
        loginOrRegister($data);
    }
}