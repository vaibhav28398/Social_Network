<?php
if(!isset($_SESSION['uid']))
echo "<script>alert('Access Denied');window.location='../index.php';</script>";
$db=new MYSQLi("localhost","root","","socialnetwork");
if(!isset($_GET['uid']))
echo "<script>alert('Can\'t Load');window.location='../member.php';</script>";
$uid=$_GET['uid'];
$query= "SELECT * FROM posts WHERE uid='$uid'";
$result=mysqli_query($db,$query);
$total_post=mysqli_num_rows($result);
$total_pages=ceil($total_post/$per_page);
echo "<center><div id='pagination' >
				<button class='btn btn-info'><a href='profile.php?page=1&uid=$uid'>First page</a></button>'
			  ";
for($i=2;$i<$total_pages;$i++)
{
	echo"<button class='btn btn-info'><a href='profile.php?page=$i&uid=$uid'>$i</a></button>";
}
echo "</div></center>";


?>