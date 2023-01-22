<?php

include ("config.php");

if($_POST['subbtn']==1)
{
	$name=$_POST['name'];
	$loc=$_POST['city'];
	$mob=$_POST['mobnum'];
	$email=$_POST['email'];
	$psswd=$_POST['psswd'];
	
	$emailSearch = "SELECT * FROM Institution WHERE Email='$email'";
	if(($conn->query($emailSearch))->num_rows > 0)
	{
		$error="Email already registered!";
		$err_flag=1;
	}
	$mobSearch = "SELECT * FROM Institution WHERE Mobile='$mob'";
	if(($conn->query($mobSearch))->num_rows > 0)
	{
		$error="Mobile number already registered!";
		$err_flag=1;
	}
	
	if($err_flag!=1)
	{
		$sql="INSERT INTO Institution VALUES('$name','$loc','$email','$mob','$psswd','0')";
		
		if($conn->query($sql))
		{
			$success="Registration Successfull. Now Login";
		}
		else
		{
			$error="Registration Unsuccessfull";
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title> Register :: Institution </title>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link rel="stylesheet" href="style.css">
	<!-- Font Awesome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	<!-- MDB -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet">
</head>

<body>
	
	<section class="vh-100" > <br>
	  <div class="container-fluid h-custom" style="overflow-y:scroll">
		<div class="row d-flex justify-content-center align-items-center h-100">
		  <div class="col-md-9 col-lg-6 col-xl-5">
			<img src="images/logo500.png"
			  class="img-fluid" alt="Sample image">
		  </div>
		  <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
			<form name="register" method="post" action="">
			  
			  <h2>Register <b><font color="#be1e2d">Institution</font></b></h2>
			  
			  <?php if(isset($error)) { ?>
				  <div class="alert alert-danger"> <?php echo $error; ?> </div>
			  <?php } ?>
			  
			  <?php if(isset($success)) { ?>
				  <div class="alert alert-success"> <?php echo $success; ?> </div>
			  <?php } ?> <hr> <br>
			  
			  <!-- Name input -->
			  <div class="form-outline mb-3">
				<input type="text" id="name" name="name" class="form-control form-control-lg"
				  placeholder="Enter Institution Name" required>
				<label class="form-label" for="name">Institution Name</label>
			  </div>

			  <!-- Mobile input -->
			  <div class="form-outline mb-3">
				<input type="tel" id="mobnum" name="mobnum" class="form-control form-control-lg"
				  placeholder="Enter Mobile Number" required>
				<label class="form-label" for="mobnum">Mobile Number</label>
			  </div>
			  
			  <!-- Email input -->
			  <div class="form-outline mb-3">
				<input type="email" id="email" name="email" class="form-control form-control-lg"
				  placeholder="Enter Email ID" required>
				<label class="form-label" for="email">Email</label>
			  </div>
			  
			  <!-- City input -->
			  <div class="form-outline mb-3">
				<input type="text" id="city" name="city" class="form-control form-control-lg" placeholder="City (Locality)" required>
				<label class="form-label" for="city">City (Locality)</label>
			  </div>
			  
			  <!-- Password input -->
			  <div class="row">
                <div class="col-md-6 mb-3">
                  <div class="form-outline">
                    <input type="password" id="psswd" name="psswd" class="form-control" required>
                    <label class="form-label" for="psswd">Enter Password</label>
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div class="form-outline">
                    <input type="text" id="cpsswd" name="cpsswd" class="form-control" required>
                    <label class="form-label" for="cpsswd">Confirm Password</label>
                  </div>
                </div>
              </div>
              
              <div class="form-check mb-0">
				  <input class="form-check-input me-2" type="checkbox" value="" id="tac">
				  <label class="form-check-label" for="tac"> I am agree to Terms & Condition </label>
			  </div>

			  <div class="text-center text-lg-start mt-4 pt-2">
				<button type="button" name="regbtn" onclick="validate()" class="btn btn-lg"
				  style="padding-left: 2.5rem; padding-right: 2.5rem; background-color:#be1e2d; color:white">Register</button>
				<p class="small fw-bold mt-2 pt-1 mb-0">Already Registered? <a href="index.php"
					class="link-danger">Login Here!</a></p>
			  </div>
			  <input type="hidden" name="subbtn">

			</form> <br>
			
			<script>
				
				
				function locval(locality)
				{
					return true;
				}
				
				function validate()
				{
					
					var name,mobnum,email,city,psswd,cpsswd;
					name=document.register.name.value;
					mobnum=document.register.mobnum.value;
					email=document.register.email.value;
					city=document.register.city.value;
					psswd=document.register.psswd.value;
					cpsswd=document.register.cpsswd.value;
					if(name=="")
					{
						alert("Enter name of the Institution!");
						document.register.name.focus();
					}
					else if(mobnum=="")
					{
						alert("Enter Mobile Number of the Institution!");
						document.register.mobnum.focus();
					}
					else if(mobnum.length!=10)
					{
						alert("Enter a valid Mobile Number!");
						document.register.mobnum.focus();
					}
					else if(isNaN(mobnum))
					{
						alert("Enter a valid Mobile Number!");
						document.register.mobnum.focus();
					}
					else if(email=="")
					{
						alert("Enter e-Mail of the Institution!");
						document.register.email.focus();
					}
					else if(city=="")
					{
						alert("Enter locality of the Institution!");
						document.register.city.focus();
					}
					else if(locval(city)==false)
					{
						alert("Select locality from the dropdown menu!");
						document.register.city.focus();
					}
					
					else if(psswd=="")
					{
						alert("Create a Password!");
						document.register.psswd.focus();
					}
					else if(psswd.length<6 || psswd.length>10)
					{
						alert("Enter a valid Password! Password length must be minimum 6 and maximum 10");
						document.register.psswd.focus();
					}
					else if(cpsswd=="")
					{
						alert("Re-Enter the Password!");
						document.register.cpsswd.focus();
					}
					else if(cpsswd!=psswd)
					{
						alert("Passwords do not Match!");
						document.register.cpsswd.focus();
					}
					
					else if(document.getElementById("tac").checked==false)
					{
						alert("Please accept terms and Conditions!");
						document.getElementById("tac").focus();
					}
					
					else
					{
						document.register.subbtn.value="1";
						document.register.submit();
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
