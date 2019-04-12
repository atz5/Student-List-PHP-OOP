<?php session_start(); ?>
<?php 
if (!isset($_SESSION['auth'])) {
	header("location:login.php");
}
 ?>
 <!DOCTYPE html>
<html>
<head>
	<title>Result</title>
	<style type="text/css">
		.border{
			border-spacing: 0;
		}
	</style>
</head>
<body>
<a href="index.php">Home</a> | <a href="view.php">View Student List</a> | <a href="logout.php">Logout</a><br><br>
 	<form action="search.php" action="GET">
 		<input type="text" name="search" autofocus="" placeholder="Search...">
 		<input type="submit" name="submit" value="Search">
 	</form>
 	<table width='80%' border='1' class='border'>
		<tr bgcolor='#CCCCCC' >
			<td>Photo</td>
			<td>Name</td>
			<td>Age</td>
			<td>Phone</td>
			<td>Update</td>
		</tr>
</body>
</html>
<?php
require 'query.php';
$query=new query();
if (isset($_GET['submit'])) {
	$q=$_GET['search'];
	$final=$query->escape($q);
	$output='';
	$result=$query->getdata("SELECT * FROM `student` WHERE CONCAT(`name`,`age`,`ph`) LIKE '%".$final."%'");
	if (count($result)=='0') {
		$output="<h3>No search found for <i>'".$final."'</i> in table.</h3>";
	}
	if ($final=="") {
		$output="<h3>No search found !!!</h3>";

	}else{

		foreach ($result as $key => $value) {

			$name=$value['name'];
			$age=$value['age'];
			$phone=$value['ph'];
			$pic=$value['photo'];

		echo "<tr>";
		echo "<td><a href='$value[photo]'><img width='100' height='100' src='".$pic."'></a></td>";
		echo "<td>".$name."</td>";
		echo "<td>".$age."</td>";
		echo "<td>".$phone."</td>";
		echo "<td><a href='update.php?id=$value[id]'>Update</a> | <a href='delete.php?id=$value[id]' onclick=\"return confirm('Are you sure want to delete?');\">Delete</a></td>";
		echo "</tr>";

			}
	}
}
  ?>
</table>
<?php  echo $output;?>
















