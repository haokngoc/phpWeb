
<?php
$filePath = $_GET['path'];
echo $filePath;
if (empty($filePath)) {
    die("'path' cannot be empty");
}

$filePath = realpath($filePath);
if (!$filePath || !file_exists($filePath)) {
    die("File not found or invalid path: " . $filePath);
}

$fileName = basename($filePath);

header("Content-Disposition: attachment; filename=" . $fileName);
header("Content-Type: " . mime_content_type($filePath));
header("Content-Length: " . filesize($filePath));

readfile($filePath);

