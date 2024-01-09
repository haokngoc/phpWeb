<!DOCTYPE html>
<html>
<head>
    <title>Authentication Required</title>
    <link rel="icon" href="logo.jpg" type="image">
    <style>
        .notification {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #4CAF50;
            color: red;
            padding: 15px;
            border-radius: 5px;
            display: none;
        }
    </style>
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
                }, 5000);
            }
        });
    </script>
</body>
</html>