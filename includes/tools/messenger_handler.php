<?php
$error = "";
$uploadOk = 1;
if(isset($_GET["id"])) {
    $sth = $dbc->prepare("UPDATE message SET opened = 1 WHERE user_id_1 IN (:id) OR user_id_2 IN (:id)");
    $sth->execute([":id" => $_GET["id"]]);
}
$m = !empty($_POST["message"]) || (isset($_FILES['upload']) && $_FILES['upload']['error'] !== 4);
if(isset($_POST["message"]) && isset($_POST["user_id_2"]) && $m) {
    $bindings = [":user_id_1" => $_SESSION["user"]->id, ":user_id_2" => $_POST["user_id_2"], ":message" => rmScript($_POST["message"])];
  //Image check
  if (isset($_FILES['upload']) && $_FILES['upload']['error'] !== 4) {
    $target_dir = "/images/messenger/";
    $target_file = $target_dir . basename($_FILES["upload"]["name"]);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["upload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $error = "bestand is geen afbeelding.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $error = "Sorry, er ging iets fout.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["upload"]["size"] > 500000) {
        $error = "Sorry, uw bestand is te groot.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $error = "Sorry, er mogen alleen JPG, JPEG, PNG & GIF bestanden worden geupload.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk != 0)  {
        $fragments = explode('.', $_FILES["upload"]["name"]);
        $path = "/messenger/". date("Y-m-d_H-i-s") . '.' . end($fragments);
        array_pop($fragments);

        $extensions = [
            '.png',
            '.jpg',
            '.jpeg',
            '.gif'
        ];

        if (move_uploaded_file($_FILES["upload"]["tmp_name"], '../../images'.$path)) {
            $sql = "INSERT INTO image (path) VALUES (?)";
            $result = $dbc->prepare($sql);
            $result->bindParam(1, $path);
            $result->execute();
            $bindings[":image_id"] = $dbc->lastInsertId();
        } else {
            $error = "Sorry, er was een error.";
        }
    }
}
    if(isset($bindings[":image_id"]) && empty($error) && $uploadOk != 0) {
        $sql = "INSERT INTO message(message, user_id_1, user_id_2, created_at, image_id) VALUES (:message, :user_id_1, :user_id_2, NOW(), :image_id)";
        $sth = $dbc->prepare($sql);
        $sth->execute($bindings);
    } else if(empty($error) && $uploadOk != 0) {
        $sql = "INSERT INTO message(message, user_id_1, user_id_2, created_at) VALUES (:message, :user_id_1, :user_id_2, NOW())";
        $sth = $dbc->prepare($sql);
        $sth->execute($bindings);
    }
}
