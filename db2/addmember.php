<?php
include("authenticate.php");
include("dbconnect.php");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>TCMC Add/edit Members</title>
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
<h1>Member Database</h1>
<?php
if ($_SESSION['status'] == 'free' OR $_SESSION['status'] == 'paid' )
	echo "You do not yet have permission to edit members. You need to be an admin. If you believe you should
	be an admin, please <a href='contact.php'>contact</a> TCMC";

else {

if($_GET['result']=='updated'){
	echo 'the member was updated';
}
elseif($_GET['result']=='notupdated'){
	echo 'the member was not updated';
}
elseif($_GET['result']=='deleted'){
	echo 'the member was deleted';
}
elseif($_GET['result']=='notdeleted'){
	echo 'the member was not deleted';
}
?>


<fieldset class="subtleSet">
<h2>Current Members:</h2>
<blockquote>
  <p>
    <input type="text" value="First name" class="description"/> <input type="text" value="Last name" class="description"/> 
    <input type="text" value="Address" class="description"/> <input type="text" value="Postcode" class="description"/>
    <input type="text" value="Suburb" class="description"/> <input type="text" value="State" class="description"/> 
    <input type="text" value="Phone Day" class="description"/>
      <input type="text" value="Phone Eve" class="description"/> <input type="text" value="Email" class="description"/> 
    <input type="text" value="Status" class="description"/> 
    <?php
// Display what's in the database at the moment.
$sql = "SELECT * FROM members";
foreach ($dbh->query($sql) as $row)
{
?>
    
  </p>
</blockquote>
<form id="deleteForm" name="deleteForm" method="post" action="dbprocessmember.php">
  <?php
	 
	echo "<input type='text' name='firstname' value='$row[firstname]' /> <input type='text' name='surname' value='$row[surname]' />
	<input type='text' name='address' value='$row[address]' /> <input type='text' name='postcode' value='$row[postcode]' /> 
	<input type='text' name='suburb' value='$row[suburb]' /> <input type='text' name='state' value='$row[state]' /> 
	<input type='text' name='phoneday' value='$row[phoneday]' /> <input type='text' name='phoneeve' value='$row[phoneeve]' />
	<input type='text' name='email' value='$row[email]' />
	<input type='text' name='status' value='$row[status]' />\n";
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
		</div>
		\n";
// close the database connection
}
$dbh = null;
include("footer.html");
?>
</body>
</html>