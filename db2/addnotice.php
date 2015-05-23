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
include("header.php");
?>

<div class="site_outside">
<div class="site">
<h1>Bulletin Database</h1>
<?php
if($_GET['result']=='notsubmitted'){
	echo '<p class="notsubmitted">Your notice was not submitted </p>';
}
?>
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
    <label class="label">Expiry date:</label>
    
    <select name="exday" id="exday"><option>01</option><option>02</option><option>03</option>
    <option>04</option><option>05</option><option>06</option><option>07</option>
    <option>08</option><option>09</option><option>10</option><option>11</option>
    <option>12</option><option>13</option><option>14</option><option>15</option>
    <option>16</option><option>17</option><option>18</option><option>19</option>
    <option>20</option><option>21</option><option>22</option><option>23</option>
    <option>24</option><option>25</option><option>26</option><option>27</option>
    <option>28</option><option>29</option><option>30</option><option>31</option></select>
    <select name="exmonth" id="exmonth"><option>01</option><option>02</option><option>03</option><option>04</option>
    <option>05</option><option>06</option><option>07</option><option>08</option><option>09</option><option>10</option>
    <option>11</option><option>12</option></select>
    <select name="exyear" id="exyear"><option>2015</option><option>2016</option><option>2017</option>
    </select>
    </p>
    <!--<p>
      <label class="label"  for="expirydate">Expiration date (yyyy-mm-dd): </label>
      <input type="text" name="expirydate" id="expirydate">
    </p>-->
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