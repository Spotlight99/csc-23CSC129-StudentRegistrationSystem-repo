<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

$conn = new mysqli($servername, $username, $password, $dbname);


if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM student_records WHERE id=$id");
    header("Location: view.php");
    exit;
}


$result = $conn->query("SELECT * FROM student_records");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registered Students</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th, table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background-color: #007bff;
            color: #fff;
            text-transform: uppercase;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        a.delete-btn {
            color: #fff;
            background: #dc3545;
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            transition: 0.3s;
        }

        a.delete-btn:hover {
            background: #a71d2a;
        }

        a.back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background: #007bff;
            color: #fff;
            padding: 10px 15px;
            border-radius: 6px;
            transition: 0.3s;
        }

        a.back-link:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registered Students</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Matric Number</th>
                <th>Action</th>
            </tr>
            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['full_name']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['department']; ?></td>
                <td><?= $row['matric_number']; ?></td>
                <td><a href="view.php?delete=<?= $row['id']; ?>" class="delete-btn" onclick="return confirm('Delete this student?')">Delete</a></td>
            </tr>
            <?php } ?>
        </table>
        <a href="index.php" class="back-link">Register Another Student</a>
    </div>
</body>
</html>
