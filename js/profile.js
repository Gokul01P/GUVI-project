$(document).ready(function(){
    // Fetch user data when the page loads
    fetchUserProfile();

    // Function to fetch user profile data
    function fetchUserProfile() {
        // Retrieve the objectId from localStorage
        var objectId = localStorage.getItem('objectId');

        // Make an AJAX request to fetch user profile data
        $.ajax({
            type: 'POST',
            url: './php/profile.php',
            data: { objectId: objectId },
            success: function(response){
                console.log(response);
                // Parse the JSON response
                var userData = JSON.parse(response);
                
                // Update the profile page with the fetched data
                $('#fname').text('First Name: ' + userData.firstname);
                $('#lname').text('Last Name: ' + userData.lastname);
                $('#email').text('Email: ' + userData.email);
                $('#age').text('Age: ' + userData.age);
                $('#contact').text('Contact: ' + userData.contact);
            },
            error: function(xhr, status, error){
                // Handle error
                console.error(xhr.responseText);
            }
        });
    }
});
