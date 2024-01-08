<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="main.css">
    <link rel="icon" href="logo.jpg" type="image">
</head>
<body>
<?php include('navigation.php'); ?>
<div class="container">
    <p><strong>Change Password</strong></p>
    <form action="save_data_changepw.php" method="post">
        <label for="new_password">New Password</label>
        <input type="text" id="new_password" name="new_password">
        <br>
        <label for="confirm_new_pasword">Confirm New Password</label>
        <input type="text" id="confirm_new_pasword" name="confirm_new_pasword">
        <br>
        <button type="submit" name="update-button">Change</button>
    </form>
</div>
</body>
</html>
