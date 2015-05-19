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
$sql = "SELECT id, name, artist, image, description, location, date, time, ticketlink
 FROM events ORDER BY date ASC";

$today = strtotime("now");

foreach ($dbh->query($sql) as $row)
{
$dt = strtotime($row[date]);	
$date = date("d/m/Y", $dt);
$day = date("D", $dt);	
<<<<<<< Updated upstream
if($date == $today or $date > $today) {
=======
if($dt == $today or $dt > $today) {
>>>>>>> Stashed changes
	
echo "
<div class=\"eventbox\">
<img class=\"eventimg\" src=/~tcmc21/db2/$row[image] alt=\"No image available\" width=25% height=25%> 
<div class=\"eventdetails\">
	<p>$row[artist] presents:</p>
	<div class=\"eventtitle\"><h2>$row[name]</h2></div>
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
