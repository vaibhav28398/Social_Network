<?php
if(!isset($_SESSION['uid']))
echo "<script>alert('Access Denied');window.location='../index.php';</script>";
if(!isset($_GET['post_id']))
echo "<script>alert('Can't Load);window.location='../member.php';</script>";
$post_id=$_GET['post_id'];
$uid_login=$_SESSION['uid'];
$db=new MYSQLi("localhost","root","","socialnetwork");
$query="SELECT * FROM comments WHERE post_id=$post_id";
$result=mysqli_query($db,$query);
echo "<div class='container' style='background-color:white; width:100%;'>
		<h4>Comments</h4>";
while($row=mysqli_fetch_array($result))
{
	$content=$row['content'];
	$comment_date=$row['comment_date'];
	$comment_id=$row['comment_id'];
	$uid=$row['uid'];
	$query1="SELECT * FROM users WHERE uid=$uid";
	$result1=mysqli_query($db,$query1);
	$row1=mysqli_fetch_array($result1);
	$name=$row1['name'];
	$profile_pic=$row1['profile_pic'];
	echo "
	<div class='row' style='padding:10px;'>
		<div class='well col-sm-3' style=' padding:5px;'>
			<img src='images/profilepic/$profile_pic' height='50' width='50' class='img-circle'>
			<strong><a href='member.php?uid=$uid'>$name</a></strong><br>
			<strong>".substr($comment_date,0,10)."<br>".substr($comment_date,11)."</strong>
		</div>
		<div class='col-sm-9 well' >
			<p >$content</p>";
			if($uid==$uid_login)
			echo"<a href='includes/delete_comment.php?comment_id=$comment_id'><button type='button' style='color:white;background-color:#4d636f;' id='btn' ><i class='fa fa-comment'></i>Delete</button></a>";
		echo"
		</div>
	</div>
	
	";
}
echo "</div>";
?>