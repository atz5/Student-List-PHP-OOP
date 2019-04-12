<?php session_start(); ?>
<?php 
if (!isset($_SESSION['auth'])) {
	header("location:login.php");
}
 ?>
 <?php 
require 'query.php';
$query=new query();
if (isset($_POST['update'])) {
	$id=$_POST['id'];

	$name=$query->escape_string($_POST['name']);
	$age=$query->escape_string($_POST['age']);
	$ph=$query->escape_string($_POST['phone']);

	$final=$query->escape($name);

	$filename=$_FILES['img']['name'];
	$tmpname=$_FILES['img']['tmp_name'];
	$ext=pathinfo($filename,PATHINFO_EXTENSION);
	$photoname=time();
	$folder="stupic/$photoname.$ext";


	if (!empty($tmpname)) {
		move_uploaded_file($tmpname, $folder);
		$result=$query->execute("UPDATE student SET name='$final',age='$age',ph='$ph',photo='$folder' WHERE id=$id");
		header("location:view.php");
	}else{
		$result=$query->execute("UPDATE student SET name='$final',age='$age',ph='$ph' WHERE id=$id");
		header("location:view.php");

	}
}
  ?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Students</title>
</head>
<body>
 	<a href="index.php">Home</a> | <a href="view.php">View Student List</a> | <a href="logout.php">Logout</a><br><br>
 	<?php 
 	$id=$_GET['id'];
 	$result=$query->getdata("SELECT * FROM student WHERE id=$id");
 	foreach ($result as $key => $value) {
 		$name=$value['name'];
 		$age=$value['age'];
 		$phone=$value['ph'];
 		$pic=$value['photo'];
 	}

 	 ?>

	<form action="" method="post" enctype="multipart/form-data">
		<table width="25%" border="0">
		<tr>
			<td>Profile Photo:</td>
			<td><img width="100" height="100" src="<?php echo $pic; ?>"></td>
		</tr>
		
		<tr>
			<td>Name:</td>
			<td><input type="text" name="name" value="<?php echo $name; ?>"></td>
		</tr>
		<tr>
			<td>Age:</td>
			<td><input type="text" name="age" value="<?php echo $age; ?>"></td>

		</tr>
		<tr>
			<td>Phone:</td>
			<td><input type="text" name="phone" value="<?php echo $phone; ?>"></td>

		</tr>
		<tr>
			<td>Update Photo:</td>
			<td><input type="file" name="img"></td>
		</tr>
		<tr>
			<td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
			<td><input type="submit" name="update" value="Update"></td>
		</tr>
		</table>
		
	</form>


</body>
</html>