<?php
session_start();
if(!isset($_SESSION['uid']))
echo "<script>alert('Access Denied');window.location='../index.php';</script>";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$uid=$_SESSION['uid'];
	$db=new MYSQLi("localhost","root","","socialnetwork");
	$allowed=array("jpg","jpeg","png");
	$profile_pic=$_FILES["image"]["name"];
	$ext=strtolower(end(explode('.',$profile_pic)));
	if(in_array($ext, $allowed))
	{
		
		$target="images/profilepic/".$uid.".".$ext;
		$imgname=$uid.".".$ext;
		move_uploaded_file($_FILES['image']['tmp_name'], $target);
		$query="UPDATE users SET profile_pic='$imgname' WHERE uid='$uid'";
		$result=mysqli_query($db,$query);
		if($result)
		{
			echo"<script>alert('Profile Pic successfully changed.');window.location='member.php';</script>";
		}
		else
		{
			echo"<script>alert('Profile Pic Failed to upload.');window.location='member.php';</script>";			
		}
	}
	else
		echo"<script>alert('Failed to upload');window.location='member.php';</script>";
}


?>