<?php
require "../assets/config_Login.php";
require '../assets/vendor/autoload.php';

use MongoDB\Client;

// MongoDB connection parameters
$mongoClient = new Client("mongodb://localhost:27017");
$mongoDatabase = $mongoClient->selectDatabase('MyDb');
$mongoCollection = $mongoDatabase->selectCollection('users');

// Fetch user profile data from MongoDB if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the email address from the POST data
    $email = $_POST['email'];

    // Query MongoDB to find the user profile based on the email address
    $userProfile = $mongoCollection->findOne(['EmailID' => $email]);
    
    // Display user profile data
    if ($userProfile) {
        echo '<p><strong>First Name:</strong> ' . $userProfile['FirstName'] . '</p>';
        echo '<p><strong>Last Name:</strong> ' . $userProfile['LastName'] . '</p>';
        echo '<p><strong>Email:</strong> ' . $userProfile['EmailID'] . '</p>';
        echo '<p><strong>Age:</strong> ' . $userProfile['Age'] . '</p>';
        echo '<p><strong>Contact:</strong> ' . $userProfile['Phone Number'] . '</p>';
        // Add more profile details as needed
    } else {
        echo '<p>No user profile found!</p>';
    }
}
?>
