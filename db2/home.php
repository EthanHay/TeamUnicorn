<?php session_start(); // this should be the very first statement when using sessions
// Report all PHP errors 
error_reporting(E_ALL);
/*	This file is a login page that will send the user to a secure page.
	There's a session 'msg' variable, which will be blank the first time (when not set).
*/
 ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Towsville Community Music Centre</title>
<link href="sitestyles.css" rel="stylesheet">
<link rel="shortcut icon" href="images/icon.png">
</head>
    
<body>
<?php
include("header.php");
?>
<div class="site_outside">
    <div class="site group"> 
        
        <div id="slideshow">
            <a href="signup.php"><img src="images/signup.jpg" alt="Slideshow1"></a>
        </div>
        
        
        <div id="thumbnails">
            <div id="thumbnail-one">
				<a href="currentartists.php">
                <img src="images/TCMC_Images/musos/Harbourside_small.jpg" alt="bandName" class="image">
                    <div class="img-footer">
                        
						<h3>Artists</h3>
						<p>Want to keep up to date with our latest artists?</p>
                        <p>Click here to check out our featured artists.</p>
						
                    </div>    
				</a>		
            </div>
            <div id="thumbnail-two">
				<a href="signup.php">
                <img src="images/TCMC_Images/musos/Poms_small2.jpg" alt="Organ" class="image">
                    <div class="img-footer">
                   		<h3>Volunteers</h3>
                        <p>Volunteering is a great way to get involved with our local music community.</p>
						<strong><p>Sign up here today!</p></strong>
                    </div>
				</a>
            </div>
            <div id="thumbnail-three">
				<a href="events.php">
                <img src="images/TCMC_Images/bulletin/TCBlogo201.jpg" alt="bandName" class="image">
                    <div class="img-footer">
                    	<h3>Events</h3>	
                        <p>Make sure you purchase your tickets for our upcoming events.</p>
						<p>Click here to view our upcoming events.</p>
                    </div>
				</a>		
            </div>
        
        </div>
        
        
    </div>   
</div>    

<?php
include("footer.html");
?>   

</body>
</html>