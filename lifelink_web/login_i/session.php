<?php

$sql = "SELECT * FROM Institution WHERE Mobile='".$_SESSION['login']."'";
$rslt = $conn->query($sql);
$row = $rslt->fetch_assoc();

?>
