<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

	<?php 
	require 'query.php';
	$query=new query();
	if (isset($_POST['login'])) {
		$user=$query->escape_string($_POST['username']);
		$pass=$query->escape_string($_POST['password']);

		if ($user=="" || $pass=="") {
			echo "Either username or password field is empty.";
        	echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
		}else{
			$result=$query->auth("SELECT * FROM login WHERE username='$user' AND password=md5('$pass') ");
		}
	}else{
	 ?>
	 <a href="index.php">Home</a>
	 <p><font size="+2">Login</font></p>
	 <form method="post" action="">
	 	<table width="75%" border="0">
	 		<tr>
	 			<td width="10%">Username</td>
	 			<td><input type="text" name="username"></td>
	 		</tr>
	 		<tr>
	 			<td>Password</td>
	 			<td><input type="password" name="password"></td>
	 		</tr>
	 		<tr>
	 			<td></td>
	 			<td><input type="submit" name="login" value="Login"></td>
	 		</tr>
	 	</table>
	 	
	 </form>





	<?php 
	}
	 ?>	



</body>
</html>