<?php
if(!isset($_SESSION['uid']))
echo "<script>alert('Access Denied');window.location='../index.php';</script>";
$db=new MYSQLi("localhost","root","","socialnetwork");
$uid=$_SESSION['uid'];
$query="SELECT DISTINCT sender_id FROM messages WHERE reciever_id='$uid' AND read_status='no'";
$result=mysqli_query($db,$query);
echo "<div class='container card' style='overflow:scroll;background-color:white; padding:0; height:500px; width:100%'>
<h3 style='background-color:#4d636f; padding:15px; border-radius:5px; color:white;'><strong>Unread Messages <i class='fa fa-comments' style='color:white;'></i></strong></h3>
";
while($row=mysqli_fetch_array($result))
{
	$sender_id=$row['sender_id'];
	$query1="SELECT * FROM users WHERE uid='$sender_id'";
	$result1=mysqli_query($db,$query1);
	$row1=mysqli_fetch_array($result1);
	$name=$row1['name'];
	$profile_pic=$row1['profile_pic'];
	$query2="SELECT * FROM messages WHERE reciever_id='$uid' AND sender_id='$sender_id' AND read_status='no'";
	$result2=mysqli_query($db,$query2);
	$msg_count=mysqli_num_rows($result2);
	echo "
	<div class='well container' style='width:100%;'>
	<a href='message.php?uid=$sender_id'><img src='images/profilepic/$profile_pic' height='50' width='50' class='img-circle'><strong> $name  <span style='color:red;'>$msg_count</span></strong><button type='button' style='background-color:#4d636f; color:white; border-radius:5px; float:right;'><i class='fa fa-comment'></i>Message</button></a>
	</div>
	";
} 
echo "</div>";
?>