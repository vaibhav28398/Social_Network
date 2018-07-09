
<?php
$db=new MYSQLi("localhost","root","","socialnetwork");
if(!isset($_SESSION['uid']))
echo "<script>alert('Access Denied');window.location='../index.php';</script>";
if(!isset($_GET['post_id']))
echo "<script>alert('Can\'t Edit');window.location='../member.php';</script>";
$post_id=$_GET['post_id'];
$uid2=$_SESSION['uid'];

$query="SELECT * FROM posts WHERE post_id=$post_id";
$result=mysqli_query($db,$query);
$row=mysqli_fetch_array($result);

$uid=$row['uid'];
if($uid!=$uid2)
echo"<script>alert('You cannot edit this post');window.location='../logout.php';</script>";
else{
$date=$row['post_date'];
$post_id=$row['post_id'];
$content=$row['post_content'];
$query1="SELECT * FROM users WHERE uid='$uid'";
$result1=mysqli_query($db,$query1);
$row1=mysqli_fetch_array($result1);
$name=$row1['name'];
$profile_pic=$row1['profile_pic'];
echo "<div class='row' style='padding:15px;background-color:white;margin-top:15px;'>
		<span><img src='images/profilepic/$profile_pic' height='55' width='55' class='img-circle'>
		<span style='padding:5px;'><strong><a href='profile.php?uid=$uid'>$name</a></strong></span>
		<span style='float:right;'>".substr($date,0,10)."<br>".substr($date,11)."
		</span></span>
		<hr>
		<div>
		<form method='POST' action='' enctype='multipart/form-data'><textarea class='form-control' name='content'>$content</textarea>
		<button type='submit' name='submit' style='color:white;background-color:#4d636f;' ><i class='fa fa-pencil'></i>POST</button>
		</form><br>
		</div>
		
		</div>
		";
		
	  if(isset($_POST['submit']))
	  {
	  	$content=addslashes($_POST['content']);
	  	if($content=="")
	  	echo "<script>alert('Post can\'t be empty');window.location='../singlepost.php?post_id=$post_id';</script>";	
	  	else{
	  	$query2="UPDATE posts SET post_content='$content' WHERE post_id='$post_id'";
	  	$result2=mysqli_query($db,$query2);
	  	echo "<script>alert('Post edited Successfully');window.location='../singlepost.php?post_id=$post_id';</script>";
	  		}
	  }}
?>