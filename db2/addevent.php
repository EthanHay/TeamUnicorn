<?php
session_start(); // this should be the very first statement when using sessions
// Report all PHP errors 
error_reporting(E_ALL);
/*	This file is a login page that will send the user to a secure page.
	There's a session 'msg' variable, which will be blank the first time (when not set).
*/

include("authenticate.php");
include("dbconnect.php");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Events</title>
</head>

<body>
<?php
include("header.php")
?>
<h1>Events Database</h1>

<?php
if ($_SESSION['status'] == 'free' OR $_SESSION['status'] == 'paid' )
	echo "You do not yet have permission to add artists. You need to be an admin. If you believe you should
	be an admin, please <a href='contact.php'>contact</a> TCMC";

else {
if($_GET['event']=='updated'){
	echo 'The event was updated';
}
elseif($_GET['event']=='notupdated'){
	echo 'The event was not updated';
}
elseif($_GET['event']=='added') {
	echo 'The event was successfully added';
}
elseif($_GET['event']=='notadded') {
	echo 'The event was not successfully added';
}
elseif($_GET['event']=='deleted') {
	echo 'The event was successfully deleted';
}
elseif($_GET['event']=='notdeleted') {
	echo 'The event was not successfully deleted';
}
?>
<form id="insert" name="insert" method="post" action="dbprocessevents.php" enctype="multipart/form-data">
<fieldset class="subtleSet">
    <h2>Insert New Event:</h2>
    <p>
      <label class="label" for="name">Event Name: </label>
      <input type="text" name="name" id="name">
    </p>
    <p>
      <label class="label" for="artist">Artist Name: </label>
      <input type="text" name="artist" id="artist">
    </p>
    <p>
        <label class="label" for="image">Image: </label>
      <input type="file" name="imagefile"  id="imagefile">
    </p>
    <!--<p>
    <input type="checkbox" name="thumbnailChoice" id="thumbnailChoice" checked="checked">
    <label for="thumbnailChoice">Create Thumbnail?</label>
    </p>-->
    <p>
      <label class="label"  for="description">Description: </label>
      <input type="text" name="description" id="description">
    </p>
    <p>
      <label class="label"  for="location">Location: </label>
      <input type="text" name="location" id="location">
    </p>
     <p>
      <label class="label"  for="date">Date (yyyy-mm-dd): </label>
      <input type="integer" name="date" id="date">
    </p>
    <p>
      <label class="label"  for="time">Time ((X)X p.m.): </label>
      <input type="integer" name="time" id="time">
    </p>
    <p>
      <label class="label"  for="link">Ticketlink: </label>
      <input type="integer" name="link" id="link">
    </p>
    <p>
      <input type="submit" name="submit" id="submit" value="Insert Event">
    </p>
</fieldset>
</form>

<fieldset class="subtleSet">
<h2>Current Events:</h2>
<blockquote>
  <p>
    <input type="text" value="Name" class="description"/> <input type="text" value="Artist" class="description"/> 
    <input type="text" value="Image" class="description"/> 
    <input type="text" value="Description" class="description"/> <input type="text" value="Location" class="description"/>
    <input type="text" value="Date" class="description"/> <input type="text" value="Time" class="description"/> 
       
  </p>
</blockquote>
<form id="deleteForm" name="deleteForm" method="post" action="dbprocessevents.php">
  <?php
  $sql = "SELECT * FROM events";
foreach ($dbh->query($sql) as $row)
{
	 
	echo "\n <input type='text' name='name' value='$row[name]' />
	<input type='text' name='artist' value='$row[artist]' /> 
	<input type='text' name='image' value='$row[image]' />
	<input type='text' name='description' value='$row[description]' /> 
	<input type='text' name='location' value='$row[location]' /> 
	<input type='text' name='date' value='$row[date]' />
	<input type='text' name='time' value='$row[time]' />
	<input type='text' name='link' value='$row[ticketlink]' />
	<input type='submit' name='submit' value='Update Event'>
  	<input type='submit' name='submit' value='Delete Event' class='deleteButton'>
  	<br> \n";
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
}
$dbh = null;
?>
</body>
</html>