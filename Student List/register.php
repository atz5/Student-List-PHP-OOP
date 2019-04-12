<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
<a href="index.php">Home</a><br>
<?php 
require 'query.php';
$query=new query();

if (isset($_POST['register'])) {
	$name=$query->escape_string($_POST['name']);
	$user=$query->escape_string($_POST['username']);
	$email=$query->escape_string($_POST['email']);
	$pass=$query->escape_string($_POST['password']);

	$chk_email=$query->email($_POST['email']);

	$filename=$_FILES['img']['name'];
	$tmpname=$_FILES['img']['tmp_name'];
	$ext=pathinfo($filename,PATHINFO_EXTENSION);
	$photoname=time();
	$folder="profile/$photoname.$ext";

	if (!$chk_email) {
		echo "Invalid Email!!!";
		echo "<br><a href='javascript:self.history.back()'>Go Back</a>";
	}else{

	move_uploaded_file($tmpname,$folder);
	$result=$query->execute("INSERT INTO login(name,username,email,password,photo)
		VALUES('$name','$user','$email',md5('$pass'),'$folder')");
	echo "<script type='text/javascript'>alert('Register Successfully!!!');window.location='login.php'</script>";

	}
}else{
 ?>
	<p><font size="+2">Register</font></p>
	<form method="post" action="" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Name:</td>
				<td><input type="text" name="name" required=""></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="text" name="email" required=""></td>
			</tr>
			<tr>
				<td>UserName:</td>
				<td><input type="text" name="username" required=""></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="password" required=""></td>
			</tr>
			<tr>
				<td>Profile Picture:</td>
				<td><input type="file" name="img" required=""></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="register" value="Register"></td>
			</tr>
		</table>
		

	</form>

<?php 
}
 ?>	

</body>
</html>