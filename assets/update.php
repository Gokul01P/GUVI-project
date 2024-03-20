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
    $FirstName = $_POST["fname"];
    $LastName = $_POST["lname"];
    $EmailID = $_POST["email"];
    $Date_of_birth = $_POST["dob"];
    $Age = $_POST["age"];
    $PhoneNumber = $_POST["contact"];
    
    // $bio = $_POST["bio"];

    // Update the user profile in MongoDB
    $result = $mongoCollection->updateOne(
        ['EmailId' => $EmailID], // Filter condition (e.g., email)
        ['$set' => [
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'EmailID' => $EmailID,
            'Date_of_birth' => $dob,
            'Age' => $Age,
            'PhoneNumber' => $PhoneNumber,
            // 'bio' => $bio
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