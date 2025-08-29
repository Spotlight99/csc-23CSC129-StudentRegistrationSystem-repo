<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("<div class='error'>❌ Database Connection Failed: " . $conn->connect_error . "</div>");
}


$full_name = trim($_POST['full_name']);
$email = trim($_POST['email']);
$department = trim($_POST['department']);
$matric_number = trim($_POST['matric_number']);


if (empty($full_name) || empty($email) || empty($department) || empty($matric_number)) {
    die("<div class='error'>⚠️ All fields are required!</div>");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("<div class='error'>⚠️ Invalid email format!</div>");
}
$sql = "INSERT INTO student_records (full_name, email, department, matric_number)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $full_name, $email, $department, $matric_number);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .message-box {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
            width: 400px;
        }
        .success {
            color: #155724;
            background-color: #d4edda;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .error {
            color: #721c24;
            background-color: #f8d7da;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 16px;
        }
        a {
            text-decoration: none;
            background: #007bff;
            color: #fff;
            padding: 10px 15px;
            border-radius: 6px;
            transition: 0.3s;
        }
        a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <?php
        if ($stmt->execute()) {
            echo "<div class='success'>✅ Student registered successfully!</div>";
            echo "<a href='view.php'>View Students</a> | <a href='index.php'>Register Another</a>";
        } else {
            echo "<div class='error'>❌ Error: " . $stmt->error . "</div>";
            echo "<a href='index.php'>Go Back</a>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
