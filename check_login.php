<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Đọc dữ liệu từ tệp JSON hiện tại
    $jsonData = file_get_contents('/var/www/html/web/data.json');
    $dataArray = json_decode($jsonData, true);
    $current_password = $dataArray['account_information']['password'];

    // Kiểm tra đăng nhập
    if ($username === "admin" && $password === $current_password) {
        // Đọc dữ liệu từ tệp JSON hiện tại
        $jsonFileName = '/var/www/html/webd/ata.json';
        $jsonData = file_exists($jsonFileName) ? json_decode(file_get_contents($jsonFileName), true) : array();

        $jsonData['account_information']['username'] = $username;
        $jsonData['account_information']['password'] = $password;

        $json_data = json_encode($jsonData, JSON_PRETTY_PRINT);
        file_put_contents($jsonFileName, $json_data);

        $successMessage = "Login successful!";
        header("Location: home.php?login=success&message=" . urlencode($successMessage));
        exit();
    } else {
        $errorMessage = "Login failed";
        header("Location: index.php?login=failed&message=" . urlencode($errorMessage));
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
