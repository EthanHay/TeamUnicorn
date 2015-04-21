<?php
include("dbconnect.php")
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Artists</title>
<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Artist Database</h1>
<form id="insert" name="insert" method="post" action="dbprocessartists.php">
<fieldset class="subtleSet">
    <h2>Insert New Artist:</h2>
    <p>
      <label class="label" for="name">Artist Name: </label>
      <input type="text" name="name" id="name">
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
      <label class="label"  for="genre">Main Genre: </label>
      <input type="text" name="genre" id="genre">
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

<fieldset class="subtleSet">
<h2>Current Artists:</h2>
<input type="text" value="Name" class="description"/> <input type="text" value="Email" class="description"/> <input type="text" value="Facebook" class="description"/>
<input type="text" value="Genre" class="description"/> <input type="text" value="Phone" class="description"/> <input type="text" value="About" class="description"/>
<?php
// Display what's in the database at the moment.
$sql = "SELECT * FROM artists";
foreach ($dbh->query($sql) as $row)
{
?>

<form id="deleteForm" name="deleteForm" method="post" action="dbprocessartists.php">
<?php
	 
	echo "<input type='text' name='name' value='$row[name]' /> <input type='text' name='email' value='$row[email]' />
	<input type='text' name='facebook' value='$row[facebook]' /> <input type='text' name='phone' value='$row[phone]' /> 
	<input type='text' name='genre' value='$row[genre]' /> <input type='text' name='about' value='$row[about]' />\n";
	echo "<input type='hidden' name='id' value='$row[id]' />";
?>
<input type="submit" name="submit" value="Update Entry" />
<input type="submit" name="submit" value="Delete Entry" class="deleteButton">
<input type="submit" name="submit" value="X" class="deleteButton">
</form>
<?php
}
echo "</fieldset>\n";
// close the database connection
$dbh = null;
?>
</body>
</html>