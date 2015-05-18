<?php
include("dbconnect.php")
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
// display selected artist.
$artist_id = $_GET['id'];
$sql = "SELECT name, image, about, genre, facebook, email, phone FROM artists WHERE id=$artist_id";
foreach ($dbh->query($sql) as $row)
{
echo "<p>$row[name]<br>";
echo "<img src=/~tcmc21/db$row[image] width=100% height=100%><br>";
echo "Genre: $row[genre]</p>";
echo "$row[about]<br>";
echo "$row[facebook]<br>";
echo "$row[email]<br>";
echo "$row[phone]</p>";
}
?>
<a href="currentartists.php">Return to Current Artists</a>
</body>
</html>