<?php
include("dbconnect.php")
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Events</title>
</head>

<body>
<h1>Events Database</h1>
<form id="insert" name="insert" method="post" action="dbprocessevents.php" enctype="multipart/form-data">
<fieldset class="subtleSet">
    <h2>Insert New Artist:</h2>
    <p>
      <label class="label" for="name">Event Name: </label>
      <input type="text" name="name" id="name">
    </p>
    <p>
        <label class="label" for="image">Image: </label>
      <input type="file" name="imagefile"  id="imagefile">
    </p>
    <p>
    <input type="checkbox" name="thumbnailChoice" id="thumbnailChoice" checked="checked">
    <label for="thumbnailChoice">Create Thumbnail?</label>
    </p>
    <p>
      <label class="label"  for="description">Description: </label>
      <input type="text" name="description" id="description">
    </p>
    <p>
      <label class="label"  for="location">Location: </label>
      <input type="text" name="location" id="location">
    </p>
     <p>
      <label class="label"  for="date">Date (ddmmyy): </label>
      <input type="integer" name="date" id="date">
    </p>
    <p>
      <input type="submit" name="submit" id="submit" value="Insert Entry">
    </p>
</fieldset>
</form>

<fieldset class="subtleSet">
<h2>Current Events:</h2>
<blockquote>
  <p>
    <input type="text" value="Name" class="description"/> <input type="text" value="Image" class="description"/> 
    <input type="text" value="Description" class="description"/> <input type="text" value="Location" class="description"/>
    <input type="text" value="Date" class="description"/> 
       
  </p>
</blockquote>
<form id="deleteForm" name="deleteForm" method="post" action="dbprocessevents.php">
  <?php
  $sql = "SELECT * FROM events";
foreach ($dbh->query($sql) as $row)
{
	 
	echo "\n <input type='text' name='name' value='$row[name]' /> <input type='text' name='image' value='$row[image]' />
	<input type='text' name='description' value='$row[description]' /> <input type='text' name='location' value='$row[location]' /> 
	<input type='text' name='date' value='$row[date]' /><input type='submit' name='submit' value='Update Entry'>
  <input type='submit' name='submit' value='Delete Entry' class='deleteButton'>
  <input type='submit' name='submit' value='X' class='deleteButton'> <input type='radio' name='featured' value='featured'>\n";
	echo "<input type='hidden' name='id' value='$row[id]' />";
}
?>
 <!-- <input type="submit" name="submit" value="Update Entry">
  <input type="submit" name="submit" value="Delete Entry" class="deleteButton">
  <input type="submit" name="submit" value="X" class="deleteButton">-->
</form>
<?php

echo "</fieldset>\n";
// close the database connection
$dbh = null;
?>
</body>
</html>