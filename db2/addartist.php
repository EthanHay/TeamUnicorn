<?php
session_start(); // this should be the very first statement when using sessions
// Report all PHP errors 
error_reporting(E_ALL);
/*	This file is a login page that will send the user to a secure page.
	There's a session 'msg' variable, which will be blank the first time (when not set).
*/

include("authenticate.php");
include("dbconnect.php");

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>TCMC - Add/edit Artists</title>
<!--<link href="styles.css" rel="stylesheet" type="text/css">-->
<link href="sitestyles.css" rel="stylesheet">
<link rel="shortcut icon" href="images/icon.png">
</head>

<body>
<?php
include("header.php");
?>
<div class="site_outside">
    <div class="site group"> 
<h1>Artist Database</h1>

<!--------------------------- NEW ARTIST  ------------------------------>
<?php 
if ($_SESSION['status'] == 'free')
	echo "You do not yet have permission to add artists. You need to be a paying member. If you believe you have 
	paid, please <a href='contact.php'>contact</a> TCMC";

else {
?>


<form id="insert" name="insert" method="post" action="dbprocessartists.php" enctype="multipart/form-data">
<fieldset class="subtleSet">
    <h2>Insert New Artist:</h2>
    <p>
      <label class="label" for="name">Artist Name: </label>
      <input type="text" name="name" id="name">
    </p>
    <p>
        <label class="label" for="image">Image: </label>
      <input type="file" name="imagefile"  id="imagefile">
    </p>
    <p>
    <input type="checkbox" name="thumbnailChoice" id="thumbnailChoice" checked="checked">
    <label for="thumbnailChoice">Create Thumbnail?</label>
    </p>
    <p>
      <label class="label"  for="email">E-mail Address: </label>
      <input type="text" name="email" id="email">
    </p>
    <p>
      <label class="label"  for="facebook">Website/Facebook Address: </label>
      <input type="text" name="facebook" id="facebook">
    </p>
     <p>
      <label class="label"  for="phone">Phone Number: </label>
      <input type="text" name="phone" id="phone">
    </p>
    <p>
      <label class="label"  for="category">Categories: </label>
      <?php
	  $sql = "SELECT * FROM categories";
	  foreach ($dbh->query($sql) as $cat) {
		  echo "<input type='checkbox' name='category[]' id='category' value='$cat[catname]'>$cat[catname] <br>";
	  }
	  ?>
    </p>
    <p>
      <label class="label"  for="about">About the Artist: </label>
      <input type="text" name="about" id="about">
    </p>
    <p>
      <input type="submit" name="submit" id="submit" value="Insert Entry">
    </p>
</fieldset>
</form>
<?php
}

if ($_SESSION['status'] == 'admin') {

?>


<!--------------------------- FEATURED ARTIST  ------------------------------>
<fieldset class="subtleSet">
<form id="featureForm" name="featureForm" method="post" action="dbprocessartists.php">
<h2>Featured artist</h2>
<?php

if($_GET['featart']=='updated'){
	echo '<p class="notsubmitted">Featured artist was updated</p>';
}


$sqlfeat = "SELECT * FROM artists";
foreach ($dbh->query($sqlfeat) as $row){
	echo "$row[name]<input type='radio' name='featured' id='featured' value='$row[name]'/> <br>";
}
?>
<input type="submit" name="submit" value="Update Featured Artist">
</form>
</fieldset>

<!--------------------------- ADD/EDIT CATEGORIES  ------------------------------>
<form method="post" action="dbprocessartists.php">
<h2>Manage categories</h2>
<fieldset class="subtleSet">
<label class="label">Add category:</label>
<input type="text" name="newcat" id="newcat"/>
<input type="submit" name="submit" value="Add category">
</fieldset>
</form>

<fieldset class="subtleSet">
<h3>Edit categories</h3>
<?php
// Display what's in the database at the moment.
$sql = "SELECT * FROM categories";
foreach ($dbh->query($sql) as $catrow)
{
?>
<form method="post" action="dbprocessartists.php">
<?php
echo "<input type='text' name='catname' value='$catrow[catname]' /> <input type='hidden' name='id' value='$catrow[id]' />"
?>  
<input type="submit" name="submit" value="Update category">
<input type="submit" name="submit" value="Delete category" class="deleteButton"><br>
</form>
<?php
}
?>
</fieldset>

<fieldset class="subtleSet">
<h3>Edit artist's categories</h3>

<?php
	$sqlart = "SELECT id, name FROM artists";
	foreach ($dbh->query($sqlart) as $art){
		 echo "<form method='post' action='dbprocessartists.php'>
		 		<label name='artname' id='artname' value='artname'>$art[name]</label>
				<input type='hidden' name='artid' id='artid' value='$art[id]'>
				";
	  $sql = "SELECT * FROM categories";
	  foreach ($dbh->query($sql) as $cat) {
		 
		  echo "<input type='checkbox' name='category[]' id='category' value='$cat[catname]'";
		  
		  $sqlac = "SELECT * FROM art_cat";
		  foreach ($dbh->query($sqlac) as $ac) {
			  if ($art['id'] == $ac['artid'] && $cat['id'] == $ac['catid']){
				  echo "checked";
			  }
		  }
		  echo ">$cat[catname]";
	  }
	 
	  echo"<input type='submit' name='submit' value='Update artist categories'><br><br>";
	  ?>
      
</form>
<?php
	}
?>
</fieldset>
<!--------------------------- CURRENT ARTIST  ------------------------------>

<fieldset class="subtleSet">
<h2>Current Artists:</h2>
<blockquote>
  <p>
    <input type="text" value="Name" class="description"/> <input type="text" value="Image" class="description"/> 
    <input type="text" value="Email" class="description"/> <input type="text" value="Website" class="description"/>
    <input type="text" value="Phone" class="description"/> <input type="text" value="About" class="description"/>
    <?php
// Display what's in the database at the moment.
$sql = "SELECT * FROM artists";
foreach ($dbh->query($sql) as $row)
{
?>
    
  </p>
</blockquote>
<form id="deleteForm" name="deleteForm" method="post" action="dbprocessartists.php">
  <?php
	 
	echo "<input type='text' name='name' value='$row[name]' /> <input type='text' name='image' value='$row[image]' />
	<input type='text' name='email' value='$row[email]' /> <input type='text' name='facebook' value='$row[facebook]' /> 
	<input type='text' name='phone' value='$row[phone]' /> 
	<input type='text' name='about' value='$row[about]' />\n";
	echo "<input type='hidden' name='id' value='$row[id]' />";
?>
  <input type="submit" name="submit" value="Update Entry">
  <input type="submit" name="submit" value="Delete Entry" class="deleteButton">
  <input type="submit" name="submit" value="X" class="deleteButton">
</form>
<?php
}
echo "</fieldset>

		</div>
		</div>\n";
// close the database connection
}
$dbh = null;
?>
</body>
</html>