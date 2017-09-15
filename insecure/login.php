<?php
session_start();

if(isset($_POST['username'])){
//	$username = mysql_real_escape_string($_POST['username']);
    $username = $_POST['username'];
	$con = mysqli_connect("localhost","root","","modul183");
	$query = "select * from login where username='".$username."'";

	$result = mysqli_query($con,$query);
	if($result == null){
		return false;
	}
	
	while($row = mysqli_fetch_array($result)){
		if($row['password'] == md5($_POST['password'])){
			$_SESSION['loggedIn'] = "true";
//			echo "succsess";
			header('Location: index.php');
		}else{
			echo "fail";
			//header('Location: index.php');
		}
	}
}
?>