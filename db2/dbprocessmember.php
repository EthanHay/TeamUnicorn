<?php
/* This code runs the SQL queries and outputs what happens as a result of the queries.
   It would be possible to have this code set messages in a session variable and pass this on to another page 
   (redirect with the header method) instead of printing the results here. 
   The X option demonstrates this ("silent" delete).
*/
include("dbconnect.php");

$debugOn = true;

if ($_REQUEST['submit'] == "X")
{
	$sql = "DELETE FROM members WHERE id = '$_REQUEST[id]'";
	if ($dbh->exec($sql))
		header("Location: addmember.php"); // NOTE: This must be done before ANY html is output, which is why it's right at the top!
/*	else
		// set message to be printed on appropriate (results) page
*/
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Member Information Processing</title>
</head>

<body>
<h1>Results</h1>
<?php
echo "<h2>Form Data</h2>";
echo "<pre>";
print_r($_REQUEST); // a useful debugging function to see everything in an array, best inside a <pre> element
echo "</pre>";
// execute the appropriate query based on which submit button (insert, delete or update) was clicked

if ($_REQUEST['submit'] == "Delete Entry")
{
	$sql = "DELETE FROM members WHERE id = '$_REQUEST[id]'";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	if ($dbh->exec($sql))
		header("Location: addmember.php?result=deleted");
	else
		header("Location: addmember.php?result=notdeleted");
}
else if ($_REQUEST['submit'] == "Update Entry")
{
	$sql = "UPDATE members SET firstname = '$_REQUEST[firstname]', surname = '$_REQUEST[surname]',
	 address= '$_REQUEST[address]', postcode = '$_REQUEST[postcode]', suburb = '$_REQUEST[suburb]', 
	 state = '$_REQUEST[state]', phoneday = '$_REQUEST[phoneday]', phoneeve = '$_REQUEST[phoneeve]', 
	 email = '$_REQUEST[email]', password = '$_REQUEST[password]',
	 status = '$_REQUEST[status]' WHERE id = '$_REQUEST[id]'";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	if ($dbh->exec($sql))
		header("Location: addmember.php?result=updated");
	else
		header("Location: addmember.php?result=notupdated");
}
else {
	echo "This page did not come from a valid form submission.<br />\n";
}
echo "</strong></p>\n";

// Basic select and display all contents from table 

echo "<h2>Members in Database Now</h2>\n";
$sql = "SELECT * FROM members";
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
<p><a href="addmember.php">Return to database test page</a></p>
</body>
</html>