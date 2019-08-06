<?php
  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "testing");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];

  	// image file directory
  	$target = "images/".basename($image);

  	$sql = "INSERT INTO tbl_images(image) VALUES ('$image')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
  
  if(isset($_POST['delete']))
 {
  $sql = "DELETE FROM tbl_images WHERE id = '".$_POST["id"]."'";
  if(mysqli_query($db, $sql))
  {
   echo 'Image Deleted from Database';
  }
 }
 
 
  $result = mysqli_query($db, "SELECT * FROM tbl_images");
?>


<!DOCTYPE html>
<html>
<head>
<style>
div.gallery {
  margin: 5px;
  border: 1px solid #ccc;
  float: left;
  width: 180px;
}

div.gallery:hover {
  border: 1px solid #777;
}

div.gallery img {
  width: 100%;
  height: auto;
}

div.desc {
  padding: 15px;
  text-align: center;
}
</style>
</head>
<body>


  <form method="POST" action="index.php" enctype="multipart/form-data">
  	<input type="hidden" name="size" value="1000000">
  	<div>
  	  <input type="file" name="image">
  	</div>
  	<div>
  		<button type="submit" name="upload">POST</button>
  	</div>
  </form>
  
 
  



  <?php
 
    while ($row = mysqli_fetch_array($result)) {
		echo "<div class='gallery'>";
      	echo "<img src='images/".$row['image']."' width='600' height='400'>";
		echo "<form method='POST' action='index.php' >";
		echo "<button type='submit' name='delete'>delete</button>";
		echo "</form>";
		echo "</div>";
    }
	
  ?>



</body>
</html>
