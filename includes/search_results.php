<?php
if(!isset($_SESSION['uid']))
echo "<script>alert('Access Denied');window.location='../index.php';</script>";
$uid_owner=$_SESSION['uid'];
$search_name=$_POST["search"];
if($search_name=="")
echo "<script>alert('Search box cannot be empty');window.location('member.php');</script>";	
$db=new MYSQLi("localhost","root","","socialnetwork");
$query="SELECT * FROM users";
$result=mysqli_query($db,$query);
echo "<div class='container card' style='overflow:scroll;background-color:white; padding:0; height:500px; width:100%'>
<h3 style='background-color:#4d636f; padding:15px; border-radius:5px; color:white;'><strong>Search Results <i class='fa fa-search' style='color:white;'></i></strong></h3>
";
while($row=mysqli_fetch_array($result))
{
	$uid=$row['uid'];
	if($uid==$uid_owner)
		continue;
	$name=$row['name'];
	$name1=strtolower($name);
	$search_name=strtolower($search_name);
	$profile_pic=$row['profile_pic'];
	if(!preg_match("/$search_name/",$name1))
		continue;
	echo "
	<div class='well container' style='width:100%;'>
	<a href='profile.php?uid=$uid'><img src='images/profilepic/$profile_pic' height='50' width='50' class='img-circle'><strong> $name</strong></a>
	<a href='message.php?uid=$uid'><button type='button' style='background-color:#4d636f; color:white; border-radius:5px; float:right;'><i class='fa fa-comment'></i>Message</button></a>
	</div>
	";
} 
echo "</div>";
?>