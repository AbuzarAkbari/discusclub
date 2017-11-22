<?php
require_once("security.php");
if(isset($_POST['sponsorverzend'])) {
    $bedrijf = htmlentities(ucfirst($_POST['naam']));
    $url = htmlentities($_POST['url']);
    $email = htmlentities($_POST['email']);
    $phone = htmlentities($_POST['phone']);
    $iban = htmlentities($_POST['iban']);
    $opties = $_POST['optie'];

	if (isset($_FILES['afbeelding']) && $_FILES['afbeelding']['error'] !== 4) {
        $error = '';
    	$sponsor_file = $_FILES['afbeelding'];

        $target_dir = "/images/sponsor/";
        $target_file = $target_dir . basename($sponsor_file["name"]);
        $uploadOk = 1;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        // var_dump([
        //     $sponsor_file["name"],
        //     $_FILES
        // ]);
        // exit;

        // Check if image file is a actual image or fake image
        $check = getimagesize($sponsor_file["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $error = "Sorry, geen fotobestand1 gevonden.";
            $uploadOk = 0;
		}

        // image height width checken eeey
        $width = $check[0];
        $height = $check[1];

        $ratio = 480 / 70;

        try {
            if (($width / $height) === $ratio){
                $error = "Sorry, het bestand is te groot";
                unlink($sponsor_file["tmp_name"]);
                $uploadOk = 0;
            }
        } catch (Except $e) {

        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $error = "Sorry, het bestand bestaat al.";
            $uploadOk = 0;
        }

        // Check file size
        if ($sponsor_file["size"] > 500000) {
            $error = "Sorry, het bestand is te groot";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (strpos('image/', $sponsor_file['type']) !== 0) {
           $error = "Sorry, alleen JPG, JPEG, PNG & GIF bestanden zijn toegestaan.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            header("Location: /sponsor/become?error=" . $error);
            exit();

            // if everything is ok, try to upload file
        } else {
            $fragments = explode('.', $sponsor_file["name"]);
			$path = "/sponsor/". (date("Y-m-d_H-i-s") . '.' . end($fragments));

            if (move_uploaded_file($sponsor_file["tmp_name"], __DIR__ . '/../../images'.$path)) {

                $result = $dbc->prepare("INSERT INTO image (path) VALUES (:path)");
				$result->execute([':path' => $path]);

                $sth = $dbc->prepare("INSERT INTO sponsor(image_id, name, url, option, created_at, phone, iban, email) VALUES (:image_id, :name, :url, :option, NOW(), :phone, :iban, :email)");
                $sth->execute([":image_id" => $dbc->lastInsertId(), ":name" => $bedrijf, ":url" => $url, ":option" => $opties, ":phone" => $phone, ":iban" => $iban, ":email" => $email]);
			} else {
                $error = "Sorry, er ging iets mis met het uploaden.";
                header("Location: /sponsor/become?error=" . $error);
                exit();
            }
        }

    }


}
// header('Location: /sponsor/become');
