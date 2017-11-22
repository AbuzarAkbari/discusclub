<?php
require_once("../../includes/tools/security.php");
if ($logged_in) {
    if (isset($_POST["profiel_parse"]) && !empty($_POST["wachtwoord"])) {
        if (isset($_POST["date"]) && !strtotime($_POST["date"])) {
            $error = "Geboortedatum is verkeerd";
        }
        else {
            $error = '';
            //Start query
            $query = "UPDATE user SET id = :userId";
            $userId = $_POST["user_id"];
            $bindings = [":userId" => $userId];
            //Nieuwsbrief
            if ($_POST['news'] == "on") {
                $news = 1;
                $query .= ", news = :news";
                $bindings[":news"] = $news;
            } else {
                $news = 0;
                $query .= ", news = :news";
                $bindings[":news"] = $news;
            }
            //Nieuw wachtwoord
            if (isset($_POST['new_password']) && !empty($_POST["new_password"])) {
                if ($_POST['new_password'] != $_POST['new_password_repeat']) {
                    $error = "Wachtwoorden komen niet overeen.";
                    exit();
                } else {
                    $new_password = $_POST['new_password'];
                    $password = password_hash($new_password, PASSWORD_BCRYPT);
                    $query .= ", password = :password";
                    $bindings[":password"] = $password;
                }
            }

        //Email
        if ($_POST['email'] === $_POST['repeat_email']) {
            $email = trim($_POST['email']);
            $query .= ", email = :email";
            $bindings[":email"] = $email;
        } else {
            $error =  "Email adressen komen niet overeen";
            exit();
        }
        //Geboortedatum
        if (isset($_POST['date']) && !empty($_POST["date"]) && strtotime($_POST["date"])) {
            $date = $_POST['date'];
            $query .= ", birthdate = :birthdate";
            $bindings[":birthdate"] = date('Y-m-d', strtotime($date));
        }

        //Locatie
        if (isset($_POST['city']) && !empty($_POST["city"])) {
            $city = $_POST['city'];
            $query .= ", city = :city";
            $bindings[":city"] = $city;
        }
        //Nieuwsbrief
        if (isset($_POST['news']) && !empty($_POST["news"])) {
            $news = $_POST['news'] == "on" ? 1 : 0;
            $query .= ", news = :news";
            $bindings[": news"] = $news;

                if (!$datum)  {
                    $error = "Geboortedatum is geen datum";
                    exit();
                }
            }



            //Locatie
            if (isset($_POST['city']) && !empty($_POST["city"])) {
                $city = $_POST['city'];
                $query .= ", city = :city";
                $bindings[":city"] = $city;
            }
            //Nieuwsbrief
            if (isset($_POST['news']) && !empty($_POST["news"])) {
                $news = $_POST['news'] == "on" ? 1 : 0;
                $query .= ", news = :news";
                $bindings[": news"] = $news;

                require 'mailer.php';
            }
            //Handtekening
            if (isset($_POST['signature']) && !empty($_POST["signature"])) {
                $signature = $_POST['signature'];
                $query .= ", signature = :signature";
                $bindings[":signature"] = $signature;
            }

            //address
            if (isset($_POST['address']) && !empty($_POST["address"])) {
                $address = $_POST['address'];
                $query .= ", address = :address";
                $bindings[":address"] = $address;
            }

            //postal_code
            if (isset($_POST['postal_code']) && !empty($_POST["postal_code"])) {
                $postal_code = $_POST['postal_code'];
                $query .= ", postal_code = :postal_code";
                $bindings[":postal_code"] = $postal_code;
            }

            //house_number
            if (isset($_POST['house_number']) && !empty($_POST["house_number"])) {
                $house_number = $_POST['house_number'];
                $query .= ", house_number = :house_number";
                $bindings[":house_number"] = $house_number;
            }

            //phone
            if (isset($_POST['phone']) && !empty($_POST["phone"])) {
                $phone = $_POST['phone'];
                $query .= ", phone = :phone";
                $bindings[":phone"] = $phone;
            }

            //iban
            if (isset($_POST['iban']) && !empty($_POST["iban"])) {
                $iban = $_POST['iban'];
                $query .= ", iban = :iban";
                $bindings[":iban"] = $iban;
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
                    $error = "Sorry, geen fotobestand gevonden.";
                    $uploadOk = 0;
                }
                // Check if file already exists
                if (file_exists($target_file)) {
                    $error = "Sorry, het bestand bestaat al.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["profiel"]["size"] > 500000) {
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

                    // if everything is ok, try to upload file
                } else {
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
                        $error = "Sorry, er ging iets mis met het uploaden.";
                        exit();
                    }
                }
            }
            //Image check
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
        }
        //Wachtwoord
        if(isset($_POST['wachtwoord']) && !empty($_POST["wachtwoord"])) {
            $wachtwoord = $_POST['wachtwoord'];
            $sql = "SELECT * FROM user WHERE id = ?";
            $result = $dbc->prepare($sql);
            $result->bindParam(1, $_SESSION["user"]->id);
            $result->execute();
            $user = $result->fetch(PDO::FETCH_OBJ);
            if (!password_verify($wachtwoord, $user->password)) {
                header("Location: /");
            }

        }
        if(empty($error)) {
            //End query
            $query .= " WHERE id = :userId";
            $result = $dbc->prepare($query);
            $result->execute($bindings);
            header("Location: /user/login?logout=true");
        } else {
            header("Location: /user/conf?error=".$error);
        }
    }
}
