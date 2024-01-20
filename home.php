<?php
if (isset($_GET['login']) && $_GET['login'] === 'success') {
    $successMessage = "Login successful!";
} else {
    $successMessage = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="main.css">
    <link rel="icon" href="logo.jpg" type="image">
    <style>
        .notification {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #4CAF50;
            color: #fff;
            padding: 15px;
            border-radius: 5px;
            display: none;
            z-index: 1000; /* Đảm bảo nó hiển thị trên cùng */
        }
    </style>
</head>
<body>

<?php include('navigation.php'); ?>
<div id="notification" class="notification"></div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Lấy thông báo từ tham số URL
        var urlParams = new URLSearchParams(window.location.search);
        var message = urlParams.get('message');

        // Hiển thị thông báo nếu có
        if (message) {
            var notificationElement = document.getElementById('notification');
            notificationElement.innerText = message;
            notificationElement.style.display = 'block';
            setTimeout(function () {
                notificationElement.style.display = 'none';
            }, 3000);
        }
    });
</script>

</body>
</html>
