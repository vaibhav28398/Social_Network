<?php
session_start();
$db=new MYSQLi("localhost","root","","socialnetwork");
require("includes/function.php");
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$name=validate($_POST["name"]);
	$email=mysql_real_escape_string($_POST["email"]);
	$password=$_POST["password"];
	$cpassword=$_POST["cpassword"];
	if($name==""||$email==""||$password==""||$cpassword=="")
		echo "<script>alert('Fill all the details');window.location='index.php';</script>";
	if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		echo "<script>alert('Invalid Email.);window.location='index.php';</script>";
	if($password!=$cpassword)
		echo "<script>alert('Password Do not match');window.location='index.php';</script>";
	$query="SELECT * FROM users WHERE email='$email' ";
	$result=mysqli_query($db,$query);
	if(mysqli_num_rows($result)>0)
		echo "<script>alert('Account with this email has already been created');window.location='index.php';</script>";
	$query="INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')";
	mysqli_query($db,$query);
	echo"<script>alert('Account has been successfully created. Please Login');window.location='index.php';</script>";
}
?>