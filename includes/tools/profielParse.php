<?php

require_once("../../includes/tools/security.php");

if ($logged_in) {
    if (isset($_POST["profiel_parse"])) {
        //Start query
        $query = "UPDATE user SET id = :userId";
        $userId = $_POST["user_id"];
        $bindings = [":userId" => $userId];

        //Nieuwsbrief
        if ($_POST['nieuwsbrief'] == "on") {
            $news = 1;
            $query .= ", news = :news";
            $bindings[":news"] = $news;
        } else {
            $news = 0;
            $query .= ", news = :news";
            $bindings[":news"] = $news;
        }

        //Nieuw wachtwoord
        if(isset($_POST['new_password'])) {
            if($_POST['new_password'] != $_POST['new_password_repeat']) {
                echo "Wachtwoorden komen niet overeen.";
                exit();
            }
            else
            {
                $new_password = $_POST['new_password'];
                $password = password_hash($new_password, PASSWORD_BCRYPT);
                $query .= ", password = :password";
                $bindings[":password"] = $password;
            }
        }

        //Email
        if ($_POST['email'] === $_POST['repeat_email']) {
            $email = $_POST['email'];
            $query .= ", email = :email";
            $bindings[":email"] = $email;
        } else {
            echo "Email adressen komen niet overeen";
            exit();
        }

        //Geboortedatum
        if (isset($_POST['date'])) {
            $date = $_POST['date'];
            $query .= ", birthdate = :birthdate";
            $bindings[":birthdate"] = date('Y-m-d', strtotime($date));
        }

        //Locatie
        if (isset($_POST['city'])) {
            $city = $_POST['city'];
            $query .= ", city = :city";
            $bindings[":city"] = $city;
        }

        //Handtekening
        if (isset($_POST['signature'])) {
            $signature = $_POST['signature'];
            $query .= ", signature = :signature";
            $bindings[":signature"] = $signature;
        }

        //Image check
        if (isset($_FILES['profiel']) && $_FILES['profiel']['error'] !== 4) {
            $target_dir = "/images/profiel/";
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
//                $time = time();
//                $path = $target_dir.$time.'-'.$_FILES["profiel"]["name"];
                $fragments = explode('.', $_FILES["profiel"]["name"]);
                $path = "/profile/".$_SESSION["user"]->username . '.' . end($fragments);
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



                if (move_uploaded_file($_FILES["profiel"]["tmp_name"], '../../images'.$path)) {
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

        //Wachtwoord
        if(isset($_POST['wachtwoord'])) {
            $wachtwoord = $_POST['wachtwoord'];
            $sql = "SELECT * FROM user WHERE id = ?";
            $result = $dbc->prepare($sql);
            $result->bindParam(1, $_SESSION["user"]->id);
            $result->execute();
            $user = $result->fetch(PDO::FETCH_OBJ);

            if(!password_verify($wachtwoord, $user->password)) {
                header("Location: /");
                exit();
            }
        }

        //End query
        $query .= " WHERE id = :userId";
        $result = $dbc->prepare($query);
        $result->execute($bindings);
        header("Location: /");
    }
}
