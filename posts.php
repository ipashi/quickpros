<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<style>
body {
  margin: 0;
  width: 100%;
  height: 100%;
  overflow-y: auto;
  position: absolute;
  background-color: #e0e0eb;
}
#navbar {
  overflow: hidden;
  background-color: #bb99ff;
}
.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}
#navbar-items{
	text-decoration: none;
}
.nav-bar-right{
	float: right;
}
.active{
	margin-left: 40px;
}
div ul li {
	display: inline;
	text-decoration: none;
	margin-right: 20px;
	font-size: 25px;
}
#navbar a{
	text-decoration: none;
	color: #000;
}
 h4{
	padding: 0;
	margin-top: 5;
	margin-left: 10px;
}
#main-side-menu-bar1{
    width: 20%;
    height: 100%;
    display: table-cell;
}
#side-menu-bar1{
	width: 100%;
	height: 100%;
	margin-top: 5px;
	border-style: groove;
}
.img-left{
	margin-left: 10px;
}
#side-menu-bar2 img{
	margin-top: 5px;
}
.mainDiv{
	width: 100%;
	height: 100%;
	margin-top: 0;
	margin-bottom: 100px;
	display: table;
}
#main-side-menu-bar2{
	margin: 0;
	padding: 0;
	width: 30%;
	border-style: groove;
	display: table-cell;
}
#side-menu-bar2{
	width: 100%;
	height: 100%;
	overflow-y: auto;
}
#main-side-menu-bar3{
	width: 50%;
	display: table-cell;
}
#side-menu-bar3-part1{
	margin: 0;
	padding: 0;
	width: 100%;
	height: 50%;
	border-style: groove;
	overflow-y: auto;
}
#side-menu-bar3{
	margin-top: 10px;
	width:100%;
	height: 48%;
	border-style: groove;
	overflow-y: auto;
	background-image: url("chat.png");
}
#btnUploadPhoto{
	margin-top: 20px;
	margin-left: 25px;
	width: 80%;
	margin-bottom: 20px;
}
#uploadDiv textarea{
    margin-top: 5px;
    padding: 10px;
	width: 100%;
}
#btnPhoto{
	margin-left: 0px;
	width: 100px;
}
#btnloc{
	width: 100px;
	display: none;
}

#real-file{
    		display: none;
    	}
#imageset{
	max-width: 400px;
	max-height: 400px;
	display: none;
}
/*#LocationSearch{
	display: none;
}*/
#modal {
	display:none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
}
.modal-content {
    background-color: #fefefe;
    margin: 4% auto 15% auto;
    border: 1px solid #888;
    width: 40%; 
	padding-bottom: 30px;
}
.animate {
    animation: zoom 0.6s
}
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}
.close:hover,.close:focus {
    color: red;
    cursor: pointer;
}
#profile_image{
	background-color: #ffff;
}
a:hover{
	text-decoration: none;
}
</style>
</head>
<body onload="getPost(event)">
<div id="navbar">
 <ul id="navbar-items"> 
  <li><a class="active" href="javascript:void(0)">Quickpros</a></li>
  <li class="nav-bar-right"><a href="javascript:void(0)">News feed</a></li>
  <li class="nav-bar-right"><a href="javascript:void(0)">Home</a></li>
 </ul>
</div> 
<div class="mainDiv">
	<div id="main-side-menu-bar1">
	<div id="side-menu-bar1">
		<!-- <h4 id="one">hello world</h4> -->
		<h4 style="display: none;" id="username"><?php echo $_SESSION['name'];?></h4>
		<div id="profile_image"></div>
        <script type="text/javascript">
        	function getprofile(e){
              var name = "<?php echo $_SESSION['name']?>";
               e.preventDefault();
               var xhr = new XMLHttpRequest();
		       xhr.open("POST",'getprofile.php',true);
		       xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		       xhr.onload = function(){
               if (this.status==200) {
               profile = JSON.parse(xhr.responseText);
               console.log(profile);
               document.getElementById('profile_image').innerHTML= `<br><img src = ${profile.profile_url} style='margin-top:6px;width:50px;height:50px;border-radius:50%;float:left'/>`+'<br><p id="profileName">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+profile.profile_name+'</p><br>';
               }
		    }
		    xhr.send("name="+name);
        }
        </script>
		<h4>About</h4>
		<h4>Settings</h4>
		<h4>Privacy Settings</h4>
		<h4>Interest</h4>
		<h4>Events</h4>
		<h4>Saved Events</h4>
		<h4>Account Settings</h4>
		<h4>Profile</h4>
    </div>
    </div>	
