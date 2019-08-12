<?php
$message =array();
$i=0;
$main_url = "http://localhost/quickpros/";
$like_url = "http://localhost/quickpros/post/images/like.svg";
$comment_url = "http://localhost/quickpros/post/images/comment.svg";
$web_url = "http://localhost/quickpros/post/images/web.svg";
$message['like_url'] = $like_url;
$message['comment_url'] = $comment_url;
$message['web_url'] = $web_url;
$con = mysqli_connect("localhost","root","password","quickpros");
if ($con) {
   if ($_POST['check']=="ok") {
   	$sql_post = "SELECT * FROM posts";
   	$res = mysqli_query($con,$sql_post);
   while($post_assoc = mysqli_fetch_assoc($res)){
        $message["url"][$i] = $main_url.$post_assoc['postlocation'];
        $message["like"][$i] = $post_assoc['postlike'];
        $message["postsite"][$i] = $post_assoc['postsite'];
        $message["caption"][$i] = $post_assoc['caption'];
        $message["postid"][$i] = $post_assoc['postid'];
        $i++;
     }
    $message['postCount'] = $i;
   }
}
echo json_encode($message);
?>