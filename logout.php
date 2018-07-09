<?php
session_start();
$db=new MYSQLi("localhost","root","","socialnetwork");
$uid=$_SESSION['uid'];
$query="DELETE FROM online WHERE uid='$uid'";
mysqli_query($db,$query);
session_destroy();
unset($_SESSION['uid']);
echo"<script>alert('Logged out successfully');window.location='index.php';</script>"
?>