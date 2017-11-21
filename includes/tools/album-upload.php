<?php
if (isset($_POST['upload_album'])) {
    require_once("security.php");
    if ($logged_in) {
    		$album_name = htmlentities($_POST['album_name']);
	        $id_poster = $_SESSION['user']->id;
    	if (isset($_FILES['files']) && $_FILES['files']['error'] !== 4) {
    		$error = '';

            $paths = [];
	        for($x = 0; $x  < count($_FILES['files']['name']); $x++) {
                $album_files = $_FILES['files'];
                $target_dir = "/images/album/";
                $target_file = $target_dir . basename($album_files["name"][$x]);
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                // Check if image file is a actual image or fake image
                $check = getimagesize($album_files["tmp_name"][$x]);
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
                if ($album_files["size"][$x] > 500000) {
                    $error = "Sorry, het bestand is te groot";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" && $imageFileType != "PNG") {
                    $error = "Sorry, alleen JPG, JPEG, PNG & GIF bestanden zijn toegestaan.";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    header("Location: /album/upload?error=" . $error);
                    exit();
                    // if everything is ok, try to upload file
                } else {
                    $fragments = explode('.', $album_files["name"][$x]);
                    $path = "/album/" . date("Y-m-d_H-i-s") . '-' . $x . '.' . end($fragments);

                    $extensions = [
                        '.png',
                        '.jpg',
                        '.jpeg',
                        '.gif'
                    ];

                    $paths[] = $path;


                }
            }

//          echo "<pre>";
//	        var_dump($_FILES['files']['name'], $album_files["tmp_name"], sizeof($_FILES['files']['name']));
//	        exit();
            $albumsql = "INSERT INTO album (title, user_id, created_at) VALUES (:title, :user_id, NOW())";
            $album_result = $dbc->prepare($albumsql);
            $album_result->execute([':title' => $album_name, ':user_id' => $id_poster]);
            $album_id = $dbc->lastInsertId();
            for ($x = 0; $x < sizeof($_FILES['files']['name']); $x++) {
                $album_files = $_FILES['files'];
                if (move_uploaded_file($album_files["tmp_name"][$x], '../../images' . $paths[$x])) {


                    $sql = "INSERT INTO image (path, album_id) VALUES (:path, :album_id)";
                    $result = $dbc->prepare($sql);
                    $result->execute([':path' => $paths[$x], ':album_id' => $album_id]);

                } else {
                    $error = "Sorry, er ging iets mis met het uploaden.";
                    exit();
                }
            }
        }
       header("Location: /album/post/" . $album_id);
    }
}
