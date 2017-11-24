<?php
require_once("../../includes/tools/security.php");
if ($logged_in) {
    if (isset($_POST["send"])) {
        $error = '';

        $title = rmScript($_POST['title']);
        $content = rmScript($_POST['content']);
        $slug = $_POST['slug'];

        // echo '<pre>';
        // var_dump($_POST);
        // exit();

        //Start query
        $query = "UPDATE page SET name = :name, content = :content";
        $pageId = $_POST["id"];
        $bindings = [":uri" => $slug, ":name" => $title, ":content" => $content];

        //Image check
        if (isset($_FILES['image']) && $_FILES['image']['error'] !== 4) {
            $target_dir = "/images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $error = "Sorry, geen fotobestand gevonden.";
                $uploadOk = 0;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                $error = "Sorry, het bestand bestaat al.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["image"]["size"] > 500000) {
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
                header("Location: /page/?error=".$error);
                exit();


                // if everything is ok, try to upload file
            } else {
                $fragments = explode('.', $_FILES["image"]["name"]);
                // echo '<pre>';
                // var_dump($fragments);
                // exit();
                $path =  "/page/".$slug . '.' . end($fragments);
                // echo '<pre>';
                // var_dump($path);
                // exit();
                array_pop($fragments);
                $extensions = [
                    '.png',
                    '.jpg',
                    '.jpeg',
                    '.gif'
                ];
                if (move_uploaded_file($_FILES["image"]["tmp_name"], "../../images/" . $path)) {
                    $sql = "INSERT INTO image (path) VALUES (?)";
                    $result = $dbc->prepare($sql);
                    $result->bindParam(1, $path);
                    $result->execute();
                    $id = $dbc->lastInsertId();
                    //Update user table->profile_img
                    $query .= ", image_id = :image_id";
                    $bindings[":image_id"] = $id;
                } else {
                    $error = "Sorry, er ging iets mis met het uploaden.";
                    exit();
                }
            }
        }
        //End query
        $query .= " WHERE uri = :uri";
        $result = $dbc->prepare($query);
        // echo '<pre>';
        // var_dump($bindings, $query);
        // exit();
        $result->execute($bindings);

        header("Location: /admin/page");

    }
}