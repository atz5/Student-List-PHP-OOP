<?php session_start(); ?>
<?php 
if (!isset($_SESSION['auth'])) {
	header("location:login.php");
}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Add Student</title>
 </head>
 <body>
 	<a href="index.php">Home</a> | <a href="view.php">View Student List</a> | <a href="logout.php">Logout</a>
 	<br><br>
 	<?php  
 	require 'query.php';
 	$query=new query();
 	if (isset($_POST['add'])) {
 		$name=$query->escape_string($_POST['name']);
 		$age=$query->escape_string($_POST['age']);
 		$ph=$query->escape_string($_POST['phone']);
 		$loginid=$_SESSION['id'];

 		$final=$query->escape($name);

 		$filename=$_FILES['img']['name'];
 		$tmpname=$_FILES['img']['tmp_name'];
 		$ext=pathinfo($filename,PATHINFO_EXTENSION);
 		$photoname=time();
		$folder="stupic/$photoname.$ext";


 		move_uploaded_file($tmpname, $folder);
 		$result=$query->execute("INSERT INTO student(name,age,ph,photo,login_id)
 			VALUES('$final','$age','$ph','$folder','$loginid')");
 		header("location:view.php");

 	}
 	else{
 	?>
 	<form method="post" action="" enctype="multipart/form-data">
 		<table width="75%" border="0">
 			<tr>
 				<td width="10%">Name:</td>
 				<td><input type="text" name="name" required=""></td>
 			</tr>
 			<tr>
 				<td>Age:</td>
 				<td><input type="number" name="age" required=""></td>
 			</tr>
 			<tr>
 				<td>Phone:</td>
 				<td><input type="text" name="phone" required="" value="+95 "></td>
 			</tr>
 			<tr>
 				<td>Photo:</td>
 				<td><input type="file" name="img" required=""></td>
 			</tr>
 			<tr>
 				<td></td>
 				<td><input type="submit" name="add" value="Add Student"></td>
 			</tr>
 			
 		</table>
 	</form>





 	<?php 
 	}
 	 ?>	
 
 </body>
 </html>