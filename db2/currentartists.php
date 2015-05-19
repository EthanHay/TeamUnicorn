<?php
include("dbconnect.php")
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Current Artists</title>
<link href="sitestyles.css" rel="stylesheet">
</head>
<body>
<!--- NAV BAR ---> 
<?php
include("header.php");
?>
 
<div class="site_outside">
	<div class="site group">   
<div class="Pageheading"><h1>Current Artists</h1></div>

		<?php
		// display current artists in the database.
		$sql = "SELECT id, name, image, genre FROM artists";

		foreach ($dbh->query($sql) as $row)
		{
		echo "<div class='currentartists'><a href=\"artistdetails.php?id=$row[id]\"><div class='leftpic'><img src=/~tcmc21/db$row[image]><br></div>";
		echo "<div class='rightinfo'><p><a href=\"artistdetails.php?id=$row[id]\">$row[name]<br>";
		echo "Genre: $row[genre]</p></a></div></div>";
		}
		?>
	</div>
</div>
<!--- FOOTER --->     
<?php
include("footer.html");
?>
</body>
</html>
