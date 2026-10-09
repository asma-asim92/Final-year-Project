<!DOCTYPE html>
<html>
<head>
    <title>Project Downloads</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>

.content{
    margin-top: 100px;

}


</style>
</head>
<body>
    <?php
include 'nav.php';

?>
    <div class=" content container">
        <h1>Project Downloads</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Access Control</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'connection.php';

                $project_id = $_GET['id'];
                $file_paths = []; // Array to store file paths for WinRAR archive

                // Fetch files associated with the project that have "Public" access control
                $sql = "SELECT * FROM project_files WHERE project_id = '$project_id' AND access_control = 'Public'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $file = $row['file_name'];
                        $access_control = $row['access_control'];

                        $file_name = $row['file_path'];
                        $file_path = "user/uploads/" . $file_name; // Relative path to the user's directory

                        // Check if the file exists and is readable
                        if (file_exists($file_path) && is_readable($file_path)) {
                            // Add file path to the array
                            $file_paths[] = $file_path;

                            echo '<tr>';
                            echo '<td>' . $file . '</td>';
                            echo '<td>' . $access_control . '</td>';
                            // Modify the download link for individual files
                            echo '</tr>';
                        } else {
                            echo '<tr>';
                            echo '<td>' . $file_name . '</td>';
                            echo '<td>File not available</td>';
                            echo '</tr>';
                        }
                    }
                }
                ?>
            </tbody>
        </table>

        <?php
        if (!empty($file_paths)) {
            $zipFileName = "project_files_$project_id.zip"; // Unique ZIP file name
            $zip = new ZipArchive();

            if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
                // Add only the files with access_control set to 'Public' to the ZIP archive
                foreach ($file_paths as $file_path) {
                    $file_name = basename($file_path);
                    $zip->addFile($file_path, $file_name);
                }

                // Close the ZIP archive
                $zip->close();

                // Provide a download link for the ZIP archive (WinRAR format) with the download count
                echo '<p><a href="download_zip.php?id=' . $project_id . '" class="btn btn-primary">Download Public Files (WinRAR)</a></p>';
            } else {
                echo 'Failed to create ZIP archive.';
            }
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>

    <!-- Include Bootstrap JavaScript (optional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
