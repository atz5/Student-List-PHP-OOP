<?php 
/**
 * 
 */
class con 
{
	private $host="localhost";
	private $username="root";
	private $password="";
	private $database="student";

	protected $con;

	function __construct()
	{
		$this->con=mysqli_connect($this->host,$this->username,$this->password,$this->database);
		if ($this->con->connect_error) {
			echo "Error".$this->con->error;
		}
		return $this->con;
	}
}



 ?>