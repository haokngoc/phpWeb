<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {

        $targetDir = "uploads/";

        $fileName = basename($_FILES["fileToUpload"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
            $jsonFileName = 'data.json';
            $jsonData = file_exists($jsonFileName) ? json_decode(file_get_contents($jsonFileName), true) : array();

            $jsonData['firmware']['filename'] = $fileName;
            $jsonData['firmware']['path'] = $targetFilePath;


            $json_data = json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            file_put_contents($jsonFileName, $json_data);

            header("Location: firmware.php");
            exit();
        } else {
            header("Location: upload_failure.php");
            exit();
        }
        // xu ly loi
    } else {
        header("Location: upload_error.php");
        exit();
    }
} else {
    header("Location: upload_form.php");
    exit();
}
?>