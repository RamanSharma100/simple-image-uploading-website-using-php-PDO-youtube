<?php
	include_once "dbConnection.php";
	if(isset($_POST['delete'])){
		$stmt = $conn->prepare("DELETE FROM images WHERE imgId=?");
		$result = $stmt->execute([$_POST['delete']]);
		if($result){
			header("Location:../index.php?success=Image successfully deleted!");
			exit(0);
		}else{
			header("Location:../index.php?error=Invalid ImageId!");
			exit(0);
		}
	}
?>