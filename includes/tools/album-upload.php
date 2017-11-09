<?php
if (isset($_POST['upload_album'])) {
    require_once("security.php");

	// echo '<pre>';
	// print_r($_FILES);
	// exit;

    if ($logged_in) {
    		$album_name = $_POST['album_name'];
	        $id_poster = $_SESSION['user']->id;
    	if (isset($_FILES['files']) && $_FILES['files']['error'] !== 4) {
	        $albumsql = "INSERT INTO album (title, user_id, created_at) VALUES (:title, :user_id, NOW())";
            $album_result = $dbc->prepare($albumsql);
            // var_dump([':title' => $album_name, ':user_id' => $id_poster]);
            $album_result->execute([':title' => $album_name, ':user_id' => $id_poster]);
			$album_id = $dbc->lastInsertId();

	        for($x = 0; $x  < count($_FILES['files']['name']); $x++) {
	        	$album_files = $_FILES['files'];
	        	// var_dump($album_files);
	            $target_dir = "/images/album/";
	            $target_file = $target_dir . basename($album_files["name"][$x]);
	            $uploadOk = 1;
				$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

				// Check if image file is a actual image or fake image
	            $check = getimagesize($album_files["tmp_name"][$x]);
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
	            if ($album_files["size"][$x] > 500000) {
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
	                $fragments = explode('.', $album_files["name"][$x]);
					$path = "/album/" . strtotime(date("Y-m-d_H:i:s")) . '-'.$x.'.' . end($fragments);

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



	                if (move_uploaded_file($album_files["tmp_name"][$x], '../../images'.$path)) {
	                    $sql = "INSERT INTO image (path, album_id) VALUES (:path, :album_id)";
	                    $result = $dbc->prepare($sql);
						$result->execute([':path' => $path, ':album_id' => $album_id]);

					} else {
	                    echo "Sorry, there was an error uploading your file.";
	                    exit();
	                }
	            }
	        }

        }



        // echo '<pre>';
        // print_r($_FILES);
        // exit();

        header("Location: /album/post/" . $album_id);
    }
}
