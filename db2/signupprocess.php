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

$password = $_REQUEST['password'];
$hash = password_hash($password, PASSWORD_BCRYPT);

if ($_REQUEST['submit'] == "Become a member")
{
	$sql = "INSERT INTO members (firstname, surname, address, postcode, suburb, state, phoneday, phoneeve, email, password, status) VALUES 
	('$_REQUEST[firstname]', '$_REQUEST[surname]', '$_REQUEST[address]', '$_REQUEST[postcode]', '$_REQUEST[suburb]', 
	'$_REQUEST[state]','$_REQUEST[phoneday]','$_REQUEST[phoneeve]','$_REQUEST[email]','$hash', 'free')";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	if ($dbh->exec($sql))
		header("Location: myprofile.php?signup=success");
	else
		header("Location: signup.php?signup=incomplete"); // in case it didn't work - e.g. if database is not writeable
}
else if ($_REQUEST['submit'] == "Update info")
{
	$sql = "UPDATE members SET firstname = '$_REQUEST[firstname]', surname = '$_REQUEST[surname]', 
	address= '$_REQUEST[address]', postcode = '$_REQUEST[postcode]', suburb = '$_REQUEST[suburb]',
	 state = '$_REQUEST[state]', phoneday = '$_REQUEST[phoneday]', phoneeve = '$_REQUEST[phoneeve]', 
	 email = '$_REQUEST[email]' WHERE id = '$_SESSION[id]' ";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	if($dbh->exec($sql))
		header("Location: myprofile.php?status=updated");
	else
		header("Location: myprofile.php?status=notupdated");
		
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
<p><a href="signup.php">Return to database test page</a></p>
</body>
</html>