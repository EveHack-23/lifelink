<?php

session_start();
include ("config.php");
include ("session.php");

if(!isset($_SESSION['login']))
{
	header("location: index.php");
}

if(isset($_POST['acceptSL']))
{
	$acceptSql="UPDATE BRequests SET Status='0' WHERE SL='".$_POST['acceptSL']."'";
	if($conn->query($acceptSql))
	{
		$success="Thank you for accepting the blood donation request";
	}
	else
	{
		$error="Error in accepting the blood donation request";
	}
}
else if(isset($_POST['denySL']))
{
	$acceptSql="UPDATE BRequests SET Status='-1' WHERE SL='".$_POST['denySL']."'";
	if($conn->query($acceptSql))
	{
		$success="Request denied successfully!";
	}
	else
	{
		$error="Error in denying the request";
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
		
		<h2> <font color="#BFBFBF"> Your Life Coins <i class="bi bi-coin"></i> </font> </h2>
		<h1> <b>
			<?php
			$fetchBal="SELECT * FROM LifeCoin WHERE Volunteer='".$_SESSION['login']."'";
			$bal=($conn->query($fetchBal))->fetch_assoc();
			echo $bal['Balance'];
			?>
		</b> <small><font color="#FF9600"><i class="bi bi-coin"></i></font></small> </h1> <br>
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
		  Your Activities <i class="bi bi-activity"></i>
		</button>

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			  </div>
			  <div class="modal-body">
				...
			  </div>
			</div>
		  </div>
		</div>
		
		<?php
			$reqSearch="SELECT * FROM BRequests WHERE Donor='".$_SESSION['login']."' AND Status='1'";
			if(($conn->query($reqSearch))->num_rows >0)
			{ $result=$conn->query($reqSearch); ?>
				<div style="padding-top:20px;overflow-x:scroll">
				<h3><b><font color="#be1e2d">Blood Donation Requests <i class="bi bi-droplet"></i></font></b></h3>
				<table class="table">
				<thead style="vertical-align:middle">
					<tr>
					  <th scope="col">Institution</th>
					  <th scope="col">Blood Group</th>
					  <th scope="col">Units</th>
					  <th scope="col">Locality</th>
					  <th scope="col">Reply</th>
					</tr>
				</thead> <tbody>
				<?php
				while($request=$result->fetch_assoc())
				{ ?>
					
					<tr>
						<td> <?php echo $request['Institution']; ?> </td>
						<td> <?php echo $request['BG']; ?> </td>
						<td> <?php echo $request['Unit']; ?> </td>
						<td> <?php echo $request['Locality']; ?> </td>
						<td>
							<div class="btn-group" role="group" aria-label="Basic mixed styles example">
							  <button type="button" onclick="accept(<?php echo $request['SL']; ?>)" class="btn btn-success">Accept</button>
							  <button type="button" onclick="deny(<?php echo $request['SL']; ?>)" class="btn btn-danger">Deny</button>
							</div>
						</td>
					</tr>
					
		<?php }} ?>
		</tbody> </table> 
		<form name="acceptReq" method="post" action="" hidden>
			<input type="hidden" name="acceptSL">
		</form>
		<form name="denyReq" method="post" action="" hidden>
			<input type="hidden" name="denySL">
		</form>
		<script>
			function accept(SL)
			{
				document.acceptReq.acceptSL.value=SL;
				document.acceptReq.submit();
			}
			function deny(SL)
			{
				document.denyReq.denySL.value=SL;
				document.denyReq.submit();
			}
		</script>
		<div style="padding-top:20px">
			<h3><b><font color="#be1e2d">Blood Donors <i class="bi bi-droplet"></i></font></b></h3>
			<?php
			$sql="SELECT * FROM BDonors WHERE Reference='".$_SESSION['login']."'";
			if(($conn->query($sql))->num_rows >0)
			{
				$result=$conn->query($sql);
				?>
				<div style="overflow-x:scroll">
				<table class="table">
				  <thead style="vertical-align:middle">
					<tr>
					  <th scope="col">Name</th>
					  <th scope="col">Gender</th>
					  <th scope="col">Age</th>
					  <th scope="col">BG</th>
					  <th scope="col">Locality</th>
					  <th scope="col">Mobile Number</th>
					  <th scope="col">Last Donated</th>
					</tr>
				</thead> <tbody>
				<?php
				while($row=$result->fetch_assoc()) {
				$today = date("Y-m-d");
				$lastDonation = $row['LastDonation'];
				$days = date_diff(date_create($lastDonation),date_create($today));
				?>
				<tr>
				  <td><?php echo $row['Name']; ?></td>
				  <td><?php echo $row['Gender']; ?></td>
				  <td>
					  <?php
					  $dateOfBirth = $row['DOB'];
					  $diff = date_diff(date_create($dateOfBirth),date_create($today));
					  echo $diff->format('%y');
					  ?>
				  </td>
				  <td><?php echo $row['BG']; ?></td>
				  <td><?php echo $row['Locality']; ?></td>
				  <td><?php echo $row['Mobile']; ?></td>
				  <td><?php echo $days->format('%r%a'); ?> Days Ago</td>
				</tr>
				<?php }
				?>
				</tbody>
				</table>
				</div>
				<?php
			}
			else
			{
				echo "<font color='red'><h2>No Donors Found! </h2></font>";
			}
			?>
		</div>
		
	</div>
	</div>
	
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>
