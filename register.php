<?php
$message = array();
$con = mysqli_connect("localhost","root","password","quickpros");
if ($con) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$password = md5($_POST['passone']);
    $email = $_POST['email'];
    $role = $_POST['role'];

   //anonymous is cration
     $day = Date('D');
     $year = Date('Y');
     $seconds = Date('u');
     $num = mt_rand(0,10000);
     $char = substr($firstname,-3);
     $str = $char.$year.$day.$seconds.$num;
     $anyid = md5($str);
   //joined date
     $year = Date('Y');
     $month = Date('m');
     $day = Date('d');
     $joinDate = $day."/".$month."/".$year;
   //proile location
    $image = $_FILES['photoUpload'];
    $imagename = $_FILES['photoUpload']['name'];
	$imagetype = $_FILES['photoUpload']['type'];
	$imageloc = $_FILES['photoUpload']['tmp_name'];
    $imageize = $_FILES['photoUpload']['size']; 
	$imageerror = $_FILES['photoUpload']['error'];
    $imageext = explode('.',$imagetype);
    $image_actual_ext = end($imageext);
    $image_actual_ext1 = explode('/', $image_actual_ext);
    $image_actual_ext2 = end($image_actual_ext1);
    $file_allowed_ext_low = strtolower($image_actual_ext2);
    $file_allowed_ext = array('jpg','jpeg','png','pdf');
    if (in_array($file_allowed_ext_low, $file_allowed_ext)) {
    	       if($imageerror === 0){
    		               if ($imageize < 1000000) {
									$direct = "proile/images";
									if (!file_exists($direct)) {
									mkdir($direct,0777,true);
									}else{
									$file_destination = $direct."/".$str.".".$file_allowed_ext_low;
    			                    $res = move_uploaded_file($imageloc, $file_destination);
                                    }
									if($res){
										echo "done1";
                                    $user_query = "INSERT INTO users values(null,'".$anyid."','".$firstname."','".$lastname."','".$email."','".$password."','".$role."','".$file_destination."','".$joinDate."','null','null','null')";
                                    $res = mysqli_query($con,$user_query);
                                    if ($res) {
                                    	echo "done";
                                        $message['message'] = "Done...";
                                        header("location: posts.php");
                                        }
                                    }
									else{$message['error'] =  "fail to upload";}
    		                }else{
    			              $message['error'] = "file should be less than 1,00,000 kilo bytes";
    		                }

    	}else{
    		$message['error'] = "there is an error uploading this msg";
    	}
    }else{
    	$message['error'] = "file of this type are no allowed";
    }
}else{
   $message['message'] = "not connected";
}
?>