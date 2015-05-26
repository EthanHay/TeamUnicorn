<?php
session_start(); // this should be the very first statement when using sessions
// Report all PHP errors 
error_reporting(E_ALL);
/*	This file is a login page that will send the user to a secure page.
	There's a session 'msg' variable, which will be blank the first time (when not set).
*/
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
<form method="post" action="dbprocessort.php" enctype="multipart/form-data">
<p><label for='sortby'>Sort by:</label>
<select name='sortby' id='sortby'>
<?php
$sqls = "SELECT catname FROM categories";
foreach ($dbh->query($sqls) as $sortcat){
	echo"
		<option value='$sortcat[catname]'"; 
		if ($_GET['sort'] == '$sortcat[catname]'){ echo " selected";} 
		echo">$sortcat[catname]</option>
	";
	
}

if ($_GET['sort'] != "")
	echo "Artists are sorted by '$_GET[sort]'";

?>
</select>
<input type="submit" name="submit" id="submit" value="Sort">
</p>
</form>

<?php
$sorting = 0;
// display current artists in the database.
$sqlcat = "SELECT * FROM categories";
foreach ($dbh->query($sqlcat) as $cat)
{	
	$sql = "SELECT id FROM artists";
	foreach ($dbh->query($sql) as $row)
	{
		$sqlart = "SELECT * FROM art_cat";
		foreach ($dbh->query($sqlart) as $art)
		{
			
	
		if ($_GET['sort'] == $cat['catname'] && $row['id'] == $art['artid'] && $cat['id'] == $art['catid']){
		$sorting = 1;
		$sqlsort = "SELECT id, name, thumb FROM artists WHERE id = '$row[id]' LIMIT 1";
		foreach ($dbh->query($sqlsort) as $sort){			
			echo "<div class='currentartists'>
			<a href=\"artistdetails.php?id=$sort[id]\">
			<div class='leftpic'><img src=/~tcmc21/db2/$sort[thumb]><br></div>";
			echo "<div class='rightinfo'><p><a href=\"artistdetails.php?id=$sort[id]\">$sort[name]<br>";
			echo "Genre: </p></a></div></div>";
		}		
		}
		
		}
}
}

if ($sorting == 0){
	$sqlsort = "SELECT id, name, thumb FROM artists";
		foreach ($dbh->query($sqlsort) as $sort){			
			echo "<div class='currentartists'>
			<a href=\"artistdetails.php?id=$sort[id]\">
			<div class='leftpic'><img src=/~tcmc21/db2/$sort[thumb]><br></div>";
			echo "<div class='rightinfo'><p><a href=\"artistdetails.php?id=$sort[id]\">$sort[name]<br>";
			echo "Genre: </p></a></div></div>";
}
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
