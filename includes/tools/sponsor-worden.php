<?php
require_once("security.php");
if(isset($_POST['sponsorverzend'])) {
    $bedrijf = html_entity_decode(ucfirst($_POST['naam']));
    $url = html_entity_decode($_POST['url']);
    $opties = $_POST['optie'];

	if (isset($_FILES['afbeelding']) && $_FILES['afbeelding']['error'] !== 4) {
        $error = '';
    	$sponsor_file = $_FILES['afbeelding'];

        $target_dir = "/images/sponsor/";
        $target_file = $target_dir . basename($sponsor_file["name"]);
        $uploadOk = 1;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image
        $check = getimagesize($sponsor_file["file_field_name"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $error = "Sorry, geen fotobestand gevonden.";
            $uploadOk = 0;
		}

        // image height width checken eeey
        $data = getimagesize($filename);
        $width = $check[0];
        $height = $check[1];

        if ($width < 480 || $height < 70){
            $error = "Sorry, het bestand bestaat al.";
            $uploadOk = 0;
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
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
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

            $extensions = [
                '.png',
                '.jpg',
                '.jpeg',
                '.gif'
            ];

//            echo '<pre>';
//            var_dump($sponsor_file);
//            exit();

            if (move_uploaded_file($sponsor_file["tmp_name"], '../../images'.$path)) {

                $result = $dbc->prepare("INSERT INTO image (path) VALUES (:path)");
				$result->execute([':path' => $path]);

                $sth = $dbc->prepare("INSERT INTO sponsor(image_id, name, url, option, created_at) VALUES (:image_id, :name, :url, :option, NOW())");
                $sth->execute([":image_id" => $dbc->lastInsertId(), ":name" => $bedrijf, ":url" => $url, ":option" => $opties]);
			} else {
                $error = "Sorry, er ging iets mis met het uploaden.";
                exit();
            }
        }

    }


}
header('Location: /sponsor/become');
