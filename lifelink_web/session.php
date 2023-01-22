<?php

$sql = "SELECT * FROM Volunteer WHERE Mobile='".$_SESSION['login']."'";
$rslt = $conn->query($sql);
$row = $rslt->fetch_assoc();

?>
