<?php
if(!isset($_SESSION['uid']))
echo "<script>alert('Access Denied');window.location='../index.php';</script>";
$db=new MYSQLi("localhost","root","","socialnetwork");
$query= "SELECT * FROM posts";
$result=mysqli_query($db,$query);
$total_post=mysqli_num_rows($result);
$total_pages=ceil($total_post/$per_page);
echo "<center><div id='pagination' >
				<button class='btn btn-info'><a href='member.php?page=1'>First page</a></button>'
			  ";
for($i=2;$i<$total_pages;$i++)
{
	echo"<button class='btn btn-info'><a href='member.php?page=$i'>$i</a></button>";
}
echo "<button class='btn btn-info'> <a href='member.php?page=$total_pages'>Last Page</a></button></div></center>";


?>