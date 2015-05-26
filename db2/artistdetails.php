<?php
include("dbconnect.php")
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>
TCMC - 
<?php 
$artist_id = $_GET['id'];
$sql = "SELECT name FROM artists WHERE id=$artist_id";
foreach ($dbh->query($sql) as $row) {
echo "$row[name]"; 
}
?>
</title>
<link href="sitestyles.css" rel="stylesheet">
</head>

<body>
<?php
include("header.php");
?>
<div class="site_outside">
	<div class="site group">
	<?php
    // display selected artist.
    $artist_id = $_GET['id'];
    $sql = "SELECT name, image, about, facebook, email, phone FROM artists WHERE id=$artist_id";
    foreach ($dbh->query($sql) as $row)
    {
    echo "<div class='top'><div class='leftside'><h1>$row[name]</h1>";
	echo "<p>$row[about]</p><br></div>";
	
    echo "<div class='rightside'><img src=/~tcmc21/db2/$row[image] width=100% height=100%><br>";
    echo "Genre: $row[genre]</p></div></div>";
    
    echo "<div class='bottom'><P>Website link: <a href='$row[facebook]'>$row[name]</a></p>";
    echo "<P>Email: $row[email]</p>";
    echo "<p>Phone: $row[phone]</p></div>";
    }
    ?>
    </div>
</div>


<?php
include("footer.html");
?>
 

</body>
</html>
