<?php
// Establish a database connection (replace with your database configuration)
include 'connection.php';

if (isset($_GET['id'])) {
    $project_id = $_GET['id'];

    // Check if the project exists in the project_download_count table
    $checkSql = "SELECT * FROM project_download_count WHERE project_id = '$project_id'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        // Project exists, increment the download count
        $sql = "UPDATE project_download_count SET download_count = download_count + 1 WHERE project_id = '$project_id'";
        if ($conn->query($sql) !== TRUE) {
            echo 'Error: ' . $conn->error;
        }
    } else {
        // Project doesn't exist, insert a new row with download count as 1
        $insertSql = "INSERT INTO project_download_count (project_id, download_count) VALUES ('$project_id', 1)";
        if ($conn->query($insertSql) !== TRUE) {
            echo 'Error: ' . $conn->error;
        }
    }

    // Provide the ZIP file for download
    $zipFileName = "project_files_$project_id.zip";
    if (file_exists($zipFileName)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($zipFileName) . '"');
        header('Content-Length: ' . filesize($zipFileName));
        readfile($zipFileName);
    } else {
        echo 'ZIP file not found.';
    }
} else {
    echo 'Invalid request.';
}

$conn->close();

?>
