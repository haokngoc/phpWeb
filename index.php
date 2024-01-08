<!DOCTYPE html>
<html>
<head>
    <title>Authentication Required</title>
    <link rel="icon" href="logo.jpg" type="image">
</head>
<body>

<h1>Authentication Required</h1>
<p>The server http://192.168.2.50:80 requires a username and password.</p>

<form action="check_login.php" method="post">
    <label for="username">User Name:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="text" id="password" name="password" required>
    <br>
    <input type="submit" value="Log In">
    <input type="button" value="Cancel" onclick="location.href='index.php';">
</form>

</body>
</html>