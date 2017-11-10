<?php
if (isset($_POST['upload_aquarium'])) {
    require_once("security.php");

    if ($logged_in) {
    		$aquarium_name = $_POST['aquarium_name'];
	        $id_poster = $_SESSION['user']->id;
    	if (isset($_FILES['files']) && $_FILES['files']['error'] !== 4) {
    	    $error = '';


	        for($x = 0; $x  < count($_FILES['files']['name']); $x++) {
	        	$aquarium_files = $_FILES['files'];
	        	// var_dump($aquarium_files);
	            $target_dir = "/images/aquarium/";
	            $target_file = $target_dir . basename($aquarium_files["name"][$x]);
	            $uploadOk = 1;
				$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

				// Check if image file is a actual image or fake image
	            $check = getimagesize($aquarium_files["tmp_name"][$x]);
	            if ($check !== false) {
	                $uploadOk = 1;
	            } else {
	                $error = "File is not an image.";
	                $uploadOk = 0;
				}

	            // Check if file already exists
	            if (file_exists($target_file)) {
                    $error = "Sorry, file already exists.";
	                $uploadOk = 0;
	            }

	            // Check file size
	            if ($aquarium_files["size"][$x] > 500000) {
                    $error = "Sorry, your file is too large.";
	                $uploadOk = 0;
	            }

	            // Allow certain file formats
	            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	                && $imageFileType != "gif" ) {
                    $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
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

	                if (move_uploaded_file($aquarium_files["tmp_name"][$x], '../../images'.$path)) {
                        $aquariumsql = "INSERT INTO aquarium (title, user_id, created_at) VALUES (:title, :user_id, NOW())";
                        $aquarium_result = $dbc->prepare($aquariumsql);
                        $aquarium_result->execute([':title' => $aquarium_name, ':user_id' => $id_poster]);
                        $aquarium_id = $dbc->lastInsertId();

	                    $sql = "INSERT INTO image (path, aquarium_id) VALUES (:path, :aquarium_id)";
	                    $result = $dbc->prepare($sql);
						$result->execute([':path' => $path, ':aquarium_id' => $aquarium_id]);

					} else {
                        $error = "Sorry, there was an error uploading your file.";
	                    exit();
	                }
	            }
	        }

        }
        header("Location: /aquarium/post/" . $aquarium_id);
    }
}
