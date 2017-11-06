<?php
require_once("security.php");
if(isset($_POST['sponsorverzend'])) {
    $bedrijf = ucfirst($_POST['naam']);
    $url = $_POST['url'];
    $opties = $_POST['optie'];

	if (isset($_FILES['afbeelding']) && $_FILES['afbeelding']['error'] !== 4) {

    	$sponsor_file = $_FILES['afbeelding'];
    	// var_dump($sponsor_file);
        $target_dir = "/images/sponsor/";
        $target_file = $target_dir . basename($sponsor_file["name"]);
        $uploadOk = 1;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);




        // Check if image file is a actual image or fake image
        $check = getimagesize($sponsor_file["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
		}

        // image height width checken eeey
        $check = $check[0];
        $check = $check[1];

        if ($check > 468 || $check > 60){
            echo "nice";
        }else {
            echo 'image isnt the right size (468x60)';
            unlink($sponsor_file["tmp_name"]);
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($sponsor_file["size"] > 500000) {
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
            $fragments = explode('.', $sponsor_file["name"]);
			$path = strtotime(date("Y-m-d H:i:s")) . '.' . end($fragments);

            $extensions = [
                '.png',
                '.jpg',
                '.jpeg',
                '.gif'
            ];

            // foreach ($extensions as $extension) {
            //     if (file_exists(_DIR_ . '/' . $target_dir . $_SESSION["user"]->username . $extension)) {
            //         unlink(_DIR_ . '/' . $target_dir . $_SESSION["user"]->username . $extension);
            //     }
            // }



            if (move_uploaded_file($sponsor_file["tmp_name"], __DIR__ . '/../../images/sponsor/'.$path)) {
                $result = $dbc->prepare("INSERT INTO image (path) VALUES (:path)");
				$result->execute([':path' => $path]);

                $sth = $dbc->prepare("INSERT INTO sponsor(image_id, name, url, option) VALUES (:image_id, :name, :url, :option)");
                $sth->execute([":image_id" => $dbc->lastInsertId(), ":name" => $bedrijf, ":url" => $url, ":option" => $opties]);
			} else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        }

    }


}
header('Location: /sponsor/become');
