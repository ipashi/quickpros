<?php
$message = array();
$main ="http://localhost/quickpros/";
$con = mysqli_connect("localhost","root","password","quickpros");
if ($con) {
	if ($_POST['check']="ok") {
		$sql = "SELECT * FROM users where userrole='faculty'";
		$res = mysqli_query($con,$sql);
		$i=0;
		if ($res) {
			while ($faculty_assoc = mysqli_fetch_assoc($res)) {
				$message['faculty'][$i] = $main.$faculty_assoc['profileloc'];
				$message['facultyName'][$i] = $faculty_assoc['firstname'];
				$i++; 
			}
		}else{
			$message['error']="Unable to fetch";
		}
	}else{
		$message['error'] = "request not received";
	}
}else{
	$message['error'] = "not connected";
}
echo json_encode($message);
?>