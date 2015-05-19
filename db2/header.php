<?php session_start(); // this should be the very first statement when using sessions
// Report all PHP errors 
error_reporting(E_ALL);
/*	This file is a login page that will send the user to a secure page.
	There's a session 'msg' variable, which will be blank the first time (when not set).
*/
 ?>
<header class="site-header group">
<!--- NAV BAR ---> 
<div id="navigation-outer">
	<div class="login">
		<?php
		// Only display the login form if the user is not logged in
		if (!isset($_SESSION['email']))
		?>
			
			<form id="login" name="login" method="post" action="myprofile.php">
			<fieldset>
			<legend>Login</legend>
			<label for="email">Email:</label>
			<input type="email" name="email" id="email">
			<br>
			<label for="password">Password:</label>
			<input type="password" name="password" id="password">
			
			
			<br>
			<input type="submit" name="submit" value="Login" id="submitBTN">
			</form>
		<?php 
		if (isset($_SESSION['email'])) echo '<a href="logout.php">Logout</a>';
		?>
	</div>
    <nav id="navigation-bar">   
        <a href="home.php"><img src="images/TCMC_Images/Site/TCMC150100.jpg"></a>
        <ul id="site-navigation">
            <li> 
                <a href="bulletin.php">Bulletin</a>    
            </li> 
            <li> 
                <a href="events.php">Events</a>    
            </li>
            <li> 
                <a href="currentartists.php">Artists</a>    
            </li>
            <li> 
                <a href="about.php">About</a>    
            </li>
            <li> 
                <a href="signup.php">Join Us</a>    
            </li>
            <li> 
                <a href="contact.php">Contact</a>    
            </li> 
            <!--<li> 
                <a href="members.php">Members</a>    
            </li>  
            <li> 
                <a href="login.php" class="1">Login</a>    
            </li>  -->
        </ul>
    </nav>
	
</div>
    
</header>
