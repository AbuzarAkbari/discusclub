<?php

if(isset($_POST["message"]) && isset($_POST["user_id_2"])) {
    $bindings = [":user_id_1" => $_SESSION["user"]->id, ":user_id_2" => $_POST["user_id_2"], ":message" => $_POST["message"]];
  //Image check
  if (isset($_FILES['upload']) && $_FILES['upload']['error'] !== 4) {
    $target_dir = "/images/messenger/";
    $target_file = $target_dir . basename($_FILES["upload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["upload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["upload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";

        // if everything is ok, try to upload file
    } else {
        $fragments = explode('.', $_FILES["upload"]["name"]);
        $path = "/messenger/". date("Y-m-d_H:i:s") . '.' . end($fragments);
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
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    }
}
    if(isset($bindings[":image_id"])) {
        $sql = "INSERT INTO message(message, user_id_1, user_id_2, created_at, image_id) VALUES (:message, :user_id_1, :user_id_2, NOW(), :image_id)";
    } else {
        $sql = "INSERT INTO message(message, user_id_1, user_id_2, created_at) VALUES (:message, :user_id_1, :user_id_2, NOW())";
    }
    $sth = $dbc->prepare($sql);
    $sth->execute($bindings);
}