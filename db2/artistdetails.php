<?php
include("dbconnect.php")
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>
TCMC - 
<?php 
$artist_id = $_GET['id'];
$sql = "SELECT name FROM artists WHERE id=$artist_id";
foreach ($dbh->query($sql) as $row) {
echo "$row[name]"; 
}
?>
</title>
<link href="artiststyle.css" rel="stylesheet">
</head>

<body>
<header class="site-header group">
<!--- NAV BAR ---> 
<div id="navigation-outer">    
    <nav id="navigation-bar">   
        <a href="Home.html"><img src="images/TCMC_Images/Site/TCMC150100.jpg"></a>
        <ul id="site-navigation">
           <li> 
                <a href="Home.html">Home</a>    
            </li> 
            <li> 
                <a href="Forum.html">Bulletin</a>    
            </li> 
            <li> 
                <a href="Events.html">Events</a>    
            </li>
            <li> 
                <a href="Artists.html">Artists</a>    
            </li>
            <li> 
                <a href="About.html">About</a>    
            </li>
            <li> 
                <a href="Join.html">Join Us</a>    
            </li>
            <li> 
                <a href="Contact.html">Contact</a>    
            </li> 
            <li> 
                <a href="Members.html">Members</a>    
            </li>  
            <li> 
                <a href="Login.html" class="1">Login</a>    
            </li>  
        </ul>
    </nav>
</div>
    
</header>
<div class="site_outside">
	<div class="site group">
	<?php
    // display selected artist.
    $artist_id = $_GET['id'];
    $sql = "SELECT name, image, about, genre, facebook, email, phone FROM artists WHERE id=$artist_id";
    foreach ($dbh->query($sql) as $row)
    {
    echo "<div class='top'><div class='leftside'><h1>$row[name]</h1>";
	echo "<p>$row[about]</p><br></div>";
	
    echo "<div class='rightside'><img src=/~tcmc21/db$row[image] width=100% height=100%><br>";
    echo "Genre: $row[genre]</p></div></div>";
    
    echo "<div class='bottom'><P>Website link: <a href='$row[facebook]'>$row[name] - $row[genre]</a></p>";
    echo "<P>Email: $row[email]</p>";
    echo "<p>Phone: $row[phone]</p></div>";
    }
    ?>
    </div>
</div>
<!--- FOOTER --->     
<div class="footer-outer group">
    <footer class="site-footer">
        <div class="footer-nav">
            <ul id="footer-navigation">
                <li> 
                <a href="Home.html">Home</a>    
            </li> 
            <li> 
                <a href="Forum.html">Bulletin</a>    
            </li> 
            <li> 
                <a href="Events.html">Events</a>    
            </li>
            <li> 
                <a href="Artists.html">Artists</a>    
            </li>
            <li> 
                <a href="About.html">About</a>    
            </li>
            <li> 
                <a href="Join.html">Join Us</a>    
            </li>
            <li> 
                <a href="Contact.html">Contact</a>    
            </li> 
            <li> 
                <a href="Members.html">Members</a>    
            </li>  
            <li> 
                <a href="Login.html" class="1">Login</a>    
            </li>   
            </ul>        
        </div>
        
        <div class="footer-contact">
            <p>Contact Info:</p>
            <p> Phone:07 4724 2086 Mobile: 04 0225 5182</p> <p>Address: Townsville Civic Theatre, 41 Boundary Street, Townsville, Qld 4810</p> <a href="mailto:admin@townsvillemusic.org.au"                   target="_top">admin@townsvillemusic.org.au</a>
        </div>
        
        <div class="Logo">
          <img src="images/TCMC_Images/Site/TCC83100.png" alt="Townsville City Logo">
          <img src="images/TCMC_Images/Site/Qldlogo150169.jpg" alt="Queensland Logo">
        
        </div>

</footer>  
</body>
</html>