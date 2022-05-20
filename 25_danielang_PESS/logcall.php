<?php 
	// add in the db connection details using require_once
	require_once 'db.php';
	// create a new connection to the db
	$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
	// create SQL query to run
	$sql = "SELECT * FROM incident_type";
	// create var result to contain the result set from SQL query
	$result = $conn ->query($sql);
	// create array var incidentTypes
	$incidentTypes = [];
	// use while loop to fetch each row of the result-set to var row
	while ($row = $result->fetch_assoc()) {
		// assign the column value for incident_type_id to var id
		$id = $row ['incident_type_id'];
		// assign the column value for incident_type_desc to var type
		$type = $row ['incident_type_desc'];
		// create array var incident incidentType to hold the column values of each row
		$incidentType = ["id" => $id, "type" => $type];
		// using the array_push function to assign all rows of the result-set into array var incidentTypes
		array_push($incidentTypes, $incidentType);
	}
	$conn->close();
?>

<!doctype html>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Log Call</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	</head>
	<body>
	 	<div class="container" style="width: 88%">
	 		<!-- Use php require_once expression to include header image and navigation bar from nav.php -->
	 		<?php require_once "nav.php" ?>
	 		<!-- Create section container to place web form -->
	 		<section style="margin-top: 20px;">

	 		<!-- Create web form with Caller Name, Contact Number, Location of Incident, Type of incident, Description of Incident input fields -->
	 		<form action="dispatch.php" method="post">

                 <!-- Row for Caller Name label and textbox input -->
                 <div class="form-group row">
                 	<label for="callerName" class="col-lg-4 col-form-label">Caller's Name</label>
                 	<div class="col-lg-8">
                 		<input type="text" name="callerName" class="form-control" id="callerName">
                 	</div>
                 </div>

                 <!-- Row for Contact No. label and textbox input -->
                 <div class="form-group row">
                 	<label for="contactNo" class="col-lg-4 col-form-label">Contact Number (Required)</label>
                 	<div class="col-lg-8">
                 		<input type="text" name="contactNo" class="form-control" id="contactNo">
                 	</div>
                 </div>

                 <!-- Row for Location of Incident label and textbox input -->
                 <div class="form-group row">
                 	<label for="locationofIncident" class="col-lg-4 col-form-label">Location of Incident (Required)</label>
                 	<div class="col-lg-8">
                 		<input type="text" name="locationofIncident" class="form-control" id="locationofIncident">
                 	</div>
                 </div>

                <!-- Row for Type of Incident label and drop-down  input -->
                 <div class="form-group row">
                 	<label for="typeofIncident" class="col-lg-4 col-form-label">Type of Incident (Required)</label>
                 	<div class="col-lg-8">
                 		<select type="text" name="typeofIncident" class="form-control" id="typeofIncident">
                 			<option>Select</option>
                 			<!-- using for loop to retrieve the data from array var incidentTypes -->
                 			<?php 
                 				for ($i=0; $i < count($incidentTypes) ; $i++) { 
                 					$incidentType = $incidentTypes[$i];
                 					echo "<option value'". $incidentType['id'] ."'>" . $incidentType['type'] . "</option>";
                 				}

                 			?>
                 		</select>
                 	</div>
                 </div>

                 <!-- Row for Description of Incident label and Large textbox  input -->
                 <div class="form-group row">
                 	<label for="descriptionofIncident" class="col-lg-4 col-form-label">Description of Incident (Required)</label>
                 	<div class="col-lg-8">
                 		<textarea rows="5" name="descriptionofIncident" class="form-control" id="descriptionofIncident"></textarea>
                 	</div>
                 </div>

                 <!-- Row for Process Call and Reset buttons  -->
                <div class="form-group row">
                	<div class="col-lg-4"></div>
                	<div class="col-lg-8" style="text-align: center;">
                		<input type="submit" name="btnProcessCall" class="btn btn-primary" value="Process Call">
                		<input type="reset" name="btnReset" class="btn btn-primary" value="Reset">
                	</div>
                </div>
                <!-- End of web form -->
	 		</form>
	 		<!-- End of section -->
	 		</section>
	 		<!-- Footer -->
	 		<footer class="page-footer font-small blue pt-4 footer-copyright text-center py-3">
	 			&copy;2021 Copyright
	 			<a href="www.ite.edu.sg">ITE</a>
	 		</footer>
	 	</div>
	</body>
	</html>