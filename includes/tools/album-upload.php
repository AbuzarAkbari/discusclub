<?php
if (isset($_POST['upload_album'])) {
    require_once("security.php");
    if ($logged_in) {
    		$album_name = $_POST['album_name'];
	        $id_poster = $_SESSION['user']->id;
    	if (isset($_FILES['files']) && $_FILES['files']['error'] !== 4) {
    		$error = '';
	        $albumsql = "INSERT INTO album (title, user_id, created_at) VALUES (:title, :user_id, NOW())";
            $album_result = $dbc->prepare($albumsql);
            $album_result->execute([':title' => $album_name, ':user_id' => $id_poster]);
			$album_id = $dbc->lastInsertId();

	        for($x = 0; $x  < count($_FILES['files']['name']); $x++) {
	        	$album_files = $_FILES['files'];
	            $target_dir = "/images/album/";
	            $target_file = $target_dir . basename($album_files["name"][$x]);
	            $uploadOk = 1;
				$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

				// Check if image file is a actual image or fake image
	            $check = getimagesize($album_files["tmp_name"][$x]);
	            if ($check !== false) {
	                $uploadOk = 1;
	            } else {
	                $error = "File is not an image.";
	                $uploadOk = 0;
				}

	            // Check if file already exists
	            if (file_exists($target_file)) {
	                $error = "Sorry, geen fotobestand gevonden.";
	                $uploadOk = 0;
	            }

	            // Check file size
	            if ($album_files["size"][$x] > 500000) {
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
	                header("Location: /album/upload?error=".$error);
	                exit();

	                // if everything is ok, try to upload file
	            } else {
	                $fragments = explode('.', $album_files["name"][$x]);
					$path = "/album/" . date("Y-m-d_H-i-s") . '-'.$x.'.' . end($fragments);

	                $extensions = [
	                    '.png',
	                    '.jpg',
	                    '.jpeg',
	                    '.gif'
	                ];

	                if (move_uploaded_file($album_files["tmp_name"][$x], '../../images'.$path)) {
	                    $sql = "INSERT INTO image (path, album_id) VALUES (:path, :album_id)";
	                    $result = $dbc->prepare($sql);
						$result->execute([':path' => $path, ':album_id' => $album_id]);

					} else {
	                     $error = "Sorry, er ging iets mis met het uploaden.";
	                    exit();
	                }
	            }
	        }

        }

        header("Location: /album/post/" . $album_id);
    }
}
