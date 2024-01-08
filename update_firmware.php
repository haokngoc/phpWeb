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
    <p><Strong>Select Firmware Image</Strong></p>
    <p>The Update Firmware function is used to update the receptor firmware. To prevent an upload </p>
    <p> failure, a fully charge battery should be used. This update will perform  two  funcions</p>
    <br>
    <p>1. Update the receptor firmware</p>
    <p>2. Reboot the receptor after the update is complete</p>
    
    <p>During this process, the battery should not be removed!</p>
    <p>An update message will display after the firmware update is complete. Do not navigate away from</p>
    <p>this page or issu any other commands to the receptor during this process</p>
    <br>
    <p>Do you wish to continue</p>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="fileToUpload">Choose a file:</label>
        <input type="file" name="fileToUpload" id="fileToUpload" required>
        <button type="submit" name="submit">Upload Firmware</button>
    </form>
</div>
</body>
</html>
