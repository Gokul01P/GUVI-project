<?php
// Include MongoDB extension
require '../assets/vendor/autoload.php';

use MongoDB\Client;

// MongoDB connection parameters
$mongoClient = new Client("mongodb://localhost:27017");
$mongoDatabase = $mongoClient->selectDatabase('MyDb'); // Replace 'your_database_name' with your actual database name
$mongoCollection = $mongoDatabase->selectCollection('users'); // Replace 'user_profiles' with your actual collection name


// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $FirstName = $_POST["FirstName"];
    $LastName = $_POST["LastName"];
    $EmailID = $_POST["EmailID"];
    $Date_of_birth = $_POST["Date_of_birth"];
    $Age = $_POST["Age"];
    $PhoneNumber = $_POST["PhoneNumber"];

    // Update the user profile in MongoDB

    var_dump($EmailID);
    
    $result = $mongoCollection->updateOne(
        ['EmailID' => $EmailID], // Filter condition (e.g., email)
        ['$set' => [
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'EmailID' => $EmailID,
            'Date_of_birth' => $Date_of_birth,
            'Age' => $Age,
            'PhoneNumber' => $PhoneNumber,
        ]]
    );

    // Check if the update was successful
    if ($result->getModifiedCount() > 0) {
        // Return success response
        echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully']);
    } else {
        // Return error response
        echo json_encode(['status' => 'error', 'message' => 'Failed to update profile']);
    }
} else {
    // If the request method is not POST, return an error
    http_response_code(405); // Method Not Allowed
    echo "Only POST requests are allowed!";
}
?>