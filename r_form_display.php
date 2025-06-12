<?php
include 'r_form_connection.php';

// Enable error reporting for debugging (IMPORTANT: Disable in production!)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define the directory where files are stored for linking purposes.
// This path MUST match the path used for uploading in 'registration_form.php'.
// Example: If 'single_form_data.php' is in /htdocs/R_FORM/, then this directory should be /htdocs/R_FORM/images/uploaded/
$upload_display_dir = 'images/uploaded/';

// Check if an ID is passed through the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Sanitize the ID to prevent SQL injection
    $id = mysqli_real_escape_string($con, $id);

    // SQL query to select all data for the given ID
    $query = "SELECT * FROM r_forms WHERE id = '$id'";
    $result = mysqli_query($con, $query);

    // Check if the query was successful and if a record was found
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<h2 style='color:red;'>Record not found for ID: " . htmlspecialchars($id) . " or query failed.</h2>";
        exit;
    }
} else {
    echo "<h2 style='color:red;'>No ID specified!</h2>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Single Form Data</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            padding: 30px;
        }
        .table-container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 1px 20px rgba(0, 0, 0, 0.2);
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
            vertical-align: top;
        }
        .clr {
            background-color: #007bff;
            color: white;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        /* New style for uploaded images */
        .uploaded-image {
            max-width: 150px; /* Adjust as needed */
            height: auto;
            display: block; /* Ensures image takes its own line and respects max-width */
            margin: 5px 0;
            border: 1px solid #ddd;
            padding: 2px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<div class="table-container">
    <h2>Selected Student Record</h2>
    <table>
        <tr class="clr">
            <th>ID</th>
            <th>Full Name</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Postal / Zip Code</th>
            <th>Country</th>
            <th>You Are</th>
            <th>Interests</th>
            <th>Uploaded File</th>
        </tr>
        <tr>
            <td><?= htmlspecialchars($row['id'] ?? 'N/A'); ?></td>
            <td><?= htmlspecialchars($row['name'] ?? 'N/A'); ?></td>
            <td><?= htmlspecialchars($row['address'] ?? 'N/A'); ?></td>
            <td><?= htmlspecialchars($row['city'] ?? 'N/A'); ?></td>
            <td><?= htmlspecialchars($row['state'] ?? 'N/A'); ?></td>
            <td><?= htmlspecialchars($row['zip_code'] ?? 'N/A'); ?></td>
            <td><?= htmlspecialchars($row['country'] ?? 'N/A'); ?></td>
            <td><?= htmlspecialchars($row['profession'] ?? 'N/A'); ?></td>
            <td><?= htmlspecialchars($row['intrested_field'] ?? 'N/A'); ?></td>
            <td>
                <?php
                // Check if the 'resume' field in the database is not empty
                if (!empty($row['resume'])) {
                    $file_path = $upload_display_dir . $row['resume'];
                    $file_ext = strtolower(pathinfo($row['resume'], PATHINFO_EXTENSION));

                    // Define common image extensions
                    $image_extensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg'];

                    // Check if the actual file exists on the server
                    if (file_exists($file_path)) {
                        // Check if the file is an image
                        if (in_array($file_ext, $image_extensions)) {
                            // Display the image directly
                            echo '<img src="' . htmlspecialchars($file_path) . '" alt="Uploaded Image" class="uploaded-image">';
                        } else {
                            // For non-image files, provide a clickable link
                            echo '<a href="' . htmlspecialchars($file_path) . '" target="_blank">View Uploaded File</a>';
                        }
                    } else {
                        echo 'File not found on server';
                    }
                } else {
                    echo 'No file uploaded';
                }
                ?>
            </td>
        </tr>
    </table>
</div>
</body>
</html>