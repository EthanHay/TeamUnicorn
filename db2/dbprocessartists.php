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
	$sql = "DELETE FROM artists WHERE id = '$_REQUEST[id]'";
	if ($dbh->exec($sql))
		header("Location: addartist.php"); // NOTE: This must be done before ANY html is output, which is why it's right at the top!
/*	else
		// set message to be printed on appropriate (results) page
*/
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Artist Information Processing</title>
</head>

<body>
<h1>Results</h1>
<?php
echo "<h2>Form Data</h2>";
echo "<pre>";
print_r($_REQUEST); // a useful debugging function to see everything in an array, best inside a <pre> element
echo "</pre>";
// execute the appropriate query based on which submit button (insert, delete or update) was clicked
if ($_REQUEST['submit'] == "Insert Entry")
{
	include("upload_file_artists.php");
	$sql = "INSERT INTO artists (name, email, facebook, phone, about, image, thumb) VALUES 
	('$_REQUEST[name]', '$_REQUEST[email]', '$_REQUEST[facebook]', '$_REQUEST[phone]', '$_REQUEST[about]',
	'$newFullName','$thumbFullName')";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	
	if ($dbh->exec($sql))
		echo "Inserted $_REQUEST[name]";
	else
		echo "Not inserted"; // in case it didn't work - e.g. if database is not writeable
	
	$query = "SELECT id, name FROM artists";
	foreach ($dbh->query($query) as $row);{
	if($row['name'] == $_REQUEST['name']) {
		$artid = $row['id'];
	}
	}
	
	$categ = $_REQUEST['category'];
	$N = count($categ);
	for($i=0; $i < $N; $i++){
	echo($categ[$i] . " ");
	$sqlcat = "SELECT * FROM categories";
	  foreach ($dbh->query($sqlcat) as $cat) {
			if ($categ[$i] == $cat['catname']){
				$sqlcatart = "INSERT INTO art_cat (artid, catid) VALUES ('$artid', '$cat[id]')";
				$result = $dbh->query($sqlcatart);
			}
	}
	}
	
}

else if ($_REQUEST['submit'] == "Update Featured Artist")
{
	$sqlfeat =  "SELECT * FROM artists";
	foreach ($dbh->query($sqlfeat) as $feat)
	if ($_REQUEST['featured'] == $feat['name']) 
	{ 
		$sql = "UPDATE artists SET featured = '1' WHERE id = '$feat[id]'";
		$dbh->exec($sql);
		$featid = $feat['id'];
		echo "IT WORKED, $featid";
	}
	else
	{
		$sql = "UPDATE artists SET featured = '0' WHERE id != '$featid'";
		echo "HA";
		$dbh->exec($sql);
	}
	header("Location: addartist.php?featart=updated");
}

else if ($_REQUEST['submit'] == "Add category")
{
	$sql = "INSERT INTO categories (catname) VALUES ('$_REQUEST[newcat]')";
	if ($dbh->exec($sql))
		echo "Added $_REQUEST[name]";
	else
		echo "Not added";
}

else if ($_REQUEST['submit'] == "Update category")
{
	
	$sql = "UPDATE categories SET catname = '$_REQUEST[catname]' WHERE id = '$_REQUEST[id]'";
	if ($dbh->exec($sql))
		echo "Updated $_REQUEST[name]";
	else
		echo "Not updated, $_REQUEST[id]";
}

else if ($_REQUEST['submit'] == "Update artist categories"){
	$categ = $_REQUEST['category'];
	$N = count($categ);
	for($i=0; $i < $N; $i++){
		$sqlcat = "SELECT id, catname FROM categories";
		foreach ($dbh->query($sqlcat) as $cat){
			if ($categ[$i] == $cat['catname']){
				$catid[$i] = $cat['id'];	
			}
		}
		$sql = "INSERT INTO art_cat (artid, catid) VALUES ('$_REQUEST[artid]', '$catid[$i]')";
		if ($dbh->exec($sql))
		echo "Updated artist categories";
	else
		echo "Not updated, artist categories";
	
	}
	
}

else if ($_REQUEST['submit'] == "Delete category")
{
	$sql = "DELETE FROM categories WHERE id = '$_REQUEST[id]'";
	if ($dbh->exec($sql))
		echo "Deleted $_REQUEST[name]";
	else
		echo "Not deleted";
}
else if ($_REQUEST['submit'] == "Delete Entry")
{
	$sql = "DELETE FROM artists WHERE id = '$_REQUEST[id]'";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	if ($dbh->exec($sql))
		echo "Deleted $_REQUEST[name]";
	else
		echo "Not deleted";
}
else if ($_REQUEST['submit'] == "Update Entry")
{
	$sql = "UPDATE artists SET name = '$_REQUEST[name]', image = '$_REQUEST[image]', 
	thumb= '$_REQUEST[thumb]', email = '$_REQUEST[email]', facebook = '$_REQUEST[facebook]', 
	genre = '$_REQUEST[genre]', phone = '$_REQUEST[phone]', about = '$_REQUEST[about]' WHERE id = '$_REQUEST[id]'";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	if ($dbh->exec($sql))
		echo "Updated $_REQUEST[name]";
	else
		echo "Not updated";
}
else {
	echo "This page did not come from a valid form submission.<br />\n";
}
echo "</strong></p>\n";
// Basic select and display all contents from table 
echo "<h2>Artists in Database Now</h2>\n";
$sql = "SELECT * FROM artists";
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
<p><a href="addartist.php">Return to database test page</a></p>
</body>
</html>