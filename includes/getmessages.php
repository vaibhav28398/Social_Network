<?php
if(!isset($_SESSION['uid']))
echo "<script>alert('Access Denied');window.location='../index.php';</script>";
$sender_id=$_SESSION['uid'];
if(!isset($_GET['uid']))
echo "<script>alert('Can\'t Message');window.location='../member.php';</script>";
$reciever_id=$_GET['uid'];
$query="SELECT * FROM messages WHERE ( sender_id='$sender_id' AND reciever_id='$reciever_id' ) OR (sender_id='$reciever_id' AND reciever_id='$sender_id')";
$result=mysqli_query($db,$query);
$query1="SELECT * FROM users WHERE uid='$reciever_id'";
$result1=mysqli_query($db,$query1);
$row1=mysqli_fetch_array($result1);
$query3="UPDATE messages SET read_status='yes' WHERE reciever_id='$sender_id' AND sender_id='$reciever_id'";
mysqli_query($db,$query3);
$profile_pic_reciever=$row1['profile_pic'];
$reciever_name=$row1['name'];
echo "<div class='container card' style='background-color:white;overflow:scroll; width:100%; height:500px; border-radius:10px; margin-top:10px;'>
<div class='row' style='padding:10px;'>
<img src='images/profilepic/$profile_pic_reciever'  class='img-circle' width='50' height='50'>
<strong>$reciever_name</strong>
</div>
";
while($row=mysqli_fetch_array($result))
{
	$sender_id1=$row['sender_id'];
	$reciever_id1=$row['reciever_id'];
	$msg_content=$row['msg_content'];
	$date=$row['msg_date'];
	if($sender_id==$sender_id1)
	{
		echo"
		<div class='container' style='width:100%; padding:0;'>
		<div class='well' style='width:50%; float:right; background-color:#4d636f; color:white;padding:5px; padding-bottom:0;'>
		<p>$msg_content</p>
		<p style='font-size:10px; float:right;'>$date</p>
		</div>
		</div>
		";
	}
	else
	{
		echo"
		<div class='container' style='width:100%; padding:0;'>
		<div class='well' style='width:50%; float:left;padding:5px; padding-bottom:0;'>
		<p>$msg_content</p>
		<p style='font-size:10px; float:right;'>$date</p>
		</div>
		</div>
		";
	}
}
echo "</div>";
echo "<div style='margin-top:10px;'>
		<form method='POST' action='' enctype='multipart/form-data' >
			<textarea class='form-control' name='message' rows='2' placeholder='Write Your reply' style='width:50%;' required></textarea>
			<button type='submit' name='submit' style='color:white;background-color:#4d636f;' ><i class='fa fa-pencil'></i>SEND</button>
		</form> 
	  </div>";

	  if(isset($_POST['submit']))
	  {
	  	$msg_content=addslashes($_POST['message']);
	  	if($msg_content=="")
	  	{
	  		echo "<script>alert('Message can\'t be empty');window.location('message.php?uid=$reciever_id');</script>";
	  	}

	  	$query2="INSERT INTO messages (sender_id,reciever_id,msg_content,msg_date) VALUES ('$sender_id','$reciever_id','$msg_content',NOW())";
	  	$result2=mysqli_query($db,$query2);
	  	echo "<script>window.location='message.php?uid=$reciever_id';</script>";
	  }
?>
