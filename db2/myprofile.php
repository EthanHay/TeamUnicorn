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
<title>TCMC - My Profile</title>
<link href="sitestyles.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
include("header.php");
?>
<div class="site_outside">
<div class="site">
<?php

echo '<h2>My details</h2>';
echo '<pre>' . print_r($_SESSION) . '</pre>';

if($_GET['status']=='updated'){
	echo 'your information was updated';
}
elseif($_GET['status']=='notupdated'){
	echo 'your information was not updated';
}
elseif($_GET['signup']=='success') {
	echo 'you were successfully signed up';
}

$sql = "SELECT * FROM members WHERE id = '$_SESSION[id]' LIMIT 1";
foreach ($dbh->query($sql) as $det) {
echo "
<form id='register' name='register' method='post' action='signupprocess.php'>
<fieldset class='subtleSet'>
	<p>
	<label class='label' for='firstname'>First Name</label>
    <input type='text' name='firstname' id='firstname' value='$det[firstname]' required>
    </p>
    <p>
    <label class='label' for='surname'>Surname</label>
    <input type='text' name='surname' id='surname' value='$det[surname]' required>
    </p>
    <p>
    <label class='label' for='address'>Address</label>
    <input type='text' name='address' value=$det[address] id='address' required>
    </p>
    <p>
    <label class='label' for='postcode'>Post code</label>
    <input type='text' name='postcode' value=$det[postcode] id='postcode' pattern='.{4,4}' required title='4 characters needed' size='4'><br>
    </p>
    <p>
    <label class='label' for='suburb'>Suburb</label>
    <input type='text' name='suburb' id='suburb' value=$det[suburb]  required>
    </p>
    <p>
    <label class='label' for='state'>State</label>
    <select name='state' id='state'><option ";if ($det['state'] == ACT){ echo "selected";}echo">ACT</option>
	<option ";if ($det['state'] == NSW) {echo "selected";}echo">NSW</option><option ";if ($det['state'] == NT){echo "selected";}echo">NT</option>
	<option ";if ($det['state'] == Qld) {echo "selected";}echo">Qld</option><option ";if ($det['state'] == SA) {echo "selected";}echo">SA</option>
	<option ";if ($det['state'] == Tas) {echo "selected";}echo">Tas</option><option ";if ($det['state'] == Vic) {echo "selected";}echo">Vic</option>
	<option ";if ($det['state'] == WA) {echo "selected";}echo">WA</option></select>
	
	</p>
    <p>
    <label class='label' for='phoneday'>Phone Day</label>
    <input type='text' pattern='.{10,10}' required title='please check the phone number. No country code needed'
    name='phoneday' id='phoneday' value=$det[phoneday] >
    </p>
    <p>
    <label class='label' for='phoneeve'>Phone Evening</label>
    <input type='text' name='phoneeve' id='phoneeve' value=$det[phoneeve]  >
    </p>
    <p>
    <label class='label' for='email'>Email</label>
    <input type='email' name='email' id='email' value=$det[email] required>
    </p>   
    <p>
    <input type='submit' name='submit' id='submit' value='Update info'>
    </p>
    </fieldset>
</form>
	";
	
}
echo "<h2>My bulletin board notices</h2>";
	
	$sqlbul = "SELECT memid, bulid FROM mem_bul";
	
	foreach ($dbh->query($sqlbul) as $bul){
		if ($_SESSION['id'] == $bul['memid']){
			echo"<form id='deleteForm' name='deleteForm' method='post' action='dbprocessbulletin.php'>";
		
		$sqlart = "SELECT * FROM bulletin WHERE id = '$bul[bulid]' LIMIT 1"; 
		foreach ($dbh->query($sqlart) as $row) {	
	 		if ($bul['bulid'] == $row['id']){
				echo"<input type='text' name='title' value='$row[title]' /> 
				<input type='text' name='description' value='$row[description]' />
				<input type='text' name='image' value='$row[image]' /> 
				<input type='text' name='type' value='$row[type]' /> 
				<input type='text' name='contact1' value='$row[contact1]' /> 
				<input type='text' name='contact2' value='$row[contact2]' />
				<input type='text' name='expirydate' value='$row[expirydate]' />\n";
				echo "<input type='hidden' name='id' value='$row[id]' />";
			
				?>
				  <input type="submit" name="submit" value="Update Notice">
				  <input type="submit" name="submit" value="Delete Notice" class="deleteButton">
				  
				</form>
           <?php  
			}
		}
	}
	
	}


if ($_SESSION['status'] == 'paid' OR 	$_SESSION['status'] == 'admin'){
	
	echo "<h2>My artists</h2>";
	
	$sqlmem = "SELECT memid, artid FROM mem_art";
	
	foreach ($dbh->query($sqlmem) as $mem){
		if ($_SESSION['id'] == $mem['memid']){
			echo"<form id='deleteForm' name='deleteForm' method='post' action='dbprocessartists.php'>";
		
		$sqlart = "SELECT * FROM artists WHERE id = '$mem[artid]' LIMIT 1"; 
		foreach ($dbh->query($sqlart) as $row) {	
	 		if ($mem['artid'] == $row['id']){
				echo"<input type='text' name='name' value='$row[name]' /> <input type='text' name='image' value='$row[image]' />
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
		}
	}
	
	}
}
	
	if ($_SESSION['status'] == "paid" OR $_SESSION['status']=="admin")
		echo'<a href="addartist.php">Add/edit Artists</a> <br>';
		
	if($_SESSION['status']=="admin")
	{
		echo'
			<a href="addmember.php">Add/edit Members</a> <br>
			<a href="addevent.php">Add/edit Events</a> <br>
			';
	}
	
?>

<!--<a href="addartist.php">Edit artists</a><br>
<a href="addmember.php">Edit members</a>-->
</div>
</div>
<?php
include("footer.html")
?>
</body>
</html>