<?php
include("dbconnect.php")
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Current Artists</title>
</head>
<body>    
<h1>Current Artists</h1>
<?php
// display current artists in the database.
$sql = "SELECT id, name, image, genre FROM artists";

foreach ($dbh->query($sql) as $row)
{
echo "<p><a href=\"artistdetails.php?id=$row[id]\">$row[name]<br>";
echo "<img src=/~tcmc21/db$row[image] width=25% height=25%><br>";
echo "Genre: $row[genre]</p></a>";
}
?>
    </body>
</html>
