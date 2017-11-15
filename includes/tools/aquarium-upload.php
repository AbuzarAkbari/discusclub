<?php
if (isset($_POST['upload_aquarium'])) {
    require_once("security.php");

    if ($logged_in) {
    		$aquarium_name = htmlentities($_POST['aquarium_name']);
	        $id_poster = $_SESSION['user']->id;

    	if (isset($_FILES['files']) && $_FILES['files']['error'] !== 4) {

    	    $error = '';
			$paths = [];
	        for($x = 0; $x  < count($_FILES['files']['name']); $x++) {
	        	$aquarium_files = $_FILES['files'];
	            $target_dir = "/images/aquarium/";
	            $target_file = $target_dir . basename($aquarium_files["name"][$x]);
	            $uploadOk = 1;
				$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

				// Check if image file is a actual image or fake image
	            $check = getimagesize($aquarium_files["tmp_name"][$x]);
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
	            if ($aquarium_files["size"][$x] > 500000) {
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
                    header("Location: /aquarium/upload?error=".$error);
                    exit();

	            // if everything is ok, try to upload file
	            } else {
	                $fragments = explode('.', $aquarium_files["name"][$x]);
					$path = "/aquarium/" . date("Y-m-d_H-i-s") . '-'.$x.'.' . end($fragments);

	                $extensions = [
	                    '.png',
	                    '.jpg',
	                    '.jpeg',
	                    '.gif'
					];

					$paths[] = $path;

	            }
	        }

			$aquariumsql = "INSERT INTO aquarium (title, user_id, created_at) VALUES (:title, :user_id, NOW())";
			$aquarium_result = $dbc->prepare($aquariumsql);
			$aquarium_result->execute([':title' => $aquarium_name, ':user_id' => $id_poster]);
			$aquarium_id = $dbc->lastInsertId();
            for($x = 0; $x  < count($_FILES['files']['name']); $x++) {
                if (move_uploaded_file($aquarium_files["tmp_name"][$x], '../../images' . $paths[$x])) {

                    $sql = "INSERT INTO image (path, aquarium_id) VALUES (:path, :aquarium_id)";
                    $result = $dbc->prepare($sql);
                    $result->execute([':path' => $paths[$x], ':aquarium_id' => $aquarium_id]);

                } else {
                    $error = "Sorry, er ging iets mis met het uploaden.";
                    exit();
                }
            }
        }
        header("Location: /aquarium/post/" . $aquarium_id);
    }
}
