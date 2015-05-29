<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>TCMC - Sign up</title>
<link href="sitestyles.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="images/icon.png">
</head>

<body>
<?php
include("header.php");
?>
<div class="site_outside">
<div class="site">
<h1>Join us!</h1>
<p>There are several ways to be an active member of Townsville Community Music Centre: </p>
<h2>As an artist</h2> <p> If you have a band or group, or even a solo act, you can advertise 
your events on our page, and let us organise your concerts, promotion, photo shoots and media releases.</p> 

<h2>As a volunteer</h2> <p> Wee need people to help us out by volunteering, which includes working with administration, 
organising events or promoting concerts and workshops.</p> 

<h2>As a paying member</h2> <p>Being a paying member only costs $25 each year, and you get benefits like ticket discounts
at the Townsville Civic Theatre, the possibility
of posting notices to the bulletin board and promoting artists for free.<br> 
To become a member of Townsville Community Music Centre, please fill out the form below. Free members can add notices to 
our bulletin board for free. To become a paying member, follow the 
link to PayPal and subscribe to a yearly fee of $25. An admin will upgrade your account as soon as possible. </p>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="YZR8VZ66B4EJQ">
<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

<p>We also welcome donations of any size</p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="HBGY945FW8D9Q">
<input type="image" src="https://www.paypalobjects.com/en_US/NO/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>


<div id="leftform">
<form id="register" name="register" method="post" action="signupprocess.php">
<fieldset class="subtleSet">
	<h2>Sign up</h2>
<?php if($_GET['result']=='updated'){
	echo 'your information was updated';
}
elseif($_GET['result']=='notupdated'){
	echo 'your information was not updated';
}
elseif($_GET['signup']=='success') {
	echo 'you were successfully signed up';
}
?>
	<p class="smalltext"><span class="req">*</span> = required field</p>
	<p>
	<label class="label" for="firstname">First Name <span class="req">*</span></label>
    <input type="text" name="firstname" id="firstname" required>
    </p>
    <p>
    <label class="label" for="surname">Surname <span class="req">*</span></label>
    <input type="text" name="surname" id="surname" required>
    </p>
    <p>
    <label class="label" for="address">Address <span class="req">*</span></label>
    <input type="text" name="address" id="address" required>
    </p>
    <p>
    <label class="label" for="postcode">Post code <span class="req">*</span></label>
    <input type="text" name="postcode" id="postcode" pattern=".{4,4}" required title="4 characters needed" size="4"><br>
    </p>
    <p>
    <label class="label" for="suburb">Suburb <span class="req">*</span></label>
    <input type="text" name="suburb" id="suburb" required>
    </p>
    <p>
    <label class="label" for="state">State <span class="req">*</span></label>
    <select name="state" id="state"><option>ACT</option><option>NSW</option><option>NT</option><option selected>Qld</option><option>SA</option><option>Tas
    </option><option>Vic</option><option>WA</option></select>
	</p>
    <p>
    <label class="label" for="phoneday">Phone Day <span class="req">*</span></label>
    <input type="text" pattern=".{10,10}" required title="please check the phone number. No country code needed"
    name="phoneday" id="phoneday" >
    </p>
    <p>
    <label class="label" for="phoneeve">Phone Evening</label>
    <input type="text" name="phoneeve" id="phoneeve" >
    </p>
    <p>
    <label class="label" for="email">Email (username) <span class="req">*</span></label>
    <input type="email" name="email" id="email" required>
    </p>
    <p>
    <label class="label" for="password">Password <span class="req">*</span></label>
    <input type="password" name="password" id="password" pattern=".{6,}" required title="Please make sure your password has more than 6 characters">
    </p>
    <p>
    <input type="submit" name="submit" id="submit" value="Become a member">
    </p>
    </fieldset>
</form>
</div>

</div>
</div>    
<?php
include("footer.html");
?>    
</body>
</html>