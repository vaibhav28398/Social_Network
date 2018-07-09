<?php
if(!isset($_SESSION['uid']))
echo "<script>alert('Access Denied');window.location='../index.php';</script>";
$uid=$_SESSION['uid'];
$db=new MYSQLi("localhost","root","","socialnetwork");
$query="SELECT DISTINCT post_id FROM comments WHERE read_status='no'";
$result=mysqli_query($db,$query); 
while ($row=mysqli_fetch_array($result)) {
 	$post_id=$row['post_id'];
 	
 	$query1="SELECT * FROM posts WHERE post_id='$post_id' AND uid=$uid";
 	$result1=mysqli_query($db,$query1);
 	if(mysqli_num_rows($result1)==0)
 		continue;
 	$row4=mysqli_fetch_array($result1);
 	$content=substr($row4['post_content'],0,200);
 	$date=$row4['post_date'];
 	$query2="SELECT * FROM comments WHERE read_status='no' AND post_id=$post_id";
 	$result2=mysqli_query($db,$query2);
 	$comments_count=mysqli_num_rows($result2);
 	$query3="SELECT * FROM users WHERE uid=$uid";
 	$result3=mysqli_query($db,$query3);
 	$row3=mysqli_fetch_array($result3);
 	$name=$row3['name'];
 	$profile_pic=$row3['profile_pic'];
 	echo "<div class='row' style='padding:15px;background-color:white;margin-top:15px;'>
 			<span><img src='images/profilepic/$profile_pic' height='55' width='55' class='img-circle'>
 			<span style='padding:5px;'><strong><a href='profile.php?uid=$uid'>$name</a></strong></span>
 			<span style='float:right;'>".substr($date,0,10)."<br>".substr($date,11)."
 			</span></span>
 			<hr>
 			<div>
 			<p>$content</p>
 			</div>
 			<a href='singlepost.php?post_id=$post_id'><button type='button' style='color:white;background-color:#4d636f;' ><i class='fa fa-file-text'></i>Full Post</button></a>
 			<button type='button' style='color:white;background-color:#4d636f;' ><i class='fa fa-thumbs-up'></i>Like</button>
 			<a href='singlepost.php?post_id=$post_id'><button type='button' style='color:white;background-color:#4d636f;' ><i class='fa fa-comment'></i>Comment<span style='color:red;'>( $comments_count )</span></button></a>

      	  </div>
 	";

 } 
?>