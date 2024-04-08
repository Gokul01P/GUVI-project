<?php

require "../assets/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement
    $checkEmailQuery = "SELECT * FROM login WHERE email = ?";
    $stmt = $mysqlConn->prepare($checkEmailQuery);

    // Bind parameters
    $stmt->bind_param("s", $email);

    // Execute query
    $stmt->execute();

    // Store result
    $stmt->store_result();

    // Check if email exists
    if ($stmt->num_rows > 0) {
        echo "\nError: Email already exists\n";
    } else {
        // Close previous statement
        $stmt->close();

        // Prepare insert statement
        $insertSql = "INSERT INTO login (email, password) VALUES (?, ?)";
        $stmt = $mysqlConn->prepare($insertSql);

        // Bind parameters
        $stmt->bind_param("ss", $email, $password);

        // Execute insert query
        if ($stmt->execute()) {
            echo "\nNew record created successfully\n";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();

        // MongoDB
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $dob = $_POST['dob'];
        $contact = $_POST['contact'];

        $data = array(
            "FirstName" => $fname,
            "LastName" => $lname,
            "EmailID" => $email,
            "Date_of_birth" =>$dob,
            "Age" => $age,
            "PhoneNumber" => $contact,
        );

        $insert = $userCollection->insertOne($data);

        if ($insert->getInsertedCount() > 0) {
            echo "\nDocument inserted successfully!";
        } else {
            echo "Error inserting data: " . $insert->getMessage();
        }
    }
    // Close MySQL connection
    $mysqlConn->close();
}
?>
