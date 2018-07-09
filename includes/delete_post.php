<?php
session_start();
if(!isset($_SESSION['uid']))
echo "<script>alert('Access Denied');window.location='../index.php';</script>";
$uid_login=$_SESSION['uid'];
if(!isset($_GET['post_id'])||!isset($_GET['uid_post']))
echo "<script>alert('Can\'t Delete');window.location='../member.php';</script>";
$post_id=$_GET['post_id'];
$uid_post=$_GET['uid_post'];
if($uid_login!=$uid_post)
	echo"<script>alert('You cannot delete this post');window.location='../logout.php';</script>";
else
{
	$db=new MYSQLi("localhost","root","","socialnetwork");
	$query="DELETE FROM posts WHERE post_id=$post_id";
	$query1="DELETE FROM comments WHERE post_id=$post_id";
	mysqli_query($db,$query);
	mysqli_query($db,$query1);
	echo"<script>alert('Post Deleted Successfully');window.location='../member.php';</script>";
}
?>