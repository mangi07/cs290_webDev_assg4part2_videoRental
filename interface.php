<!DOCTYPE html>

<html>
  <head>
    <meta charset="UTF-8">
	<meta name="description" content="CS 290 Assignment 4 Part 2: PHP and MySQL">
	<meta name="author" content="Benjamin R. Olson">
	<title>CS 290 Assignment 4 Part 2: PHP and MySQL</title>
	<script src="functions.js"></script>
  </head>
  <body>
    <h1>Video Store Inventory</h1>
	
	<form action="add_video.php" method="POST">
	  <fieldset>
	    <legend>Add Video</legend>
		Name (required): <input type="textfield" name="name" id="n" />
		Category: <input type="textfield" name="category" id="c" />
		Length in minutes: <input type="textfield" name="length" id="l" />
		<input type="submit" name="Add Video" />
	  </fieldset>
	</form>
	
	<!-- shows a table of video stats based on filter -->
	<?php
	  include 'main.php';
	  include 'filter.php';
	?>
	
	<!-- form to filter based on category -->
	<?php
		include 'dropdown.php';
	?>
	
	<!-- button to delete all videos -->
	<form action='clearTable.php' method='POST'>
	  <fieldset>
	    <legend>Proceed With Caution!...</legend>
		<input type='submit' name='submit' value='Clear Table' />
	  </fieldset>
	</form>
	
  </body>
  
</html>

