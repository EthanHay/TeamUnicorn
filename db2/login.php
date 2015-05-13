<?php session_start();
error_reporting(E_ALL);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<h1>Login Page</h1>
<?php 
// Only display the login form if the user is not logged in
if (!isset($_SESSION['username'])) 
?>
<form id="login" name="login" method="post" action="addartist.php">
  <label for="username">Username:</label>
  <input type="text" name="username" id="username">
  <br>
    <label for="password">Password:</label>
  <input type="password" name="password" id="password">
  <br>
    <input type="submit" name="submit" value="Login">
</form>
</body>
</html>