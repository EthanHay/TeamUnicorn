<?php
include("dbconnect.php")
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
include("header.html")
?>
<div class="site_outside">
<div class="site">
<?php


  $sql = "SELECT (firstname, surname, address, postcode, suburb, state, phoneday, phoneeve, email, username, password)
  FROM members WHERE email == '$_SESSION[email]' ";
echo '
<form id="register" name="register" method="post" action="signupprocess.php">
<fieldset class="subtleSet">
	<h2>My details</h2>
	<p>
	<label class="label" for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname" value="$_SESSION[firstname] required>
    </p>
    <p>
    <label class="label" for="surname">Surname</label>
    <input type="text" name="surname" id="surname" required>
    </p>
    <p>
    <label class="label" for="street">Address</label>
    <input type="text" name="street" id="street" required>
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
    <label class="label" for="password">Password</label>
    <input type="password" name="password" id="password" pattern=".{6,}" required title="Please make sure your password has more than 6 characters">
    </p>
    <p>
    <label class="label" for="repassword">Retype password</label>
    <input type="password" name="repassword" id="repassword" >
    </p>    
    <p>
    <input type="submit" name="submit" id="submit" value="Edit info">
    </p>
    </fieldset>
</form>
	';
	
	if($_REQUEST['type']=="admin")
	{
		echo'
			<a href="addartist.php">Add/edit Artists</a> <br>
			<a href="addmember.php">Add/edit Members</a> <br>
			<a href="addevent.php">Add/edit Events</a> <br>
			';
	}
	
?>
</div>
</div>
<?php
include("footer.html")
?>
</body>
</html>