<?php

include ("config.php");

session_start();

if(isset($_POST['email']))
{
	$email=$_POST['email'];
	$psswd=$_POST['psswd'];
	$sql="SELECT * FROM Volunteer WHERE Email='$email'";
	if(($conn->query($sql))->num_rows >0)
	{
		$result=$conn->query($sql);
		$row=$result->fetch_assoc();
		if($row['Password']==$psswd)
		{
			$_SESSION['login']=$row['Mobile'];
			header("location: dashboard.php");
		}
		else
		{
			$error="Incorrect Password!";
		}
	}
	else
	{
		$error="User Not Found!";
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title> Login :: Volunteer </title>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link rel="stylesheet" href="style.css">
	<!-- Font Awesome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	<!-- MDB -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet">
</head>

<body>
	
	<section class="vh-100" >
	  <div class="container-fluid h-custom" style="overflow-y:scroll">
		<div class="row d-flex justify-content-center align-items-center h-100">
		  <div class="col-md-9 col-lg-6 col-xl-5">
			<img src="images/logo500.png"
			  class="img-fluid" alt="Sample image">
		  </div>
		  <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
			<form name="login" method="post" action="">
			  
			  <h2><b><font color="#be1e2d">Volunteer</font></b> Login</h2>
			  
			  <?php if(isset($error)) { ?>
				  <div class="alert alert-danger"> <?php echo $error; ?> </div>
			  <?php } ?> <hr> <br>
			  
			  <!-- Email input -->
			  <div class="form-outline mb-3">
				<input type="email" id="email" name="email" class="form-control form-control-lg"
				  placeholder="Enter a valid email address" />
				<label class="form-label" for="email">Email address</label>
			  </div>

			  <!-- Password input -->
			  <div class="form-outline mb-3">
				<input type="password" id="psswd" name="psswd" class="form-control form-control-lg"
				  placeholder="Enter password" />
				<label class="form-label" for="psswd">Password</label>
			  </div>

			  <div class="d-flex justify-content-between align-items-center">
				<!-- Checkbox -->
				<div class="form-check mb-0">
				  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
				  <label class="form-check-label" for="form2Example3">
					Remember me
				  </label>
				</div>
				<a href="#!" class="text-body">Forgot password?</a>
			  </div>

			  <div class="text-center text-lg-start mt-4 pt-2">
				<button type="button" onclick="validate()" class="btn btn-lg"
				  style="padding-left: 2.5rem; padding-right: 2.5rem; background-color:#be1e2d; color:white">Login</button>
				<p class="small fw-bold mt-2 pt-1 mb-0">Want to be a volunteer? <a href="signup.php"
					class="link-danger">Register Now!</a></p>
			  </div>

			</form>
			<script>
				function validate()
				{
					var email,psswd;
					email=document.login.email.value;
					psswd=document.login.psswd.value;
					if(email=="")
					{
						alert("Enter your email!");
						document.login.email.focus();
					}
					else if(psswd=="")
					{
						alert("Enter your password!");
						document.login.psswd.focus();
					}
					else if(psswd.length<6 || psswd.length>10)
					{
						alert("Enter a valid password!");
						document.login.psswd.focus();
					}
					else
					{
						document.login.submit();
					}
				}
			</script>
		  </div>
		</div>
	  </div>
	  <div
		class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 footer">
		<!-- Copyright -->
		<div class="text-white mb-3 mb-md-0">
		  Copyright © 2020. All rights reserved.
          <a style="color:white" href="login_i"> <br> Institution Login</a>
		</div>
		<!-- Copyright -->

		<!-- Right -->
		<div>
		  <a href="#!" class="text-white me-4">
			<i class="fab fa-facebook-f"></i>
		  </a>
		  <a href="#!" class="text-white me-4">
			<i class="fab fa-twitter"></i>
		  </a>
		  <a href="#!" class="text-white me-4">
			<i class="fab fa-google"></i>
		  </a>
		  <a href="#!" class="text-white">
			<i class="fab fa-linkedin-in"></i>
		  </a>
		</div>
		<!-- Right -->
	  </div>
	</section>

	<!-- MDB -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
	
</body>

</html>
