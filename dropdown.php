<?php

require('db.php');

if (!($stmt = $mysqli->prepare("SELECT DISTINCT category  FROM inventory WHERE 1"))) {
	//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	echo "Error: Could not get information from the database.<br>";
	echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
	exit();
}
if (!$stmt->execute()) {
	//echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
	echo "Error: Could not get information from the database.<br>";
	echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
	exit();
}
$out_category = NULL;
if (!$stmt->bind_result($out_category)) {
	//echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	echo "Error: Could not get information from the database.<br>";
	echo "<a href='interface.php'>Back to 'Add Video' interface.</a>";
	exit();
}

echo "
<form action='interface.php' method='GET'>
	  <fieldset>
	    <legend>Categories</legend>
		
		<!--test dropdown-->
		<select name='category'>
		  <option value=''>All Movies</option>
";
while ($stmt->fetch()) {
	//prepare variables for access
	if (!isset($out_category)) $out_category = "";
	if ($out_category == "") continue;
	echo "<option value=$out_category>$out_category</option>";
}
echo "
		</select>

		<input type='submit' name='submit' value='Filter Categories' />
	  </fieldset>
	</form>
";

$stmt->close();
	
$mysqli->close();

?>

