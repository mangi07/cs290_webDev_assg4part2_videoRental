<?php

require('db.php');

$name = $_POST["x"];

//get rental status
if (!($stmt = $mysqli->prepare("SELECT rented FROM inventory WHERE name = ?"))) {
    //echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	echo "Error: Failed to get rental status.<br>";
	echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
	exit();
}
if (!$stmt->bind_param("s", $name)) {
	//echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	echo "Error: Failed to get rental status.<br>";
	echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
	exit();
	}
if (!$stmt->execute()) {
    //echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
	echo "Error: Failed to get rental status.<br>";
	echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
	exit();
}
$x = NULL;
if (!$stmt->bind_result($x)) {
    //echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	echo "Error: Failed to get rental status.<br>";
	echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
	exit();
}
$stmt->fetch();
$stmt->close();


//change rental status
$x = !$x;
if (!($stmt2 = $mysqli->prepare("UPDATE inventory SET rented=? WHERE name=?"))) {
    //echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	echo "Error: Failed to execute rental status change.<br>";
	echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
	exit();
}
if (!$stmt2->bind_param("is", $x, $name)) {
	//echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	echo "Error: Failed to execute rental status change.<br>";
	echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
	exit();
}
if (!$stmt2->execute()) {
    //echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
	echo "Error: Failed to execute rental status change.<br>";
	echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
	exit();
}
$stmt2->close();

$mysqli->close();

echo "$x";

?>

