<?php
/* This code runs the SQL queries and outputs what happens as a result of the queries.
   It would be possible to have this code set messages in a session variable and pass this on to another page 
   (redirect with the header method) instead of printing the results here. 
   The X option demonstrates this ("silent" delete).
*/
session_start(); // this should be the very first statement when using sessions
// Report all PHP errors 
error_reporting(E_ALL);
/*	This file is a login page that will send the user to a secure page.
	There's a session 'msg' variable, which will be blank the first time (when not set).
*/
include("dbconnect.php");

$debugOn = true;

/*if ($_REQUEST['submit'] == "X")
{
	$sql = "DELETE FROM events WHERE id = '$_REQUEST[id]'";
	if ($dbh->exec($sql))
		header("Location: addevent.php"); // NOTE: This must be done before ANY html is output, which is why it's right at the top!
/*	else
		// set message to be printed on appropriate (results) page

} */
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Events Information Processing</title>
</head>

<body>
<h1>Results</h1>
<?php
echo "<h2>Form Data</h2>";
echo "<pre>";
print_r($_REQUEST); // a useful debugging function to see everything in an array, best inside a <pre> element
echo "</pre>";
// execute the appropriate query based on which submit button (insert, delete or update) was clicked

if ($_REQUEST['submit'] == "Insert Event")
{
	include("upload_file_events.php");
	$sql = "INSERT INTO events (name, artist, image, description, location, date, time, ticketlink) VALUES 
	('$_REQUEST[name]', '$_REQUEST[artist]', '$newFullName', '$_REQUEST[description]', '$_REQUEST[location]',
	 '$_REQUEST[date]', '$_REQUEST[time]', '$_REQUEST[link]' )";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	if ($dbh->exec($sql)){
		echo "Inserted $_REQUEST[name]";
		header("Location: addevent.php?event=added");
	}
	else{
		echo "Not inserted"; // in case it didn't work - e.g. if database is not writeable
		header("Location: addevent.php?event=notadded");
	}
}
else if ($_REQUEST['submit'] == "Delete Event")
{
	$sql = "DELETE FROM events WHERE id = '$_REQUEST[id]'";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	if ($dbh->exec($sql)){
		echo "Deleted $_REQUEST[name]";
		header("Location: addevent.php?event=deleted");
	}
	else {
		echo "Not deleted";
		header("Location: addevent.php?event=notdeleted");
	}
}
else if ($_REQUEST['submit'] == "Update Event")
{
	$sql = "UPDATE events SET name = '$_REQUEST[name]', artist = '$_REQUEST[artist]', image = '$_REQUEST[image]',
	description = '$_REQUEST[description]', location = '$_REQUEST[location]', date = '$_REQUEST[date]', 
	time = '$_REQUEST[time]', ticketlink = '$_REQUEST[link]' WHERE id = '$_REQUEST[id]'";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	if ($dbh->exec($sql)){
		echo "Updated $_REQUEST[name]";
		header("Location: addevent.php?event=updated");
	}
	else {
		echo "Not updated";
		header("Location: addevent.php?event=notupdated");
	}
}
else {
	echo "This page did not come from a valid form submission.<br />\n";
}
echo "</strong></p>\n";

// Basic select and display all contents from table 

echo "<h2>Events in Database Now</h2>\n";
$sql = "SELECT * FROM events";
$result = $dbh->query($sql);
$resultCopy = $result;

if ($debugOn) {
	echo "<pre>";	
// one row at a time:
/*	$row = $result->fetch(PDO::FETCH_ASSOC);
	print_r($row);
	echo "<br />\n";
	$row = $result->fetch(PDO::FETCH_ASSOC);
	print_r($row);
*/
// all rows in one associative array
	$rows = $result->fetchall(PDO::FETCH_ASSOC);
	echo count($rows) . " records in table<br />\n";
	print_r($rows);
	echo "</pre>";
	echo "<br />\n";
}
//foreach ($dbh->query($sql) as $row)
//{
//	print $row[name] .' - '. $row[phone] . "<br />\n";
//}

// close the database connection 
$dbh = null;
?>
<p><a href="addevent.php">Return to database test page</a></p>
</body>
</html>