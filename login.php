<?php
session_start();
$con = mysqli_connect("localhost","root","password","quickpros");
if ($con) {
	$name = $_POST['userName'];
	$_SESSION['name'] = $name;
	$password = md5($_POST['password']);
	$check_one = "SELECT * FROM users where firstname ='".$name."' AND password='".$password."'";
	$check_two = "SELECT * FROM users where email ='".$name."' AND password='".$password."'";
	$res1 = mysqli_query($con,$check_one);
	$res2 = mysqli_query($con,$check_two);
	if (mysqli_num_rows($res1)==1||mysqli_num_rows($res2)==1) {
       header("location: posts.php");		
	}else{
		echo "fail";
	}
}
?>