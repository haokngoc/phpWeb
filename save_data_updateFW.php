<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $udfirmware = $_POST["firmware"];

    try {
        // Đọc dữ liệu từ tệp JSON hiện tại (nếu có)
        $jsonFileName = 'data.json';
        $jsonData = file_exists($jsonFileName) ? json_decode(file_get_contents($jsonFileName), true) : array();

        // Thêm thông tin mới vào mảng dữ liệu
        $jsonData['firmware']['firmware'] = $udfirmware;

        // Chuyển đổi mảng thành định dạng JSON và lưu vào tệp
        $json_data = json_encode($jsonData, JSON_PRETTY_PRINT);
        file_put_contents($jsonFileName, $json_data);

        // Gửi dữ liệu đến server
        $serverHost = 'localhost';  // Đổi thành địa chỉ IP hoặc tên miền của server
        $serverPort = 12345;

        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if (!$socket) {
            throw new Exception("Failed to create socket");
        }

        $result = socket_connect($socket, $serverHost, $serverPort);
        if (!$result) {
            throw new Exception("Failed to connect to server");
        }

        $message = json_encode($jsonData); // Chuyển đổi dữ liệu thành chuỗi JSON
        socket_write($socket, $message, strlen($message));
        socket_close($socket);

        header("Location: firmware.php");
        exit();
    } catch (Exception $e) {
        // Xử lý exception, in thông báo lỗi, ghi log, hoặc chuyển hướng đến trang lỗi
        echo "Error: " . $e->getMessage();
        // Ghi log vào file hoặc hệ thống log của bạn
        error_log("Error: " . $e->getMessage(), 3, "error_log.txt");
        // Hoặc chuyển hướng đến trang lỗi
        // header("Location: error.php?err=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
