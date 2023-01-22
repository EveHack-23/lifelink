<?php

session_start();
include("config.php");
include("session.php");
$Search="SELECT * FROM BDonors WHERE BG='".$_POST['BGroup']."' AND Locality='".$_POST['Locality']."'";
if(($conn->query($Search))->num_rows >0)
{
	$result=$conn->query($Search);
	?>
	<div style="overflow-x:scroll">
	<table class="table">
	  <thead style="vertical-align:middle">
		<tr>
		  <th scope="col">Name</th>
		  <th scope="col">Gender</th>
		  <th scope="col">Age</th>
		  <th scope="col">Mobile Number</th>
		  <th scope="col">Last Donated</th>
		</tr>
	</thead> <tbody>
	<?php
	while($dat=$result->fetch_assoc()) {
	$today = date("Y-m-d");
	$lastDonation = $dat['LastDonation'];
	$days = date_diff(date_create($lastDonation),date_create($today));
	?>
	<tr>
      <td><?php echo $dat['Name']; ?></td>
      <td><?php echo $dat['Gender']; ?></td>
      <td>
		  <?php
		  $dateOfBirth = $dat['DOB'];
		  $diff = date_diff(date_create($dateOfBirth),date_create($today));
		  echo $diff->format('%y');
		  ?>
      </td>
      <td><?php if($row['Pro']=='0') {echo "<font color='red'><i>Locked (Need Pro)</i></font>";} else {echo $dat['Mobile'];} ?></td>
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
	echo "<font color='red'><h2>No Donors Found! <img src='not_found.png' style='width:50px'> </h2></font>";
}

?>
