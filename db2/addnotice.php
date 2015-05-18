<?php
include("dbconnect.php")
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Bulletin</title>
<link href="sitestyles.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php 
include("header.html");
?>

<div class="site_outside">
<div class="site">
<h1>Bulletin Database</h1>
<form id="insert" name="insert" method="post" action="dbprocessbulletin.php" enctype="multipart/form-data">
<fieldset class="subtleSet">
    <h2>Insert New Notice:</h2>
    <p>
      <label class="label" for="title">Title: </label>
      <input type="text" name="title" id="title">
    </p>
    <p>
      <label class="label"  for="description">Description: </label>
      <input type="text" name="description" id="description">
    </p>
    <p>
      <label class="label" for="image">Image: </label> <!--jpeg and less than 2MB, change/let them know? -->
      <input type="file" name="imagefile"  id="imagefile">
    </p>
    <p>
      <label class="label"  for="type">Type: </label>
      <select name="type" id="type"><option>Buy/sell</option><option>Announcement</option>
      <option>Lesson</option><option>Other</option></select>
    </p>
    <p>
      <label class="label"  for="contact1">Contact option 1: </label>
      <input type="text" name="contact1" id="cpntact1">
    </p>
     <p>
      <label class="label"  for="contact2">Contact option 2: </label>
      <input type="text" name="contact2" id="contact2">
    </p>
    <p>
      <input type="submit" name="submit" id="submit" value="Insert Entry">
    </p>
</fieldset>
</form>
</div>
</div>
<?php 
include("footer.html");
?>
</body>
</html>