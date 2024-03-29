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
            top: 10px;
            right: 10px;
            background-color: #4CAF50;
            color: #fff;
            padding: 15px;
            border-radius: 5px;
            display: none;
        }
    </style>
</head>
<body>
    <?php include('navigation.php'); ?>
    <div class="container">
        <p><strong>Change Password</strong></p>
        <form action="save_data_changepw.php" method="post">
            <label for="new_password">New Password</label>
            <input type="text" id="new_password" name="new_password">
            <br>
            <label for="confirm_new_password">Confirm New Password</label>
            <input type="text" id="confirm_new_password" name="confirm_new_password">
            <br>
            <button type="submit" name="update-button">Change</button>
        </form>
    </div>
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
