<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST["new_password"];
    $confirmNewPassword = $_POST["confirm_new_pasword"];
    $jsonFileName = '/var/www/html/web/data.json';
    $jsonData = file_exists($jsonFileName) ? json_decode(file_get_contents($jsonFileName), true) : array();
    $jsonData['account_information']['password'] = $newPassword;
    $json_data = json_encode($jsonData, JSON_PRETTY_PRINT);
    file_put_contents($jsonFileName, $json_data);
    header("Location: home.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
