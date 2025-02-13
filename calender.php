<!DOCTYPE html>
<html lang="en-us">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calender</title>
  <link rel="stylesheet" href="calender.css">
  <link rel="stylesheet" href="modal.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <?php 

	function formatDate($date) {
		// Get the full name of the day
		$dayFullName = date('l', strtotime($date));
		// Check if the day is Thursday
		if ($dayFullName === 'Thursday') {
			// If it is Thursday, use 'Thur'
			$dayShortName = 'Thur';
		} else {
			// Otherwise, use the standard three-letter abbreviation
			$dayShortName = date('D', strtotime($date));
		}
		// Format the rest of the date
		$formattedDate = date(' M j, Y', strtotime($date));
		// Combine the short day name with the formatted date
		return $dayShortName . $formattedDate;
	}


	$conn = mysqli_connect("localhost","francis","rDY6JcAcmyCOEsJQ","my_database");
	$sql = "SELECT * FROM reminder";
	$query = mysqli_query($conn, $sql);
	if ($query) {
		//echo "Select successful";
		$i = 0;
		echo "<script>";
		echo "var items = [];\n";
		
		while ($row = mysqli_fetch_array($query, MYSQLI_BOTH)){
			echo "items[".$i."]=[".$row["id"].",\"".$row["date"]."\",\"".$row["message"]."\",\"".$row["name"]."\"];\n";
			$i++;
		}
		echo "</script>";
		
	} else {
		echo "Error selecting data: " . mysqli_error($conn);
		mysqli_close($conn); 
	}
	$today = formatDate(date('Y-M-d'));
	$sql = "SELECT * FROM reminder WHERE date = '{$today}'";
	$query = mysqli_query($conn, $sql);
?>

</head>
<body>
	<header>
		<div id='welcome-message'>Hello</div>
		<nav>
			 <a href="add_user.html" id='addUser'>Add User</a>
			 <a href="index.html" id='logout'>Logout</a>
		</nav>
	</header>
	<div>
		<h1 id="monthandyear"></h1>
	</div>
  
	<section class="content">
		<div class="body">
			<div class="content-wrapper">
				<div class="side-bar">Dummy links
					<a href="#">Add +</a>
					<a href="#">View all</a>
				</div>
				<div class="calender">
			
					<div class="selector">
						<form class="form-inline">
							<label class="lead mr-2 ml-2" for="month">Jump To: </label>
							<select class="form-control col-sm-4" name="month" id="month" onchange="jump()">
								<option value=0>Jan</option>
								<option value=1>Feb</option>
								<option value=2>Mar</option>
								<option value=3>Apr</option>
								<option value=4>May</option>
								<option value=5>Jun</option>
								<option value=6>Jul</option>
								<option value=7>Aug</option>
								<option value=8>Sep</option>
								<option value=9>Oct</option>
								<option value=10>Nov</option>
								<option value=11>Dec</option>
							</select>


							<label for="year"></label><select class="year-sl" name="year" id="year" onchange="jump()">
								<option value=1990>1990</option>
								<option value=1991>1991</option>
								<option value=1992>1992</option>
								<option value=1993>1993</option>
								<option value=1994>1994</option>
								<option value=1995>1995</option>
								<option value=1996>1996</option>
								<option value=1997>1997</option>
								<option value=1998>1998</option>
								<option value=1999>1999</option>
								<option value=2000>2000</option>
								<option value=2001>2001</option>
								<option value=2002>2002</option>
								<option value=2003>2003</option>
								<option value=2004>2004</option>
								<option value=2005>2005</option>
								<option value=2006>2006</option>
								<option value=2007>2007</option>
								<option value=2008>2008</option>
								<option value=2009>2009</option>
								<option value=2010>2010</option>
								<option value=2011>2011</option>
								<option value=2012>2012</option>
								<option value=2013>2013</option>
								<option value=2014>2014</option>
								<option value=2015>2015</option>
								<option value=2016>2016</option>
								<option value=2017>2017</option>
								<option value=2018>2018</option>
								<option value=2019>2019</option>
								<option value=2020>2020</option>
								<option value=2021>2021</option>
								<option value=2022>2022</option>
								<option value=2023>2023</option>
								<option value=2024>2024</option>
								<option value=2025>2025</option>
								<option value=2026>2026</option>
								<option value=2027>2027</option>
								<option value=2028>2028</option>
								<option value=2029>2029</option>
								<option value=2030>2030</option>
							</select>
						</form>
					</div>

					<div class="cal" id="cal">

					</div>

					<div class="action">
						<button class="btn" id="previous" onclick="previous()">&lt;&lt;Previous</button>
						<button class="btn" id="today" onclick="today()">Today</button>
						<button class="btn" id="next" onclick="next()">Next&gt;&gt;</button>
					</div>
								
				</div>
				
				<section id="today-section" class="today-section">
					<div class="title">Today</div>
					<?php 
						if ($query) {
							while ($row = mysqli_fetch_array($query, MYSQLI_BOTH)){
								echo "<div class='msg'>
										<span class='name'>{$row['name']}: </span>
										{$row['message']}
									</div>";
								$i++;
							}
						}
					?>
				</section>
				
			</div>
			<div class="upcomming" id="uc">
				<h4 id="display-h4">Selected item to view details</h4>
				<div id="display-div" class="display-div">
				</div>
			</div>
		</div>
	</section>
	<!--<section class="howto">
		<div>
			<h1>How to</h1>
		</div>
	</section> -->
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
	<div class="modal-content">
		<button class="close" id="close">&times;</button>
		<h3 id="form-h3"></h3>
		<form action="action.php" method="post">	
			<input type="hidden" name="date" id="date" value="">
			<input type="hidden" name="name" id="name" value="">

			<label for="details" >Enter details:</label><br>
			<textarea id="details" name="details" rows="10" cols="50" oninput="validateform()" required></textarea><br>
			<input type="submit" id="sbmit" name="submit" value="Save" disabled>
		</form>
    
	</div>

</div>

</body>
<script src="calender.js"></script>
<script src="modal.js"></script>
</html>