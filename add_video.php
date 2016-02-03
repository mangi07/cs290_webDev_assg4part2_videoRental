<?php

require('db.php');

// Receives POST variables from Add Video form in interface.php
$name = null;
$category = null;  //optional
$length = null;  //optional

$insertOkay = true;

/* Check and prepare variables for possible insertion */
if (isset($_POST['name']) && !(trim($_POST['name']) == "")) {
	$name = $_POST['name'];
	
	if (isset($_POST['category'])) {
	  $category = $_POST['category'];
	  if (trim($_POST['name']) == "") $category = null;
	}
	if (isset($_POST['length']) && !$_POST['length'] == "") {
	  $length = $_POST['length'];
	  
	  //***error checking on length and convert it to int***
	  $regEx = "/^[+]?[1-9]{1}\d{0,}$/";
	  if (preg_match($regEx, $length) || $length == "0") {
		$length = intval($length);
	  } else {
	    $insertOkay = false;
		echo "You entered $length but length must be a positive number.  Please try again.<br>";
		echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
		exit();
	  }
	}
} else {
	$insertOkay = false;
	echo "Name is required.  Please try again.<br>";
	echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
	exit();
}

/* If all checks passed, it is okay to attempt INSERT INTO... */
if ($insertOkay){
	if (!($stmt = $mysqli->prepare(
			"INSERT INTO inventory(id, name, category, length, rented) VALUES (NULL, ?, ?, ?, 0)"
		))) {
		//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		echo "Error: Failed to prepare for adding video.";
		echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
		exit();
	}

	if (!$stmt->bind_param("ssi", $name, $category, $length)) {
		//echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		echo "Error: Failed to prepare for adding video.";
		echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
		exit();
	}

	if (!$stmt->execute()) {
		//echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		echo "Error: Please enter a unique name.<br>
			<a href='interface.php'>Back to 'Add Video' interface.</a>";
		exit();
	}
	
	$stmt->close();
}

$mysqli->close();

header("Location: http://web.engr.oregonstate.edu/~olsonbe/assignment4-part2/interface.php");

echo "<script type='text/javascript'>
	window.location = 'http://web.engr.oregonstate.edu/~olsonbe/assignment4-part2/interface.php';
	</script>";

//in case header redirect attempts do not work:
echo "Video successfully added!<br>";
echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";

?>

