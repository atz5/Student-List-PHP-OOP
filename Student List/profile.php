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
	$new=$_POST['new'];
	$con=$_POST['con'];
	if ($new==$con) {
		$result=$query->execute("UPDATE login SET password=md5('$new') WHERE id=\"$_SESSION[id]\"");
		echo "<script type='text/javascript'>alert('Successfully Changed!!!');window.location='logout.php';</script>";
	
	}else{
		echo "<script type='text/javascript'>alert('Password and Confirm-Password does not match!!!');window.location='profile.php';</script>";
	}

}else{
	$data=$query->getdata("SELECT * FROM login WHERE id=\"$_SESSION[id]\"");
	foreach ($data as $key => $value) {
		$name=$value['name'];
		$email=$value['email'];
		$pic=$value['photo'];
	}

  ?>
  <style type="text/css">
  	.style{
  		text-decoration: none;
  	}
  </style>
	<form action="" method="post">
		<table width="75%" border="0">
			<tr>
				<td width="10%">Profile:</td>
				<?php echo "<td><a href='$value[photo]'><img width='100' height='100' src='".$pic."'></a></td>"; ?>
			</tr>
			<tr>
				<td>Name:</td>
				<td><b><i>"<?php echo $name; ?>"</b></i></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><?php echo $email; ?></td>
			</tr>
			<tr>
				<td>New Password:</td>
				<td><input type="password" name="new" placeholder="New Password"></td>
			</tr>
			<tr>
				<td>Confirm-Password:</td>
				<td><input type="password" name="con" placeholder="Confirm-Password"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="update" value="Change"><button><a class="style" href="index.php">Cancel</a></button></td>
			</tr>
		</table>
	</form>
	<?php 

}
	 ?>
