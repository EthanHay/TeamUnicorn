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
$sql = "SELECT name, image, email, facebook, genre FROM artists";

foreach ($dbh->query($sql) as $row)
{
echo "<p>$row[name]<br>";
echo "<img src=$row[image] width=25% height=25%><br>";
echo "E-mail: $row[email]<br>";
echo "$row[facebook]<br>";
echo "Genre: $row[genre]</p>";
}
?>
    </body>
</html>
