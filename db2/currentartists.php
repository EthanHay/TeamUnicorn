<?php
include("dbconnect.php")
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Current Artists</title>
<link href="sitestyles.css" rel="stylesheet" type="text/css">
</head>
<body>    
<?php
include("header.html");
?>
<div class="site_outside">
<div class="site">
<h1>Artists</h1>
<?php
// display current artists in the database.
$sql = "SELECT id, name, image, genre FROM artists";

foreach ($dbh->query($sql) as $row)
{
echo "
<div class=\"artistbox\">
<img class=\"artistimg\" src=/~tcmc21/db$row[image] width=25% height=25%> 
<div class=\"basicinfo\">
	<p>
	<a href=\"artistdetails.php?id=$row[id]\">$row[name]</a>
	</p>
	<p>
	Genre: $row[genre] 
	</p>
</div>	
</div>
	";
}
?>
</div>
</div>
<?php
include("footer.html");
?>

</body>
</html>
