<!DOCTYPE html>
<html>
<head>
<title>Social Network</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/indexstyle.css">
</head>
<!--Beginning of the body -->
<body>

	<!-- header -->
	<div class="container " id="head" >
		<div class="col-sm-12 col-md-4">
			<h1 style="color:white;"><strong>Social Network</strong></h1>
		</div>
		<div class="col-md-2">
		</div>
		<div class="col-sm-12 col-md-6" style="padding-top:10px;">
			<form method="post" action="login.php" class="form-inline">
				<div class="form-group">
					<label for="email">E-mail:</label>
					<input class="form-control" type="text" placeholder="email" name="email">
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input class="form-control" type="password" placeholder="password" name="password">
				</div>
				<button type="submit" class="btn btn-primary">Login</button>
			</form>
		</div>
	</div>
	<!-- End of header-->

	<!-- Beginning of middle part -->
	<div class="container" id="middle" style="background-image: url('images/index/back.jpg');">
		<div class="col-md-7"></div>
		<div class="col-md-5" id="signup">
			<h2><strong>Create an Account</strong></h2>
			<form method="post" action="signup.php">
				<div class="form-group">
					<label for="name">Name:</label>
					<input type="text" class="form-control" placeholder="Enter name" name="name" required>
				</div>
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="email" class="form-control" placeholder="Enter email" name="email" required>

				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" class="form-control" placeholder="Choose a password" name="password" required>
				</div>
				<div class="form-group">
					<label for="cpassword">Confirm Password</label>
					<input type="password" class="form-control" placeholder="Re-enter Password" name="cpassword" required>
				</div>
				<button type="submit" class="btn btn-primary">Sign up</button>
			</form>
		</div>

	</div>
	<!-- End of middle part -->

	<!-- Beginning of footer part -->

	<?php include 'includes/footer.php';?> 

	<!-- End of footer -->

</body>
<!--End of body -->
</html>
