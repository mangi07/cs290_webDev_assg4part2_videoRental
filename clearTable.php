<?php

require('db.php');

if (!($stmt = $mysqli->prepare("TRUNCATE TABLE inventory"))) {
	//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	echo "Error: Could not prepare to clear the table.<br>";
	echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
	exit();
}
if (!$stmt->execute()) {
	//echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
	echo "Error: Could not execute statement to clear the table.<br>";
	echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
	exit();
}

$stmt->close();
	
$mysqli->close();

header("Location: http://web.engr.oregonstate.edu/~olsonbe/assignment4-part2/interface.php");

echo "<script type='text/javascript'>
	window.location = 'http://web.engr.oregonstate.edu/~olsonbe/assignment4-part2/interface.php';
	</script>";

//in case header redirect attempts do not work:
echo "Table cleared!<br>";
echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";

?>

