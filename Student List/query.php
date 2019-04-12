<?php 
/**
 * 
 */
require 'config/connection.php';
class query extends con
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function execute($query){
		$result=$this->con->query($query);
		if (!$result) {
			echo "Error:Cannot Execute Command!!!";
		}
		return $this->con;
	}
	public function getdata($query){
		$result=$this->con->query($query);
		if (!$result) {
			echo "Error:Cannot Execute Command!!!";
		}
		$rows=array();
		while ($row=$result->fetch_array()) {
			$rows[]=$row;
		}
		return $rows;
	}
	public function delete($id,$table){
		$data=$this->con->query("SELECT * FROM $table WHERE id=$id");
		while ($row=$data->fetch_array()) {
			$img=$row['photo'];
		}
		unlink($img);
		$query="DELETE FROM $table WHERE id=$id";
		$result=$this->con->query($query);
		if(!$result) {
			echo "Error:Cannot Execute Command!!!";
		}
		return $this->con;
	}
	public function auth($query){
		$result=$this->con->query($query);
		if (!$result) {
			echo "Error:Cannot Execute Command!!!";
		}
		$row=$result->fetch_array();
		if (is_array($row) && !empty($row)) {
			$authuser=$row['username'];
			$_SESSION['auth']=$authuser;
			$_SESSION['name']=$row['name'];
			$_SESSION['id']=$row['id'];
		}else{
			echo "Invalid User or Password<br>";
			echo "<a href='login.php'>Go Back</a>";
		}
		if (isset($_SESSION['auth'])) {
			header("location:index.php");
		}
	}
	public function escape_string($value){
		return $this->con->real_escape_string($value);
	}

	public function escape($value){
		return htmlspecialchars($value,ENT_QUOTES,'utf-8');
	}
	public function email($email){
		if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
			return $email;
		}
		return false;

	}

}

 ?>