<div id="main-side-menu-bar2"><div id="side-menu-bar2">
			<div>
				<svg width="400px" height="40px" style='margin-top:3px;margin-bottom: 5px'>
					<rect width="400px" height="40px" style='stroke-width:3;fill:#ac3973'/>
				</svg>
			</div>
      

			<div id="uploadDiv">
				<div id="modal">
				<form class="modal-content animate" method="POST" action="post.save.php" enctype="multipart/form-data">
					<div class="imgcontainer">
					<span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp">&times;</span>
					<h1 style="text-align:center">Create An Event</h1>
					</div>
					<!-- input photo to save -->
                    <input type="file" id="real-file" name="photoUpload" onchange="preView(event)" >
				    <center><button type="button" class="btn btn-primary btn-sm" id="btnPhoto">photo/video</button></center>
				   <div>
					<center><img id="imageSet"/></center>
				    </div>
				    <br>
				    Enter the Website:<input type="text" name="website" placeholder="http://www.example.com">
				    <!-- input caption -->
				    <br>
				    Caption:
                    <textarea name="caption" style="padding-right: 10px;padding-left: 10px" placeholder="write something..."></textarea>
                    <!-- input submit -->
                    <center><input type="submit" name="submit" value="submit" style="margin-top: 10px"></center>
				</form>
				<script type="text/javascript">
					const btnRealphoto = document.getElementById('real-file');
					const btnNewphoto = document.getElementById('btnPhoto');
					btnNewphoto.addEventListener('click',function () {
					btnRealphoto.click();
					});
					function preView(e){
					var srcimage = document.getElementById('imageSet');
					srcimage.style="display:block;width:200px;height:200px"
					srcimage.src = URL.createObjectURL(e.target.files[0]);
					};
                </script>
				</div>
				 <div>
       	            <button type="button" class="btn btn-primary btn-lg" id="btnUploadPhoto" onclick="document.getElementById('modal').style.display='block'">Post</button>
                 </div>
                 </form>
			</div>
        <!-- script to load photos -->
        <script type="text/javascript">
            function getPost(e){
               e.preventDefault();
               getprofile(e);
               getfaculty(e);
               var xhr = new XMLHttpRequest();
		       xhr.open("POST",'getpost.php',true);
		       xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		       xhr.onload = function(){
               if (this.status==200) {
               post_url = JSON.parse(xhr.responseText);
               console.log(post_url);
               var i=0;
               while(i < post_url.url.length){
                  document.getElementById("postdiv").innerHTML+="<div><p>"+post_url.caption[i]+"</p><img width='400px' height='400px' src="+post_url.url[i]+">"+"<br>"+"<button><img width='110px' height='40px' src="+post_url.like_url+">"+post_url.like[i]+"</button><button onclick=getcmt('"+post_url.postid[i]+"')><img width='110px' height='40px' src="+post_url.comment_url+"></button>"+"<a target='_blank' href="+post_url.postsite[i]+"><button><img width='110px' height='40px' src="+post_url.web_url+"></button></a>"+"</div><hr>";
                  i++;
               }
            }
		}
		xhr.send("check=ok");
      }
      function getcmt(param){
          console.log(param);
      }
    </script>
    <div id="postdiv">
    </div>
       <img src="post.png">
       <img src="post.png">
       <img src="post.png">
       <img src="post.png">
       <img src="post.png">                         
       <img src="post.png">
       <img src="post.png">
       <br>
       <br>
       <br>
       <br><br>         
	</div></div>
		<div id="main-side-menu-bar3"> 
			<div id="side-menu-bar3-part1">
			<div id="facultydiv">
				
			</div>
            <script type="text/javascript">
            	function getfaculty(e){
            		e.preventDefault();
                    var xhr = new XMLHttpRequest();
		            xhr.open("POST",'getfaculty.php',true);
		            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		            xhr.onload = function(){
                    if (this.status==200) {
                    faculty_profile = JSON.parse(xhr.responseText);
                    console.log(faculty_profile);
                    var i=0;
                    while(i<faculty_profile.faculty.length){
                       document.getElementById('facultydiv').innerHTML += `<a href="http://localhost:4000/" target='_blank'><div style="background-color:#ffff"><img src = ${faculty_profile.faculty[i]} style='margin-top:6px;width:50px;height:50px;border-radius:50%;float:left'/>`+'<br><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+faculty_profile.facultyName[i]+'</p><hr></div></a>';
                       i++;
                    }
               }
		    }
		    xhr.send("check=ok");           
            	}
            </script>
			<!-- h4>Faculty Group-1</h4>
			<h4>Friends Adda</h4>
			<h4>Whatever</h4>
			<h4>Club Group Arts</h4>
			<h4>Club Group Science</h4>
			<h4>group-1</h4>
			<h4>group-2</h4>
			<h4>group-3</h4> -->
			    <br>
       <br>
       <br>
       <br><br>
			</div>
			<div id="side-menu-bar3">
				<center><h1>Every Question is Answered Here..!!</h1></center>
				<br><br>
        <div id="main-box">
        	<div id="message">
        		
        	</div>
        </div>
        <input type="text" id="msgwritten" placeholder="Type something..." style="width: 100%">
        <center><button id="btnsend" style="margin-top: 5px">Send</button></center>
        <script type="text/javascript">
        	document.getElementById('btnsend').addEventListener('click',function(){
                //connect to socket
                var socket = io.connect("http://localhost:4000");

        		var message = document.getElementById('msgwritten').value;
        		var output = document.getElementById('message');
        		alert(message+":"+profile.profile_name);
                //push data to network
        		socket.emit('chat',{
        			user:profile.profile_name,
        			message:message
        		});
                //get data from network
        		socket.on('chat',function(data){ 
                  output.innerHTML +='<p><strong>'+data.user+'</strong>'+data.message+'</p>';
                });
        	});
        </script>
       <br>
       <br>
       <br>
       <br><br>
		</div></div>
</div>
<script>
		window.onscroll = function() {myFunction()};
		var navbar = document.getElementById("navbar");
		var sticky = navbar.offsetTop;
		function myFunction() {
		  if (window.pageYOffset >= sticky+30) {
		    navbar.classList.add("sticky")
		    document.getElementById('one').style.visibility = "hidden";
		  } else {
		    navbar.classList.remove("sticky");
		    document.getElementById('one').style.visibility = "visible";
		  }
		}
</script>

</body>
</html>
