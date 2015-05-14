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
<h1>Member Database</h1>
<?php
if($_GET['result']=='submitted'){
	echo 'the member was submitted';
}
elseif($_GET['result']=='notsubmitted'){
	echo 'the member was not submitted';
}
elseif($_GET['result']=='updated'){
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


<form id="insert" name="insert" method="post" action="dbprocessmember.php" enctype="multipart/form-data">
<fieldset class="subtleSet">
	<h2>Enter new member</h2>
	<p>
	<label class="label" for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname" required>
    </p>
    <p>
    <label class="label" for="surname">Surname</label>
    <input type="text" name="surname" id="surname" required>
    </p>
    <p>
    <label class="label" for="address">Address</label>
    <input type="text" name="address" id="address" required>
    </p>
    <p>
    <label class="label" for="postcode">Post code</label>
    <input type="text" name="postcode" id="postcode" pattern=".{4,4}" required title="4 characters needed" size="4"><br>
    </p>
    <p>
    <label class="label" for="suburb">Suburb</label>
    <input type="text" name="suburb" id="suburb" required>
    </p>
    <p>
    <label class="label" for="state">State</label>
    <select name="state" id="state"><option>ACT</option><option>NSW</option><option>NT</option><option selected>Qld</option><option>SA</option><option>Tas
    </option><option>Vic</option><option>WA</option></select>
	</p>
    <p>
    <label class="label" for="phoneday">Phone Day</label>
    <input type="text" pattern=".{10,10}" required title="please check the phone number. No country code needed"
    name="phoneday" id="phoneday" >
    </p>
    <p>
    <label class="label" for="phoneeve">Phone Evening</label>
    <input type="text" name="phoneeve" id="phoneeve" >
    </p>
    <p>
    <label class="label" for="email">Email</label>
    <input type="email" name="email" id="email" required>
    </p>
    <p>
    <label class="label" for="username">Username</label>
    <input type="text" name="username" id="username" required>
    </p>
    <p>
    <label class="label" for="password">Password</label>
    <input type="text" name="password" id="password" pattern=".{6,}" required title="Please make sure your password has more than 6 characters">
    </p>
    <p>
    <label class="label" for="status">Status</label>
    <select name="status" id="status"><option>free</option><option selected>paid</option><option>admin</option></select>
    </p>    
    <p>
    <input type="submit" name="submit" id="submit" value="Submit new member">
    </p>
    </fieldset>
    </form>

<fieldset class="subtleSet">
<h2>Current Member:</h2>
<blockquote>
  <p>
    <input type="text" value="First name" class="description"/> <input type="text" value="Image" class="description"/> 
    <input type="text" value="Email" class="description"/> <input type="text" value="Facebook" class="description"/>
    <input type="text" value="Genre" class="description"/> <input type="text" value="Phone" class="description"/> 
    <input type="text" value="About" class="description"/>
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
	<input type='text' name='email' value='$row[email]' /><input type='text' name='username' value='$row[username]' />
	<input type='text' name='password' value='$row[password]' /><input type='text' name='status' value='$row[status]' />\n";
	echo "<input type='hidden' name='id' value='$row[id]' />";
?>
  <input type="submit" name="submit" value="Update Entry">
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