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
<link rel="shortcut icon" href="images/icon.png">
</head>
<body>
<!--- NAV BAR ---> 
<?php
include("header.php");
?>
 
<div class="site_outside">
	<div class="site group">   
<div class="Pageheading"><h1>Artists</h1></div>
<h2>Featured artist</h2>
<?php
$sqlf = "SELECT id, name, thumb, featured FROM artists";
foreach($dbh->query($sqlf) as $row){
		
		
	if ($row['featured'] == 1){
		echo "<div class='featuredartists'>
			<a href=\"artistdetails.php?id=$row[id]\">
			<div class='leftpic'><img src=/~tcmc21/$row[thumb]><br></div>";
			echo "<div class='rightinfo'><p><a href=\"artistdetails.php?id=$row[id]\">$row[name]<br>Genre:";
		$sqlcat = "SELECT * FROM categories";
			foreach ($dbh->query($sqlcat) as $cat)
			{
			$sqlart = "SELECT * FROM art_cat";
				foreach ($dbh->query($sqlart) as $art)
				{
			if ($row['id'] == $art['artid'] && $cat['id']	== $art['catid'])
				echo"$cat[catname]  ";
		}
	}
		
			echo "</p></a></div></div>";
	}
}


?>

<div class="filterby">
<form method="post" action="dbprocessort.php" enctype="multipart/form-data">
<p><label for='filterby'>Filter by:</label>
<select name='filterby' id='filterby'>
<?php
$sqls = "SELECT catname FROM categories";
foreach ($dbh->query($sqls) as $sortcat){
	print_r($sortcat);
	echo"
		<option value='$sortcat[catname]'"; 
		if ($_GET['filter'] == $sortcat['catname']){ echo " selected";} 
		echo">$sortcat[catname]</option>
	";
	
}




?>
</select>
<input type="submit" name="submit" id="submit" value="Filter">
<input type="submit" name="submit" id="submit" value="Remove Filter">
</p>
</form>
</div>
<?php
if ($_GET['filter'] != "")
	echo "<p>Artists are filtered by $_GET[filter]</p>";
$sorting = 0;
// display current artists in the database.
$sqlcateg = "SELECT * FROM categories";
foreach ($dbh->query($sqlcateg) as $categ)
{	
	$sql = "SELECT id FROM artists";
	foreach ($dbh->query($sql) as $row)
	{
		$sqlartist = "SELECT * FROM art_cat";
		foreach ($dbh->query($sqlartist) as $artist)
		{
			
	
		if ($_GET['filter'] == $categ['catname'] && $row['id'] == $artist['artid'] && $categ['id'] == $artist['catid']){
		$sorting = 1;
		$sqlsort = "SELECT id, name, thumb, featured FROM artists WHERE id = '$row[id]' LIMIT 1";
		foreach ($dbh->query($sqlsort) as $sort){
			if ($sort['featured'] == 0){		
				echo "<div class='currentartists'>
				<a href=\"artistdetails.php?id=$sort[id]\">
				<div class='leftpic'><img src=/~tcmc21/$sort[thumb]><br></div>";
				echo "<div class='rightinfo'><p><a href=\"artistdetails.php?id=$sort[id]\">$sort[name]<br>";
				echo "Genre:";
				
				$sqlcat = "SELECT * FROM categories";
			foreach ($dbh->query($sqlcat) as $cat)
			{
			$sqlart = "SELECT * FROM art_cat";
				foreach ($dbh->query($sqlart) as $art)
				{
			if ($sort['id'] == $art['artid'] && $cat['id'] == $art['catid'])
				echo"$cat[catname]  ";
		}
	} 
				
				echo "</p></a></div></div>";
			}
		}		
		}
		
		}
}
}
if ($sorting == 0 && $_GET['filter'] != ""){
	echo "<p>There are no artists in this category </p>";
	/*$sqlsort = "SELECT id, name, thumb FROM artists";
		foreach ($dbh->query($sqlsort) as $sort){			
			echo "<div class='currentartists'>
			<a href=\"artistdetails.php?id=$sort[id]\">
			<div class='leftpic'><img src=/~tcmc21/db2/$sort[thumb]><br></div>";
			echo "<div class='rightinfo'><p><a href=\"artistdetails.php?id=$sort[id]\">$sort[name]<br>";
			echo "Genre: </p></a></div></div>";
}*/
}

elseif ($sorting == 0){
	$sqlsort = "SELECT id, name, thumb, featured FROM artists";
		foreach ($dbh->query($sqlsort) as $sort){			
			if ($sort['featured'] == 0){	
			echo "<div class='currentartists'>
			<a href=\"artistdetails.php?id=$sort[id]\">
			<div class='leftpic'><img src=/~tcmc21/$sort[thumb]><br></div>";
			echo "<div class='rightinfo'><p><a href=\"artistdetails.php?id=$sort[id]\">$sort[name]<br>";
			echo "Genre:";
				
				$sqlcat = "SELECT * FROM categories";
			foreach ($dbh->query($sqlcat) as $cat)
			{
			$sqlart = "SELECT * FROM art_cat";
				foreach ($dbh->query($sqlart) as $art)
				{
			if ($sort['id'] == $art['artid'] && $cat['id'] == $art['catid'])
				echo"$cat[catname]  ";
		}
	}
				
				echo "</p></a></div></div>";
			}
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
