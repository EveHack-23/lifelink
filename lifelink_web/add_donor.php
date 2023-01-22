<?php

session_start();
include ("config.php");
include ("session.php");

if(!isset($_SESSION['login']))
{
	header("location: index.php");
}

if(isset($_POST['mobnum']))
{
	$name=$_POST['dname'];
	$dob=$_POST['dob'];
	$gender=$_POST['gender'];
	$bgrp=$_POST['bgrp'];
	$loc=$_POST['loc'];
	$mob=$_POST['mobnum'];
	$ldon=$_POST['lastDonation'];
	$refer=$_POST['refer'];
	$addDonor="INSERT INTO BDonors (Name,DOB,Gender,BG,Locality,Mobile,Reference,LastDonation)
				VALUES('$name','$dob','$gender','$bgrp','$loc','$mob','$refer','$ldon')";
	if($conn->query($addDonor))
	{
		$success="Donor added successfully!";
	}
	else
	{
		$error="Donor adding failed!";
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	
	<title> <?php echo $row['Name']; ?> :: Volunteer </title>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap');

		* {
		font-family: 'Source Sans Pro', sans-serif;
		}
	</style>
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	
</head>

<body>
	
	<?php include("header.php"); ?>
	
	<div class="container" style="padding-top:15px">
		
		<?php if(isset($error)) { ?>
		  <div class="alert alert-danger"> <?php echo $error; ?> </div>
		<?php } ?>
			  
		<?php if(isset($success)) { ?>
			<div class="alert alert-success"> <?php echo $success; ?> </div>
		<?php } ?>
		
		<h2> <font color="#BFBFBF"> Add New Donors <i class="bi bi-person-plus-fill"></i> </font> </h2> <hr>
		<form name="addDonor" method="post" action="">
		<div class="row g-3">
		  <div class="col-md">
			<div class="form-floating">
			  <input type="text" class="form-control" name="dname" id="dname" placeholder="Enter Name of Donor">
			  <label for="dname">Enter Name of Donor</label>
			</div>
		  </div>
		  <div class="col-md">
			<div class="form-floating">
			  <input type="date" class="form-control" name="dob" id="dob" placeholder="Date of Birth">
			  <label for="dob">Date of Birth</label>
			</div>
		  </div>
		  <div class="col-md">
			<div class="form-floating">
			<select class="form-select" name="gender" id="gender" aria-label="Default select example">
			  <option value="0" selected hidden>-Select-</option>
			  <option value="MALE">Male</option>
			  <option value="FEMALE">Female</option>
			  <option value="OTHERS">Others</option>
			</select>
			<label for="gender">Gender</label>
			</div>
		  </div>
		</div>
		<div class="row g-3" style="padding-top:1rem">
		  <div class="col-md">
			<div class="form-floating">
			<select class="form-select" name="bgrp" id="bgrp" aria-label="Default select example">
			  <option value="0" selected hidden>-Select-</option>
			  <option value="A+">A+</option>
			  <option value="A-">A-</option>
			  <option value="AB+">AB+</option>
			  <option value="AB-">AB-</option>
			  <option value="B+">B+</option>
			  <option value="B-">B-</option>
			  <option value="O+">O+</option>
			  <option value="O-">O-</option>
			</select>
			<label for="bgrp">Blood Group</label>
			</div>
		  </div>
		  <div class="col-md">
			<div class="form-floating">
				<input class="form-control" id="loc" name="loc" list="datalistOptions" placeholder="Enter Locality">
				<datalist id="datalistOptions">
				  <option value="Ernakulam">
				  <option value="Thrissur">
				  <option value="Kottayam">
				</datalist>
				<label for="loc">Locality</label>
			</div>
		  </div>
		  <div class="col-md">
			<div class="form-floating">
			  <input type="tel" class="form-control" name="mobnum" id="mobnum" placeholder="Enter Mobile Number">
			  <label for="mobnum">Enter Mobile Number</label>
			</div>
		  </div>
		</div>
		<div class="row g-3" style="padding-top:1rem">
			<div class="col-md">
			<div class="form-floating">
			  <input type="date" class="form-control" name="lastDonation" id="lastDonation" placeholder="Last Donated Date">
			  <label for="lastDonation">Last Donated Date</label>
			</div>
		  </div>
		</div>
		<div style="padding-top:1rem">
			<button  type="button" onclick="validate()"  class="btn btn-success">Add New Donor <i class="bi bi-person-plus-fill"></i> </button>
		</div>
		<input type="hidden" name="refer" value="<?php echo $_SESSION['login']; ?>?">
		</form>
		<script>
			function validate()
			{
				var name,dob,gender,bgrp,loc,mob,ldon;
				name=document.addDonor.dname.value;
				dob=document.addDonor.dob.value;
				gender=document.addDonor.gender.value;
				bgrp=document.addDonor.bgrp.value;
				loc=document.addDonor.loc.value;
				mob=document.addDonor.mobnum.value;
				ldon=document.addDonor.lastDonation.value;
				if(name=="")
				{
					alert("Enter the Name of Donor!");
					document.addDonor.dname.focus();
				}
				else if(dob=="")
				{
					alert("Enter the DOB of Donor!");
					document.addDonor.dob.focus();
				}
				else if(gender=="0")
				{
					alert("Select Gender of Donor!");
					document.addDonor.gender.focus();
				}
				else if(bgrp=="0")
				{
					alert("Select Blood Group of Donor!");
					document.addDonor.bgrp.focus();
				}
				else if(loc=="")
				{
					alert("Select Locality of Donor!");
					document.addDonor.loc.focus();
				}
				else if(mob=="")
				{
					alert("Mobile Number of Donor!");
					document.addDonor.mobnum.focus();
				}
				else if(ldon=="")
				{
					alert("Enter the Last Donated date of Donor!");
					document.addDonor.lastDonation.focus();
				}
				else
				{
					document.addDonor.submit();
				}
			}
		</script>
	</div>
	
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>
