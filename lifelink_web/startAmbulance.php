<?php

include ("config.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<title> Start Ambulance Service </title>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap');

		* {
		font-family: 'Source Sans Pro', sans-serif;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	
</head>
<body>
	
	<div class="container" style="padding-top:15px">
		
	<h2> <font color="#BFBFBF"> Start Ambulance Service <i class="bi bi-truck-front"></i> </font> </h2>
	
	<div style="padding-top:15px">
		<form class="row g-3">
		  <div class="col-auto">
			<input class="form-control" id="fromLoc" list="datalistOptions" placeholder="Enter Locality">
			<datalist id="datalistOptions">
			  <option value="Ernakulam">
			  <option value="Thrissur">
			  <option value="Kottayam">
			</datalist>
		  </div>
		  <div class="col-auto">
			<input class="form-control" id="toLoc" list="datalistOptions" placeholder="Enter Locality">
			<datalist id="datalistOptions">
			  <option value="Ernakulam">
			  <option value="Thrissur">
			  <option value="Kottayam">
			</datalist>
		  </div>
		  <div class="col-auto">
			<button type="button" id="searchBtn" class="btn btn-danger mb-3">Search <i class="bi bi-search-heart"></i></button>
		  </div>
		</form>
		<div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=ernakulam&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://pdflist.com/" alt="pdf download">Pdf download</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:400px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:400px;}.gmap_iframe {height:400px!important;}</style></div>
	</div>
	
</div>
	
</body>
</html>
