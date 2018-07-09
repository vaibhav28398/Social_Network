
<?php
if(!isset($_SESSION['uid']))
echo "<script>alert('Access Denied');window.location='../index.php';</script>";
$db=new MYSQLi("localhost","root","","socialnetwork");
if(!isset($_GET['post_id']))
echo "<script>alert('Can\'t Load');window.location='../member.php';</script>";
$post_id=$_GET['post_id'];
$uid2=$_SESSION['uid'];
$query="SELECT * FROM posts WHERE post_id=$post_id";
$result=mysqli_query($db,$query);
$row=mysqli_fetch_array($result);

$uid=$row['uid'];
if($uid2==$uid)
{$query3="UPDATE comments SET read_status='yes' WHERE post_id='$post_id'";
mysqli_query($db,$query3);}
$date=$row['post_date'];
$post_id=$row['post_id'];
$content=$row['post_content'];
$query1="SELECT * FROM users WHERE uid='$uid'";
$result1=mysqli_query($db,$query1);
$row1=mysqli_fetch_array($result1);
$name=$row1['name'];
$profile_pic=$row1['profile_pic'];
echo "<div class='row' style='padding:15px;background-color:white;margin-top:15px;'>";
		if($uid==$uid2)
			echo"
		<div style='float:right;' title='Delete Post'><a  href='includes/delete_post.php?post_id=$post_id&uid_post=$uid'><i class='fa fa-close' style='font-size:30px;color:red'></i></a></div><br>";
		echo"
		<span><img src='images/profilepic/$profile_pic' height='55' width='55' class='img-circle'>
		<span style='padding:5px;'><strong><a href='profile.php?uid=$uid'>$name</a></strong></span>
		<span style='float:right;'>".substr($date,0,10)."<br>".substr($date,11)."
		</span></span>
		<hr>
		<div>
		<p><pre>$content</pre></p>
		</div>";
		if($uid2==$uid)
			echo"

		<a href='singlepost.php?post_id=$post_id&post_edit=true'><button type='button' style='color:white;background-color:#4d636f;' ><i class='fa fa-pencil'></i>Edit</button></a>";
		echo"
		<button type='button' style='color:white;background-color:#4d636f;' ><i class='fa fa-comment'></i>Comment</button>


   	  </div>
 	";

echo "<div style='margin-top:20px;'>
		<form method='POST' action='' enctype='multipart/form-data'>
			<textarea class='form-control' name='comment' rows='2' placeholder='Write Your reply'required></textarea><br>
			<button type='submit' name='submit' style='color:white;background-color:#4d636f;' ><i class='fa fa-pencil'></i>POST</button>
		</form> 
	  </div>";
include 'comments.php';
	  if(isset($_POST['submit']))
	  {
	  	$uid1=$_SESSION['uid'];
	  	$comment=addslashes($_POST['comment']);
	  	if($comment=="")
	  	echo "<script>alert('Comment can\'t be empty');window.location='singlepost.php?post_id=$post_id';</script>";	
	  	else{
	  	$query2="INSERT INTO comments (uid,post_id,content,comment_date) VALUES ('$uid1','$post_id','$comment',NOW())";
	  	$result2=mysqli_query($db,$query2);
	  	echo "<script>alert('Comment added Successfully');window.location='singlepost.php?post_id=$post_id';</script>";
	  		}
	  }
?>