<?php
$message = array();
$con = mysqli_connect("localhost","root","password","quickpros");
if ($con) {
	//intialize default parameter like date time likes
     $year = Date('Y');
     $month = Date('m');
     $day = Date('d');
     $hour = Date('H');
     $minutes = Date('i');
     $seconds = Date('s');
 
    //date and time to store
     $saveDate = $day."/".$month."/".$year;
     $saveTime = $hour.":".$minutes.":".$seconds;
     $str = $saveTime.$saveDate;
     // post id to store
     $postid = md5($str);
    //caption to store
     $caption = $_POST['caption'];;
    //post website to store
     $website = $_POST['website'];
    //public name to save 
     $nameofpost = "prashanth reddy";
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
									$direct = "post/images";
									if (!file_exists($direct)) {
									mkdir($direct,0777,true);
									}else{
									$file_destination = $direct."/".$postid.".".$file_allowed_ext_low;
    			                    $res = move_uploaded_file($imageloc, $file_destination);
                                    }
									if($res){
                                    $pos_query = "INSERT INTO posts(sno,postid,postby,postontime,postondate,postlike,postsite,caption,postlocation) values(null,'".$postid."','".$nameofpost."','".$saveTime."','".$saveDate."',0,'".$website."','".$caption."','".$file_destination."')";
                                    $res = mysqli_query($con,$pos_query);
                                    if ($res) {
                                    header("location: posts.php");
                                    }
                                        $message['message'] = "Done...";
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
	$message['error'] = "not connected";
}
echo json_encode($message);
?>