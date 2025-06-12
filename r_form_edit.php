<?php
include 'r_form_connection.php' ;

// Check if the form was submitted for update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip_code'];
    $country = $_POST['country'];
    $profession = $_POST['profession'];
    $interest = $_POST['intrested_field'];

    // IMPORTANT: Sanitize user input to prevent SQL injection!
    // For simple cases, mysqli_real_escape_string can help, but prepared statements are better.
    $id = mysqli_real_escape_string($con, $id);
    $name = mysqli_real_escape_string($con, $name);
    // ... repeat for all other variables

    $update_query = "UPDATE r_forms SET name='$name', address='$address', city='$city', state='$state', zip_code='$zip', country='$country', profession='$profession', intrested_field='$interest' WHERE id='$id'";

    $data = mysqli_query($con, $update_query);

    if ($data) {
        header('Location: r_form_table.php'); // Corrected header syntax
        exit();
    } else {
        // Handle error if update fails
        echo "Error updating record: " . mysqli_error($con);
        // You might want to log this error instead of echoing in production
    }
}

// This part fetches data for the form when the page is first loaded or after a non-update submission
if (isset($_GET['id'])) { // Ensure 'id' is present in the URL
    $id = $_GET['id'];
    // Sanitize the ID from the GET request to prevent SQL injection
    $id = mysqli_real_escape_string($con, $id);

    $select_query = "SELECT * FROM r_forms WHERE id = '$id'"; // Use single quotes for string comparison in SQL for safety
    $data = mysqli_query($con, $select_query); // Use the correct SELECT query here

    if ($data && mysqli_num_rows($data) > 0) {
        $row = mysqli_fetch_assoc($data);
    } else {
        // Handle case where ID is not found or query fails
        echo "Record not found or error fetching data: " . mysqli_error($con);
        // Redirect or show an error page
        exit();
    }
} else {
    // Handle case where 'id' is not provided in the URL
    echo "No ID provided for editing.";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <script src="https://kit.fontawesome.com/13d6d99986.js" crossorigin="anonymous"></script>
    <style>
       body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            padding: 30px;
        }
form{
    display: inline-block;
    text-align: left;
    border: 2px solid;
    padding: 25px;
    border-radius: 10px;
}
.table-container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 1px 20px rgba(0, 0, 0, 0.2);
        }
        input{
            display: block;
            width: 300px;
            margin-bottom: 15px;
            padding: 8px;
        }
        button {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

    </style>
</head>
<body>
     <h1>Student Details</h1>
    <div class="table-container">
    <form method="POST">
    <h2>Edit Student Info</h2>
    <label>ID</label>
    <input type="text" name="id" value="<?= htmlspecialchars($row['id'] ?? '') ?>" required readonly><br>
    <label>Full Name</label>
    <input type="text" name="name" value="<?= htmlspecialchars($row['name'] ?? '') ?>"><br>
    <label>Address</label>
    <input type="text" name="address" value="<?= htmlspecialchars($row['address'] ?? '') ?>"><br>
    <label>City</label>
    <input type="text" name="city" value="<?= htmlspecialchars($row['city'] ?? '') ?>"><br>
    <label>State</label>
    <input type="text" name="state" value="<?= htmlspecialchars($row['state'] ?? '') ?>"><br>
    <label>ZIP CODE</label>
    <input type="text" name="zip_code" value="<?= htmlspecialchars($row['zip_code'] ?? '') ?>"><br>
    <label>Country</label>
    <input type="text" name="country" value="<?= htmlspecialchars($row['country'] ?? '') ?>"><br>
    <label>You Are</label>
    <input type="text" name="profession" value="<?= htmlspecialchars($row['profession'] ?? '') ?>"><br>
    <label>Interest</label>
    <input type="text" name="intrested_field" value="<?= htmlspecialchars($row['intrested_field'] ?? '') ?>"><br>
    <button type="submit" name="update">Update</button>
</form>
    </div>
</body>
</html>