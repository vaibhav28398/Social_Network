<nav class="navbar"style="background-color:#4d636f;color:white;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="member.php">Home</a></li>
        <li><a href="unreadmessages.php"><i class="fa fa-comments" style='font-size:20px;'></i><span style="color:red;"><?php echo "( $msg_count )"; ?></span></a></li>
        <li><a href="unread_comments.php"><i class="fa fa-bell" style='font-size:20px;'></i><span style="color:red;"><?php echo "( $notif_count )"; ?></span></a></li>

      </ul>
      <form class="navbar-form navbar-right" action="search_results_display.php" method="POST" enctype="multipart/formdata" role="search">
        <div class="form-group input-group">
          <input type="text" class="form-control" name="search" placeholder="Search.." required>
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>        
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.php?uid=<?php echo $uid ?>"><span class="glyphicon glyphicon-user"></span> My Account</a></li>
      </ul>
    </div>
  </div>
</nav>