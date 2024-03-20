<?php
session_start();

require "config.php"; // Include your MongoDB connection configuration

// Check if user is logged in, redirect to login page if not
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

// Fetch user profile data from MongoDB
$user_email = $_SESSION['user_email'];
$filter = ['Email ID' => $user_email];
$user_profile_data = $userCollection->findOne($filter);

// Check if user profile data exists
if (!$user_profile_data) {
    echo "Error: User profile not found!";
    exit;
}
?>