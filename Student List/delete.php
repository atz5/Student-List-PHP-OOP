<?php session_start(); ?>
<?php 
if (!isset($_SESSION['auth'])) {
	header("location:login.php");
}
 ?>
<?php 
require 'query.php';
$query=new query();
$id=$_GET['id'];
$result=$query->delete($id,"student");
header("location:view.php");

 ?>