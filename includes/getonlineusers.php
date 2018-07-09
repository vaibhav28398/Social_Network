<?php
if(!isset($_SESSION['uid']))
echo "<script>alert('Access Denied');window.location='../index.php';</script>";
$uid_owner=$_SESSION['uid'];
$db=new MYSQLi("localhost","root","","socialnetwork");
$query="SELECT * FROM online";
$result=mysqli_query($db,$query);
echo "<div class='container card' style='overflow:scroll;background-color:white; padding:0; height:500px;'>
<h3 style='background-color:#4d636f; padding:15px; border-radius:5px; color:white;'><strong>Online users <i class='fa fa-circle' style='color:#66ff33;'></i></strong></h3>
";
while($row=mysqli_fetch_array($result))
{
	$uid=$row['uid'];
	if($uid==$uid_owner)
		continue;
	$query1="SELECT * FROM users WHERE uid=$uid";
	$result1=mysqli_query($db,$query1);
	$row1=mysqli_fetch_array($result1);
	$name=$row1['name'];
	echo "
	<div class='well'>
	<a href='message.php?uid=$uid'><i class='fa fa-comment' ></i> $name</a>
	</div>
	";
} 
echo "</div>";
?>