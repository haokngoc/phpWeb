<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download File Example</title>
    <link rel="stylesheet" href="main.css">
    <link rel="icon" href="logo.jpg" type="image">
    <style>
        a.download-link {
            display: block;
            width: 200px;
            padding: 10px;
            color: #fff;
            background-color: #3498db;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        a.download-link:hover {
            background-color: #2980b9;
        }

    </style>
</head>
<body>
    <?php include('navigation.php'); ?>
    <?php
        $downloadPage = 'download.php';
        $filePath = '/home/hk/eclipse-workspace/01_IMX8_Server_x86/logfile.1.txt';
    ?>
    <h1>Download file log</h1>
    <a class="download-link" href="<?php echo $downloadPage . '?path=' . urlencode($filePath); ?>">Download File</a>
</body>
</html>
