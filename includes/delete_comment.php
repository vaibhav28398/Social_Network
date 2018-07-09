<?php
session_start();
if(!isset($_SESSION['uid']))
echo "<script>alert('Access Denied');window.location='../index.php';</script>";
$db=new MYSQLi("localhost","root","","socialnetwork");
$uid_login=$_SESSION['uid'];
if(!isset($_GET['comment_id']))
echo "<script>alert('Can\'t Delete');window.location='../member.php';</script>";
$comment_id=$_GET['comment_id'];
$query="SELECT * FROM comments WHERE comment_id=$comment_id";
$result=mysqli_query($db,$query);
$row=mysqli_fetch_array($result);
$uid_comment=$row['uid'];
$post_id=$row['post_id'];
if($uid_login!=$uid_comment)
	echo "<script>alert('You are not allowed to delete this comment');window.location='../logout.php';</script>";
else
{
	$query1="DELETE FROM comments WHERE comment_id=$comment_id";
	$result1=mysqli_query($db,$query1);
	echo"<script>alert('Comment deleted Successfully');window.location='../singlepost.php?post_id=$post_id';</script>";

}

?>