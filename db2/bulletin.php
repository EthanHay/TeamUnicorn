<?php
include("dbconnect.php");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>TCMC - Bulletin</title>
<link href="sitestyles.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="images/icon.png">
</head>

<body>
<?php
include("header.php");
?>
<div class="site_outside">
    <div class="site">
        <h1>Bulletin Board</h1>
<?php
if($_GET['result']=='submitted'){
	echo '<p class="submitted">Your notice was submitted </p>';
}
?>
        <p>Here you can find stuff for sale, lessons or announcements about volunteer work and other stuff. <br>
     <?php
	 if (isset($_SESSION['status'])){
	 
    	echo" <a href='addnotice.php'>Click here</a> to add your own notice.
        </p> ";
	 }
		?>
        <?php
// display current notices in the database.

$today = date("d/m/Y");
$date = strtotime("now");

$sql = "SELECT id, title, description, image, type, contact1, contact2, expirydate FROM bulletin WHERE type = 'Buy/sell' ";
echo "<h2>Buy/sell</h2>";

foreach ($dbh->query($sql) as $row) {
	$dt = strtotime($row[expirydate]);	
	
	
	if($dt == $date or $dt > $date)
		{
		echo "
		<div class=\"bulletinbox\">";
		
		if ($row['image'] != "")
		echo "<img class=\"bulletinimg\" src=/~tcmc21/$row[image] width=25% height=25%> ";
		
		echo "<div class=\"description\">
			<h3>$row[title]</h3>
			<p>$row[description]</p>
			<p>
			Contact: $row[contact1], $row[contact2]
			</p>
		</div>	
		</div>
			";
		}
}
$sql = "SELECT id, title, description, image, type, contact1, contact2, expirydate FROM bulletin WHERE type = 'Lesson' ";
echo "<h2>Lessons</h2>";

foreach ($dbh->query($sql) as $row){
	$dt = strtotime($row[expirydate]);	
	$date = date("d/m/Y", $dt);
	
	if($dt == $date or $dt > $date)
		{
		echo "
		<div class=\"bulletinbox\">";
		
		if ($row['image'] != "")
		echo "<img class=\"bulletinimg\" src=/~tcmc21/$row[image] width=25% height=25%> ";
		
		echo "
		<div class=\"description\">
			<h3>$row[title]</h3>
			<p>$row[description]</p>
			<p>
			Contact: $row[contact1], $row[contact2]
			</p>
		</div>	
		</div>
			";
		}
}
$sql = "SELECT id, title, description, image, type, contact1, contact2, expirydate FROM bulletin WHERE type = 'Announcement' ";

echo "<h2>Announcements</h2>";

foreach ($dbh->query($sql) as $row){
	$dt = strtotime($row[expirydate]);	
	$date = date("d/m/Y", $dt);
	
	if($dt == $date or $dt > $date)
		{
		echo "
		<div class=\"bulletinbox\">";
		
		if ($row['image'] != "")
		echo "<img class=\"bulletinimg\" src=/~tcmc21/$row[image] width=25% height=25%> ";
		
		echo "
		<div class=\"description\">
			<h3>$row[title]</h3>
			<p>$row[description]</p>
			<p>
			Contact: $row[contact1], $row[contact2]
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