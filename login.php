<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$db=new MYSQLi("localhost","root","","socialnetwork");
	$email=mysql_real_escape_string($_POST["email"]);
	$password=$_POST["password"];
	$query="SELECT * FROM users WHERE email='$email' AND password='$password' ";
	$result=mysqli_query($db,$query);
	if(mysqli_num_rows($result)>0)
	{
		$row=mysqli_fetch_array($result);
		$_SESSION['uid']=$row['uid'];
		$uid=$row['uid'];
		$query1="SELECT * FROM online where uid='$uid'";
		$result1=mysqli_query($db,$query1);
		if(mysqli_num_rows($result1)==0)
		{
			$query2="INSERT INTO online (uid,login_time) VALUES ('$uid',NOW())";
			$result2=mysqli_query($db,$query2);
		}
		header("location:member.php");
	}
	else
		echo"<script>alert('Incorrect Username/Password');window.location='index.php';</script>";

}
?>