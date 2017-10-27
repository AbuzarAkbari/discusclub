<?php

require_once("includes/security.php");

if($logged_in) {

    require_once('dbc.php');

    if(isset($_POST["profiel_parse"])) {

        //Start query
        $query = "UPDATE user SET";
        $userId = $_POST["user_id"];
        $bindings = [":userId" => $userId];

        //Nieuwsbrief
        if(isset($_POST['nieuwsbrief']))
        {
            if($_POST['nieuwsbrief'] == "checked")
            {
                $news = 1;
                $query .= ", news = :news";
                $bindings[":news"] = $news;
            }
            else
            {
                $news = 0;
                $query .= ", news = :news";
                $bindings[":news"] = $news;
            }
        }

        //Email
        if($_POST['email'] === $_POST['repeat_email'])
        {
            $email = $_POST['email'];
            $query .= ", email = :email";
            $bindings[":email"] = $email;
        }

        //Geboortedatum
        if(isset($_POST['date']))
        {
            $date = $_POST['date'];
            $query .= " birthdate = :birthdate";
            $bindings[":birthdate"] = $date;
        }

        //Locatie
        if(isset($_POST['location']))
        {
            $location = $_POST['location'];
            $query .= ", location = :location";
            $bindings[":location"] = $location;
        }

        //Handtekening
        if(isset($_POST['signature']))
        {
            $signature = $_POST['signature'];
            $query .= ", signature = :signature";
            $bindings[":signature"] = $signature;
        }

        //Image check
        if(isset($_FILES['profiel']))
        {
            $target_dir = "images/profiel/";
            $target_file = $target_dir . basename($_FILES["profiel"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["profiel"]["tmp_name"]);
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
//                $time = time();
//                $path = $target_dir.$time.'-'.$_FILES["profiel"]["name"];
                $fragments = explode('.', $_FILES["profiel"]["name"]);
                $path = $_SESSION["user"]->username . '.' . end($fragments);
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



                if(move_uploaded_file($_FILES["profiel"]["tmp_name"], 'images/profiel/'.$path)) {
                    $sql = "INSERT INTO image (path) VALUES (?)";
                    $result = $dbc->prepare($sql);
                    $result->bindParam(1, $path);
                    $result->execute();
                    $id = $dbc->lastInsertId();

                    //Update user table->profile_img
                    $query .= ", profile_img = :profile_image";
                    $bindings[":profile_image"] = $id;

                } else {
                    echo "Sorry, there was an error uploading your file.";
                    exit();
                }
            }
        }

        //End query
        $query .= " WHERE id = :userId";

        echo "<pre>";
        var_dump($query);
        var_dump($bindings);
        echo "</pre>";

        $result = $dbc->prepare($query);
        $result->execute($bindings);

        header("Location: /");
    }

}