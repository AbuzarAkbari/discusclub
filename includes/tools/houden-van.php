<?php
    require_once('security.php');

    if (isset($_POST['send'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $img = $_POST['image'];



        $insert = "INSERT INTO `image`('path') VALUES (:path)";
        $result = $dbc->prepare($insert);
        $result->execute(['path' => $img]);

        $update = "UPDATE `page` SET name = :name, content = :content , image_id = :image_id ";
        $result = $dbc->prepare($update);
        $result->execute([':name' => $title , ':content' => $content, ':image_id' => $img]);

        header('Location: /page');
    }

    if (isset($_FILES['background']) && $_FILES['background']['error'] !== 4) {
        $target_dir = "/images/messenger_background/";
        $target_file = $target_dir . basename($_FILES["background"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["background"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $error = "Sorry, geen fotobestand gevonden.";
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["background"]["size"] > 500000) {
            $error = "Sorry, het bestand is te groot";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $error = "Sorry, alleen JPG, JPEG, PNG & GIF bestanden zijn toegestaan.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            header("Location: /user/conf?error=".$error);
            exit();

        } else {
            $fragments = explode('.', $_FILES["background"]["name"]);
            $path = "/messenger_background/".$_SESSION["user"]->username . '.' . end($fragments);
            array_pop($fragments);
            $extensions = [
                '.png',
                '.jpg',
                '.jpeg',
                '.gif'
            ];
            foreach ($extensions as $extension) {
                if (file_exists(__DIR__ . '/' . $target_dir . $_SESSION["user"]->username . $extension)) {
                    unlink(__DIR__ . '/' . $target_dir . $_SESSION["user"]->username . $extension);
                }
            }
            if (move_uploaded_file($_FILES["background"]["tmp_name"], '../../images'.$path)) {
                $sql = "INSERT INTO image (path) VALUES (?)";
                $result = $dbc->prepare($sql);
                $result->bindParam(1, $path);
                $result->execute();
                $id = $dbc->lastInsertId();
                //Update user table->profile_img
                $query .= ", messenger_img = :messenger_background_image";
                $bindings[":messenger_background_image"] = $id;
            } else {
                $error = "Sorry, er ging iets mis met het uploaden.";
                exit();
            }
        }
    }
