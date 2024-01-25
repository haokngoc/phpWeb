<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serverHost = '127.0.0.1';
    $serverPort = 12345;
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if (!$socket) {
        echo "Failed to create socket";
        exit();
    }

    $result = socket_connect($socket, $serverHost, $serverPort);
    if (!$result) {
        echo "Failed to connect to server";
        exit();
    }

    $jsondataCMD = "cmd_scan_wifi";
    socket_write($socket, $jsondataCMD, strlen($jsondataCMD));
    
    $scanResults = '';
    while ($buffer = socket_read($socket, 1024)) {
        $scanResults .= $buffer;
    }

    // Close the socket before further operations
    socket_close($socket);

    // Use $scanResults as needed, maybe display or process the scan results

    $response = "Scan results: " . $scanResults;
    header("Location: settings.php?message=" . urlencode($response));
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
