<?php

	include_once "dbconnection.php";

	if(isset($_POST['upload-image'])){
		$image = $_FILES['imageFile'];
		$imageName = $image['name'];
		$imageType = $image['type'];
		$imageTmp_name = $image['tmp_name'];
		$error = $image['error'];
		$imageSize = $image['size'];

		if(!$error){
			if($imageSize <= 5242880){
				$date = Date('y-m-d H:m:s');
				$imageNewName = Date('y-m-d')."_".$imageName;
				$destinationFolder = '../uploads/';
				$allowed = ["png","jpg"];
				if(in_array(explode('/',$imageType)[1], $allowed)){
					if(move_uploaded_file($imageTmp_name, $destinationFolder.$imageNewName)){
						$stmt = $conn->prepare("INSERT INTO images(imgName,imgPath,uploadeddate) VALUES(?,?,?)");
						$result = $stmt->execute([$imageNewName,$destinationFolder.$imageNewName,$date]);
						$conn = null;
						if($result){
							header("Location:../index.php?success=File successfully uploaded!!");
							exit(0);
						}else{
							header("Location:../index.php?error=$stmt->errorInfo()");
							exit(0);
						}
					}
					else{
							header("Location:../index.php?error=Make sure you have not any special characters in your file");
							exit(0);
						}
				}
				else{
					header("Location:../index.php?error=Please upload only png or jpg images");
					exit(0);
				}
				
			}else{
				header("Location:../index.php?error=The size of image sould not increase 5mb");
			exit(0);
			}
		}else{
			header("Location:../index.php?error=The file is corrupted!");
			exit(0);
		}
	}

?>