<?php
session_start();
if(!isset($_SESSION['uid']))
echo "<script>alert('Access Denied');window.location='index.php';</script>";
$db=new MYSQLi("localhost","root","","socialnetwork");
$uid=$_SESSION["uid"];
$query="SELECT * FROM users WHERE uid='$uid'";
$result=mysqli_query($db,$query);
$row=mysqli_fetch_array($result);
$name=$row['name'];
$profile_pic=$row['profile_pic'];
$query1="SELECT * FROM messages WHERE reciever_id='$uid' AND read_status='no'";
$result1=mysqli_query($db,$query1);
$msg_count=mysqli_num_rows($result1);
$query2="SELECT DISTINCT post_id FROM comments WHERE read_status='no'";
$result2=mysqli_query($db,$query2);
$notif_count=0;
while($row=mysqli_fetch_array($result2))
{
    $post_id=$row['post_id'];
    $query3="SELECT * FROM posts WHERE post_id='$post_id' ";
    $result3=mysqli_query($db,$query3);
    $row3=mysqli_fetch_array($result3);
    if($row3['uid']!=$uid)
        continue;
    $query4="SELECT * FROM comments WHERE read_status='no' AND post_id=$post_id ";
    $result4=mysqli_query($db,$query4);
    $notif_count=$notif_count+mysqli_num_rows($result4);

}
?>
<!DOCTYPE html>
<html>
<head>
<title>Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/profilestyle.css">
    <script type="text/javascript">
    $(document).ready(function(){
        $("#show").hide();
    });
    $(document).ready(function(){
        $("#hide").click(function(){
            $("#hide").hide();
            $("#show").show();
        })
    });
    </script>
</head>
<body>
<!-- Including footer -->
<?php
include 'includes/header.php';
?>
<!--Beginning of middle part -->

<div class="container">
    <!-- BEginning of side menu -->
    <div class="card col-md-2 lside" >
        <table class="menu" style="color:black;"  >
            <tr >
                <td class="propic" >
                    <?php echo "<img src='images/profilepic/$profile_pic' width='100%;'>";?>
                </td>
            </tr>
            <tr class="tbrow" >
                <td class="tbrowsub">
                    <h3 id="hide">Change dp</h3>
                    <span id="show" style="padding:10px;">
                    <form  action="changedp.php" method="post" enctype="multipart/form-data" >
                        <div class="form-group ">
                            <input type="file" name="image" class="form-control" required />
                            <input type="submit" value="change"/>
                        </div>
                    </form>
                    </span>
                </td>
            </tr>
            <tr class="tbrow active1">
                <td class="tbrowsub">
                    <a href="member.php" class="menulink"><h3>Home<i class="iconmenu fa fa-group"></i></h3></a>
                </td>
            </tr>
            <tr class="tbrow">
                <td class="tbrowsub">
                    <a class="menulink" href="unreadmessages.php"><h3>Messages<span style="color:red;"><?php echo "( $msg_count )"; ?></span><i class="iconmenu fa fa-file-text"></i></h3></a>
                </td>
            </tr>
            <tr class="tbrow">
                <td class="tbrowsub">
                    <a class="menulink" href="profile.php?uid=<?php echo $uid ?>"><h3>Profile<i class="iconmenu fa fa-drivers-license"></i></h3></a>
                </td>
            </tr>
            <tr class="tbrow">
                <td class="tbrowsub">
                    <a class="menulink" href="memberinfo.php"><h3>Members<i class="iconmenu fa fa-address-book"></i></h3></a>
                </td>
            </tr>
            <tr class="tbrow">
                <td class="tbrowsub">
                    <a class="menulink" href="logout.php"><h3>Logout<i class="iconmenu fa fa-power-off"></i></h3></a>
                </td>
            </tr>
        </table>
    </div>
    <!-- End of side menu -->


    <div class="col-md-8">
    

    <!--Beginning of post display area -->
        <div class="container post" style="width:100%; padding:0; height:600px; overflow:scroll;">
            <h3 style='background-color:#4d636f; padding:15px; border-radius:5px; color:white;'><strong>New comments <i class='fa fa-comments' style='color:white;'></i></strong></h3>

            <?php include "includes/newcomments.php" ?>
        </div>
    <!--End of post display area -->
    </div>
    <!-- Beginnning of online users -->
    <div class="col-md-2">
        <?php include "includes/getonlineusers.php" ?>
    </div>
    <!-- End of online users -->
</div>
</body>
</html>