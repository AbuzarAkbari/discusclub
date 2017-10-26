<?php

require_once("includes/security.php");
if($logged_in)
{
    require_once('dbc.php');

    $target_dir = "images/profiel/";
    $target_file = $target_dir . basename($_FILES["profiel"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    // Check if image file is a actual image or fake image
    if(isset($_POST["profiel_parse"])) {
        $check = getimagesize($_FILES["profiel"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["profiel"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";

    // if everything is ok, try to upload file
    } else {
        $time = time();
        $path = $target_dir.$time.'-'.$_FILES["profiel"]["name"];

        if (move_uploaded_file($_FILES["profiel"]["tmp_name"], $path)) {
            $sql = "INSERT INTO image (path) VALUES (?)";
            $result = $dbc->prepare($sql);
            $result->bindParam(1, $path);
            $result->execute();

            $id = $dbc->lastInsertId();
            $updateSql = "UPDATE user SET profile_img = :profile_image_id WHERE id = :id";
            $updatResult = $dbc->prepare($updateSql);
            $updatResult->bindParam(':profile_image_id', $id);
            $updatResult->bindParam(':id', $_SESSION['user']->id);
            $updatResult->execute();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}