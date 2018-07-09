<?php
if(!isset($_SESSION['uid']))
echo "<script>alert('Access Denied');window.location='../index.php';</script>";
if(!isset($_GET['uid']))
echo "<script>alert('Try Again);window.location='../member.php';</script>";
$uid_profile=$_GET['uid'];
$db=new MYSQLi("localhost","root","","socialnetwork");
$per_page=5;
if(isset($_GET['page']))
{
	$page=$_GET['page'];

}
else
{
	$page=1;
}
$start_from=($page-1)*($per_page);
$query="SELECT * FROM posts WHERE uid='$uid_profile' ORDER BY post_id DESC LIMIT $start_from,$per_page";
$result=mysqli_query($db,$query);
while ($row=mysqli_fetch_array($result)) {
 	$uid=$row['uid'];
 	$date=$row['post_date'];
 	$post_id=$row['post_id'];
 	$content=substr($row['post_content'],0,200);
 	$query2="SELECT * FROM comments WHERE post_id=$post_id";
 	$result2=mysqli_query($db,$query2);
 	$comments_count=mysqli_num_rows($result2);
 	$query1="SELECT * FROM users WHERE uid='$uid'";
 	$result1=mysqli_query($db,$query1);
 	$row1=mysqli_fetch_array($result1);
 	$name=$row1['name'];
 	$profile_pic=$row1['profile_pic'];
 	echo "<div class='row' style='padding:15px;background-color:white;margin-top:15px;'>
 			<span><img src='images/profilepic/$profile_pic' height='55' width='55' class='img-circle'>
 			<span style='padding:5px;'><strong>$name</strong></span>
 			<span style='float:right;'>".substr($date,0,10)."<br>".substr($date,11)."
 			</span></span>
 			<hr>
 			<div>
 			<p><pre>$content.........</pre></p>
 			</div>
 			<a href='singlepost.php?post_id=$post_id'><button type='button' style='color:white;background-color:#4d636f;' ><i class='fa fa-file-text'></i>Full Post</button></a>";
            if($uid_profile==$_SESSION['uid'])
            	echo"
 			<a href='singlepost.php?post_id=$post_id'><button type='button' style='color:white;background-color:#4d636f;' ><i class='fa fa-pencil'></i>Edit</button></a>";
 			echo"
 			<a href='singlepost.php?post_id=$post_id'><button type='button' style='color:white;background-color:#4d636f;' ><i class='fa fa-comment'></i>Comment<span style='color:red;'>( $comments_count )</span></button></a>

      	  </div>
 	";

 } 
 include 'paginationprofile.php';
?>

