<?php
session_start();
if(!isset($_SESSION['uid']))
echo "<script>alert('Access Denied');window.location='index.php';</script>";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$db=new MYSQLi("localhost","root","","socialnetwork");
	$uid=$_SESSION['uid'];
	$post_content=addslashes($_POST['posttext']);
	if($post_content=="")
		echo "<script>alert('Text field cannot be empty');window.location='member.php';</script>";
	else
	{
		$query="INSERT INTO posts (uid,post_content,post_date) VALUES ('$uid','$post_content',NOW())";
		$p=mysqli_query($db,$query);
		echo"<script>alert('Posted successfully');window.location='member.php';</script>";
	}

}
?>