<?php

require "../assets/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $checkEmailQuery = "SELECT * FROM login WHERE email = '$email'";
    $result = $mysqlConn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        echo "\nError: Email already exists\n";
    } else {
        $insertSql = "INSERT INTO login (email, password) VALUES ('$email', '$password')";
        
        if ($mysqlConn->query($insertSql) === TRUE) {
            echo "\nNew record created successfully\n";
        } else {
            echo "Error: " . $insertSql . "<br>" . $mysqlConn->error;
        }

        // mongoDB
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
        $age = $_POST['age'];
		$contact = $_POST['contact'];

		$data = array(
			"FirstName" => $fname,
			"LastName" => $lname,
			"EmailID" => $email,
            "Age" => $age,
			"Phone Number" => $contact,
		);

		$insert = $userCollection->insertOne($data);

		if ($insert->getInsertedCount() > 0) {
			echo "\nDocument inserted successfully!";
		} else {
			echo "Error inserting data: " . $insert->getMessage();
		}
    }
    $mysqlConn->close();
}
?>
