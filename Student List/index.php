<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>
	Welcome To My Page!!!
	<br>

	<?php  
	if (isset($_SESSION['auth'])) {

	?>
	Welcome "<i><b><?php echo $_SESSION['name']; ?>"</i>!!!</b><br>
	<a href="view.php">View and Add Student</a><br>
	<a href="profile.php">Edit Profile</a> | <a href="logout.php">Logout</a>
<?php  
	}else{
		echo "<br>You must be logged in to view this page.<br>";
		echo "<a href='login.php'>Login</a> | <a href='register.php'>Register</a>";

	}
?>
<br>
<br>
<div>
	
Created by <i><b>'/ATZ/'</b></i>
</div>
</body>
</html>