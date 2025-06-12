<?php include 'r_form_connection.php' ; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
    <script src="https://kit.fontawesome.com/13d6d99986.js" crossorigin="anonymous"></script>
    <style>
       body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            padding: 30px;
        }
table{
    border: 2px solid;
    border-collapse: collapse;
    margin: 10px;
}
.table-container {
            
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 1px 20px rgba(0, 0, 0, 0.2);
        }
        table {
           
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        table th {
            background-color: #007bff;
            color: white;
        }
        h2 {
            text-align: center;
        }


    </style>
</head>
<body>
    <div class="table-container">
        <h1>Submitted Student Details</h1>
        <table method="post" action="r_form_process.php" enctype="multipart/form-data">
            <tbody>
            <thead>
            <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Postal / Zip Code</th>
            <th>Country</th>
            <th>You Are</th>
            <th>Interests</th>
            <th>Resume</th>
            <th>Action</th>
            <?php
        $result = $con->query("SELECT * FROM r_forms where id = id");
        while ($row = $result->fetch_assoc()):
        ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><a href="r_form_display.php?id=<?= $row['id'] ?>"><?=($row['name']) ?></a></td>
            <td><?= $row['address'] ?></td>
            <td><?= $row['city'] ?></td>
            <td><?= $row['state'] ?></td>
            <td><?= $row['zip_code'] ?></td>
            <td><?= $row['country'] ?></td>
            <td><?= $row['profession'] ?></td>
            <td><?= $row['intrested_field'] ?></td>
            <td><?= $row['resume'] ?></td>
            <td>
            <a href="r_form_edit.php?id=<?= urlencode($row['id']) ?>">
    <button>Edit</button>
</a>

            
            <a href="r_form_delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this entry?');"><button class="action-btn delete-btn"><i class="fas fa-trash-alt"></i> Delete</button></a>

          </td>
          </tr>
        <?php endwhile; ?>
            </tr>
            </thead>
            </tbody>
        </table>
    </div>
</body>
</html>