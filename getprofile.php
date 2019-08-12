<?php
$message = array();
$main = "http://localhost/quickpros/";
$con = mysqli_connect("localhost","root","password","quickpros");
if ($con) {
	$user = $_POST['name'];
	$prof_sql ="SELECT profileloc,firstname from users where email='".$user."' OR firstname='".$user."'";
	$res = mysqli_query($con,$prof_sql);
	if (mysqli_num_rows($res)>0) {
		$profile = mysqli_fetch_assoc($res);
		$message['profile_url'] = $main.$profile['profileloc'];
		$message['profile_name']=$profile['firstname'];
	}else{
		$message['error']="No row selected";
	}
}else{
  $message['error']="Not Connected";
}
echo json_encode($message);
?>