<?php session_start(); ?>
<?php 
if (!isset($_SESSION['auth'])) {
	header("location:login.php");
}
 ?>
 	<?php 
 	require 'query.php';
 	$query=new query();
 	$result=$query->getdata("SELECT * FROM student WHERE login_id=\"$_SESSION[id]\" ORDER BY id DESC");

 	 ?>
 	 
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Student Lists</title>
 	<style type="text/css">
 		.border{
 			border-spacing: 0;
 		}
 	</style>
 </head>
 <body>
 	<a href="index.php">Home</a> | <a href="add.php">Add New Student</a> | <a href="logout.php">Logout</a><br><br>
 	<form action="search.php" action="get">
 		<input type="text" name="search" autofocus="" placeholder="Search...">
 		<input type="submit" name="submit" value="Search">
 	</form>
	<table width="80%" border="1" class="border">
		<tr bgcolor='#CCCCCC' >
			<td>Photo</td>
			<td>Name</td>
			<td>Age</td>
			<td>Phone</td>
			<td>Update</td>
		</tr>
			<?php 
			foreach ($result as $key => $value) {
				echo "<tr>";
				echo "<td><a href='$value[photo]'><img width='100' height='100' src='".$value['photo']."'></a></td>";
				echo "<td>".$value['name']."</td>";
				echo "<td>".$value['age']."</td>";
				echo "<td>".$value['ph']."</td>";
				echo "<td><a href='update.php?id=$value[id]'>Update</a> | <a href='delete.php?id=$value[id]' onclick=\"return confirm('Are you sure want to delete?')\">Delete</a></td>";
				echo "</tr>";
			}


			 ?>


 	</table>
 
 </body>
 </html>