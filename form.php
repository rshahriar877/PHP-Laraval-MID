<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentname = trim($_POST['studentname']);
    $rollnumber = trim($_POST['rollnumber']);
    $mobile = trim($_POST['mobile']);
    $email = trim($_POST['email']);

    $errors = [];

    // Validate Student Name
    if (!preg_match("/^[a-zA-Z\s]+$/", $studentname)) {
        $errors[] = "Name must contain only letters and spaces.";
    }

    // Validate Roll Number
    if (!preg_match("/^\d+$/", $rollnumber)) {
        $errors[] = "Roll Number must be a unique number.";
    }

    // Validate Mobile Number
    if (!preg_match("/^\d{10,}$/", $mobile)) {
        $errors[] = "Mobile number must be at least 10 digits long.";
    }

    // Validate Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email must be a valid email address.";
    }

    if (empty($errors)) {
        // Check if Roll Number is unique
        $stmt = $conn->prepare("SELECT * FROM students WHERE rollnumber = ?");
        $stmt->bind_param("s", $rollnumber);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errors[] = "Roll Number must be unique.";
        } else {
            // Insert data into database
            $stmt = $conn->prepare("INSERT INTO students (studentname, rollnumber, mobile, email) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $studentname, $rollnumber, $mobile, $email);

            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}

$conn->close();
