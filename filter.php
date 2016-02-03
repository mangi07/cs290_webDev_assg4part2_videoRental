<?php

require('db.php');

if (isset($_GET['category'])) {
	$category = $_GET['category'];
} else {
	$category = "";
}

if ($category != "") {
	//SELECT based on $category to be loaded HTML in while loop
	if (!($stmt = $mysqli->prepare("SELECT name, category, length, rented  FROM inventory WHERE category = ?"))) {
		//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		echo "Error: Failed to select category for filtering.<br>";
		echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
		exit();
	}

	if (!$stmt->bind_param("s", $category)) {
		//echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		echo "Error: Failed to select category for filtering.<br>";
		echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
		exit();
	}
	if (!$stmt->execute()) {
		//echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
		echo "Error: Failed to select category for filtering.<br>";
		echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
		exit();
	}
	$out_name     = NULL;
	$out_category = NULL;
	$out_length   = NULL;
	$out_rented   = NULL;
	if (!$stmt->bind_result($out_name, $out_category, $out_length, $out_rented)) {
		//echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		echo "Error: Failed to get results of filtering.<br>";
		echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
		exit();
	}

	//include some javascript needed for button ajax:
	echo "<script src='functions.js'></script>";

	/* CREATE TABLE */
	echo "<table border='1'>";
	echo "<caption>Videos</caption>";
	
	//create top row
	echo "<thead><tr>";
	echo "<th>Name<th>Category<th>Length in minutes<th>Rental status";
	echo "</thead>";
	echo "<tbody>";

	while ($stmt->fetch()) {
		//prepare variables for access
		if (!isset($out_category)) $out_category = "";
		
		if (!isset($out_length))
			$out_length = "";
		else
			$out_length = intval($out_length);
		
		if (!$out_rented)
			$out_rented = "available";
		else
			$out_rented = "checked out";
			
		//create another row
		echo "<tr id='$out_name'><td>$out_name
			<td>$out_category
			<td>$out_length
			<td>$out_rented
			<td><button onclick='makeRequest(toggleRental, \"$out_name\", \"toggleRental.php\");'>Change Rental Status</button>";
	}		

	echo "</tbody>";
	echo "</table>";
	/* FINISHED CREATING TABLE */

	$stmt->close();
	
} else if ($category == "" || $category == NULL) {
	
	if (!($stmt2 = $mysqli->prepare("SELECT name, category, length, rented FROM inventory WHERE 1"))) {
		//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		echo "Error: Failed to select category for filtering.<br>";
		echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
		exit();
	}
	if (!$stmt2->execute()) {
		//echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
		echo "Error: Failed to select category for filtering.<br>";
		echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
		exit();
	}
	$out_name     = NULL;
	$out_category = NULL;
	$out_length   = NULL;
	$out_rented   = NULL;
	if (!$stmt2->bind_result($out_name, $out_category, $out_length, $out_rented)) {
		//echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt2->error;
		echo "Error: Failed to get results of filtering.<br>";
		echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
		exit();
	}

	//include some javascript needed for button ajax:
	echo "<script src='functions.js'></script>";

	/* CREATE TABLE */
	echo "<table border='1'>";
	echo "<caption>Videos</caption>";
	
	//create top row
	echo "<thead><tr>";
	echo "<th>Name<th>Category<th>Length in minutes<th>Rental status";
	echo "</thead>";
	echo "<tbody>";

	while ($stmt2->fetch()) {
		//prepare variables for access
		if (!isset($out_category)) $out_category = "";
		
		if (!isset($out_length))
			$out_length = "";
		else
			$out_length = intval($out_length);
		
		if (!$out_rented)
			$out_rented = "available";
		else
			$out_rented = "checked out";
			
		//create another row
		echo "<tr id='$out_name'><td>$out_name
			<td>$out_category
			<td>$out_length
			<td>$out_rented
			<td><button onclick='makeRequest(toggleRental, \"$out_name\", \"toggleRental.php\");'>Change Rental Status</button>";
	}		

	echo "</tbody>";
	echo "</table>";
	/* FINISHED CREATING TABLE */

	$stmt2->close();
	
}

$mysqli->close();

?>

