<?php
include("dbconnect.php");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>TCMC - Events</title>
<link href="sitestyles.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
include("header.php");
?>
<div class="site_outside">
	<div class="site">
		<h1>Events</h1>
		<p>Here you can find upcoming events</p>
<?php
// display current notices in the database.

$sqlartist = "SELECT id, name FROM artists";



$sql = "SELECT id, name, artist, image, description, location, date, time, ticketlink
 FROM events ORDER BY date ASC";

$today = strtotime("now");

foreach ($dbh->query($sql) as $row)
{
$dt = strtotime($row[date]);	
$date = date("d/m/Y", $dt);
$day = date("D", $dt);	

if($dt == $today or $dt > $today) {

echo "
<div class=\"eventbox\">
<img class=\"eventimg\" src=/~tcmc21/db2/$row[image] alt=\"No image available\" width=25% height=25%> 
<div class=\"eventdetails\">";

$artid = 0;
$nameid = 0;
	foreach ($dbh->query($sqlartist) as $rowart)
	{		
		//echo"$row[artist], $rowart[name] <br>";
		if($row['artist'] == $rowart['name']) {
			$artid = $rowart['id'];
			}
		elseif($row['name'] == $rowart['name']){
			$nameid = $rowart['id'];
		}
	}
if($row['artist'] != "") {
	if($artid != 0) {
		
		echo"<p><a href=\"artistdetails.php?id=$artid\">$row[artist]</a> presents:</p>";
	}
	else {
		echo"<p>$row[artist] presents: </p>";
	
	}
}


if($nameid != 0) {
		
		echo"<div class=\"eventtitle\"><a href=\"artistdetails.php?id=$nameid\"><h2>$row[name]</h2></a></div>";
	}
	else {
		echo"<div class=\"eventtitle\"><h2>$row[name]</h2></div>";
	
	}


echo"
	<p>@$row[location], $day $date, $row[time]</p>
	<p>$row[description]</p>
	<p>
	<a href=\"$row[ticketlink]\" target=\"_blank\">Get tickets here</a>
	</p>

</div>	
</div>
	";
}  

}
?>        
	</div>
</div>
<?php
include("footer.html");
?>
</body>
</html>
