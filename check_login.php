<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $jsonData = file_get_contents('/var/www/html/web/data.json');
    $dataArray = json_decode($jsonData, true);
    $current_password = $dataArray['account_information']['password'];
    if ($username === "admin" && $password === $current_password) {
        // Đọc dữ liệu từ tệp JSON hiện tại (neu co)
        $jsonFileName = '/var/www/html/webd/ata.json';
        $jsonData = file_exists($jsonFileName) ? json_decode(file_get_contents($jsonFileName), true) : array();

        // Thêm thông tin mới vào mảng dữ liệu
        $jsonData['account_information']['username'] = $username;
        $jsonData['account_information']['password'] = $password;

        // Chuyển đổi mảng thành định dạng JSON và luu vao tep
        $json_data = json_encode($jsonData, JSON_PRETTY_PRINT);
        file_put_contents($jsonFileName, $json_data);

        header("Location: home.php");
        exit();
    } else {
        header("Location: authentication_failed.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
