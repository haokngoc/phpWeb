<?php
// Đường dẫn đến tệp JSON
$jsonFileName = '/home/hk/eclipse-workspace/01_IMX8_Server_x86/received_data.json';

// Đọc dữ liệu từ tệp JSON
$jsonData = file_get_contents($jsonFileName);
$data = json_decode($jsonData, true);

// Kiểm tra xem có dữ liệu không trước khi sử dụng
if ($data) {
    $ipAddress = isset($data['settings']['ip-address']) ? $data['settings']['ip-address'] : '';
    $loggingLevel = isset($data['settings']['logging-level']) ? $data['settings']['logging-level'] : '';
    $wirelessMode = isset($data['settings']['wireless-mode']) ? $data['settings']['wireless-mode'] : '';
    $wirelessSSID = isset($data['settings']['wireless-SSID']) ? $data['settings']['wireless-SSID'] : '';
    $wirelessPassPhrase = isset($data['settings']['wireless-Pass-Phrase']) ? $data['settings']['wireless-Pass-Phrase'] : '';
} else {
    // Xử lý trường hợp không đọc được dữ liệu từ tệp JSON
    $ipAddress = $loggingMethod = $loggingLevel = $wirelessMode = $wirelessSSID = $wirelessPassPhrase = '';
}
$response1 = isset($_GET['response1']) ? $_GET['response1'] : '';
$response2 = isset($_GET['response2']) ? $_GET['response2'] : '';
$message = isset($_GET['message']) ? urldecode($_GET['message']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" href="logo.jpg" type="image">
    <link rel="stylesheet" href="main.css">
    <style>
        .notification {
            position: fixed;
            top: 83%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #4CAF50;
            color: #fff;
            padding: 15px;
            border-radius: 5px;
            /* display: none; */
            z-index: 1000; 
        }
        .wireless-settings input[type="text"].access-point {
            border: none;
            outline: none;
        }

    </style>
</head>
<body>
<?php include('navigation.php'); ?>
<div class="container">

    <form action="save_data_setting.php" method="post">
        <p><strong>Network Settings</strong></p>
        <label for="ip-address">IP Address:</label>
        <input type="text" id="ip-address" name="ip-address" pattern="(?:[0-9]{1,3}\.){3}[0-9]{1,3}" title="Enter a valid IP address" required value="<?php echo $ipAddress; ?>"> 

        <p><strong>Logging Settings</strong></p>
        <label for="logging-level">Logging Level:</label>
        <select id="logging-level" name="logging-level">
            <option value="debug" <?php echo ($loggingLevel === 'debug') ? 'selected' : ''; ?>>Debug</option>
            <option value="info" <?php echo ($loggingLevel === 'info') ? 'selected' : ''; ?>>Info</option>
            <option value="warning" <?php echo ($loggingLevel === 'warning') ? 'selected' : ''; ?>>Warning</option>
            <option value="error" <?php echo ($loggingLevel === 'error') ? 'selected' : ''; ?>>Error</option>
        </select>

        <p><strong>Wireless Settings</strong></p>
        <label>Wireless Mode:</label>
        <input type="radio" id="station" name="wireless-mode" value="station" <?php echo ($wirelessMode === 'station') ? 'checked' : ''; ?>>
        <label for="station">Station</label>

        <input type="radio" id="access-point" name="wireless-mode" value="access-point" <?php echo ($wirelessMode === 'access-point') ? 'checked' : ''; ?>>
        <label for="access-point">Access Point</label>

        <!-- Thêm một lớp CSS để chứa các trường cài đặt không hiển thị mặc định -->
        <div class="wireless-settings">
            <p>Valid SSID and Pass Phrase characters are 0-9,A-Z,a-z,!#%+,-,.?[]^_}</p>
            <br>
            <label for="wireless-SSID">Wireless SSID:</label>
            <input type="text" id="wireless-SSID" name="wireless-SSID" <?php echo ($wirelessMode === 'access-point') ? 'value="voyance" readonly' : 'value="' . $wirelessSSID . '"'; ?>>
            <br>
            <label for="wireless-Pass-Phrase">Wireless Pass Phrase:</label>
            <input type="text" id="wireless-Pass-Phrase" name="wireless-Pass-Phrase" <?php echo ($wirelessMode === 'access-point') ? 'value="123456789" readonly' : 'value="' . $wirelessPassPhrase . '"'; ?>>
            <br>
        </div>
        <button class = "btnUpdate" type="submit" name="update-button">Update</button>
    </form>
    <br>

    <form action="scan_wifi.php" method="post">
        <button class = "btnScan" type="submit" name="scan-button">Scan WiFi</button>
    </form>
        <br>
        
    <div id="notification" class="notification"></div>
    <div id="notification2" class="notification2"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var wirelessModeRadio = document.getElementsByName('wireless-mode');
            var wirelessSettings = document.querySelector('.wireless-settings');
            var wirelessSSIDInput = document.getElementById('wireless-SSID');
            var wirelessPassPhraseInput = document.getElementById('wireless-Pass-Phrase');

            function updateWirelessSettings() {
                var selectedMode = Array.from(wirelessModeRadio).find(radio => radio.checked).value;

                // Đặt các giá trị từ JSON cho Wireless SSID và Pass Phrase khi chọn "Station"
                if (selectedMode === 'station') {
                    wirelessSSIDInput.value = '<?php echo $wirelessSSID; ?>';
                    wirelessPassPhraseInput.value = '<?php echo $wirelessPassPhrase; ?>';
                    // Loại bỏ lớp CSS 'access-point' khi chọn "Station"
                    wirelessSSIDInput.classList.remove('access-point');
                    wirelessPassPhraseInput.classList.remove('access-point');
                } else {
                    // Đặt giá trị mặc định cho Wireless SSID và Pass Phrase khi chọn "Access Point"
                    wirelessSSIDInput.value = 'voyance';
                    wirelessPassPhraseInput.value = '123456789';
                    // Thêm lớp CSS 'access-point' vào các ô nhập khi chọn "Access Point"
                    wirelessSSIDInput.classList.add('access-point');
                    wirelessPassPhraseInput.classList.add('access-point');
                }

                // Đặt thuộc tính readonly dựa trên chế độ được chọn
                wirelessSSIDInput.readOnly = (selectedMode === 'access-point');
                wirelessPassPhraseInput.readOnly = (selectedMode === 'access-point');
            }

            // Gắn hàm updateWirelessSettings vào sự kiện change của các nút radio
            wirelessModeRadio.forEach(function (radio) {
                radio.addEventListener('change', updateWirelessSettings);
            });

            // Gọi hàm này lúc ban đầu để đặt trạng thái ban đầu dựa trên nút radio được chọn
            updateWirelessSettings();
        });
        document.addEventListener('DOMContentLoaded', function () {
            // Lấy thông báo từ tham số URL
            var urlParams = new URLSearchParams(window.location.search);
            var message = urlParams.get('message');
            var response1 = urlParams.get('response1');
            var response2 = urlParams.get('response2');
            var response3 = urlParams.get('response3');



            // Tạo một thông báo kết hợp từ response1 và response2
            var combinedMessage = (response1 ? 'Ip address current: ' + response1 + '\n' : '') +
                    (response2 ? 'Response: ' + response2 + '\n' : '') +
                    (response3 ? 'Info wifi: ' + response3 + '\n' : '');

            // Nếu có thông báo từ URL, thêm vào thông báo kết hợp
            if (message) {
                combinedMessage += message;
            }

            // Hiển thị thông báo nếu có
            if (combinedMessage) {
                var notificationElement = document.getElementById('notification');
                notificationElement.innerText = combinedMessage;
                notificationElement.style.display = 'block';
                setTimeout(function () {
                    notificationElement.style.display = 'none';
                }, 3000);
            }
        });
        document.addEventListener('DOMContentLoaded', function () {
            // Lấy thông báo từ tham số URL
            var urlParams = new URLSearchParams(window.location.search);
            var message = urlParams.get('message');

            // Hiển thị thông báo nếu có
            if (message) {
                var notificationElement = document.getElementById('notification2');
                notificationElement.innerText = message;
                notificationElement.style.display = 'block';
            }
        }); 


        const btnUpdate = document.queryselector(".btnUpdate");
        btnUpdate.addEventListener('click', (e) =>{
            e.preventdefault();
            console.log(('ds'))
        })
    </script>

</div>
</body>
</html>
