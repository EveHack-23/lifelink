<div class="container" style="padding-top:15px">
		
	<h2> <font color="#BFBFBF"> Search Blood Donor <i class="bi bi-search-heart"></i> </font> </h2>
	
	<div style="padding-top:15px">
		<form class="row g-3">
		  <div class="col-auto">
			<select class="form-select" id="bgrp" name="bgrp" aria-label="Default select example">
			  <option value="0" selected hidden>Select Blood Group</option>
			  <option value="A+">A+</option>
			  <option value="A-">A-</option>
			  <option value="AB+">AB+</option>
			  <option value="AB-">AB-</option>
			  <option value="B+">B+</option>
			  <option value="B-">B-</option>
			  <option value="O+">O+</option>
			  <option value="O-">O-</option>
			</select>
		  </div>
		  <div class="col-auto">
			<input class="form-control" id="loc" list="datalistOptions" placeholder="Enter Locality">
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
		<span id="error" style="display:none; color:red"></span>
		<div id="loader" style="display:none"> Checking Availability... <img src="loader.gif" style="vertical-align:middle;width:20px"></div>
		<div id="bSearchR" style="padding-top:20px"></div>
		<script>
			$(document).ready(function() {
			$("#searchBtn").click(function()
			{
				$("#error").hide();
				var bgrp = $('#bgrp').val();
				var loc = $('#loc').val();
				if(bgrp == "0")
				{
					$("#error").show();
					$("#error").text('Select the blood group!');
				}
				else if(loc == "")
				{
					$("#error").show();
					$("#error").text('Select the locality!');
				}
				else
				{
					$("#loader").show();
					jQuery.ajax({
						url: "bSearchR.php",
						data: {BGroup:bgrp,Locality:loc},
						type: "POST",
						success: function(data) {
							$("#loader").hide();
							$("#bSearchR").html(data);
						},
						error: function() { }
					});
				}
			});
		});
		</script>
	</div>
	
</div>
